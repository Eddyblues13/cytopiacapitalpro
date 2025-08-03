@include('user.layouts.header')


<!-- Main Content -->
<div class="container content-area">
    <!-- Filters -->
    <div class="row g-2 mt-3">
        <div class="col-6">
            <select class="form-select">
                <option>ALL</option>
                <option>ETF</option>
                <option>STOCK</option>
                <option>INDEX</option>
                <option>FOREX</option>
                <option>CRYPTO</option>
            </select>
        </div>
        <div class="col-6">
            <select class="form-select">
                <option>DEFAULT</option>
                <option>NAME ASC</option>
                <option>NAME DESC</option>
                <option>SYMBOL ASC</option>
                <option>SYMBOL DESC</option>
                <option>GAINERS 1D</option>
                <option>GAINERS 7D</option>
                <option>GAINERS 30D</option>
                <option>LOSERS 1D</option>
                <option>LOSERS 7D</option>
                <option>LOSERS 30D</option>
            </select>
        </div>
    </div>

    <!-- Search -->
    <div class="row mt-3">
        <div class="col-12">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </div>

    <!-- Time Tabs - Mobile Only -->
    <div class="time-tabs d-md-none">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link active" href="#">1D</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">7D</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">30D</a>
            </li>
        </ul>
    </div>

    <!-- Desktop Time Labels - Desktop Only -->
    <div class="d-none d-md-flex justify-content-end mt-3 mb-2 pe-5">
        <div style="width: 100px; text-align: center; margin: 0 15px;">
            <span class="time-label">1D</span>
        </div>
        <div style="width: 100px; text-align: center; margin: 0 15px;">
            <span class="time-label">7D</span>
        </div>
        <div style="width: 100px; text-align: center; margin: 0 15px;">
            <span class="time-label">30D</span>
        </div>
        <div style="width: 40px;"></div>
    </div>

    <!-- Assets List -->
    <div class="t-assets-list">
        <!-- 1inch -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzFCMzE0RiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xOC41ODggMTcuNDQ3YTUuNDIgNS40MiAwIDAxLTEuMDEzLS4wOTZjLS4zNjMtLjA3LS43MTUtLjE2OC0xLjA1My0uMjkzYTUuNTQyIDUuNTQyIDAgMDEtLjk2NS0uNDU0IDUuNTYgNS41NiAwIDAxLS44NS0uNTg4IDUuNTQyIDUuNTQyIDAgMDEtLjcwNy0uNjk3IDUuNTQyIDUuNTQyIDAgMDEtLjU0LS43NzUgNS41NDIgNS41NDIgMCAwMS0uMzQ2LS44MjQgNS41NDIgNS41NDIgMCAwMS0uMTI3LS44NDUgNS41NDIgNS41NDIgMCAwMS4xMjctLjg0NSA1LjU0MiA1LjU0MiAwIDAxLjM0Ni0uODI0IDUuNTQyIDUuNTQyIDAgMDEuNTQtLjc3NSA1LjU0MiA1LjU0MiAwIDAxLjcwNy0uNjk3IDUuNTYgNS41NiAwIDAxLjg1LS41ODggNS41NDIgNS41NDIgMCAwMS45NjUtLjQ1NCA1LjU0MiA1LjU0MiAwIDAxMS4wNTMtLjI5MyA1LjQyIDUuNDIgMCAwMTEuMDEzLS4wOTZjLjM0NyAwIC42ODcuMDMyIDEuMDEzLjA5Ni4zNjMuMDcuNzE1LjE2OCAxLjA1My4yOTNhNS41NDIgNS41NDIgMCAwMS45NjUuNDU0IDUuNTYgNS41NiAwIDAxLjg1LjU4OCA1LjU0MiA1LjU0MiAwIDAxLjcwNy42OTcgNS41NDIgNS41NDIgMCAwMS41NC43NzUgNS41NDIgNS41NDIgMCAwMS4zNDYuODI0IDUuNTQyIDUuNTQyIDAgMDEuMTI3Ljg0NSA1LjU0MiA1LjU0MiAwIDAxLS4xMjcuODQ1IDUuNTQyIDUuNTQyIDAgMDEtLjM0Ni44MjQgNS41NDIgNS41NDIgMCAwMS0uNTQuNzc1IDUuNTQyIDUuNTQyIDAgMDEtLjcwNy42OTcgNS41NiA1LjU2IDAgMDEtLjg1LjU4OCA1LjU0MiA1LjU0MiAwIDAxLS45NjUuNDU0IDUuNTQyIDUuNTQyIDAgMDEtMS4wNTMuMjkzIDUuNDIgNS40MiAwIDAxLTEuMDEzLjA5NnptLTYuNTg4LTUuNDJhMy45NTMgMy45NTMgMCAwMC0uMDkuODQ1YzAgLjI5LjAzLjU3NS4wOS44NDVhMy45NTMgMy45NTMgMCAwMC4yNDYuODI0Yy4xMTQuMjcuMjYuNTMuNDM4Ljc3NWEzLjk1MyAzLjk1MyAwIDAwLjYwNS42OTcgMy45NTMgMy45NTMgMCAwMC43NDQuNTg4Yy4yODIuMTguNTg4LjMzLjkxMi40NTRhMy45NTMgMy45NTMgMCAwMDEuMDUzLjI5M2MuMzYzLjA2NC43MzQuMDk2IDEuMTAzLjA5Ni4zNyAwIC43NC0uMDMyIDEuMTAzLS4wOTZhMy45NTMgMy45NTMgMCAwMDEuMDUzLS4yOTNjLjMyNC0uMTI0LjYzLS4yNzQuOTEyLS40NTRhMy45NTMgMy45NTMgMCAwMC43NDQtLjU4OCAzLjk1MyAzLjk1MyAwIDAwLjYwNS0uNjk3Yy4xNzgtLjI0NS4zMjQtLjUwNS40MzgtLjc3NWEzLjk1MyAzLjk1MyAwIDAwLjI0Ni0uODI0Yy4wNi0uMjcuMDktLjU1NS4wOS0uODQ1YTMuOTUzIDMuOTUzIDAgMDAtLjA5LS44NDUgMy45NTMgMy45NTMgMCAwMC0uMjQ2LS44MjQgMy45NTMgMy45NTMgMCAwMC0uNDM4LS43NzUgMy45NTMgMy45NTMgMCAwMC0uNjA1LS42OTcgMy45NTMgMy45NTMgMCAwMC0uNzQ0LS41ODggMy45NTMgMy45NTMgMCAwMC0uOTEyLS40NTQgMy45NTMgMy45NTMgMCAwMC0xLjA1My0uMjkzYy0uMzYzLS4wNjQtLjczNC0uMDk2LTEuMTAzLS4wOTYtLjM3IDAtLjc0LjAzMi0xLjEwMy4wOTZhMy45NTMgMy45NTMgMCAwMC0xLjA1My4yOTNjLS4zMjQuMTI0LS42My4yNzQtLjkxMi40NTRhMy45NTMgMy45NTMgMCAwMC0uNzQ0LjU4OCAzLjk1MyAzLjk1MyAwIDAwLS42MDUuNjk3Yy0uMTc4LjI0NS0uMzI0LjUwNS0uNDM4Ljc3NWEzLjk1MyAzLjk1MyAwIDAwLS4yNDYuODI0eiIvPjwvc3ZnPg=="
                        alt="1inch">
                </div>
                <div class="t-t-asset-info">
                    <div class="t-asset-name text-white">1inch</div>
                    <div class="t-asset-symbol text-header">1INCHUSD | Crypto</div>
                    <div class="t-asset-price text-white">0.262</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.77%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-2.6%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-17.87%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.77%</div>
                <div class="performance-cell negative">-2.6%</div>
                <div class="performance-cell negative">-17.87%</div>
            </div>
        </div>

        <!-- Apple -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMCAzMCI+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZD0iTTI0LjczIDI2YTExLjI2IDExLjI2IDAgMDEtMS4wOS0yLjU2IDkuNjUgOS42NSAwIDAxLS42My0zLjQ0IDcuMjUgNy4yNSAwIDAxMS4zMS00LjEzIDguMzUgOC4zNSAwIDAxMy42OC0yLjg4IDcuMzQgNy4zNCAwIDAwLTEuMTktMS4xNSA4LjEgOC4xIDAgMDAtNC4yNS0xLjgyIDExLjEzIDExLjEzIDAgMDAtMi4yMy4xOSA2LjIzIDYuMjMgMCAwMS0xLjk1LS4xMSA4LjQzIDguNDMgMCAwMC0yLjE1LS4xOSA4LjQ5IDguNDkgMCAwMC0zLjMzLjkzQTcuMzIgNy4zMiAwIDAwOS44IDEzLjRhOS4zOCA5LjM4IDAgMDAtMS4yNSA0Ljg1IDEwLjY2IDEwLjY2IDAgMDAuODcgNC4yMSA5LjQ0IDkuNDQgMCAwMDEuNjcgMi43NyA2LjY5IDYuNjkgMCAwMDEuODMgMS41MyA0LjQ5IDQuNDkgMCAwMDIuMTMuNTQgNS41OSA1LjU5IDAgMDAyLS4zNyA3LjQgNy40IDAgMDExLjk1LS4zOCA3LjI3IDcuMjcgMCAwMTEuOTUuMzggNS43NiA1Ljc2IDAgMDAxLjk1LjM3IDQuNDkgNC40OSAwIDAwMi4xMy0uNTQgNi42OSA2LjY5IDAgMDAxLjgzLTEuNTNBNS4zOSA1LjM5IDAgMDAyOCAyNGgtLjA5YTUuMzUgNS4zNSAwIDAxLTMuMTggMnptLTMuNDMtMTQuNzVhNy4yNSA3LjI1IDAgMDExLjY5LTEuNTMgNi4wNSA2LjA1IDAgMDExLjk1LS44NyA0LjI0IDQuMjQgMCAwMC0uODctMS4zMSA2LjUxIDYuNTEgMCAwMC00LjU3LTEuOTUgNi43NiA2Ljc2IDAgMDAtLjg3IDMuNjggNi4yIDYuMiAwIDAwMi42NyAxLjk4eiIvPjwvc3ZnPg=="
                        alt="Apple">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Apple Inc.</div>
                    <div class="t-asset-symbol text-header">AAPL | Stock</div>
                    <div class="t-asset-price text-white">245.27</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.11%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.25%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+10.35%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.11%</div>
                <div class="performance-cell positive">+0.25%</div>
                <div class="performance-cell positive">+10.35%</div>
            </div>
        </div>

        <!-- Bitcoin -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0Y3OTExQiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0yMS44MTIgMTYuN2MuMTM5LTEuMDA5LS42NDYtMS41NTItMS43NTctMS45MWwuMzU4LTEuNDM5LS44NzQtLjIyLS4zNDkgMS40MDRjLS4yMy0uMDU2LS40NjYtLjEwOC0uNjk4LS4xNnYuMDAxbC0uMzI1LTEuMzA1LS44NzIuMjE5LjM1NiAxLjQzN2MtLjE5LS4wNDItLjM3NS0uMDg0LS41NTQtLjEyOGwtLjAwMS0uMDAyLTEuMTM2LS4yODUtLjIyMi44OTIgMS4wNTIuMjY0Yy4wNzcuMDE4LjE1Mi4wMzYuMjI1LjA1NGwtMS4wNTcgNC4yMzRjLS4wOC4wMTktLjE1OC4wNDQtLjI0OC4wNDEtLjA2Mi0uMDAyLS4xMjUtLjAxOS0uMTk4LS4wNDFsLS43NDctLjE4Ny0uMTQ2LjU4NSAxLjMzLjMzMmMuMjQ5LjA2Mi40OTkuMTI0Ljc0NC4xODFsLS4zNjEgMS40NTUuODczLjIxOC4zNi0xLjQ0NmMuMTU0LjA0MS4zMDMuMDguNDQ3LjExN2wtLjM1OSAxLjQ0My44NzQuMjE5LjM2NS0xLjQ2MWMuOTU3LjE4MSAxLjY3OC4xMDggMS45ODUtLjc2LjI0My0uODY0LS4xMjItMS4zNjItLjgyNS0xLjY4Ni42NTQtLjE1NCAxLjA3Mi0uNTk1Ljk1Ny0xLjUxNnptLTIuMDQ3IDIuNDMxYy4xNzMuNjk4LTEuMzQyLjM0L0wxOC4zIDE3LjY3Yy0uNDQ5LS4xMTItMS4xNDItLjI4NS0uOTY5LjU3Ni4xNzMuODYyIDEuMzQ0LjM0IDEuMzQ0LjM0bC0uMDAyLjAwMXptLjE3Ni0yLjU4NWMuMTU4LjYzOC0xLjE0OC4zMTQtMS40NjYuMDhsLS41MjktMi4xMTdjLjMxOC0uMDggMS4zMjgtLjI5IDEuOTk1LjEwNi4wMDEuMDAxLjAwMS4wMDEuMDAxLjAwMS4wMDEgMCAwIC4wMDIuMDAxLjAwMi4xNzMuNDA0LS4wMDEuNzY4LS4wMDEgMS4wMjh6Ii8+PC9zdmc+"
                        alt="Bitcoin">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Bitcoin</div>
                    <div class="t-asset-symbol text-header">BTCUSD | Crypto</div>
                    <div class="t-asset-price text-white">42,856.12</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.25%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+28.91%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.25%</div>
                <div class="performance-cell positive">+5.67%</div>
                <div class="performance-cell positive">+28.91%</div>
            </div>
        </div>

        <!-- Tesla -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0U4MjEyNiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Tesla">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Tesla Inc</div>
                    <div class="t-asset-symbol text-header">TSLA | Stock</div>
                    <div class="t-asset-price text-white">187.65</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-3.22%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.89%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.45%</div>
                <div class="performance-cell negative">-3.22%</div>
                <div class="performance-cell positive">+5.89%</div>
            </div>
        </div>

        <!-- Gold -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGQ0MwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Gold">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Gold</div>
                    <div class="t-asset-symbol text-header">XAUUSD | Commodity</div>
                    <div class="t-asset-price text-white">2,034.50</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.32%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.32%</div>
                <div class="performance-cell negative">-0.78%</div>
                <div class="performance-cell positive">+3.45%</div>
            </div>
        </div>

        <!-- Microsoft -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzdQQUJGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Microsoft">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Microsoft</div>
                    <div class="t-asset-symbol text-header">MSFT | Stock</div>
                    <div class="t-asset-price text-white">403.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.89%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.15%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.89%</div>
                <div class="performance-cell positive">+2.15%</div>
                <div class="performance-cell positive">+12.67%</div>
            </div>
        </div>

        <!-- Ethereum -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzNEMzc1RiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Ethereum">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Ethereum</div>
                    <div class="t-asset-symbol text-header">ETHUSD | Crypto</div>
                    <div class="t-asset-price text-white">2,345.67</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.91%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+35.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell positive">+8.91%</div>
                <div class="performance-cell positive">+35.67%</div>
            </div>
        </div>

        <!-- Amazon -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGOTgwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Amazon">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Amazon</div>
                    <div class="t-asset-symbol text-header">AMZN | Stock</div>
                    <div class="t-asset-price text-white">175.89</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+18.23%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.67%</div>
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+18.23%</div>
            </div>
        </div>

        <!-- US Dollar Index -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNzNCQiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="DXY">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">US Dollar Index</div>
                    <div class="t-asset-symbol text-header">DXY | Forex</div>
                    <div class="t-asset-price text-white">103.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.56%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.12%</div>
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell negative">-1.56%</div>
            </div>
        </div>

        <!-- NVIDIA -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzc2QjkyOSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="NVIDIA">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">NVIDIA</div>
                    <div class="t-asset-symbol text-header">NVDA | Stock</div>
                    <div class="t-asset-price text-white">865.32</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+56.89%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+12.67%</div>
                <div class="performance-cell positive">+56.89%</div>
            </div>
        </div>

        <!-- Crude Oil -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Crude Oil">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Crude Oil</div>
                    <div class="t-asset-symbol text-header">CL1! | Commodity</div>
                    <div class="t-asset-price text-white">78.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+0.45%</div>
                <div class="performance-cell negative">-5.67%</div>
            </div>
        </div>

        <!-- S&P 500 -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwQjFENyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="S&P 500">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">S&P 500</div>
                    <div class="t-asset-symbol text-header">SPX | Index</div>
                    <div class="t-asset-price text-white">5,123.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+8.45%</div>
            </div>
        </div>

        <!-- EUR/USD -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNTdBQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="EUR/USD">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Euro/Dollar</div>
                    <div class="t-asset-symbol text-header">EURUSD | Forex</div>
                    <div class="t-asset-price text-white">1.0856</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.12%</div>
                <div class="performance-cell negative">-0.34%</div>
                <div class="performance-cell negative">-1.23%</div>
            </div>
        </div>

        <!-- Silver -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0NDQ0NDQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjkgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Silver">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Silver</div>
                    <div class="t-asset-symbol text-header">XAGUSD | Commodity</div>
                    <div class="t-asset-price text-white">22.89</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.45%</div>
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+3.45%</div>
            </div>
        </div>

        <!-- Google -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzM0QTg1MyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Google">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Alphabet (Google)</div>
                    <div class="t-asset-symbol text-header">GOOGL | Stock</div>
                    <div class="t-asset-price text-white">156.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+15.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.78%</div>
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell positive">+15.67%</div>
            </div>
        </div>

        <!-- Binance Coin -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0YzQjkwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="BNB">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Binance Coin</div>
                    <div class="t-asset-symbol text-header">BNBUSD | Crypto</div>
                    <div class="t-asset-price text-white">356.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+4.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+23.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+4.56%</div>
                <div class="performance-cell positive">+23.45%</div>
            </div>
        </div>

        <!-- NASDAQ -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzVBQjBGQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="NASDAQ">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">NASDAQ 100</div>
                    <div class="t-asset-symbol text-header">NDX | Index</div>
                    <div class="t-asset-price text-white">18,234.56</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.34%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.56%</div>
                <div class="performance-cell positive">+1.78%</div>
                <div class="performance-cell positive">+12.34%</div>
            </div>
        </div>

        <!-- USD/JPY -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="USD/JPY">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Dollar/Yen</div>
                    <div class="t-asset-symbol text-header">USDJPY | Forex</div>
                    <div class="t-asset-price text-white">151.23</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.23%</div>
                <div class="performance-cell positive">+0.67%</div>
                <div class="performance-cell positive">+3.45%</div>
            </div>
        </div>

        <!-- Meta (Facebook) -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZEOCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Meta">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Meta Platforms</div>
                    <div class="t-asset-symbol text-header">META | Stock</div>
                    <div class="t-asset-price text-white">485.67</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+24.56%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+24.56%</div>
            </div>
        </div>

        <!-- Solana -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwRjdDQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Solana">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Solana</div>
                    <div class="t-asset-symbol text-header">SOLUSD | Crypto</div>
                    <div class="t-asset-price text-white">102.34</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+56.78%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+12.34%</div>
                <div class="performance-cell positive">+56.78%</div>
            </div>
        </div>

        <!-- Vanguard S&P 500 ETF -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzVBQjBGQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC62NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="VOO">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Vanguard S&P 500 ETF</div>
                    <div class="t-asset-symbol text-header">VOO | ETF</div>
                    <div class="t-asset-price text-white">456.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+8.45%</div>
            </div>
        </div>

        <!-- 1inch -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzFCMzE0RiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xOC41ODggMTcuNDQ3YTUuNDIgNS40MiAwIDAxLTEuMDEzLS4wOTZjLS4zNjMtLjA3LS43MTUtLjE2OC0xLjA1My0uMjkzYTUuNTQyIDUuNTQyIDAgMDEtLjk2NS0uNDU0IDUuNTYgNS41NiAwIDAxLS44NS0uNTg4IDUuNTQyIDUuNTQyIDAgMDEtLjcwNy0uNjk3IDUuNTQyIDUuNTQyIDAgMDEtLjU0LS43NzUgNS41NDIgNS41NDIgMCAwMS0uMzQ2LS44MjQgNS41NDIgNS41NDIgMCAwMS0uMTI3LS44NDUgNS41NDIgNS41NDIgMCAwMS4xMjctLjg0NSA1LjU0MiA1LjU0MiAwIDAxLjM0Ni0uODI0IDUuNTQyIDUuNTQyIDAgMDEuNTQtLjc3NSA1LjU0MiA1LjU0MiAwIDAxLjcwNy0uNjk3IDUuNTYgNS41NiAwIDAxLjg1LS41ODggNS41NDIgNS41NDIgMCAwMS45NjUtLjQ1NCA1LjU0MiA1LjU0MiAwIDAxMS4wNTMtLjI5MyA1LjQyIDUuNDIgMCAwMTEuMDEzLS4wOTZjLjM0NyAwIC42ODcuMDMyIDEuMDEzLjA5Ni4zNjMuMDcuNzE1LjE2OCAxLjA1My4yOTNhNS41NDIgNS41NDIgMCAwMS45NjUuNDU0IDUuNTYgNS41NiAwIDAxLjg1LjU4OCA1LjU0MiA1LjU0MiAwIDAxLjcwNy42OTcgNS41NDIgNS41NDIgMCAwMS41NC43NzUgNS41NDIgNS41NDIgMCAwMS4zNDYuODI0IDUuNTQyIDUuNTQyIDAgMDEuMTI3Ljg0NSA1LjU0MiA1LjU0MiAwIDAxLS4xMjcuODQ1IDUuNTQyIDUuNTQyIDAgMDEtLjM0Ni44MjQgNS41NDIgNS41NDIgMCAwMS0uNTQuNzc1IDUuNTQyIDUuNTQyIDAgMDEtLjcwNy42OTcgNS41NiA1LjU2IDAgMDEtLjg1LjU4OCA1LjU0MiA1LjU0MiAwIDAxLS45NjUuNDU0IDUuNTQyIDUuNTQyIDAgMDEtMS4wNTMuMjkzIDUuNDIgNS40MiAwIDAxLTEuMDEzLjA5NnptLTYuNTg4LTUuNDJhMy45NTMgMy45NTMgMCAwMC0uMDkuODQ1YzAgLjI5LjAzLjU3NS4wOS44NDVhMy45NTMgMy45NTMgMCAwMC4yNDYuODI0Yy4xMTQuMjcuMjYuNTMuNDM4Ljc3NWEzLjk1MyAzLjk1MyAwIDAwLjYwNS42OTcgMy45NTMgMy45NTMgMCAwMC43NDQuNTg4Yy4yODIuMTguNTg4LjMzLjkxMi40NTRhMy45NTMgMy45NTMgMCAwMDEuMDUzLjI5M2MuMzYzLjA2NC43MzQuMDk2IDEuMTAzLjA5Ni4zNyAwIC43NC0uMDMyIDEuMTAzLS4wOTZhMy45NTMgMy45NTMgMCAwMDEuMDUzLS4yOTNjLjMyNC0uMTI0LjYzLS4yNzQuOTEyLS40NTRhMy45NTMgMy45NTMgMCAwMC43NDQtLjU4OCAzLjk1MyAzLjk1MyAwIDAwLjYwNS0uNjk3Yy4xNzgtLjI0NS4zMjQtLjUwNS40MzgtLjc3NWEzLjk1MyAzLjk1MyAwIDAwLjI0Ni0uODI0Yy4wNi0uMjcuMDktLjU1NS4wOS0uODQ1YTMuOTUzIDMuOTUzIDAgMDAtLjA5LS44NDUgMy45NTMgMy45NTMgMCAwMC0uMjQ2LS44MjQgMy45NTMgMy45NTMgMCAwMC0uNDM4LS43NzUgMy45NTMgMy45NTMgMCAwMC0uNjA1LS42OTcgMy45NTMgMy45NTMgMCAwMC0uNzQ0LS41ODggMy45NTMgMy45NTMgMCAwMC0uOTEyLS40NTQgMy45NTMgMy45NTMgMCAwMC0xLjA1My0uMjkzYy0uMzYzLS4wNjQtLjczNC0uMDk2LTEuMTAzLS4wOTYtLjM3IDAtLjc0LjAzMi0xLjEwMy4wOTZhMy45NTMgMy45NTMgMCAwMC0xLjA1My4yOTNjLS4zMjQuMTI0LS42My4yNzQtLjkxMi40NTRhMy45NTMgMy45NTMgMCAwMC0uNzQ0LjU4OCAzLjk1MyAzLjk1MyAwIDAwLS42MDUuNjk3Yy0uMTc4LjI0NS0uMzI0LjUwNS0uNDM4Ljc3NWEzLjk1MyAzLjk1MyAwIDAwLS4yNDYuODI0eiIvPjwvc3ZnPg=="
                        alt="1inch">
                </div>
                <div class="t-t-asset-info">
                    <div class="t-asset-name text-white">1inch</div>
                    <div class="t-asset-symbol text-header">1INCHUSD | Crypto</div>
                    <div class="t-asset-price text-white">0.262</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.77%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-2.6%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-17.87%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.77%</div>
                <div class="performance-cell negative">-2.6%</div>
                <div class="performance-cell negative">-17.87%</div>
            </div>
        </div>

        <!-- Apple -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMCAzMCI+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZD0iTTI0LjczIDI2YTExLjI2IDExLjI2IDAgMDEtMS4wOS0yLjU2IDkuNjUgOS42NSAwIDAxLS42My0zLjQ0IDcuMjUgNy4yNSAwIDAxMS4zMS00LjEzIDguMzUgOC4zNSAwIDAxMy42OC0yLjg4IDcuMzQgNy4zNCAwIDAwLTEuMTktMS4xNSA4LjEgOC4xIDAgMDAtNC4yNS0xLjgyIDExLjEzIDExLjEzIDAgMDAtMi4yMy4xOSA2LjIzIDYuMjMgMCAwMS0xLjk1LS4xMSA4LjQzIDguNDMgMCAwMC0yLjE1LS4xOSA4LjQ5IDguNDkgMCAwMC0zLjMzLjkzQTcuMzIgNy4zMiAwIDAwOS44IDEzLjRhOS4zOCA5LjM4IDAgMDAtMS4yNSA0Ljg1IDEwLjY2IDEwLjY2IDAgMDAuODcgNC4yMSA5LjQ0IDkuNDQgMCAwMDEuNjcgMi43NyA2LjY5IDYuNjkgMCAwMDEuODMgMS41MyA0LjQ5IDQuNDkgMCAwMDIuMTMuNTQgNS41OSA1LjU5IDAgMDAyLS4zNyA3LjQgNy40IDAgMDExLjk1LS4zOCA3LjI3IDcuMjcgMCAwMTEuOTUuMzggNS43NiA1Ljc2IDAgMDAxLjk1LjM3IDQuNDkgNC40OSAwIDAwMi4xMy0uNTQgNi42OSA2LjY5IDAgMDAxLjgzLTEuNTNBNS4zOSA1LjM5IDAgMDAyOCAyNGgtLjA5YTUuMzUgNS4zNSAwIDAxLTMuMTggMnptLTMuNDMtMTQuNzVhNy4yNSA3LjI1IDAgMDExLjY5LTEuNTMgNi4wNSA2LjA1IDAgMDExLjk1LS44NyA0LjI0IDQuMjQgMCAwMC0uODctMS4zMSA2LjUxIDYuNTEgMCAwMC00LjU3LTEuOTUgNi43NiA2Ljc2IDAgMDAtLjg3IDMuNjggNi4yIDYuMiAwIDAwMi42NyAxLjk4eiIvPjwvc3ZnPg=="
                        alt="Apple">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Apple Inc.</div>
                    <div class="t-asset-symbol text-header">AAPL | Stock</div>
                    <div class="t-asset-price text-white">245.27</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.11%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.25%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+10.35%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.11%</div>
                <div class="performance-cell positive">+0.25%</div>
                <div class="performance-cell positive">+10.35%</div>
            </div>
        </div>

        <!-- Bitcoin -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0Y3OTExQiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0yMS44MTIgMTYuN2MuMTM5LTEuMDA5LS42NDYtMS41NTItMS43NTctMS45MWwuMzU4LTEuNDM5LS44NzQtLjIyLS4zNDkgMS40MDRjLS4yMy0uMDU2LS40NjYtLjEwOC0uNjk4LS4xNnYuMDAxbC0uMzI1LTEuMzA1LS44NzIuMjE5LjM1NiAxLjQzN2MtLjE5LS4wNDItLjM3NS0uMDg0LS41NTQtLjEyOGwtLjAwMS0uMDAyLTEuMTM2LS4yODUtLjIyMi44OTIgMS4wNTIuMjY0Yy4wNzcuMDE4LjE1Mi4wMzYuMjI1LjA1NGwtMS4wNTcgNC4yMzRjLS4wOC4wMTktLjE1OC4wNDQtLjI0OC4wNDEtLjA2Mi0uMDAyLS4xMjUtLjAxOS0uMTk4LS4wNDFsLS43NDctLjE4Ny0uMTQ2LjU4NSAxLjMzLjMzMmMuMjQ5LjA2Mi40OTkuMTI0Ljc0NC4xODFsLS4zNjEgMS40NTUuODczLjIxOC4zNi0xLjQ0NmMuMTU0LjA0MS4zMDMuMDguNDQ3LjExN2wtLjM1OSAxLjQ0My44NzQuMjE5LjM2NS0xLjQ2MWMuOTU3LjE4MSAxLjY3OC4xMDggMS45ODUtLjc2LjI0My0uODY0LS4xMjItMS4zNjItLjgyNS0xLjY4Ni42NTQtLjE1NCAxLjA3Mi0uNTk1Ljk1Ny0xLjUxNnptLTIuMDQ3IDIuNDMxYy4xNzMuNjk4LTEuMzQyLjM0L0wxOC4zIDE3LjY3Yy0uNDQ5LS4xMTItMS4xNDItLjI4NS0uOTY5LjU3Ni4xNzMuODYyIDEuMzQ0LjM0IDEuMzQ0LjM0bC0uMDAyLjAwMXptLjE3Ni0yLjU4NWMuMTU4LjYzOC0xLjE0OC4zMTQtMS40NjYuMDhsLS41MjktMi4xMTdjLjMxOC0uMDggMS4zMjgtLjI5IDEuOTk1LjEwNi4wMDEuMDAxLjAwMS4wMDEuMDAxLjAwMS4wMDEgMCAwIC4wMDIuMDAxLjAwMi4xNzMuNDA0LS4wMDEuNzY4LS4wMDEgMS4wMjh6Ii8+PC9zdmc+"
                        alt="Bitcoin">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Bitcoin</div>
                    <div class="t-asset-symbol text-header">BTCUSD | Crypto</div>
                    <div class="t-asset-price text-white">42,856.12</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.25%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+28.91%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.25%</div>
                <div class="performance-cell positive">+5.67%</div>
                <div class="performance-cell positive">+28.91%</div>
            </div>
        </div>

        <!-- Tesla -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0U4MjEyNiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Tesla">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Tesla Inc</div>
                    <div class="t-asset-symbol text-header">TSLA | Stock</div>
                    <div class="t-asset-price text-white">187.65</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-3.22%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.89%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.45%</div>
                <div class="performance-cell negative">-3.22%</div>
                <div class="performance-cell positive">+5.89%</div>
            </div>
        </div>

        <!-- Gold -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGQ0MwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Gold">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Gold</div>
                    <div class="t-asset-symbol text-header">XAUUSD | Commodity</div>
                    <div class="t-asset-price text-white">2,034.50</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.32%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.32%</div>
                <div class="performance-cell negative">-0.78%</div>
                <div class="performance-cell positive">+3.45%</div>
            </div>
        </div>

        <!-- Microsoft -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzdQQUJGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Microsoft">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Microsoft</div>
                    <div class="t-asset-symbol text-header">MSFT | Stock</div>
                    <div class="t-asset-price text-white">403.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.89%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.15%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.89%</div>
                <div class="performance-cell positive">+2.15%</div>
                <div class="performance-cell positive">+12.67%</div>
            </div>
        </div>

        <!-- Ethereum -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzNEMzc1RiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Ethereum">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Ethereum</div>
                    <div class="t-asset-symbol text-header">ETHUSD | Crypto</div>
                    <div class="t-asset-price text-white">2,345.67</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.91%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+35.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell positive">+8.91%</div>
                <div class="performance-cell positive">+35.67%</div>
            </div>
        </div>

        <!-- Amazon -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGOTgwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Amazon">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Amazon</div>
                    <div class="t-asset-symbol text-header">AMZN | Stock</div>
                    <div class="t-asset-price text-white">175.89</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+18.23%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.67%</div>
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+18.23%</div>
            </div>
        </div>

        <!-- US Dollar Index -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNzNCQiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="DXY">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">US Dollar Index</div>
                    <div class="t-asset-symbol text-header">DXY | Forex</div>
                    <div class="t-asset-price text-white">103.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.56%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.12%</div>
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell negative">-1.56%</div>
            </div>
        </div>

        <!-- NVIDIA -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzc2QjkyOSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="NVIDIA">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">NVIDIA</div>
                    <div class="t-asset-symbol text-header">NVDA | Stock</div>
                    <div class="t-asset-price text-white">865.32</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+56.89%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+12.67%</div>
                <div class="performance-cell positive">+56.89%</div>
            </div>
        </div>

        <!-- Crude Oil -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Crude Oil">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Crude Oil</div>
                    <div class="t-asset-symbol text-header">CL1! | Commodity</div>
                    <div class="t-asset-price text-white">78.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+0.45%</div>
                <div class="performance-cell negative">-5.67%</div>
            </div>
        </div>

        <!-- S&P 500 -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwQjFENyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="S&P 500">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">S&P 500</div>
                    <div class="t-asset-symbol text-header">SPX | Index</div>
                    <div class="t-asset-price text-white">5,123.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+8.45%</div>
            </div>
        </div>

        <!-- EUR/USD -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNTdBQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="EUR/USD">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Euro/Dollar</div>
                    <div class="t-asset-symbol text-header">EURUSD | Forex</div>
                    <div class="t-asset-price text-white">1.0856</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.12%</div>
                <div class="performance-cell negative">-0.34%</div>
                <div class="performance-cell negative">-1.23%</div>
            </div>
        </div>

        <!-- Silver -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0NDQ0NDQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjkgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Silver">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Silver</div>
                    <div class="t-asset-symbol text-header">XAGUSD | Commodity</div>
                    <div class="t-asset-price text-white">22.89</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.45%</div>
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+3.45%</div>
            </div>
        </div>

        <!-- Google -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzM0QTg1MyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Google">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Alphabet (Google)</div>
                    <div class="t-asset-symbol text-header">GOOGL | Stock</div>
                    <div class="t-asset-price text-white">156.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+15.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.78%</div>
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell positive">+15.67%</div>
            </div>
        </div>

        <!-- Binance Coin -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0YzQjkwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="BNB">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Binance Coin</div>
                    <div class="t-asset-symbol text-header">BNBUSD | Crypto</div>
                    <div class="t-asset-price text-white">356.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+4.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+23.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+4.56%</div>
                <div class="performance-cell positive">+23.45%</div>
            </div>
        </div>

        <!-- NASDAQ -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzVBQjBGQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="NASDAQ">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">NASDAQ 100</div>
                    <div class="t-asset-symbol text-header">NDX | Index</div>
                    <div class="t-asset-price text-white">18,234.56</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.34%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.56%</div>
                <div class="performance-cell positive">+1.78%</div>
                <div class="performance-cell positive">+12.34%</div>
            </div>
        </div>

        <!-- USD/JPY -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="USD/JPY">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Dollar/Yen</div>
                    <div class="t-asset-symbol text-header">USDJPY | Forex</div>
                    <div class="t-asset-price text-white">151.23</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.23%</div>
                <div class="performance-cell positive">+0.67%</div>
                <div class="performance-cell positive">+3.45%</div>
            </div>
        </div>

        <!-- Meta (Facebook) -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZEOCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Meta">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Meta Platforms</div>
                    <div class="t-asset-symbol text-header">META | Stock</div>
                    <div class="t-asset-price text-white">485.67</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+24.56%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+24.56%</div>
            </div>
        </div>

        <!-- Solana -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwRjdDQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Solana">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Solana</div>
                    <div class="t-asset-symbol text-header">SOLUSD | Crypto</div>
                    <div class="t-asset-price text-white">102.34</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+56.78%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+12.34%</div>
                <div class="performance-cell positive">+56.78%</div>
            </div>
        </div>

        <!-- Vanguard S&P 500 ETF -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzVBQjBGQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC62NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="VOO">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Vanguard S&P 500 ETF</div>
                    <div class="t-asset-symbol text-header">VOO | ETF</div>
                    <div class="t-asset-price text-white">456.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+8.45%</div>
            </div>
        </div>
    </div>
    <div class="t-assets-list">
        <!-- Berkshire Hathaway -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwODFBMiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA2LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="BRK.A">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Berkshire Hathaway</div>
                    <div class="t-asset-symbol text-header">BRK.A | Stock</div>
                    <div class="t-asset-price text-white">620,850.00</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.45%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+5.67%</div>
            </div>
        </div>

        <!-- Cardano -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwQkRCNyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="ADA">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Cardano</div>
                    <div class="t-asset-symbol text-header">ADAUSD | Crypto</div>
                    <div class="t-asset-price text-white">0.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+15.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+15.67%</div>
            </div>
        </div>

        <!-- Pfizer -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwOTNDQyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="PFE">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Pfizer</div>
                    <div class="t-asset-symbol text-header">PFE | Stock</div>
                    <div class="t-asset-price text-white">27.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-12.34%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.56%</div>
                <div class="performance-cell negative">-2.34%</div>
                <div class="performance-cell negative">-12.34%</div>
            </div>
        </div>

        <!-- USD/CAD -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="USDCAD">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Dollar/Loonie</div>
                    <div class="t-asset-symbol text-header">USDCAD | Forex</div>
                    <div class="t-asset-price text-white">1.3567</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.12%</div>
                <div class="performance-cell negative">-0.23%</div>
                <div class="performance-cell positive">+1.45%</div>
            </div>
        </div>

        <!-- Ripple -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC62NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="XRP">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Ripple</div>
                    <div class="t-asset-symbol text-header">XRPUSD | Crypto</div>
                    <div class="t-asset-price text-white">0.5678</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+8.90%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell positive">+8.90%</div>
                <div class="performance-cell negative">-5.67%</div>
            </div>
        </div>

        <!-- Walt Disney -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZGNyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="DIS">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Walt Disney</div>
                    <div class="t-asset-symbol text-header">DIS | Stock</div>
                    <div class="t-asset-price text-white">112.34</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+3.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-8.90%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+3.45%</div>
                <div class="performance-cell negative">-8.90%</div>
            </div>
        </div>

        <!-- Natural Gas -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwQjFENyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC62NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="NG1!">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Natural Gas</div>
                    <div class="t-asset-symbol text-header">NG1! | Commodity</div>
                    <div class="t-asset-price text-white">2.34</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-15.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell negative">-15.67%</div>
            </div>
        </div>

        <!-- Boeing -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZGNyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC62NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="BA">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Boeing</div>
                    <div class="t-asset-symbol text-header">BA | Stock</div>
                    <div class="t-asset-price text-white">203.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.56%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell negative">-5.67%</div>
            </div>
        </div>

        <!-- Polkadot -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0U2MDBGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="DOT">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Polkadot</div>
                    <div class="t-asset-symbol text-header">DOTUSD | Crypto</div>
                    <div class="t-asset-price text-white">6.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+45.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+5.67%</div>
                <div class="performance-cell positive">+12.34%</div>
                <div class="performance-cell positive">+45.67%</div>
            </div>
        </div>

        <!-- Starbucks -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjY0NCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy62NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="SBUX">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Starbucks</div>
                    <div class="t-asset-symbol text-header">SBUX | Stock</div>
                    <div class="t-asset-price text-white">98.76</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.34%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell negative">-3.45%</div>
            </div>
        </div>

        <!-- USD/CHF -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGMDAwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="USDCHF">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Dollar/Franc</div>
                    <div class="t-asset-symbol text-header">USDCHF | Forex</div>
                    <div class="t-asset-price text-white">0.8765</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.12%</div>
                <div class="performance-cell positive">+0.23%</div>
                <div class="performance-cell negative">-1.45%</div>
            </div>
        </div>

        <!-- Copper -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0I4NzM0QyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC62NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Copper">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Copper</div>
                    <div class="t-asset-symbol text-header">HG1! | Commodity</div>
                    <div class="t-asset-price text-white">3.89</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-3.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.56%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell negative">-3.45%</div>
            </div>
        </div>

        <!-- JPMorgan Chase -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA6LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="JPM">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">JPMorgan Chase</div>
                    <div class="t-asset-symbol text-header">JPM | Stock</div>
                    <div class="t-asset-price text-white">198.76</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+12.34%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.78%</div>
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell positive">+12.34%</div>
            </div>
        </div>

        <!-- Chainlink -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzJCNTlDRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC62NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="LINK">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Chainlink</div>
                    <div class="t-asset-symbol text-header">LINKUSD | Crypto</div>
                    <div class="t-asset-price text-white">14.56</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+4.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+10.12%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+34.56%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+4.56%</div>
                <div class="performance-cell positive">+10.12%</div>
                <div class="performance-cell positive">+34.56%</div>
            </div>
        </div>

        <!-- Coca-Cola -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0Y0MDAxMSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="KO">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Coca-Cola</div>
                    <div class="t-asset-symbol text-header">KO | Stock</div>
                    <div class="t-asset-price text-white">60.45</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-2.34%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell negative">-0.23%</div>
                <div class="performance-cell positive">+0.56%</div>
                <div class="performance-cell negative">-2.34%</div>
            </div>
        </div>

        <!-- AUD/USD -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwODBGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy62NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="AUDUSD">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Aussie/Dollar</div>
                    <div class="t-asset-symbol text-header">AUDUSD | Forex</div>
                    <div class="t-asset-price text-white">0.6543</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-0.56%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-2.34%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.34%</div>
                <div class="performance-cell negative">-0.56%</div>
                <div class="performance-cell negative">-2.34%</div>
            </div>
        </div>

        <!-- Wheat -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGQ0MwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="Wheat">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Wheat</div>
                    <div class="t-asset-symbol text-header">ZW1! | Commodity</div>
                    <div class="t-asset-price text-white">5.67</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-8.90%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell negative">-2.34%</div>
                <div class="performance-cell negative">-8.90%</div>
            </div>
        </div>

        <!-- Walmart -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjkgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="WMT">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Walmart</div>
                    <div class="t-asset-symbol text-header">WMT | Stock</div>
                    <div class="t-asset-price text-white">165.78</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.45%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.45%</div>
                <div class="performance-cell positive">+1.23%</div>
                <div class="performance-cell positive">+5.67%</div>
            </div>
        </div>

        <!-- Litecoin -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzMxMzEzMSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="LTC">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Litecoin</div>
                    <div class="t-asset-symbol text-header">LTCUSD | Crypto</div>
                    <div class="t-asset-price text-white">78.90</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+2.34%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+23.45%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+2.34%</div>
                <div class="performance-cell positive">+5.67%</div>
                <div class="performance-cell positive">+23.45%</div>
            </div>
        </div>
            <!-- Alibaba -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0Y3OTExQiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="BABA">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Alibaba</div>
                <div class="t-asset-symbol text-header">BABA | Stock</div>
                <div class="t-asset-price text-white">78.45</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+1.23%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-2.34%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-15.67%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+1.23%</div>
            <div class="performance-cell negative">-2.34%</div>
            <div class="performance-cell negative">-15.67%</div>
        </div>
    </div>

    <!-- Uniswap -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGNEEwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="UNI">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Uniswap</div>
                <div class="t-asset-symbol text-header">UNIUSD | Crypto</div>
                <div class="t-asset-price text-white">6.78</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+3.45%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+8.90%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+34.56%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+3.45%</div>
            <div class="performance-cell positive">+8.90%</div>
            <div class="performance-cell positive">+34.56%</div>
        </div>
    </div>

    <!-- Shell -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0ZGQ0MwMCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="SHEL">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Shell</div>
                <div class="t-asset-symbol text-header">SHEL | Stock</div>
                <div class="t-asset-price text-white">65.43</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+0.56%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-1.23%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+3.45%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+0.56%</div>
            <div class="performance-cell negative">-1.23%</div>
            <div class="performance-cell positive">+3.45%</div>
        </div>
    </div>

    <!-- GBP/USD -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwODBGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="GBPUSD">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Pound/Dollar</div>
                <div class="t-asset-symbol text-header">GBPUSD | Forex</div>
                <div class="t-asset-price text-white">1.2654</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+0.23%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-0.45%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+1.23%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+0.23%</div>
            <div class="performance-cell negative">-0.45%</div>
            <div class="performance-cell positive">+1.23%</div>
        </div>
    </div>

    <!-- Dogecoin -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0JBNzkyNCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="DOGE">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Dogecoin</div>
                <div class="t-asset-symbol text-header">DOGEUSD | Crypto</div>
                <div class="t-asset-price text-white">0.0876</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+5.67%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+12.34%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+45.67%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+5.67%</div>
            <div class="performance-cell positive">+12.34%</div>
            <div class="performance-cell positive">+45.67%</div>
        </div>
    </div>

    <!-- Samsung -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwNjZGRiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="005930.KS">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Samsung</div>
                <div class="t-asset-symbol text-header">005930.KS | Stock</div>
                <div class="t-asset-price text-white">72,500</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+0.45%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+1.23%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-3.45%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+0.45%</div>
            <div class="performance-cell positive">+1.23%</div>
            <div class="performance-cell negative">-3.45%</div>
        </div>
    </div>

    <!-- Palladium -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0FFQUFBRSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="Palladium">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Palladium</div>
                <div class="t-asset-symbol text-header">XPDUSD | Commodity</div>
                <div class="t-asset-price text-white">1,023.45</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="negative">-1.23%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-3.45%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-12.34%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell negative">-1.23%</div>
            <div class="performance-cell negative">-3.45%</div>
            <div class="performance-cell negative">-12.34%</div>
        </div>
    </div>

    <!-- Netflix -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0U1MDMxMyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="NFLX">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Netflix</div>
                <div class="t-asset-symbol text-header">NFLX | Stock</div>
                <div class="t-asset-price text-white">560.78</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+2.34%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+5.67%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+23.45%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+2.34%</div>
            <div class="performance-cell positive">+5.67%</div>
            <div class="performance-cell positive">+23.45%</div>
        </div>
    </div>

    <!-- USD/MXN -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwOTY4OCIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="USDMXN">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Dollar/Peso</div>
                <div class="t-asset-symbol text-header">USDMXN | Forex</div>
                <div class="t-asset-price text-white">16.7890</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="negative">-0.45%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+0.67%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+2.34%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell negative">-0.45%</div>
            <div class="performance-cell positive">+0.67%</div>
            <div class="performance-cell positive">+2.34%</div>
        </div>
    </div>

    <!-- Toyota -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0Y0MDAxMSIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="TM">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Toyota</div>
                <div class="t-asset-symbol text-header">TM | Stock</div>
                <div class="t-asset-price text-white">245.67</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+0.78%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+1.23%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+8.90%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+0.78%</div>
            <div class="performance-cell positive">+1.23%</div>
            <div class="performance-cell positive">+8.90%</div>
        </div>
    </div>

    <!-- Avalanche -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iI0U4NDE0MiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy62NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA2LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="AVAX">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Avalanche</div>
                <div class="t-asset-symbol text-header">AVAXUSD | Crypto</div>
                <div class="t-asset-price text-white">36.78</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+4.56%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+10.12%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="positive">+56.78%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+4.56%</div>
            <div class="performance-cell positive">+10.12%</div>
            <div class="performance-cell positive">+56.78%</div>
        </div>
    </div>

    <!-- Nestle -->
    <div class="t-asset-card">
        <div class="d-flex align-items-center">
            <div class="t-asset-icon me-3">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwQjFENyIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                    alt="NESN.SW">
            </div>
            <div class="t-asset-info">
                <div class="t-asset-name text-white">Nestle</div>
                <div class="t-asset-symbol text-header">NESN.SW | Stock</div>
                <div class="t-asset-price text-white">105.45</div>
            </div>
            <div class="desktop-performance d-none d-md-flex">
                <div class="desktop-performance-cell">
                    <div class="positive">+0.34%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-0.56%</div>
                </div>
                <div class="desktop-performance-cell">
                    <div class="negative">-2.34%</div>
                </div>
            </div>
            <div class="star-container">
                <i class="bi bi-star star-icon-empty"></i>
            </div>
        </div>
        <div class="performance-row d-md-none">
            <div class="performance-cell positive">+0.34%</div>
            <div class="performance-cell negative">-0.56%</div>
            <div class="performance-cell negative">-2.34%</div>
        </div>
    </div>

        <!-- Exxon Mobil -->
        <div class="t-asset-card">
            <div class="d-flex align-items-center">
                <div class="t-asset-icon me-3">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PHBhdGggZmlsbD0iIzAwODFBMiIgZD0iTTE2IDMyQzcuMTYzIDMyIDAgMjQuODM3IDAgMTZTNy4xNjMgMCAxNiAwczE2IDcuMTYzIDE2IDE2LTcuMTYzIDE2LTE2IDE2eiIvPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0xNiA2LjY2N2MtMy42NjcgMC02LjY2NyAzLTYuNjY3IDYuNjY3UzEyLjMzMyAyMCAxNiAyMHM2LjY2Ny0zIDYuNjY3LTYuNjY3UzE5LjY2NyA6LjY2NyAxNiA6LjY2N3ptMCAxMS4zMzNhNC42NjcgNC42NjcgMCAxMSAwLTkuMzM0IDQuNjY3IDQuNjY3IDAgMDEwIDkuMzM0eiIvPjwvc3ZnPg=="
                        alt="XOM">
                </div>
                <div class="t-asset-info">
                    <div class="t-asset-name text-white">Exxon Mobil</div>
                    <div class="t-asset-symbol text-header">XOM | Stock</div>
                    <div class="t-asset-price text-white">118.76</div>
                </div>
                <div class="desktop-performance d-none d-md-flex">
                    <div class="desktop-performance-cell">
                        <div class="positive">+0.78%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="negative">-1.23%</div>
                    </div>
                    <div class="desktop-performance-cell">
                        <div class="positive">+5.67%</div>
                    </div>
                </div>
                <div class="star-container">
                    <i class="bi bi-star star-icon-empty"></i>
                </div>
            </div>
            <div class="performance-row d-md-none">
                <div class="performance-cell positive">+0.78%</div>
                <div class="performance-cell negative">-1.23%</div>
                <div class="performance-cell positive">+5.67%</div>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')