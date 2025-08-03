@include('user.layouts.header')


<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Left Section -->
        <div class="col-lg-4">
            <div class="balance-section py-4">
                <div class="balance-amount text-white fs-5">{{ config('currencies.' .
                    Auth::user()->currency, '$') }}{{ number_format($stakingBalance, 1) }}</div>
                <div class="balance-label">STAKING BALANCE</div>
            </div>
            <div class="action-buttons">
                <a href="{{route('deposit.one')}}" class="action-button">DEPOSIT</a>
                <a href="{{route('plans')}}" class="action-button">PLANS</a>

            </div>
        </div>

        <!-- Right Section -->
        <div class="col-lg-8">
            <!-- ETH -->
            <div class="asset-card mt-3">
                <img src="https://s3-symbol-logo.tradingview.com/crypto/XTVCETH--big.svg" alt="ETH"
                    class="asset-icon bg-primary">
                <div class="asset-info">
                    <div class="staked-section">
                        <div class="section-label">STAKED</div>
                        <div class="amount">0.00 USD</div>
                        <div class="crypto-amount">0.0000 ETH</div>
                    </div>
                    <div class="earned-section">
                        <div class="section-label">EARNED</div>
                        <div class="amount">0.00 USD</div>
                        <div class="crypto-amount">0.0000 ETH</div>
                    </div>
                    <div class="usd-value">2187.84 USD</div>
                </div>
            </div>

            <div class="asset-card mt-3">
                <img src="https://s3-symbol-logo.tradingview.com/crypto/XTVCETH--big.svg" alt="ETH"
                    class="asset-icon bg-primary">
                <div class="asset-info">
                    <div class="staked-section">
                        <div class="section-label">STAKED</div>
                        <div class="amount">0.00 USD</div>
                        <div class="crypto-amount">0.0000 ETH</div>
                    </div>
                    <div class="earned-section">
                        <div class="section-label">EARNED</div>
                        <div class="amount">0.00 USD</div>
                        <div class="crypto-amount">0.0000 ETH</div>
                    </div>
                    <div class="usd-value">2187.84 USD</div>
                </div>
            </div>
        </div>


    </div>
</div>

@include('user.layouts.footer')