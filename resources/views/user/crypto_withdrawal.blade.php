@include('user.layouts.header')

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Main Content -->
<div class="depost-form-main">
    <h6 class="heading text-secondary fs-6">CRYPTO WITHDRAWAL</h6>
    <div class="withdraw-card">
        <form id="withdrawalForm">
            @csrf
            <!-- Add CSRF Token -->
            <div class="input-group">
                <div class="input-label">Account</div>
                <select class="select-account" name="account">
                    {{-- <option value="trading">Trading Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($tradingBalance, 2) }})</option> --}}
                    <option value="holding">Holding Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($holdingBalance, 2) }})</option>
                    <option value="staking">Staking Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($stakingBalance, 2) }})</option>
                    <option value="referral">Staking Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($referralBalance, 2) }})</option>
                    <option value="deposit">Deposit Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($depositBalance, 2) }})</option>
                    <option value="profit">Profit Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($profit, 2) }})</option>
                </select>
            </div>

            <div class="input-group">
                <div class="input-label">Crypto Currency</div>
                <select class="select-account" name="crypto_currency">
                    <option value="btc">Bitcoin BTC</option>
                    <option value="usdt">Tether USDT</option>
                    <option value="eth">Ethereum ETH</option>
                </select>
            </div>

            <div class="input-group">
                <div class="input-label">Amount ({{Auth::user()->currency}})</div>
                <input type="number" class="amount-input" name="amount" value="0">
            </div>

            <div class="input-group">
                <div class="input-label">Wallet Address</div>
                <input type="text" class="amount-input" name="wallet_address">
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
        // Handle form submission
        $('#withdrawalForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("withdraw.submit") }}', // Replace with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    toastr.success(response.message); // Show success message
                    $('#withdrawalForm')[0].reset(); // Reset the form
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON.message || 'An error occurred.';
                    toastr.error(errorMessage); // Show error message
                }
            });
        });
    });
</script>