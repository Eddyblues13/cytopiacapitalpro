@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Create New User</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <form id="createUserForm" method="POST" action="{{ route('admin.users.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div id="formErrors" class="alert alert-danger d-none"></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">First Name</label>
                                                <input type="text" name="first_name"
                                                    class="form-control bg-dark text-light" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Last Name</label>
                                                <input type="text" name="last_name"
                                                    class="form-control bg-dark text-light" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Email</label>
                                        <input type="email" name="email" class="form-control bg-dark text-light"
                                            required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control bg-dark text-light" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Confirm Password</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control bg-dark text-light" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Phone Number</label>
                                                <input type="text" name="phone_number"
                                                    class="form-control bg-dark text-light">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Country</label>
                                                <select name="country" class="form-control bg-dark text-light" required>
                                                    <option value="">Select Country</option>
                                                    @foreach(config('countries') as $code => $name)
                                                    <option value="{{ $name }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">City</label>
                                                <input type="text" name="city" class="form-control bg-dark text-light">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Currency</label>
                                                <select name="currency" class="form-control bg-dark text-light">
                                                    <option value="">Select Currency</option>
                                                    <option value="USD">USD</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="GBP">GBP</option>
                                                    <!-- Add more currencies as needed -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Profile Photo</label>
                                                <input type="file" name="profile_photo"
                                                    class="form-control-file bg-dark text-light">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Referred By</label>
                                                <select name="referred_by" class="form-control bg-dark text-light">
                                                    <option value="">None</option>
                                                    @foreach($referrers as $referrer)
                                                    <option value="{{ $referrer->id }}">{{ $referrer->first_name }} {{
                                                        $referrer->last_name }} ({{ $referrer->referral_code }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Status</label>
                                        <select name="user_status" class="form-control bg-dark text-light" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="banned">Banned</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create User</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
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
    $('#createUserForm').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        
        // Reset errors
        errorContainer.addClass('d-none').empty();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...');
        
        // Create FormData object for file upload
        const formData = new FormData(this);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Create User');
                
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