@include('user.layouts.header')

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Main Content -->
<div class="depost-form-main">
    <h6 class="heading text-secondary fs-6">WITHDRAWAL</h6>
    <div class="withdraw-card">
        <form id="withdrawalForm">
            @csrf
            <div class="input-group">
                <div class="input-label">Withdrawal Method</div>
                <select class="select-account" name="withdrawal_method" id="withdrawalMethod">
                    <option value="crypto">Crypto Withdrawal</option>
                    <option value="bank">Bank Transfer</option>
                </select>
            </div>

            <div class="input-group">
                <div class="input-label">Account</div>
                <select class="select-account" name="account">
                    <option value="holding">
                        Holding Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($holdingBalance, 2) }})
                    </option>
                    <option value="staking">
                        Staking Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($stakingBalance, 2) }})
                    </option>
                    <option value="trading">
                        Trading Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($tradingBalance, 2) }})
                    </option>
                    <option value="referral">
                        Referral Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($referralBalance, 2) }})
                    </option>
                    <option value="deposit">
                        Deposit Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($depositBalance, 2) }})
                    </option>
                    <option value="profit">
                        Profit Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($profit, 2) }})
                    </option>
                </select>
            </div>


            <!-- Crypto Fields -->
            <div id="cryptoFields">
                <div class="input-group">
                    <div class="input-label">Crypto Currency</div>
                    <select class="select-account" name="crypto_currency">
                        <option value="btc">Bitcoin BTC</option>
                        <option value="usdt">Tether USDT</option>
                        <option value="eth">Ethereum ETH</option>
                    </select>
                </div>

                <div class="input-group">
                    <div class="input-label">Wallet Address</div>
                    <input type="text" class="amount-input" name="wallet_address" id="walletAddress" required>
                </div>
            </div>

            <!-- Bank Fields -->
            <div id="bankFields" style="display: none;">
                <div class="input-group">
                    <div class="input-label">Country</div>
                    <select class="select-account" name="country" id="countrySelect">
                        @foreach(config('banks.countries') as $country => $data)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <div class="input-label">Bank</div>
                    <select class="select-account" name="bank" id="bankSelect">
                        @foreach(config('banks.countries')[array_key_first(config('banks.countries'))]['banks'] as $name
                        => $code)
                        <option value="{{ $code }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <div class="input-label">Account Number</div>
                    <input type="text" class="amount-input" name="account_number" id="accountNumber">
                </div>

                <div class="input-group">
                    <div class="input-label">Account Name</div>
                    <input type="text" class="amount-input" name="account_name" id="accountName">
                </div>

                <div class="input-group">
                    <div class="input-label">SWIFT/IBAN Code (Optional)</div>
                    <input type="text" class="amount-input" name="swift_code" id="swiftCode">
                </div>
            </div>

            <div class="input-group">
                <div class="input-label">Amount ({{Auth::user()->currency}})</div>
                <input type="number" class="amount-input" name="amount" value="0" min="0.01" step="0.01" required>
            </div>

            <button type="submit" class="withdrawal-btn">Submit</button>
        </form>
    </div>
</div>

@include('user.layouts.footer')

<!-- jQuery and Toastr JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle withdrawal method change
        $('#withdrawalMethod').change(function() {
            if ($(this).val() === 'bank') {
                $('#cryptoFields').hide();
                $('#bankFields').show();
                $('#walletAddress').removeAttr('required');
                $('#accountNumber, #accountName').attr('required', 'required');
            } else {
                $('#cryptoFields').show();
                $('#bankFields').hide();
                $('#walletAddress').attr('required', 'required');
                $('#accountNumber, #accountName').removeAttr('required');
            }
        });

        // Handle country change to update banks
        $('#countrySelect').change(function() {
            const country = $(this).val();
            const banks = @json(config('banks.countries'));
            
            $('#bankSelect').empty();
            $.each(banks[country].banks, function(name, code) {
                $('#bankSelect').append($('<option>', {
                    value: code,
                    text: name
                }));
            });
        });

        // Handle form submission
        $('#withdrawalForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("withdraw.submit") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    toastr.success(response.message);
                    $('#withdrawalForm')[0].reset();
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON.message || 'An error occurred.';
                    toastr.error(errorMessage);
                }
            });
        });
    });
</script>