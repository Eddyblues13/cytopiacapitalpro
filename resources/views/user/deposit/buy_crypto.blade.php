@include('user.layouts.header')

<!-- Main Content -->
<div class="container py-4 bg-blend-darken">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card crypto-purchase-card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">BUY CRYPTO</h2>
                    <p class="mb-0 small">Buy Bitcoin, Ethereum, and other cryptocurrencies for account funding from
                        third parties</p>
                </div>

                <div class="card-body">
                    <div class="payment-methods">
                        <h4 class="section-title">Recommended Exchanges</h4>

                        <div class="payment-method">
                            <div class="method-logo">
                                <img src="https://cryptologos.cc/logos/gemini-exchange-gem-logo.png" alt="Gemini"
                                    class="img-fluid">
                            </div>
                            <div class="method-info">
                                <h5>Gemini</h5>
                                <p class="text-muted">Secure cryptocurrency exchange</p>
                            </div>
                            <div class="method-action">
                                <a href="https://www.gemini.com" target="_blank" class="btn btn-outline-primary">Buy
                                    Now</a>
                            </div>
                        </div>

                        <div class="payment-method">
                            <div class="method-logo">
                                <img src="https://cryptologos.cc/logos/coinbase-coin-logo.png" alt="Coinbase"
                                    class="img-fluid">
                            </div>
                            <div class="method-info">
                                <h5>Coinbase</h5>
                                <p class="text-muted">Easy to use crypto platform</p>
                            </div>
                            <div class="method-action">
                                <a href="https://www.coinbase.com" target="_blank" class="btn btn-outline-primary">Buy
                                    Now</a>
                            </div>
                        </div>

                        <div class="payment-method">
                            <div class="method-logo">
                                <img src="https://cryptologos.cc/logos/crypto-com-coin-cro-logo.png" alt="Crypto.com"
                                    class="img-fluid">
                            </div>
                            <div class="method-info">
                                <h5>Crypto.com</h5>
                                <p class="text-muted">Complete cryptocurrency solution</p>
                            </div>
                            <div class="method-action">
                                <a href="https://crypto.com" target="_blank" class="btn btn-outline-primary">Buy Now</a>
                            </div>
                        </div>

                        <div class="payment-method">
                            <div class="method-logo">
                                <img src="https://cryptologos.cc/logos/bitcoin-btc-logo.png" alt="Bitcoin.com"
                                    class="img-fluid">
                            </div>
                            <div class="method-info">
                                <h5>Bitcoin.com</h5>
                                <p class="text-muted">Simple Bitcoin wallet and exchange</p>
                            </div>
                            <div class="method-action">
                                <a href="https://www.bitcoin.com" target="_blank" class="btn btn-outline-primary">Buy
                                    Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="notice mt-4 p-3 bg-light rounded">
                        <p class="mb-0 small text-muted">
                            <i class="fas fa-info-circle"></i> After purchasing crypto from these exchanges, you can
                            transfer funds to your account wallet for trading.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')

<style>
    .crypto-purchase-card {
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 1.5rem;
    }

    .section-title {
        color: #333;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eee;
    }

    .payment-method {
        display: flex;
        align-items: center;
        padding: 1rem;
        margin-bottom: 1rem;
        background: #f9f9f9;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        background: #f0f0f0;
        transform: translateY(-2px);
    }

    .method-logo {
        width: 50px;
        height: 50px;
        margin-right: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .method-logo img {
        max-height: 40px;
        max-width: 100%;
    }

    .method-info {
        flex-grow: 1;
    }

    .method-info h5 {
        margin-bottom: 0.2rem;
        color: #333;
    }

    .method-info p {
        margin-bottom: 0;
        font-size: 0.85rem;
    }

    .notice {
        font-size: 0.9rem;
    }
</style>