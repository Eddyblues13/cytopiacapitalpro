@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-light">Withdrawals for {{ $user->name }}</h1>
                    <div>
                        <a href="{{ route('admin.users.withdrawals.create', $user->id) }}" class="btn btn-primary">Add
                            New Withdrawal</a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
                    </div>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 card shadow p-4 bg-dark">
                        <div class="table-responsive" data-example-id="hoverable-table">
                            <table id="WithdrawalTable" class="table table-hover text-light">
                                <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>
                                            @if($withdrawal->account_type == 'crypto')
                                            {{ number_format($withdrawal->amount, 8) }} {{
                                            strtoupper($withdrawal->crypto_currency) }}
                                            @else
                                            ${{ number_format($withdrawal->amount, 2) }}
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($withdrawal->account_type) }}</td>
                                        <td>
                                            @if($withdrawal->account_type == 'crypto')
                                            {{ $withdrawal->wallet_address }}
                                            @else
                                            Bank Transfer
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($withdrawal->status == 'approved') badge-success
                                                @elseif($withdrawal->status == 'rejected') badge-danger
                                                @else badge-warning
                                                @endif">
                                                {{ ucfirst($withdrawal->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.users.withdrawals.edit', [$user->id, $withdrawal->id]) }}"
                                                    class="btn btn-warning btn-sm mr-1">Edit</a>
                                                <form
                                                    action="{{ route('admin.users.withdrawals.destroy', [$user->id, $withdrawal->id]) }}"
                                                    method="POST" class="d-inline" data-ajax-delete>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                @if($withdrawal->status == 'pending')
                                                <form
                                                    action="{{ route('admin.users.withdrawals.approve', [$user->id, $withdrawal->id]) }}"
                                                    method="POST" class="d-inline ml-1" data-ajax-form>
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.users.withdrawals.reject', [$user->id, $withdrawal->id]) }}"
                                                    method="POST" class="d-inline ml-1" data-ajax-form>
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-secondary btn-sm">Reject</button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    $(document).ready(function () {
        $('#WithdrawalTable').DataTable({
            order: [[4, 'desc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf']
        });

        $(".dataTables_length select").addClass("bg-dark text-light");
        $(".dataTables_filter input").addClass("bg-dark text-light");

        // Handle delete with AJAX
        $('form[data-ajax-delete]').submit(function(e) {
            e.preventDefault();
            
            const form = $(this);
            const button = form.find('[type="submit"]');
            
            if(confirm('Are you sure you want to delete this withdrawal?')) {
                // Show loading state
                button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...');
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status === 'success') {
                            toastr.success(response.message);
                            form.closest('tr').fadeOut(300, function() {
                                $(this).remove();
                            });
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        toastr.error(response.message || 'An error occurred');
                        button.prop('disabled', false).html('Delete');
                    }
                });
            }
        });

        // Handle approve/reject with AJAX
        $('form[data-ajax-form]').submit(function(e) {
            e.preventDefault();
            
            const form = $(this);
            const button = form.find('[type="submit"]');
            const action = form.attr('action').includes('approve') ? 'approve' : 'reject';
            
            if(confirm(`Are you sure you want to ${action} this withdrawal?`)) {
                // Show loading state
                button.prop('disabled', true).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${action.charAt(0).toUpperCase() + action.slice(1)}ing...`);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status === 'success') {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        toastr.error(response.message || 'An error occurred');
                        button.prop('disabled', false).html(action.charAt(0).toUpperCase() + action.slice(1));
                    }
                });
            }
        });
    });
</script>