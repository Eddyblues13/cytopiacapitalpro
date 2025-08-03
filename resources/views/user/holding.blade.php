@include('user.layouts.header')
<!-- Main Content -->
<div class="main-content">
    <div class="row g-4">
        <!-- Left Column - Balance and Chart -->
        <div class="col-md-4">
            <div class="chart-bg h-50">
                <div class="h-balance-section d-flex align-items-center">
                    <div class="h-balance-box">
                        <div class="h-balance-value text-white small-amount">{{ config('currencies.' .
                            Auth::user()->currency, '$') }}{{ number_format($holdingBalance, 1) }}</div>
                        <div class="h-balance-label text-white">Holding Balance</div>
                    </div>
                    <div class="h-balance-box">
                        <div class="h-balance-value text-white small-amount">{{ config('currencies.' .
                            Auth::user()->currency, '$') }}{{ number_format($holdingBalance, 1) }}</div>
                        <div class="h-balance-label text-white">Value of Holdings</div>
                    </div>
                </div>
            </div>
            <a href="{{route('deposit.one')}}" class="btn deposit-btn">Deposit</a>
        </div>

        <!-- Right Column - Assets List -->
        <div class="col-md-8">
            <!-- Bitcoin -->
            <div class="h-asset-card">
                <div class="h-asset-icon">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI2Y3OTMxYSIgZD0iTTE1Ljk2MyAyMC45OTlsLTcuNzQtMy4xMjEgNy43NC0xMy44NTUgNy43NDEgMTMuODU1LTcuNzQxIDMuMTIxem0wIDEuMTI3bC03Ljc0IDMuMTIyIDcuNzQgNC41NzUgNy43NDEtNC41NzUtNy43NDEtMy4xMjJ6Ii8+PC9zdmc+"
                        alt="Bitcoin">
                </div>
                <div class="h-asset-info">
                    <div class="h-asset-amount text-greyish">0.00 BTC</div>
                    <div class="h-asset-value text-greyish">{{ config('currencies.' .
                        Auth::user()->currency, '$') }}0.00</div>
                </div>
                <div class="h-asset-type">
                    <div class="h-asset-name text-greyish">Bitcoin</div>
                    <div class="h-asset-category text-greyish">crypto</div>
                </div>
            </div>

            <!-- Ethereum -->
            <div class="h-asset-card">
                <div class="h-asset-icon">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzYyN0VFQSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2em03Ljk5NC0xNS43ODFMMTYgNi41NDdsLTcuOTk0IDkuNjcyTDE2IDIzLjA0MWw3Ljk5NC03LjgyMnptLTguMDAxIDIuMDYzTDE2IDIzLjA0MWw4LjAwMS03LjgyMkwxNiA2LjU0N2wtLjAwNyAxMS43MzV6Ii8+PC9zdmc+"
                        alt="Ethereum">
                </div>
                <div class="h-asset-info">
                    <div class="h-asset-amount text-greyish">0.00 ETH</div>
                    <div class="h-asset-value text-greyish">{{ config('currencies.' .
                        Auth::user()->currency, '$') }}0.00</div>
                </div>
                <div class="h-asset-type">
                    <div class="h-asset-name text-greyish">Ethereum</div>
                    <div class="h-asset-category text-greyish">crypto</div>
                </div>
            </div>

            <!-- Apple -->
            <div class="h-asset-card">
                <div class="h-asset-icon">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMCAzMCI+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZD0iTTI0LjczIDI2YTExLjI2IDExLjI2IDAgMDEtMS4wOS0yLjU2IDkuNjUgOS42NSAwIDAxLS42My0zLjQ0IDcuMjUgNy4yNSAwIDAxMS4zMS00LjEzIDguMzUgOC4zNSAwIDAxMy42OC0yLjg4IDcuMzQgNy4zNCAwIDAwLTEuMTktMS4xNSA4LjEgOC4xIDAgMDAtNC4yNS0xLjgyIDExLjEzIDExLjEzIDAgMDAtMi4yMy4xOSA2LjIzIDYuMjMgMCAwMS0xLjk1LS4xMSA4LjQzIDguNDMgMCAwMC0yLjE1LS4xOSA4LjQ5IDguNDkgMCAwMC0zLjMzLjkzQTcuMzIgNy4zMiAwIDAwOS44IDEzLjRhOS4zOCA5LjM4IDAgMDAtMS4yNSA0Ljg1IDEwLjY2IDEwLjY2IDAgMDAuODcgNC4yMSA5LjQ0IDkuNDQgMCAwMDEuNjcgMi43NyA2LjY5IDYuNjkgMCAwMDEuODMgMS41MyA0LjQ5IDQuNDkgMCAwMDIuMTMuNTQgNS41OSA1LjU5IDAgMDAyLS4zNyA3LjQgNy40IDAgMDExLjk1LS4zOCA3LjI3IDcuMjcgMCAwMTEuOTUuMzggNS43NiA1Ljc2IDAgMDAxLjk1LjM3IDQuNDkgNC40OSAwIDAwMi4xMy0uNTQgNi42OSA2LjY5IDAgMDAxLjgzLTEuNTNBNS4zOSA1LjM5IDAgMDAyOCAyNGgtLjA5YTUuMzUgNS4zNSAwIDAxLTMuMTggMnptLTMuNDMtMTQuNzVhNy4yNSA3LjI1IDAgMDExLjY5LTEuNTMgNi4wNSA2LjA1IDAgMDExLjk1LS44NyA0LjI0IDQuMjQgMCAwMC0uODctMS4zMSA2LjUxIDYuNTEgMCAwMC00LjU3LTEuOTUgNi43NiA2Ljc2IDAgMDAtLjg3IDMuNjggNi4yIDYuMiAwIDAwMi42NyAxLjk4eiIvPjwvc3ZnPg=="
                        alt="Apple">
                </div>
                <div class="h-asset-info">
                    <div class="h-asset-amount text-greyish">0.00 AAPL</div>
                    <div class="h-asset-value text-greyish">{{ config('currencies.' .
                        Auth::user()->currency, '$') }}0.00</div>
                </div>
                <div class="h-asset-type">
                    <div class="h-asset-name text-greyish">Apple</div>
                    <div class="h-asset-category text-greyish">stock</div>
                </div>
            </div>

            <!-- Microsoft -->
            <div class="h-asset-card">
                <div class="h-asset-icon">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMyAyMyI+PHBhdGggZmlsbD0iI2YyNTAyMiIgZD0iTTEgMWgxMHYxMEgxeiIvPjxwYXRoIGZpbGw9IiM3ZmJhMDAiIGQ9Ik0xMiAxaDEwdjEwSDEyeiIvPjxwYXRoIGZpbGw9IiMwMGE0ZWYiIGQ9Ik0xIDEyaDEwdjEwSDEiLz48cGF0aCBmaWxsPSIjZmZiOTAwIiBkPSJNMTIgMTJoMTB2MTBIMTIiLz48L3N2Zz4="
                        alt="Microsoft">
                </div>
                <div class="h-asset-info">
                    <div class="h-asset-amount text-greyish">0.00 MSFT</div>
                    <div class="h-asset-value text-greyish">$0.00</div>
                </div>
                <div class="h-asset-type">
                    <div class="h-asset-name text-greyish">Microsoft</div>
                    <div class="h-asset-category text-greyish">stock</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')