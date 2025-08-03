<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="bingbot" content="noindex, nofollow">
    <meta name="scam-advisor" content="noindex, nofollow">
    <meta name="scam-adviser" content="noindex, nofollow">
    <meta name="scamadviser" content="noindex, nofollow">
    <meta name="google" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>cytopia capital pro - Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&family=Sahitya:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        /* Your existing CSS styles */
    </style>
</head>

<body>
    <div class="login-container">
        <a href="#" class="text-decoration-none">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Logo">
            </div>
        </a>

        <form id="resetPasswordForm">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <input type="email" name="email" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">New Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password_confirmation" class="form-input" required>
                </div>
            </div>

            <button type="submit" class="sign-in-button" id="submitButton">
                <span id="buttonText">Reset Password</span>
                <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
            </button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#resetPasswordForm').on('submit', function (e) {
                e.preventDefault();

                // Show loading spinner and disable button
                $('#buttonText').hide();
                $('#loadingSpinner').show();
                $('#submitButton').prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: '{{ route("password.update") }}', // Route to handle password reset
                    method: 'POST',
                    data: $(this).serialize(),
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

                            // Redirect to login page
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
</body>

</html>