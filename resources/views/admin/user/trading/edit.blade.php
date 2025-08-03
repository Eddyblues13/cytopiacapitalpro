@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Edit Trading History for {{ $user->name }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <form id="editHistoryForm" method="POST"
                                    action="{{ route('admin.users.trading-histories.update', [$user->id, $history->id]) }}">
                                    @csrf
                                    @method('PUT')

                                    <div id="formErrors" class="alert alert-danger d-none"></div>

                                    <div class="form-group">
                                        <label class="text-light">Trader</label>
                                        <select name="trader_id" class="form-control bg-dark text-light" required>
                                            @foreach($traders as $trader)
                                            <option value="{{ $trader->id }}" {{ $history->trader_id == $trader->id ?
                                                'selected' : '' }}>{{ $trader->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Amount</label>
                                        <input type="number" step="0.01" name="amount"
                                            class="form-control bg-dark text-light" value="{{ $history->amount }}"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Status</label>
                                        <select name="status" class="form-control bg-dark text-light" required>
                                            <option value="pending" {{ $history->status == 'pending' ? 'selected' : ''
                                                }}>Pending</option>
                                            <option value="completed" {{ $history->status == 'completed' ? 'selected' :
                                                '' }}>Completed</option>
                                            <option value="failed" {{ $history->status == 'failed' ? 'selected' : ''
                                                }}>Failed</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update History</button>
                                        <a href="{{ route('admin.users.trading-histories.index', $user->id) }}"
                                            class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
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
    $('#editHistoryForm').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        
        // Reset errors
        errorContainer.addClass('d-none').empty();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Update History');
                
                if(xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="mb-0">';
                    
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    
                    errorHtml += '</ul>';
                    errorContainer.html(errorHtml).removeClass('d-none');
                } else {
                    // Other errors
                    const response = xhr.responseJSON;
                    toastr.error(response.message || 'An error occurred');
                }
            }
        });
    });
});
</script>