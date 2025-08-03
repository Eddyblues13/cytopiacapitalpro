@include('home.header')
<div class="about-main py-5 bg-light">
    <div class="container">
        <h4 class="about-page-title text-center text-dark">MSFT</h4>
        
         <!-- TradingView Widget for MSFT -->
          <div class="tradingview-widget-container">
            <div id="tradingview_msft" style="height: 500px; width: 100%;"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
            <script type="text/javascript">
              new TradingView.widget({
                "autosize": true,
                "symbol": "NASDAQ:MSFT",
                "interval": "D",
                "timezone": "America/New_York",
                "theme": "light",  // Try "dark" for dark mode
                "style": "1",
                "locale": "en",
                "toolbar_bg": "#f1f3f6",
                "enable_publishing": false,
                "hide_top_toolbar": false,
                "withdateranges": true,
                "range": "1M",  // Default range: 1D,1M,3M,1Y,5Y,ALL
                "hide_side_toolbar": false,
                "allow_symbol_change": true,
                "studies": ["MACD@tv-basicstudies"],
                "container_id": "tradingview_msft"
              });
            </script>
          </div>
        
    </div>
</div>
@include('home.footer')