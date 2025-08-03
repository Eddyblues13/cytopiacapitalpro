@include('user.layouts.header')
<!-- Main Content -->
<div class="pay-crypto-main-content">
    <div class="pay-crypto-payment-card">
        <div class="send-amount text-secondary">SEND {{ $crypto_amount ?? '0.00000000' }} {{ $payment_method ?? 'BTC' }}
        </div>
        <div class="coin-info">
            <span class="badge bg-primary">{{ $coin_name ?? 'Bitcoin' }}</span>
            <span class="badge bg-secondary">{{ $network_type ?? 'Mainnet' }}</span>
        </div>
        <div class="instruction">TO THE WALLET ADDRESS BELOW OR SCAN THE QR CODE WITH YOUR WALLET APP</div>
        <div class="wallet-address" id="walletAddress">{{ $wallet_address ?? 'Generating address...' }}</div>

        <div class="qr-code">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($wallet_address) }}"
                alt="QR Code" style="width: 100%; height: 100%;">
        </div>

        {{-- <div class="network-warning">
            <i class="fas fa-exclamation-triangle"></i> Ensure you're sending {{ $payment_method }} via {{ $network_type
            }} network only
        </div> --}}

        <div class="timer text-secondary" id="paymentTimer">15:00</div>
        <div class="status" id="paymentStatus">Awaiting Payment</div>

        <input type="hidden" id="transactionId" value="{{ $txn_id }}">
        <input type="hidden" id="cryptoType" value="{{ $crypto }}">

        <button class="button px-4" onclick="copyToClipboard()">CLICK TO COPY WALLET ADDRESS</button>
        <a href="{{route('deposit.page')}}"><button class="button px-4" id="paymentMadeBtn">I HAVE MADE THE
                PAYMENT</button></a>
        <a href="{{route('deposit.page')}}"><button class="diff-button px-4" id="waitConfirmBtn">WAIT FOR
                CONFIRMATION</button></a>
    </div>
</div>

<script>
    function copyToClipboard() {
        const walletAddress = document.getElementById('walletAddress').innerText;
        navigator.clipboard.writeText(walletAddress).then(() => {
            toastr.success('Wallet address copied to clipboard!');
        }).catch(err => {
            toastr.error('Failed to copy address');
            console.error('Copy failed:', err);
        });
    }

    // Timer functionality with redirect on expiration
    function startPaymentTimer(duration = 900) { // 15 minutes = 900 seconds
        let timer = duration, minutes, seconds;
        const interval = setInterval(() => {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById('paymentTimer').textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval);
                document.getElementById('paymentStatus').textContent = "Payment Expired";
                document.getElementById('paymentStatus').style.color = "#e74c3c";
                toastr.error('Payment time has expired. Redirecting...', 'Timeout', {timeOut: 3000});
                
                // Disable all buttons
                $('#paymentMadeBtn').prop('disabled', true);
                $('#waitConfirmBtn').prop('disabled', true);
                
                // Redirect to payment failed page
                setTimeout(() => {
                    window.location.href = '{{ route("payment.failed") }}?reason=timeout&txn_id=' + $('#transactionId').val();
                }, 3000);
            }
        }, 1000);
    }

    $(document).ready(function() {
        // Start timer when page loads
        startPaymentTimer();

        // Handle payment made button click
        $('#paymentMadeBtn').on('click', function() {
            toastr.info('Payment verification in progress...');
            
            // Disable buttons while verifying
            $(this).prop('disabled', true);
            $('#waitConfirmBtn').prop('disabled', true);
            
            // Get transaction details
            const transactionId = $('#transactionId').val();
            const cryptoType = $('#cryptoType').val();
            
            // Make AJAX call to verify payment
            $.ajax({
                url: '{{ route("verify.payment") }}',
                method: 'POST',
                data: {
                    transaction_id: transactionId,
                    crypto_type: cryptoType,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        document.getElementById('paymentStatus').textContent = "Payment Confirmed";
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    } else {
                        toastr.error(response.message);
                        $('#paymentMadeBtn').prop('disabled', false);
                        $('#waitConfirmBtn').prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    toastr.error('Error verifying payment. Please try again.');
                    $('#paymentMadeBtn').prop('disabled', false);
                    $('#waitConfirmBtn').prop('disabled', false);
                }
            });
        });

        // Check payment status periodically
        setInterval(() => {
            const transactionId = $('#transactionId').val();
            $.ajax({
                url: '{{ route("check.payment.status") }}',
                method: 'GET',
                data: {
                    transaction_id: transactionId,
                    crypto_type: $('#cryptoType').val()
                },
                success: function(response) {
                    if (response.confirmed) {
                        toastr.success('Payment confirmed!');
                        document.getElementById('paymentStatus').textContent = "Payment Confirmed";
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    } else if (response.failed) {
                        toastr.error('Payment verification failed');
                        document.getElementById('paymentStatus').textContent = "Payment Failed";
                    }
                }
            });
        }, 30000); // Check every 30 seconds
    });
</script>

<!-- Include jQuery, Toastr and Font Awesome for icons -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@include('user.layouts.footer')