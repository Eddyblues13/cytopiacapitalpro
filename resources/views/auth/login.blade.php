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

    <title>cytopia capital pro - Sign In</title>
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
        body {
            background-color: rgb(8, 7, 30);
            color: white;
            font-family: "Poppins", serif;
            font-weight: 400;
            font-style: normal;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo img {
            width: 80px;
            height: 80px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            width: 20px;
            height: 20px;
        }

        .form-input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: none;
            border-radius: 8px;
            background: none;
            font-size: 1rem;
            color: #1a1f2b;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        .sign-in-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(225deg, #3045ff, #ae2aff 76%, #ff5d02);
            color: white;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 20px;
            transition: opacity 0.3s;
        }

        .sign-in-button:hover {
            background-color: #0287df !important;
        }

        .forgot-password {
            display: block;
            text-align: center;
            color: #0d6efd;
            text-decoration: none;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .signup-prompt {
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .signup-link {
            color: #0d6efd;
            text-decoration: none;
            margin-left: 5px;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

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
</head>

<body>
    <div class="login-container">
        <a href="#" class="text-decoration-none">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Logo">
            </div>
        </a>

        <form id="loginForm">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    <input type="email" name="email" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="password" name="password" class="form-input" required>
                </div>
            </div>

            <button type="submit" class="sign-in-button" id="submitButton">
                <span id="buttonText">Sign In</span>
                <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
            </button>

            <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>

            <div class="signup-prompt">
                Don't have an account?<a href="{{route('register')}}" class="signup-link">Sign Up</a>
            </div>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        // Show loading spinner and disable button
        $('#buttonText').hide();
        $('#loadingSpinner').show();
        $('#submitButton').prop('disabled', true);

        // Send AJAX request
        $.ajax({
            url: '{{ route("login") }}', // Replace with your Laravel route
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
</body>

</html>