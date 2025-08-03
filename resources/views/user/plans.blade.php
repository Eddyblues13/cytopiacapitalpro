@include('user.layouts.header')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container mt-3">
    <h1 class="text-center text-white before-main-heading">Pricing</h1>
    <h1 class="main-heading">Trading</h1>

    <div class="row g-4 mb-5">
        @foreach($plans as $plan)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="pricing-card">
                <div class="plan-name">{{ $plan->name }}</div>
                <div class="price">{{ config('currencies.' . $localCurrency, '$') }}{{
                    number_format($plan->local_amount, 2) }}</div>
                <div class="usd-amount">USD {{ number_format($plan->price, 2) }}</div>
                <ul class="feature-list">
                    <li class="feature-item">
                        <span class="feature-text">{{ $plan->pairs }}+ Pairs</span>
                        <span class="check-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#00ff9d">
                                <path
                                    d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                            </svg>
                        </span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-text">Leverage up to {{ $plan->leverage }}</span>
                        <span class="check-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#00ff9d">
                                <path
                                    d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                            </svg>
                        </span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-text">Spreads from {{ $plan->spread }}</span>
                        <span class="check-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#00ff9d">
                                <path
                                    d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                            </svg>
                        </span>
                    </li>
                    @if(!$plan->swap_fee)
                    <li class="feature-item">
                        <span class="feature-text">No Swap Fees</span>
                        <span class="check-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#00ff9d">
                                <path
                                    d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                            </svg>
                        </span>
                    </li>
                    @endif
                </ul>

                <a href="{{ route('deposit.one') }}" class="fund-trading-btn">FUND TRADING</a>

                {{-- @if($totalBalance <= 0) <a href="{{ route('deposit.one') }}" class="fund-trading-btn">FUND
                    TRADING</a>
                    @else
                    <button class="fund-trading-btn" data-plan-id="{{ $plan->id }}" data-toggle="modal"
                        data-target="#fundTradingModal">BUY PLAN</button>
                    @endif --}}
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="fundTradingModal" tabindex="-1" role="dialog" aria-labelledby="fundTradingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fundTradingModalLabel">Fund Trading Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fundTradingForm">
                    @csrf
                    <input type="hidden" id="planId" name="plan_id">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="account">Select Account</label>
                        <select class="form-control" id="account" name="account" required>
                            <option value="holding">Holding Account</option>
                            <option value="staking">Staking Account</option>
                            <option value="trading">Trading Account</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')

<script>
    $(document).ready(function() {
        $('.fund-trading-btn').on('click', function() {
            var planId = $(this).data('plan-id');
            $('#planId').val(planId);
        });

        $('#fundTradingForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("fund.trading") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        alert('Funds transferred successfully!');
                        $('#fundTradingModal').modal('hide');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(response) {
                    alert('An error occurred. Please try again.');
                    console.error(response); // Log the error to the console
                }
            });
        });
    });
</script>