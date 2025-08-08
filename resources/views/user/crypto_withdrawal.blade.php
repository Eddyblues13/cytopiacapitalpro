@include('user.layouts.header')

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Font Awesome for loading spinner -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .loading-spinner {
        display: none;
        margin-left: 10px;
    }

    .btn-loading .loading-spinner {
        display: inline-block;
    }
</style>

<div class="depost-form-main">
    <h6 class="heading text-secondary fs-6">WITHDRAWAL</h6>
    <div class="withdraw-card">
        <form id="withdrawalForm" action="{{ route('withdraw.submit') }}" method="POST">
            @csrf
            <div class="input-group">
                <div class="input-label">Withdrawal Method</div>
                <select class="select-account" name="withdrawal_method" id="withdrawalMethod" required>
                    <option value="">Select Method</option>
                    <option value="crypto">Crypto Withdrawal</option>
                    <option value="bank">Bank Transfer</option>
                </select>
            </div>

            <div class="input-group">
                <div class="input-label">Account</div>
                <select class="select-account" name="account" id="accountSelect" required>
                    <option value="">Select Account</option>
                    @foreach([
                    'holding' => $holdingBalance,
                    'staking' => $stakingBalance,
                    'trading' => $tradingBalance,
                    'referral' => $referralBalance,
                    'deposit' => $depositBalance,
                    'profit' => $profit
                    ] as $account => $balance)
                    <option value="{{ $account }}">
                        {{ ucfirst($account) }} Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($balance, 2) }})
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Crypto Fields -->
            <div id="cryptoFields" style="display: none;">
                <div class="input-group">
                    <div class="input-label">Crypto Currency</div>
                    <select class="select-account" name="crypto_currency" id="cryptoCurrency">
                        <option value="">Select Currency</option>
                        <option value="btc">Bitcoin BTC</option>
                        <option value="usdt">Tether USDT</option>
                        <option value="eth">Ethereum ETH</option>
                    </select>
                </div>

                <div class="input-group">
                    <div class="input-label">Wallet Address</div>
                    <input type="text" class="amount-input" name="wallet_address" id="walletAddress">
                </div>
            </div>

            <!-- Bank Fields -->
            <div id="bankFields" style="display: none;">
                <div class="input-group">
                    <div class="input-label">Country</div>
                    <select class="select-account" name="country" id="countrySelect">
                        <option value="">Select Country</option>
                        @foreach(config('banks.countries') as $country => $data)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <div class="input-label">Bank</div>
                    <select class="select-account" name="bank" id="bankSelect">
                        <option value="">Select Bank</option>
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
                <div class="input-label">Amount ({{ Auth::user()->currency }})</div>
                <input type="number" class="amount-input" name="amount" id="withdrawalAmount" min="0.01" step="0.01"
                    required>
            </div>

            <button type="submit" class="withdrawal-btn" id="submitBtn">
                Submit <i class="fas fa-spinner fa-spin loading-spinner"></i>
            </button>
        </form>
    </div>
</div>

@include('user.layouts.footer')

<!-- jQuery and Toastr JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const withdrawalForm = document.getElementById('withdrawalForm');
    const withdrawalMethod = document.getElementById('withdrawalMethod');
    const cryptoFields = document.getElementById('cryptoFields');
    const bankFields = document.getElementById('bankFields');
    const submitBtn = document.getElementById('submitBtn');
    const loadingSpinner = document.querySelector('.loading-spinner');

    // Field references
    const walletAddress = document.getElementById('walletAddress');
    const cryptoCurrency = document.getElementById('cryptoCurrency');
    const countrySelect = document.getElementById('countrySelect');
    const bankSelect = document.getElementById('bankSelect');
    const accountNumber = document.getElementById('accountNumber');
    const accountName = document.getElementById('accountName');

    function updateFieldRequirements() {
        // Reset requirements
        [walletAddress, cryptoCurrency, countrySelect, bankSelect, accountNumber, accountName]
            .forEach(field => {
                field.removeAttribute('required');
                field.value = ''; // clear hidden values
            });

        // Hide both sections
        cryptoFields.style.display = 'none';
        bankFields.style.display = 'none';

        if (withdrawalMethod.value === 'bank') {
            bankFields.style.display = 'block';
            countrySelect.setAttribute('required', 'required');
            bankSelect.setAttribute('required', 'required');
            accountNumber.setAttribute('required', 'required');
            accountName.setAttribute('required', 'required');
        } else if (withdrawalMethod.value === 'crypto') {
            cryptoFields.style.display = 'block';
            walletAddress.setAttribute('required', 'required');
            cryptoCurrency.setAttribute('required', 'required');
        }
    }

    if (withdrawalForm && withdrawalMethod) {
        withdrawalMethod.addEventListener('change', updateFieldRequirements);
        updateFieldRequirements(); // run on load

        withdrawalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            submitBtn.disabled = true;
            loadingSpinner.style.display = 'inline-block';

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                return response.json().then(data => {
                    if (!response.ok) {
                        throw data;
                    }
                    return data;
                });
            })
            .then(data => {
                toastr.success(data.message || "Withdrawal successful");
                this.reset();
                updateFieldRequirements();
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                }
            })
            .catch(error => {
                let errorMessage = 'An error occurred. Please try again...';
                if (error && error.errors) {
                    errorMessage = Object.values(error.errors).flat().join('<br>');
                } else if (error && error.message) {
                    errorMessage = error.message;
                }
                toastr.error(errorMessage);
            })
            .finally(() => {
                submitBtn.disabled = false;
                loadingSpinner.style.display = 'none';
            });
        });
    }
});
</script>