@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-light">Identity Verification #{{ $verification->id }}</h1>
                    <a href="{{ route('admin.users.identity-verifications.index', $user->id) }}"
                        class="btn btn-secondary">Back to List</a>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow bg-dark">
                            <div class="card-header">
                                <h4 class="card-title text-light">Front Photo</h4>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset($verification->front_photo_path) }}" class="img-fluid"
                                    style="max-height: 500px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow bg-dark">
                            <div class="card-header">
                                <h4 class="card-title text-light">Back Photo</h4>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset($verification->back_photo_path) }}" class="img-fluid"
                                    style="max-height: 500px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="text-light"><strong>Status:</strong>
                                            <span class="badge 
                                            @if($user->id_verification)
                                                bg-success
                                            @else
                                                bg-danger
                                            @endif">
                                                {{ $user->id_verification ? 'Verified' : 'Not Verified' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-light"><strong>Submitted At:</strong> {{
                                            $verification->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-light"><strong>Verified At:</strong>
                                            @if($verification->updated_at)
                                            {{ $verification->updated_at->format('M d, Y H:i') }}
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if($verification->status == 'rejected')
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <p class="text-light"><strong>Rejection Reason:</strong> {{
                                            $verification->rejection_reason }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($verification->status == 'pending')
                                <div class="row mt-4">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <form
                                            action="{{ route('admin.users.identity-verifications.approve', [$user->id, $verification->id]) }}"
                                            method="POST" class="d-inline" data-ajax-form>
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-danger ml-2" data-toggle="modal"
                                            data-target="#rejectModal">Reject</button>

                                        <!-- Reject Modal -->
                                        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog"
                                            aria-labelledby="rejectModalLabel" aria-hidden="true">
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
                                                        action="{{ route('admin.users.identity-verifications.reject', [$user->id, $verification->id]) }}"
                                                        method="POST" data-ajax-form>
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="text-light">Reason for Rejection</label>
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
                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-outline-danger btn-sm ml-1"
                                            data-toggle="modal" data-target="#deleteModal{{ $verification->id }}">
                                            Delete
                                        </button>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $verification->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-light" id="deleteModalLabel">Confirm
                                                            Deletion</h5>
                                                        <button type="button" class="close text-light"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('admin.users.identity-verifications.destroy', [$user->id, $verification->id]) }}"
                                                        method="POST" data-ajax-form>
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body text-light">
                                                            Are you sure you want to delete this verification record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
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