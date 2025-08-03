@include('home.header')
<div class="about-main py-5 bg-light">
    <div class="container">
        <h4 class="about-page-title text-center text-dark">NVDA</h4>
        
          <!-- TradingView Widget for NVDA -->
          <div class="tradingview-widget-container">
            <div id="tradingview_nvda_chart" style="height: 500px;"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
            <script type="text/javascript">
              new TradingView.widget({
                "autosize": true,
                "symbol": "NASDAQ:NVDA",
                "interval": "D",
                "timezone": "America/New_York",
                "theme": "light",
                "style": "1",
                "locale": "en",
                "toolbar_bg": "#f1f3f6",
                "enable_publishing": false,
                "hide_top_toolbar": false,
                "hide_side_toolbar": false,
                "allow_symbol_change": true,
                "container_id": "tradingview_nvda_chart"
              });
            </script>
          </div>
        
    </div>
</div>
@include('home.footer')