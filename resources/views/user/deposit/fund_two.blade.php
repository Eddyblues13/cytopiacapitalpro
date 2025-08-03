@include('user.layouts.header')
<!-- Main Content -->
<div class="deposit-succes-main-content">
    <div class="total-label">FUND {{ strtoupper($account) }} BALANCE TOTAL</div>
    <div class="amount text-white" style="font-size: 4rem; color: white !important;">{{ config('currencies.' .
        auth()->user()->currency, '$') }}{{ number_format($amount, 2) }}
    </div>

    <div class="payment-label">SELECT PAYMENT METHOD</div>

    <div class="payment-card py-4 mb-4" id="sendCrypto">
        <div class="payment-title">Send Crypto</div>
        <div class="payment-description">Send supported crypto currencies</div>
    </div>

    <a href="{{route('buy.crypto.page')}}" class="buy-crypto">BUY CRYPTO</a>
</div>

<!-- Include jQuery and Toastr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        $('#sendCrypto').on('click', function (e) {
            e.preventDefault();

            // Get the amount and account from the page
            const amount = "{{ $amount }}";
            const account = "{{ $account }}";

            // Send AJAX request
            $.ajax({
                url: '{{ route("deposit.two.submit") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    amount: amount,
                    account: account
                },
                success: function (response) {
                    if (response.success) {
                        // Redirect to the new page with the amount and account
                        window.location.href = '{{ route("deposit.three") }}?amount=' + response.amount + '&account=' + response.account;
                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    // Show error message
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>
@include('user.layouts.footer')