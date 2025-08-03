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

        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-light">address Verifications for {{ $user->name }}</h1>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 card shadow p-4 bg-dark">
                        <div class="table-responsive" data-example-id="hoverable-table">
                            <table id="VerificationTable" class="table table-hover text-light">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Submitted At</th>
                                        <th>Verified At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($verifications as $verification)
                                    <tr>
                                        <td>#{{ $verification->id }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($user->address_verification)
                                                    bg-success
                                                @else
                                                    bg-danger
                                                @endif">
                                                {{ $user->address_verification ? 'Verified' : 'Not Verified' }}
                                            </span>
                                        </td>

                                        <td>{{ $verification->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            @if($verification->updated_at)
                                            {{ $verification->updated_at->format('M d, Y H:i') }}
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.address-verifications.show', [$user->id, $verification->id]) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            @if($user->email_verification)
                                            <form
                                                action="{{ route('admin.users.address-verifications.approve', [$user->id, $verification->id]) }}"
                                                method="POST" class="d-inline ml-1" data-ajax-form>
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm ml-1" data-toggle="modal"
                                                data-target="#rejectModal{{ $verification->id }}">Reject</button>

                                            <!-- Reject Modal -->
                                            <div class="modal fade" id="rejectModal{{ $verification->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Reject
                                                                Verification</h5>
                                                            <button type="button" class="close text-light"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('admin.users.address-verifications.reject', [$user->id, $verification->id]) }}"
                                                            method="POST" data-ajax-form>
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="text-light">Reason for
                                                                        Rejection</label>
                                                                    <textarea name="reason"
                                                                        class="form-control bg-dark text-light" rows="3"
                                                                        required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Confirm
                                                                    Rejection</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
        $('#VerificationTable').DataTable({
            order: [[2, 'desc']],
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
            
            // Show loading state
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
            
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
                    button.prop('disabled', false).html(function() {
                        return $(this).data('original-text') || $(this).text();
                    });
                }
            });
        });
    });
</script>