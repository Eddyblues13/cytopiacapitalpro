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
    <h2 class="heading text-white fs-4 py-3">Update Contact Info</h2>
    <div class="fund-same-card">
        <form id="updateContactInfoForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-label">Mobile Number</div>
                        <input type="text" name="mobile_number" class="amount-input text-header"
                            value="{{ $user->contactInfo->mobile_number ?? '' }}" required>
                    </div>
                    <div class="input-group">
                        <div class="input-label">Zip Code</div>
                        <input type="text" name="zip_code" class="amount-input text-header"
                            value="{{ $user->contactInfo->zip_code ?? '' }}" required>
                    </div>
                    <div class="input-group">
                        <div class="input-label">State</div>
                        <input type="text" name="state" class="amount-input text-header"
                            value="{{ $user->contactInfo->state ?? '' }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-label">Street Address</div>
                        <input type="text" name="street_address" class="amount-input text-header"
                            value="{{ $user->contactInfo->street_address ?? '' }}" required>
                    </div>
                    <div class="input-group">
                        <div class="input-label">City</div>
                        <input type="text" name="city" class="amount-input text-header"
                            value="{{ $user->contactInfo->city ?? '' }}" required>
                    </div>
                    <div class="input-group">
                        <div class="input-label">Country</div>
                        <select name="country" class="select-account text-header" required>
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
        $('#updateContactInfoForm').on('submit', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            // Send AJAX request
            $.ajax({
                url: '{{ route("account.update.contact") }}',
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

@include('user.layouts.footer')