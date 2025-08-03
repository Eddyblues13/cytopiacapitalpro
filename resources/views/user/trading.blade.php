@include('user.layouts.header')
<!-- Main Content -->
<div class="container-fluid content-area py-1">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-4">
            <div class="d-flex gap-2">
                <select class="form-select asset-type" style="max-width: 140px;" onchange="updateAssetOptions()">
                    <option value="CRYPTO">CRYPTO</option>
                    <option value="STOCKS">STOCKS</option>
                    <option value="FOREX">FOREX</option>
                </select>
                <select class="form-select asset-pair" style="max-width: 140px;" onchange="updateTradingView()">
                    <!-- Options will be populated dynamically -->
                    <option value="ZRXUSD">ZRXUSD</option>
                    <option value="BTCUSD">BTCUSD</option>
                    <option value="ETHUSD">ETHUSD</option>
                </select>
                <select class="form-select trading-mode" style="max-width: 140px;" onchange="updateTradingMode()">
                    <option value="LIVE">LIVE</option>
                    <option value="DEMO">DEMO</option>
                </select>
            </div>
            <div class="ct-trades-card mt-4 h-25 d-flex justify-content-center align-items-center text-header desktop-only">
                <div id="open-trades-status">NO OPEN TRADES</div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <h1 class="asset-title text-header" id="asset-title">ZRXUSD</h1>
            <div class="chart-container">
                <!-- TradingView Chart Widget -->
                <div id="tradingview-chart" class="chart-area"></div>
                
                <!-- Price Levels (will be updated dynamically) -->
                <div class="price-levels" id="price-levels">
                    <!-- Prices will be populated by JavaScript -->
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="desktop-only">
                <!-- Amount USD -->
                <div class="mb-3">
                    <div class="ct-input-label">
                        <span>Amount (USD)</span>
                    </div>
                    <input type="text" class="form-control text-header amount-usd" value="0" onchange="calculateCryptoAmount()">
                </div>

                <!-- Amount Crypto -->
                <div class="mb-3">
                    <div class="ct-input-label">
                        <span id="crypto-amount-label">Amount (ZRX)</span>
                        <span class="crypto-usd-value">(0.31054 USD)</span>
                    </div>
                    <input type="text" class="form-control amount-crypto" value="0" onchange="calculateUsdAmount()">
                </div>

                <!-- Leverage -->
                <div class="mb-3">
                    <div class="ct-input-label">
                        <span>Leverage</span>
                        <span>(250 MAX)</span>
                    </div>
                    <input type="text" class="form-control leverage" value="100">
                </div>

                <!-- Time -->
                <div class="mb-4">
                    <div class="ct-input-label">
                        <span>Time (Minutes)</span>
                    </div>
                    <input type="text" class="form-control trade-time" value="5">
                </div>

                <!-- Trading Buttons -->
                <button class="btn btn-up w-100" onclick="placeTrade('up')">UP</button>
                <button class="btn btn-down w-100 mb" onclick="placeTrade('down')">DOWN</button>
            </div>
        </div>
    </div>
    <!-- Mobile Trading Buttons -->
    <div class="mobile-trading-buttons d-md-none">
        <button class="btn btn-up" onclick="placeTrade('up')">UP</button>
        <button class="btn btn-down" onclick="placeTrade('down')">DOWN</button>
    </div>
</div>

<!-- Bottom Navigation -->
<div class="bottom-nav">
    <a href="{{route('home')}}" class="nav-item active">
        <svg class="nav-icon" viewBox="0 0 24 24">
            <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm9-8.586 6 6V20H6v-9.586l6-6z" />
        </svg>
        <span>Home</span>
    </a>
    <a href="{{route('current.trade')}}" class="nav-item">
        <svg class="nav-icon" viewBox="0 0 24 24">
            <path d="M3 3v17a1 1 0 0 0 1 1h17v-2H5V3H3z M15.293 14.707a1 1 0 0 0 1.414 0l5-5-1.414-1.414L16 12.586l-2.293-2.293a1 1 0 0 0-1.414 0l-5 5 1.414 1.414L13 12.414l2.293 2.293z" />
        </svg>
        <span>Assets</span>
    </a>
    <a href="{{route('trading')}}" class="nav-item">
        <svg class="nav-icon" viewBox="0 0 24 24">
            <path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM5 19V5h14l.002 14H5z" />
            <path d="m11 7-4 4h3v4h2v-4h3z" />
        </svg>
        <span>Trade</span>
    </a>
    <a href="#" class="nav-item">
        <svg class="nav-icon" viewBox="0 0 24 24">
            <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z" />
            <path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z" />
        </svg>
        <span>Closed Trades</span>
    </a>
    <a href="#" class="nav-item">
        <svg class="nav-icon" viewBox="0 0 24 24">
            <path d="M12 2l2.582 6.953L22 9.257l-5.822 4.602L18.18 21 12 16.89 5.82 21l2.002-7.141L2 9.257l7.418-.304z" />
        </svg>
        <span>Star</span>
    </a>
</div>

@include('user.layouts.footer')

<!-- TradingView Script -->
<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<script>
    // Asset data - in a real app this would come from an API
    const assetData = {
        CRYPTO: ['BTCUSD', 'ETHUSD', 'ZRXUSD', 'LTCUSD', 'XRPUSD'],
        STOCKS: ['AAPL', 'TSLA', 'AMZN', 'GOOGL', 'MSFT'],
        FOREX: ['EURUSD', 'GBPUSD', 'USDJPY', 'AUDUSD', 'USDCAD']
    };

    // Current prices - in a real app this would come from a WebSocket
    let currentPrices = {
        'ZRXUSD': 0.2523,
        'BTCUSD': 42356.78,
        'ETHUSD': 2987.45,
        // Add more assets as needed
    };

    // Initialize TradingView widget
    let tradingViewWidget = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        initializeTradingView('ZRXUSD');
        updatePriceLevels('ZRXUSD');
        
        // Simulate price updates (in a real app, use WebSocket)
        setInterval(updatePrices, 3000);
    });

    function initializeTradingView(symbol) {
        if(tradingViewWidget !== null) {
            tradingViewWidget.remove();
        }
        
        tradingViewWidget = new TradingView.widget({
            "autosize": true,
            "symbol": `BINANCE:${symbol}`,
            "interval": "1",
            "timezone": "Etc/UTC",
            "theme": "dark",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "hide_top_toolbar": true,
            "hide_side_toolbar": true,
            "allow_symbol_change": false,
            "container_id": "tradingview-chart"
        });
    }

    function updateAssetOptions() {
        const assetType = document.querySelector('.asset-type').value;
        const assetPairSelect = document.querySelector('.asset-pair');
        
        // Clear existing options
        assetPairSelect.innerHTML = '';
        
        // Add new options
        assetData[assetType].forEach(pair => {
            const option = document.createElement('option');
            option.value = pair;
            option.textContent = pair;
            assetPairSelect.appendChild(option);
        });
        
        // Update the trading view
        updateTradingView();
    }

    function updateTradingView() {
        const symbol = document.querySelector('.asset-pair').value;
        document.getElementById('asset-title').textContent = symbol;
        
        // Update the crypto amount label
        document.getElementById('crypto-amount-label').textContent = `Amount (${symbol.replace('USD', '')})`;
        
        initializeTradingView(symbol);
        updatePriceLevels(symbol);
    }

    function updateTradingMode() {
        const mode = document.querySelector('.trading-mode').value;
        // In a real app, this would switch between live and demo accounts
        console.log(`Switched to ${mode} mode`);
    }

    function updatePriceLevels(symbol) {
        const priceLevelsContainer = document.getElementById('price-levels');
        const currentPrice = currentPrices[symbol] || 0;
        priceLevelsContainer.innerHTML = '';
        
        // Generate price levels around current price
        for (let i = 6; i >= -6; i--) {
            const price = (currentPrice + (i * 0.0001)).toFixed(7);
            const div = document.createElement('div');
            div.textContent = price;
            
            // Highlight the current price level
            if (i === 0) {
                div.classList.add('current-price');
            }
            
            priceLevelsContainer.appendChild(div);
        }
    }

    // Simulate price updates
    function updatePrices() {
        const symbol = document.querySelector('.asset-pair').value;
        if (!currentPrices[symbol]) {
            currentPrices[symbol] = Math.random() * 100;
        }
        
        // Random price movement
        const change = (Math.random() - 0.5) * 0.001;
        currentPrices[symbol] += change;
        
        // Update the display
        updatePriceLevels(symbol);
        
        // Update the USD value display
        const cryptoAmount = parseFloat(document.querySelector('.amount-crypto').value) || 0;
        const usdValue = (cryptoAmount * currentPrices[symbol]).toFixed(5);
        document.querySelector('.crypto-usd-value').textContent = `(${usdValue} USD)`;
    }

    function calculateCryptoAmount() {
        const usdAmount = parseFloat(document.querySelector('.amount-usd').value) || 0;
        const symbol = document.querySelector('.asset-pair').value;
        const currentPrice = currentPrices[symbol] || 1;
        
        const cryptoAmount = usdAmount / currentPrice;
        document.querySelector('.amount-crypto').value = cryptoAmount.toFixed(8);
        
        // Update the USD value display
        document.querySelector('.crypto-usd-value').textContent = `(${usdAmount.toFixed(5)} USD)`;
    }

    function calculateUsdAmount() {
        const cryptoAmount = parseFloat(document.querySelector('.amount-crypto').value) || 0;
        const symbol = document.querySelector('.asset-pair').value;
        const currentPrice = currentPrices[symbol] || 1;
        
        const usdAmount = cryptoAmount * currentPrice;
        document.querySelector('.amount-usd').value = usdAmount.toFixed(2);
        
        // Update the USD value display
        document.querySelector('.crypto-usd-value').textContent = `(${usdAmount.toFixed(5)} USD)`;
    }

    function placeTrade(direction) {
        const symbol = document.querySelector('.asset-pair').value;
        const amount = document.querySelector('.amount-usd').value;
        const leverage = document.querySelector('.leverage').value;
        const time = document.querySelector('.trade-time').value;
        const mode = document.querySelector('.trading-mode').value;
        
        // In a real app, this would send the trade to your backend
        console.log(`Placing ${mode} trade: ${direction} ${amount} USD of ${symbol} with ${leverage}x leverage for ${time} minutes`);
        
        // Update open trades status
        document.getElementById('open-trades-status').textContent = '1 OPEN TRADE';
    }
</script>

<style>
    .current-price {
        color: #00ff00;
        font-weight: bold;
    }
    
    #tradingview-chart {
        height: 400px;
        width: 100%;
    }
    
    .chart-container {
        position: relative;
    }
    
    .price-levels {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
        background: rgba(0, 0, 0, 0.5);
    }
</style>