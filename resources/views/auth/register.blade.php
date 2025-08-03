<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="assets/css/styles2.css">
<script src="{{asset('assets/js/countries.js')}}"></script>
<script language="javascript">
    populateCountries("country", "state");
        populateCountries("country2");
        populateCountries("country2");
</script>




@include('home.header')

<div class="signup-container">
    <h1 class="signup-title">Create An Account</h1>
    <form id="registerForm" class="signup-form">
        @csrf

        <!-- Add these hidden fields to your form -->
        <input type="hidden" name="js_enabled" id="js_enabled" value="0">
        <input type="hidden" name="form_token" value="{{ $formToken }}">
        <input type="hidden" name="timestamp" id="timestamp" value="{{ now()->timestamp }}">
        <input type="hidden" name="time_check" id="time_check" value="0">

        <!-- Honeypot field (styled to be invisible) -->
        <div style="position: absolute; left: -9999px;">
            <label for="website">Leave this blank</label>
            <input type="text" name="website" id="website">
        </div>

        <!-- JavaScript to set these values -->
        <script>
            document.getElementById('js_enabled').value = 1;
    setTimeout(function() {
        document.getElementById('time_check').value = 1;
    }, 5000); // 5 second delay
        </script>

        <!-- Other form fields -->
        <input type="hidden" name="referral_code" value="{{ $referral_code ?? '' }}">

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-input" value="{{ old('first_name') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-input" value="{{ old('last_name') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone_number" class="form-input" value="{{ old('phone') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Currency</label>
                <select name="currency" class="form-select" required>
                    <option value="USD" {{ old('currency')=='USD' ? 'selected' : '' }}>USD</option>
                    <option value="EUR" {{ old('currency')=='EUR' ? 'selected' : '' }}>EUR</option>
                    <option value="GBP" {{ old('currency')=='GBP' ? 'selected' : '' }}>GBP</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Country</label>
                <select name="country" class="form-select" id="country" required>

                    @php
                    $countries = [
                    "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
                    "Argentina", "Armenia", "Australia", "Austria",
                    "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium",
                    "Belize", "Benin", "Bhutan", "Bolivia",
                    "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso",
                    "Burundi", "Cabo Verde", "Cambodia",
                    "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia",
                    "Comoros", "Congo (Congo-Brazzaville)",
                    "Congo (Congo-Kinshasa)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic",
                    "Denmark", "Djibouti", "Dominica",
                    "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea",
                    "Estonia", "Eswatini", "Ethiopia",
                    "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece",
                    "Grenada", "Guatemala", "Guinea",
                    "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia",
                    "Iran", "Iraq", "Ireland", "Israel",
                    "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait",
                    "Kyrgyzstan", "Laos", "Latvia", "Lebanon",
                    "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar",
                    "Malawi", "Malaysia", "Maldives",
                    "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia",
                    "Moldova", "Monaco", "Mongolia",
                    "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
                    "Netherlands", "New Zealand", "Nicaragua",
                    "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau",
                    "Palestine", "Panama", "Papua New Guinea",
                    "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia",
                    "Rwanda", "Saint Kitts and Nevis",
                    "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and
                    Principe", "Saudi Arabia", "Senegal",
                    "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon
                    Islands", "Somalia", "South Africa",
                    "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden",
                    "Switzerland", "Syria", "Taiwan", "Tajikistan",
                    "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia",
                    "Turkey", "Turkmenistan", "Tuvalu",
                    "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",
                    "Uzbekistan", "Vanuatu", "Vatican City",
                    "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
                    ];
                    $selectedCountry = $user->contactInfo->country ?? '';
                    @endphp

                    @foreach($countries as $country)
                    <option value="{{ $country }}" {{ $selectedCountry==$country ? 'selected' : '' }}>
                        {{ $country }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">City</label>
                <input type="text" name="city" id="state" class="form-input" value="{{ old('city') }}" required>
            </div>
        </div>

        <div class="terms-checkbox d-flex justify-content-center">
            <input type="checkbox" name="terms" class="checkbox-input" {{ old('terms') ? 'checked' : '' }} required>
            <span class="text-primary" style="font-size: 13px;">I Declare That The Information Provided Is Correct
                And Accept All <a href="#" class="terms-link">Terms Of Service</a></span>
        </div>

        <button type="submit" id="submitButton" class="submit-button">
            <span id="buttonText">CREATE MY ACCOUNT</span>
            <span id="loadingSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                style="display: none;"></span>
        </button>
    </form>
</div>
<div class="text-center mb-5">
    Already have an account? <a href="{{route('login')}}">Login</a>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="brand">cytopia capital pro</div>
        <h2 class="heading">
            Build your wealth with<br>
            <span class="gradient-crypto">cryptocurrencies</span>
            <span class="gradient-step">step by step.</span>
        </h2>
        <div class="footer-bottom">
            <div class="copyright">Copyright © 2023 by cytopia capital pro</div>
            <a href="#" class="terms">Terms and Conditions</a>
        </div>
    </div>
    <div class="glow-arc"></div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
            $('#registerForm').on('submit', function (e) {
                e.preventDefault();

                // Show loading spinner and disable button
                $('#buttonText').hide();
                $('#loadingSpinner').show();
                $('#submitButton').prop('disabled', true);

                // Send AJAX request
                $.ajax({
                    url: '{{ route("register") }}', // Replace with your Laravel route
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