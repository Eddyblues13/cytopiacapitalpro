@include('admin.header')
<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Open Trade</h1>
            </div>
            <div>
                <div class="mb-5 row">
                    <div class="col-lg-12">
                        <div class="p-3 card bg-dark">
                            <form action="{{ route('admin.trades.store') }}" method="POST">
                                @csrf
                                <!-- Hidden user_id -->
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <!-- Rest of the form -->
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <h5 class="text-light">Asset</h5>
                                        <select name="asset" class="form-control text-light bg-dark" required>

                                            @foreach($traders as $trader)
                                            <option value="{{ $trader->trader_name }}">{{ $trader->trader_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-light">Category</h5>
                                        <select name="category" id="category" class="form-control text-light bg-dark"
                                            required>
                                            <option value="stocks">Stocks</option>
                                            <option value="crypto">Crypto</option>
                                            <option value="currencies">Currencies</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-light">Company</h5>
                                        <select name="company" id="company" class="form-control text-light bg-dark"
                                            required></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5 class="text-light">Amount</h5>
                                    <input type="number" class="form-control text-light bg-dark" name="amount"
                                        value="1000" required>
                                </div>
                                <div class="form-group">
                                    <h5 class="text-light">Take Profit (Optional)</h5>
                                    <input type="number" class="form-control text-light bg-dark" name="take_profit"
                                        value="7">
                                </div>
                                <div class="form-group">
                                    <h5 class="text-light">Stop Loss (Optional)</h5>
                                    <input type="number" class="form-control text-light bg-dark" name="stop_loss"
                                        value="9">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success px-4">BUY</button>
                                    <button type="submit" class="btn btn-danger px-4">SELL</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="mb-5 row">
                    <div class="col card p-3 shadow bg-dark">
                        <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                            <span style="margin:3px;">
                                <table id="ShipTable" class="table table-hover text-light">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Asset</th>
                                            <th>Category</th>
                                            <th>Company</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Take Profit</th>
                                            <th>Stop Loss</th>
                                            <th>Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trades as $trade)
                                        <tr>
                                            <th scope="row">{{ $trade->id }}</th>
                                            <td>{{ $trade->asset }}</td>
                                            <td>{{ $trade->category }}</td>
                                            <td>{{ $trade->company }}</td>
                                            <td>{{ $trade->status }}</td>
                                            <td>${{ number_format($trade->amount, 2, '.', ',') }}</td>
                                            <td>{{ $trade->take_profit ?? 'N/A' }}</td>
                                            <td>{{ $trade->stop_loss ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($trade->created_at)->format('D, M j, Y g:i A')
                                                }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editTradeModal{{ $trade->id }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.trades.destroy', $trade->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Trade Modal -->
                                        <div class="modal fade" id="editTradeModal{{ $trade->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editTradeModalLabel{{ $trade->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-dark text-light">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editTradeModalLabel{{ $trade->id }}">Edit Trade</h5>
                                                        <button type="button" class="close text-light"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.trades.update', $trade->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Asset -->
                                                            <div class="form-group">
                                                                <label for="asset">Asset</label>
                                                                <input type="text"
                                                                    class="form-control bg-dark text-light" name="asset"
                                                                    id="asset" value="{{ old('asset', $trade->asset) }}"
                                                                    required>
                                                            </div>

                                                            <!-- Category -->
                                                            <div class="form-group">
                                                                <label for="category">Category</label>
                                                                <input type="text"
                                                                    class="form-control bg-dark text-light"
                                                                    name="category" id="category"
                                                                    value="{{ old('category', $trade->category) }}"
                                                                    required>
                                                            </div>

                                                            <!-- Company -->
                                                            <div class="form-group">
                                                                <label for="company">Company</label>
                                                                <input type="text"
                                                                    class="form-control bg-dark text-light"
                                                                    name="company" id="company"
                                                                    value="{{ old('company', $trade->company) }}"
                                                                    required>
                                                            </div>

                                                            <!-- Amount -->
                                                            <div class="form-group">
                                                                <label for="amount">Amount</label>
                                                                <input type="number"
                                                                    class="form-control bg-dark text-light"
                                                                    name="amount" id="amount"
                                                                    value="{{ old('amount', $trade->amount) }}"
                                                                    required>
                                                            </div>

                                                            <!-- Take Profit -->
                                                            <div class="form-group">
                                                                <label for="take_profit">Take Profit</label>
                                                                <input type="number"
                                                                    class="form-control bg-dark text-light"
                                                                    name="take_profit" id="take_profit"
                                                                    value="{{ old('take_profit', $trade->take_profit) }}">
                                                            </div>

                                                            <!-- Stop Loss -->
                                                            <div class="form-group">
                                                                <label for="stop_loss">Stop Loss</label>
                                                                <input type="number"
                                                                    class="form-control bg-dark text-light"
                                                                    name="stop_loss" id="stop_loss"
                                                                    value="{{ old('stop_loss', $trade->stop_loss) }}">
                                                            </div>

                                                            <!-- Status -->
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status"
                                                                    class="form-control text-light bg-dark" required>
                                                                    <option value="open" {{ old('status', $trade->
                                                                        status) === 'open' ? 'selected' : '' }}>Open
                                                                    </option>
                                                                    <option value="close" {{ old('status', $trade->
                                                                        status) === 'close' ? 'selected' : '' }}>Close
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>

                                </table>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Define the data for each category
        const companies = {
            stocks: [
        'Amazon', 'Apple', 'Tesla', 'Microsoft', 'Google', 'Facebook', 'NVIDIA', 'Intel', 
        'Alibaba', 'Samsung', 'Sony', 'Toyota', 'Visa', 'Mastercard', 'JPMorgan Chase', 
        'Berkshire Hathaway', 'Walmart', 'Procter & Gamble', 'Coca-Cola', 'PepsiCo', 
        'Johnson & Johnson', 'Chevron', 'ExxonMobil', 'Pfizer', 'Meta Platforms', 'Disney', 
        'Netflix', 'Starbucks', 'Square', 'AMD', 'Nike', 'Zoom', 'PayPal', 'Salesforce', 
        'Shopify', 'Adidas', 'Boeing', 'Cisco', 'Oracle', 'IBM', 'Dell', 'Uber', 'Lyft'
    ],
    crypto: [
        'Bitcoin', 'Ethereum', 'Ripple', 'Litecoin', 'Cardano', 'Polkadot', 'Dogecoin', 
        'Binance Coin', 'Tether', 'Solana', 'Avalanche', 'Tron', 'Stellar', 'Monero', 
        'Dash', 'Shiba Inu', 'Chainlink', 'Uniswap', 'Algorand', 'Cosmos', 'VeChain', 
        'Aave', 'EOS', 'Zcash', 'Tezos', 'SushiSwap', 'PancakeSwap', 'Filecoin', 
        'Decentraland', 'Axie Infinity', 'Sandbox', 'Theta', 'Polygon', 'Chiliz', 
        'Flow', 'Gala', 'Quant', 'Maker', 'Elrond', 'Hedera', 'Celo', 'Near Protocol'
    ],
    currencies: [ 
        'AUD/CAD', 'AUD/USD', 'EUR/USD', 'GBP/USD', 'USD/JPY', 'USD/CHF', 'NZD/USD', 
        'EUR/GBP', 'EUR/JPY', 'GBP/JPY', 'CAD/JPY', 'AUD/NZD', 'USD/CNY', 'USD/INR', 
        'USD/SGD', 'EUR/AUD', 'GBP/AUD', 'USD/MXN', 'USD/BRL', 'EUR/CHF', 'USD/HKD', 
        'EUR/CAD', 'GBP/CAD', 'AUD/JPY', 'CHF/JPY', 'NZD/JPY', 'EUR/NZD', 'USD/ZAR', 
        'EUR/SEK', 'USD/NOK', 'GBP/NZD', 'EUR/DKK', 'USD/PLN', 'USD/RUB', 'EUR/PLN', 
        'USD/TRY', 'USD/THB', 'GBP/SEK', 'EUR/NOK', 'GBP/DKK', 'USD/ILS', 'EUR/HUF', 
        'GBP/ZAR', 'EUR/TRY', 'USD/KRW', 'USD/TWD'
    ]
        };

        // Populate companies based on selected category
        document.getElementById('category').addEventListener('change', function () {
            const category = this.value;
            const companySelect = document.getElementById('company');

            // Clear current options
            companySelect.innerHTML = '';

            // Add new options
            if (companies[category]) {
                companies[category].forEach(company => {
                    const option = document.createElement('option');
                    option.value = company.toLowerCase().replace(/\s+/g, '_'); // Format value as lowercase and replace spaces with underscores
                    option.textContent = company;
                    companySelect.appendChild(option);
                });
            }
        });

        // Trigger the event on page load to set the initial values
        document.getElementById('category').dispatchEvent(new Event('change'));
    </script>
    @include('admin.footer')