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

<div class="container py-5">
    <div class="row justify-content-center g-4">
        <!-- Transfer from Trading to Holding Balance -->
        <div class="col-md-6 col-lg-5">
            <div class="text-center text-header py-3">
                TRANSFER FROM TRADING TO HOLDING BALANCE
            </div>
            <div class="tf-card p-4">
                <div class="card-body">
                    <h6 class="tf-card-title text-center">TRADING BALANCE: {{ config('currencies.' . $user->currency,
                        '$') }}{{
                        number_format($tradingBalance, 2) }}</h6>
                    <form id="transferToHoldingForm">
                        @csrf
                        <div class="mb-4">
                            <input type="number" name="amount" class="form-control" placeholder="Amount" required>
                        </div>
                        <button type="submit" class="btn btn-gradient text-uppercase" id="submitButton1">
                            <span id="buttonText1">Transfer to Holding Balance</span>
                            <span id="loadingSpinner1" class="loading-spinner" style="display: none;"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Transfer from Holding to Trading Balance -->
        <div class="col-md-6 col-lg-5">
            <div class="text-center text-header py-3">
                TRANSFER FROM HOLDING TO TRADING BALANCE
            </div>
            <div class="tf-card p-4">
                <div class="card-body">
                    <h5 class="tf-card-title text-center">HOLDING BALANCE: {{ config('currencies.' . $user->currency,
                        '$') }}{{
                        number_format($holdingBalance, 2) }}</h5>
                    <form id="transferToTradingForm">
                        @csrf
                        <div class="mb-4">
                            <input type="number" name="amount" class="form-control" placeholder="Amount" required>
                        </div>
                        <button type="submit" class="btn btn-gradient text-uppercase" id="submitButton2">
                            <span id="buttonText2">Transfer to Trading Balance</span>
                            <span id="loadingSpinner2" class="loading-spinner" style="display: none;"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        // Transfer from Trading to Holding Balance
        $('#transferToHoldingForm').on('submit', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText1').hide();
            $('#loadingSpinner1').show();
            $('#submitButton1').prop('disabled', true);

            // Send AJAX request
            $.ajax({
                url: '{{ route("account.transfer.to.holding") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    // Hide loading spinner and enable button
                    $('#buttonText1').show();
                    $('#loadingSpinner1').hide();
                    $('#submitButton1').prop('disabled', false);

                    if (response.success) {
                        // Show success message
                        toastr.success(response.message);

                        // Reload the page to reflect updated balances
                        window.location.reload();
                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    // Hide loading spinner and enable button
                    $('#buttonText1').show();
                    $('#loadingSpinner1').hide();
                    $('#submitButton1').prop('disabled', false);

                    // Show error message
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });

        // Transfer from Holding to Trading Balance
        $('#transferToTradingForm').on('submit', function (e) {
            e.preventDefault();

            // Show loading spinner and disable button
            $('#buttonText2').hide();
            $('#loadingSpinner2').show();
            $('#submitButton2').prop('disabled', true);

            // Send AJAX request
            $.ajax({
                url: '{{ route("account.transfer.to.trading") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    // Hide loading spinner and enable button
                    $('#buttonText2').show();
                    $('#loadingSpinner2').hide();
                    $('#submitButton2').prop('disabled', false);

                    if (response.success) {
                        // Show success message
                        toastr.success(response.message);

                        // Reload the page to reflect updated balances
                        window.location.reload();
                    } else {
                        // Show error message
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    // Hide loading spinner and enable button
                    $('#buttonText2').show();
                    $('#loadingSpinner2').hide();
                    $('#submitButton2').prop('disabled', false);

                    // Show error message
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>

@include('user.layouts.footer')