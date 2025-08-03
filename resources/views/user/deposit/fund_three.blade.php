@include('user.layouts.header')
<!-- Main Content -->
<div class="depost-form-main px-2">
    <h1 class="amount text-white" style="font-size: 4rem; color: white !important;">PAY {{ config('currencies.' .
        auth()->user()->currency, '$') }}{{ request('amount') }}</h1>
    <a href="#" class="view-pricing text-secondary">Send Crypto</a>

    <div class="fund-card">
        <div class="text-center mb-5 text-secondary" id="cryptoAmountDisplay">
            <span id="calculatedAmount">Calculating...</span>
            <small id="rateInfo" class="d-block text-muted mt-1"></small>
        </div>
        <div class="input-group">
            <div class="input-label">Select Payment Method</div>
            <select class="select-account" id="paymentMethod">
                <option value="BTC">Bitcoin (BTC)</option>
                <option value="ETH">Ethereum (ETH)</option>
                <option value="XRP">XRP (XRP)</option>
                <option value="SOL">Solana (SOL)</option>
                <option value="USDT">Tether (USDT)</option>
                <option value="DOGE">Dogecoin (DOGE)</option>
                <option value="LTC">Litecoin (LTC)</option>
                <option value="ADA">Cardano (ADA)</option>
            </select>
        </div>

        <button class="withdrawal-btn" id="proceedButton">
            <span id="buttonText">Proceed</span>
            <span id="loadingSpinner" style="display: none;">
                <div class="loading-spinner"></div> Processing...
            </span>
        </button>
    </div>
</div>

<!-- Include jQuery and Toastr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Loading Spinner CSS -->
<style>
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
        vertical-align: middle;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    #cryptoAmountDisplay {
        font-size: 1.2rem;
        font-weight: bold;
        min-height: 60px;
    }

    #rateInfo {
        font-size: 0.8rem;
    }

    .rate-update {
        color: #28a745;
    }

    .rate-old {
        color: #dc3545;
    }
</style>

<script>
    // Crypto configuration with proper names and precision
    const cryptoConfig = {
        BTC: { name: "Bitcoin", precision: 8, coingeckoId: "bitcoin" },
        ETH: { name: "Ethereum", precision: 6, coingeckoId: "ethereum" },
        XRP: { name: "XRP", precision: 2, coingeckoId: "ripple" },
        SOL: { name: "Solana", precision: 4, coingeckoId: "solana" },
        USDT: { name: "Tether", precision: 2, coingeckoId: "tether" },
        DOGE: { name: "Dogecoin", precision: 2, coingeckoId: "dogecoin" },
        LTC: { name: "Litecoin", precision: 4, coingeckoId: "litecoin" },
        ADA: { name: "Cardano", precision: 2, coingeckoId: "cardano" }
    };

    // Cache for exchange rates
    let exchangeRates = {};
    let lastUpdated = null;
    const CACHE_DURATION = 300000; // 5 minutes in milliseconds

    // Function to format crypto amount with proper decimal places
    function formatCryptoAmount(amount, crypto) {
        return parseFloat(amount.toFixed(cryptoConfig[crypto].precision));
    }

    // Function to update the crypto amount display
    function updateCryptoDisplay(crypto, amount, rate) {
        const displayText = `${formatCryptoAmount(amount, crypto)} ${crypto}`;
        const rateText = `1 ${crypto} = ${'{{ config("currencies.".auth()->user()->currency, "$") }}'}${rate.toLocaleString()}`;
        const updateText = lastUpdated ? `Rates updated: ${new Date(lastUpdated).toLocaleTimeString()}` : '';
        
        $('#calculatedAmount').text(displayText);
        $('#rateInfo').html(`${rateText}<br><span class="${isRateFresh() ? 'rate-update' : 'rate-old'}">${updateText}</span>`);
    }

    // Check if rates are fresh (within cache duration)
    function isRateFresh() {
        if (!lastUpdated) return false;
        return (Date.now() - lastUpdated) < CACHE_DURATION;
    }

    // Function to fetch current crypto prices from CoinGecko API
    async function fetchCryptoPrices() {
        // Use cached rates if they're fresh
        if (isRateFresh() && Object.keys(exchangeRates).length > 0) {
            return exchangeRates;
        }

        try {
            // Show loading state
            $('#calculatedAmount').text("Fetching latest rates...");
            
            // Get all coin IDs from our config
            const coinIds = Object.values(cryptoConfig).map(c => c.coingeckoId).join(',');
            const currency = "{{ strtolower(auth()->user()->currency ?? 'usd') }}";
            
            // Make API request to CoinGecko
            const response = await fetch(`https://api.coingecko.com/api/v3/simple/price?ids=${coinIds}&vs_currencies=${currency}`);
            
            if (!response.ok) {
                throw new Error(`API error: ${response.status}`);
            }
            
            const data = await response.json();
            
            // Transform the response to our format
            Object.keys(cryptoConfig).forEach(crypto => {
                const coinId = cryptoConfig[crypto].coingeckoId;
                if (data[coinId] && data[coinId][currency]) {
                    exchangeRates[crypto] = data[coinId][currency];
                }
            });
            
            lastUpdated = Date.now();
            return exchangeRates;
        } catch (error) {
            console.error("Error fetching crypto prices:", error);
            
            // If we have stale rates, use them but show warning
            if (Object.keys(exchangeRates).length > 0) {
                toastr.warning('Using cached rates - could not fetch latest prices', 'Network Error');
                return exchangeRates;
            }
            
            // No cached rates available - show error
            toastr.error('Could not load exchange rates', 'Error');
            $('#calculatedAmount').text("Exchange rate service unavailable");
            throw error;
        }
    }

    // Main function to calculate and display crypto amount
    async function calculateCryptoAmount() {
        const fiatAmount = parseFloat("{{ request('amount') }}");
        const selectedCrypto = $('#paymentMethod').val();
        
        if (isNaN(fiatAmount)) {
            $('#calculatedAmount').text("Invalid amount");
            return;
        }

        try {
            // Get current prices
            const prices = await fetchCryptoPrices();
            const rate = prices[selectedCrypto];
            
            if (rate && rate > 0) {
                const cryptoAmount = fiatAmount / rate;
                updateCryptoDisplay(selectedCrypto, cryptoAmount, rate);
            } else {
                $('#calculatedAmount').text("Rate not available for selected crypto");
            }
        } catch (error) {
            $('#calculatedAmount').text("Error calculating amount");
            console.error(error);
        }
    }

    $(document).ready(function () {
        // Initial calculation when page loads
        calculateCryptoAmount();
        
        // Update when selection changes
        $('#paymentMethod').on('change', calculateCryptoAmount);

        // Handle form submission
        $('#proceedButton').on('click', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#proceedButton').prop('disabled', true);

            // Get form data
            const amount = "{{ request('amount') }}";
            const account = "{{ request('account') }}";
            const paymentMethod = $('#paymentMethod').val();
            const cryptoAmount = $('#calculatedAmount').text().split(' ')[0];
            const currency = "{{ auth()->user()->currency }}";

            // Validate the crypto amount
            if (isNaN(cryptoAmount) || cryptoAmount <= 0) {
                toastr.error('Please wait while we calculate the crypto amount', 'Error');
                $('#buttonText').show();
                $('#loadingSpinner').hide();
                $('#proceedButton').prop('disabled', false);
                return;
            }

            // Send AJAX request
            $.ajax({
                url: '{{ route("user.pay.crypto") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    amount: amount,
                    account: account,
                    payment_method: paymentMethod,
                    crypto_amount: cryptoAmount,
                    currency: currency
                },
                success: function (response) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#proceedButton').prop('disabled', false);

                    if (response.success) {
                        toastr.success(response.message, 'Success');
                        // Redirect to payment instructions page after 2 seconds
                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 2000);
                    } else {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function (xhr) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#proceedButton').prop('disabled', false);

                    let errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.statusText) {
                        errorMessage = xhr.statusText;
                    }
                    
                    toastr.error(errorMessage, 'Error');
                }
            });
        });
        
        // Auto-refresh rates every 5 minutes
        setInterval(() => {
            if (!isRateFresh()) {
                toastr.info('Updating exchange rates...', 'Info');
                calculateCryptoAmount();
            }
        }, CACHE_DURATION);
    });
</script>
@include('user.layouts.footer')