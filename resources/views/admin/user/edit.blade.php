@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Edit User: {{ $user->first_name }} {{ $user->last_name }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <form id="editUserForm" method="POST"
                                    action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div id="formErrors" class="alert alert-danger d-none"></div>

                                    <div class="text-center mb-4">
                                        @if($user->profile_photo)
                                        <img src="{{ asset($user->profile_photo) }}" class="rounded-circle" width="120"
                                            height="120">
                                        @else
                                        <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                            style="width: 120px; height: 120px; font-size: 48px;">
                                            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">First Name</label>
                                                <input type="text" name="first_name"
                                                    class="form-control bg-dark text-light"
                                                    value="{{ $user->first_name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Last Name</label>
                                                <input type="text" name="last_name"
                                                    class="form-control bg-dark text-light"
                                                    value="{{ $user->last_name }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Email</label>
                                        <input type="email" name="email" class="form-control bg-dark text-light"
                                            value="{{ $user->email }}" required>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Phone Number</label>
                                                <input type="text" name="phone_number"
                                                    class="form-control bg-dark text-light"
                                                    value="{{ $user->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Country</label>
                                                <select name="country" class="form-control bg-dark text-light" required>
                                                    <option value="">Select Country</option>
                                                    @foreach(config('countries') as $code => $name)
                                                    <option value="{{ $name }}" {{ $user->country == $name ? 'selected'
                                                        : '' }}>{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">City</label>
                                                <input type="text" name="city" class="form-control bg-dark text-light"
                                                    value="{{ $user->city }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Currency</label>
                                                <select name="currency" class="form-control bg-dark text-light">
                                                    <option value="">Select Currency</option>
                                                    <option value="USD" {{ $user->currency == 'USD' ? 'selected' : ''
                                                        }}>USD</option>
                                                    <option value="EUR" {{ $user->currency == 'EUR' ? 'selected' : ''
                                                        }}>EUR</option>
                                                    <option value="GBP" {{ $user->currency == 'GBP' ? 'selected' : ''
                                                        }}>GBP</option>
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
                                                    <option value="{{ $referrer->id }}" {{ $user->referred_by ==
                                                        $referrer->id ? 'selected' : '' }}>
                                                        {{ $referrer->first_name }} {{ $referrer->last_name }} ({{
                                                        $referrer->referral_code }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Status</label>
                                                <select name="user_status" class="form-control bg-dark text-light"
                                                    required>
                                                    <option value="active" {{ $user->user_status == 'active' ?
                                                        'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $user->user_status == 'inactive' ?
                                                        'selected' : '' }}>Inactive</option>
                                                    <option value="banned" {{ $user->user_status == 'banned' ?
                                                        'selected' : '' }}>Banned</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-light">Signal Strength</label>
                                                <select name="signal_strength" class="form-control bg-dark text-light">
                                                    @for($i = 1; $i <= 100; $i++) <option value="{{ $i }}" {{ $user->
                                                        signal_strength == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-light" for="emailVerification">Email Verified</label>
                                                <select name="email_verification" id="emailVerification"
                                                    class="form-control bg-dark text-light">
                                                    <option value="1" {{ $user->email_verification ? 'selected' : ''
                                                        }}>Yes</option>
                                                    <option value="0" {{ !$user->email_verification ? 'selected' : ''
                                                        }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-light" for="idVerification">ID Verified</label>
                                                <select name="id_verification" id="idVerification"
                                                    class="form-control bg-dark text-light">
                                                    <option value="1" {{ $user->id_verification ? 'selected' : '' }}>Yes
                                                    </option>
                                                    <option value="0" {{ !$user->id_verification ? 'selected' : '' }}>No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-light" for="addressVerification">Address
                                                    Verified</label>
                                                <select name="address_verification" id="addressVerification"
                                                    class="form-control bg-dark text-light">
                                                    <option value="1" {{ $user->address_verification ? 'selected' : ''
                                                        }}>Yes</option>
                                                    <option value="0" {{ !$user->address_verification ? 'selected' : ''
                                                        }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update User</button>
                                        <a href="{{ route('admin.user.view', $user->id) }}"
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
    $('#editUserForm').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        
        // Reset errors
        errorContainer.addClass('d-none').empty();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
        
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
                submitBtn.prop('disabled', false).html('Update User');
                
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