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
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Manage Deposits</h1>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 card shadow p-4 bg-dark">
                        <div class="table-responsive" data-example-id="hoverable-table">
                            <table id="DepositTable" class="table table-hover text-light">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Account Type</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deposits as $deposit)
                                    <tr>
                                        <td>{{ $deposit->user->first_name }} {{ $deposit->user->last_name }}</td>
                                        <td>${{ number_format($deposit->amount, 2) }}</td>
                                        <td>{{ ucfirst($deposit->account_type) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($deposit->status == 'approved') badge-success
                                                @elseif($deposit->status == 'rejected') badge-danger
                                                @else badge-warning
                                                @endif">
                                                {{ ucfirst($deposit->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $deposit->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            @if($deposit->status == 'pending')
                                            <div class="btn-group">
                                                <form action="{{ route('admin.deposits.approve', $deposit->id) }}"
                                                    method="POST" class="d-inline" data-ajax-form>
                                                    @csrf 
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.deposits.reject', $deposit->id) }}"
                                                    method="POST" class="d-inline ml-1" data-ajax-form>
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </div>
                                            @else
                                            <span class="text-muted">No actions available</span>
                                            @endif
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
        $('#DepositTable').DataTable({
            order: [[4, 'desc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf']
        });

        $(".dataTables_length select").addClass("bg-dark text-light");
        $(".dataTables_filter input").addClass("bg-dark text-light");

        // Handle approve/reject with AJAX
        $('form[data-ajax-form]').submit(function(e) {
            e.preventDefault();
            
            const form = $(this);
            const button = form.find('[type="submit"]');
            const action = form.attr('action').includes('approve') ? 'approve' : 'reject';
            
            if(confirm(`Are you sure you want to ${action} this deposit?`)) {
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