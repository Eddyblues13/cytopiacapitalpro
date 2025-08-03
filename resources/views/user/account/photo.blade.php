@include('user.layouts.header')
<style>
    /* Loading spinner */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<!-- Main Content -->
<div class="depost-form-main w-100">
    <h2 class="heading text-white fs-4 py-3">Update Photo</h2>
    <div class="fund-same-card">
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center mb-5">
                        <img src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('assets/img/human.png') }}"
                            class="account-profile-avatar mx-auto mb-1">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex gap-3 align-items-center">
                        <input type="file" id="photoInput" name="photo" accept="image/*">
                        <button type="button" class="btn btn-select"
                            onclick="document.getElementById('photoInput').click()">
                            Select Photo
                        </button>
                        <div class="file-name-display flex-grow-1"></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="withdrawal-btn" id="submitButton">
                <span id="buttonText">Update</span>
                <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            // Create FormData object
            var formData = new FormData(this);

            // Send AJAX request
            $.ajax({
                url: '{{ route("account.upload.photo") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);

                    if (response.success) {
                        // Show success message
                        toastr.success(response.message);

                        // Redirect to the specified URL
                        window.location.href = response.redirect;
                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);

                    // Show error message
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>

@include('user.layouts.footer')