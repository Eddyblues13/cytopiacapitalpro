@include('user.layouts.header')
<!-- Main Content -->
<div class="depost-form-main">
    <h1 class="heading text-white">Fund Account</h1>
    <a href="#" class="view-pricing">VIEW PRICING</a>

    <div class="fund-card">

        <div class="input-group">
            <div class="input-label">Amount ({{ config('currencies.' . auth()->user()->currency, '$') }})</div>
            <input type="number" class="amount-input" id="amount" value="1000" min="1000" required>
        </div>

        <div class="input-group">
            <div class="input-label">Account</div>
            <select class="select-account" id="account" name="account" required>
                <option value="">Select Account Type</option>
                <option value="trading" @if(old('account')=='holding' ) selected @endif>
                    Trading Balance Deposit ({{ config('currencies.' . auth()->user()->currency, '$') }}{{
                    number_format($holdingBalance ?? 0, 2) }})
                </option>
                <option value="trading" @if(old('account')=='holding' ) selected @endif>
                    Holding Balance ({{ config('currencies.' . auth()->user()->currency, '$') }}{{
                    number_format($holdingBalance ?? 0, 2) }})
                </option>
                {{-- <option value="trading" @if(old('account')=='trading' ) selected @endif>
                    Trading Balance ({{ config('currencies.' . auth()->user()->currency, '$') }}{{
                    number_format($tradingBalance ?? 0, 2) }})
                </option> --}}
                <option value="mining" @if(old('account')=='mining' ) selected @endif>
                    Mining Balance ({{ config('currencies.' . auth()->user()->currency, '$') }}{{
                    number_format($miningBalance ?? 0, 2) }})
                </option>

            </select>
        </div>

        <button class="withdrawal-btn" id="proceedButton">
            <span id="buttonText">Proceed</span>
            <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
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
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    $(document).ready(function () {
        $('#proceedButton').on('click', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#proceedButton').prop('disabled', true);

            // Get form data
            const amount = $('#amount').val();
            const account = $('#account').val();

            // Send AJAX request
            $.ajax({
                url: '{{ route("deposit.one.submit") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    amount: amount,
                    account: account
                },
                success: function (response) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#proceedButton').prop('disabled', false);

                    if (response.success) {
                        // Show success message
                        toastr.success(response.message);

                        // Redirect to the next page with data
                        window.location.href = '{{ route("deposit.two") }}?amount=' + response.amount + '&account=' + response.account;
                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    // Hide loading spinner and enable button
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#proceedButton').prop('disabled', false);

                    // Show error message
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>
@include('user.layouts.footer')