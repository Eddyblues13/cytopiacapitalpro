@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Create New Plan</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <form id="createPlanForm" method="POST" action="{{ route('admin.plans.store') }}">
                                    @csrf

                                    <div id="formErrors" class="alert alert-danger d-none"></div>

                                    <div class="form-group">
                                        <label class="text-light">Plan Name</label>
                                        <input type="text" name="name" class="form-control bg-dark text-light" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Price ($)</label>
                                        <input type="number" step="0.01" name="price"
                                            class="form-control bg-dark text-light" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Swap Fee</label>
                                        <select name="swap_fee" class="form-control bg-dark text-light">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Number of Trading Pairs</label>
                                        <input type="number" name="pairs" class="form-control bg-dark text-light"
                                            value="76" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Leverage (optional)</label>
                                        <input type="text" name="leverage" class="form-control bg-dark text-light"
                                            placeholder="e.g. 1:500">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Spread (optional)</label>
                                        <input type="text" name="spread" class="form-control bg-dark text-light"
                                            placeholder="e.g. 0.8 pips">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create Plan</button>
                                        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
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
    $('#createPlanForm').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        
        // Reset errors
        errorContainer.addClass('d-none').empty();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...');
        
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
                submitBtn.prop('disabled', false).html('Create Plan');
                
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