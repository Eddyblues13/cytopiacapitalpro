<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cytopia capital pro - Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&family=Sahitya:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body {
            background-color: #000000;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: "Poppins", serif;
            font-weight: 400;
            font-style: normal;
        }

        .card {
            background-color: #121825;
            border: none;
            border-radius: 12px;
        }

        .card-title {
            color: #0d6efd;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: transparent;
            border: 1px solid #30363d;
            color: white;
            padding: 0.5rem;
            font-size: 1rem;
        }

        .form-control:focus {
            background-color: #0d1117;
            border-color: #0d6efd;
            color: white;
            box-shadow: none;
        }

        .btn-gradient {
            background: linear-gradient(225deg, #3045ff, #ae2aff 76%, #ff5d02);
            border: none;
            color: white;
            border-color: #0d6efd;
            padding: 0.5rem;
            width: 100%;
            margin-bottom: 1rem;
            font-weight: 500;
            transition: opacity 0.3s;
            border-radius: 20px;
        }

        .btn-gradient:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #0d6efd;
            color: white;
            padding: 0.5rem;
            width: 100%;
            transition: background-color 0.3s;
            border-radius: 20px;
        }

        .btn-outline:hover {
            border-color: #0d6efd;
            color: white;
        }

        .info-text {
            color: #6c757d;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 1.5rem;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center g-4">
            @if(session('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
            @endif

            @if(session('error'))
            <script>
                toastr.error("{{ session('error') }}");
            </script>
            @endif
            <!-- Email Verification Card -->
            <div class="col-md-6 col-lg-5">
                <div class="card p-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Email Verification</h5>
                        <form action="{{ route('verify.code') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Pin</label>
                                <input type="number" class="form-control" name="verification_code"
                                    value="{{ old('verification_code') }}">
                            </div>
                            <button type="submit" class="btn btn-gradient text-uppercase">
                                Verify Email
                            </button>
                        </form>

                        <form action="{{ route('skip.code') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn skip-style btn-outline text-uppercase">
                                Skip
                            </button>
                        </form>
                        <p class="info-text">
                            An email containing your PIN has been sent to your email. If you have not received it in
                            a minute or two, use the resend form.
                        </p>

                    </div>
                </div>
            </div>

            <!-- Resend Pin Card -->
            <div class="col-md-6 col-lg-5">
                <div class="card p-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Resend Pin</h5>
                        <form>
                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{Auth::user()->email}}" readonly>
                            </div>
                            <a type="submit" href="{{ route('resend.verification.code') }}"
                                class="btn btn-gradient text-uppercase">
                                Resend Pin
                            </a>
                            <button type="button" class="btn btn-outline text-uppercase skip-style">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>