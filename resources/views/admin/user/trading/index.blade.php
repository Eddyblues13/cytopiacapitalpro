@include('admin.header')
<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Manage Trades for {{ $user->name }}</h1>
            </div>

            <!-- Create Trade Form -->
            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-dark">
                        <form id="tradeForm" action="{{ route('admin.trade.history.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <h5 class="text-light">Trader</h5>
                                    <select name="trader_name" class="form-control text-light bg-dark" required>
                                        <option value="">Select Trader</option>
                                        <option value="VirtualBacon">VirtualBacon</option>
                                        <option value="CryptoRover">CryptoRover</option>
                                        <option value="BitBoy">BitBoy</option>
                                        @foreach(App\Models\Trader::all() as $trader)
                                        <option value="{{ $trader->name }}">{{ $trader->name }}</option>
                                        @endforeach
                                        <option value="Other">Other</option>
                                    </select>
                                    <small id="trader_name-error" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <h5 class="text-light">Symbol</h5>
                                    <select name="symbol" class="form-control text-light bg-dark" required>
                                        <option value="">Select Symbol</option>
                                        
                                        <!-- Cryptocurrencies -->
                                        <option value="BTCUSDT">BTC/USDT</option>
                                        <option value="ETHUSDT">ETH/USDT</option>
                                        <option value="TONUSDT">TON/USDT</option>
                                        <option value="XRPUSDT">XRP/USDT</option>
                                        <option value="SOLUSDT">SOL/USDT</option>
                                        <option value="TSLA">Tesla (TSLA)</option>
                                        <option value="AAPL">Apple (AAPL)</option>
                                        <option value="GOOGL">Alphabet (GOOGL)</option>
                                        <option value="AMZN">Amazon (AMZN)</option>
                                        <option value="MSFT">Microsoft (MSFT)</option>
                                        <option value="NFLX">Netflix (NFLX)</option>
                                        <option value="META">Meta Platforms (META)</option>
                                        <option value="NVDA">NVIDIA (NVDA)</option>
                                        <option value="BRK.A">Berkshire Hathaway (BRK.A)</option>
                                        <option value="JPM">JPMorgan Chase (JPM)</option>
                                    </select>
                                    
                                    <small id="symbol-error" class="text-danger"></small>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <h5 class="text-light">Type</h5>
                                    <select name="type" class="form-control text-light bg-dark" required>
                                        <option value="spot">Spot</option>
                                        <option value="futures">Futures</option>
                                        <option value="margin">Margin</option>
                                    </select>
                                    <small id="type-error" class="text-danger"></small>
                                </div> --}}
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <h5 class="text-light">Direction</h5>
                                    <select name="direction" class="form-control text-light bg-dark" required>
                                        <option value="up">Long (UP)</option>
                                        <option value="down">Short (DOWN)</option>
                                    </select>
                                    <small id="direction-error" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <h5 class="text-light">PROFIT</h5>
                                    <input type="number" step="0.0001" class="form-control text-light bg-dark"
                                        name="profit" required>
                                    <small id="entry_price-error" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <h5 class="text-light">Amount</h5>
                                    <input type="number" step="0.0001" class="form-control text-light bg-dark"
                                        name="amount" required>
                                    <small id="amount-error" class="text-danger"></small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Entry Date</h5>
                                    <input type="datetime-local" class="form-control text-light bg-dark"
                                        name="entry_date" required>
                                    <small id="entry_date-error" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Status</h5>
                                    <select name="status" class="form-control text-light bg-dark" id="statusSelect"
                                        required>
                                        <option value="active">Active</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                    <small id="status-error" class="text-danger"></small>
                                </div>
                            </div>

                            <div class="form-row" id="closedFields" style="display: none;">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Exit Price</h5>
                                    <input type="number" step="0.0001" class="form-control text-light bg-dark"
                                        name="exit_price">
                                    <small id="exit_price-error" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Exit Date</h5>
                                    <input type="datetime-local" class="form-control text-light bg-dark"
                                        name="exit_date">
                                    <small id="exit_date-error" class="text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="text-light">Notes</h5>
                                <textarea class="form-control text-light bg-dark" name="notes" rows="2"></textarea>
                                <small id="notes-error" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                    <i class="fas fa-plus-circle"></i> Create Trade
                                </button>
                            </div>
                        </form>

                        <script>
                            $(document).ready(function() {
                                // Initialize toastr
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "timeOut": "5000"
                                };
                        
                                // Show/hide closed fields based on status
                                $('#statusSelect').change(function() {
                                    if ($(this).val() === 'closed') {
                                        $('#closedFields').show();
                                        $('[name="exit_price"]').prop('required', true);
                                        $('[name="exit_date"]').prop('required', true);
                                    } else {
                                        $('#closedFields').hide();
                                        $('[name="exit_price"]').prop('required', false);
                                        $('[name="exit_date"]').prop('required', false);
                                    }
                                }).trigger('change');
                        
                                $('#tradeForm').on('submit', function(e) {
                                    e.preventDefault();
                                    
                                    // Reset error messages
                                    $('.text-danger').text('');
                                    
                                    // Disable button and show spinner
                                    $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');
                                    
                                    // Create FormData object
                                    let formData = new FormData(this);
                                    
                                    $.ajax({
                                        url: $(this).attr('action'),
                                        type: "POST",
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            toastr.success(response.message);
                                            $('#tradeForm')[0].reset();
                                            
                                            setTimeout(() => {
                                                window.location.reload(); // Or redirect if needed
                                            }, 2000);
                                        },
                                        error: function(xhr) {
                                            // Re-enable button and restore original text
                                            $('#submitBtn').prop('disabled', false).html('<i class="fas fa-plus-circle"></i> Create Trade');
                                            
                                            if(xhr.status === 422) {
                                                // Validation errors
                                                const errors = xhr.responseJSON.errors;
                                                $.each(errors, function(key, value) {
                                                    $(`#${key}-error`).text(value[0]);
                                                });
                                                toastr.error('Please fix the form errors');
                                            } else {
                                                toastr.error(xhr.responseJSON?.message || 'An error occurred');
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <!-- Trades Table -->
            <div class="mb-5 row">
                <div class="col card p-3 shadow bg-dark">
                    <div class="table-responsive">
                        <table id="tradeTable" class="table table-hover text-light">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Symbol</th>
                                    <th>Trader</th>
                                    <th>Type</th>
                                    <th>Direction</th>
                                    <th>Amount</th>
                                    <th>Entry Price</th>
                                    <th>Exit Price</th>
                                    <th>Profit</th>
                                    <th>Status</th>
                                    <th>Entry Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trades as $trade)
                                <tr id="trade-row-{{ $trade->id }}">
                                    <th scope="row">{{ $trade->id }}</th>
                                    <td>{{ $trade->symbol }}</td>
                                    <td>{{ $trade->trader_name }}</td>
                                    <td>{{ ucfirst($trade->type) }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $trade->direction === 'up' ? 'badge-success' : 'badge-danger' }}">
                                            {{ strtoupper($trade->direction) }}
                                        </span>
                                    </td>
                                    <td>{{ $trade->formattedAmount }}</td>
                                    <td>{{ number_format($trade->entry_price, 4) }}</td>
                                    <td>{{ $trade->exit_price ? number_format($trade->exit_price, 4) : 'N/A' }}</td>
                                    <td class="{{ $trade->profit >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $trade->profit ? $trade->formattedProfit : 'N/A' }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $trade->status === 'active' ? 'badge-primary' : 'badge-secondary' }}">
                                            {{ ucfirst($trade->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $trade->entry_date->format('M j, Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-btn" data-trade-id="{{ $trade->id }}"
                                            data-trade="{{ $trade }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-btn"
                                            data-trade-id="{{ $trade->id }}" data-trade-symbol="{{ $trade->symbol }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Trade Modal -->
    <div class="modal fade" id="editTradeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Trade #<span id="modalTradeId"></span></h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editTradeForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editTradeId">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Trader</label>
                                <select name="trader_name" class="form-control text-light bg-dark" id="editTraderName"
                                    required>
                                    <option value="VirtualBacon">VirtualBacon</option>
                                    <option value="CryptoRover">CryptoRover</option>
                                    <option value="BitBoy">BitBoy</option>
                                    <option value="Other">Other</option>
                                </select>
                                <small id="edit-trader_name-error" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Symbol</label>
                                <select name="symbol" class="form-control text-light bg-dark" id="editSymbol" required>
                                    <option value="BTCUSDT">BTC/USDT</option>
                                    <option value="ETHUSDT">ETH/USDT</option>
                                    <option value="TONUSDT">TON/USDT</option>
                                    <option value="XRPUSDT">XRP/USDT</option>
                                    <option value="SOLUSDT">SOL/USDT</option>
                                </select>
                                <small id="edit-symbol-error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Type</label>
                                <select name="type" class="form-control text-light bg-dark" id="editType" required>
                                    <option value="spot">Spot</option>
                                    <option value="futures">Futures</option>
                                    <option value="margin">Margin</option>
                                </select>
                                <small id="edit-type-error" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Direction</label>
                                <select name="direction" class="form-control text-light bg-dark" id="editDirection"
                                    required>
                                    <option value="up">Long (UP)</option>
                                    <option value="down">Short (DOWN)</option>
                                </select>
                                <small id="edit-direction-error" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Status</label>
                                <select name="status" class="form-control text-light bg-dark" id="editStatus" required>
                                    <option value="active">Active</option>
                                    <option value="closed">Closed</option>
                                </select>
                                <small id="edit-status-error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Amount</label>
                                <input type="number" step="0.0001" class="form-control bg-dark text-light" name="amount"
                                    id="editAmount" required>
                                <small id="edit-amount-error" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Entry Price</label>
                                <input type="number" step="0.0001" class="form-control bg-dark text-light"
                                    name="entry_price" id="editEntryPrice" required>
                                <small id="edit-entry_price-error" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Profit</label>
                                <input type="number" step="0.0001" class="form-control bg-dark text-light" name="profit"
                                    id="editProfit">
                                <small id="edit-profit-error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Entry Date</label>
                                <input type="datetime-local" class="form-control bg-dark text-light" name="entry_date"
                                    id="editEntryDate" required>
                                <small id="edit-entry_date-error" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-6" id="editExitDateField" style="display: none;">
                                <label>Exit Date</label>
                                <input type="datetime-local" class="form-control bg-dark text-light" name="exit_date"
                                    id="editExitDate">
                                <small id="edit-exit_date-error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6" id="editExitPriceField" style="display: none;">
                                <label>Exit Price</label>
                                <input type="number" step="0.0001" class="form-control bg-dark text-light"
                                    name="exit_price" id="editExitPrice">
                                <small id="edit-exit_price-error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control bg-dark text-light" name="notes" rows="2"
                                id="editNotes"></textarea>
                            <small id="edit-notes-error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateTradeBtn">
                            <i class="fas fa-save"></i> Update Trade
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteTradeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete trade for <span id="deleteTradeSymbol"
                            class="font-weight-bold"></span>?</p>
                    <p class="text-danger">This action cannot be undone!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    // Edit Trade Button Click
    $('.edit-btn').click(function() {
        const trade = $(this).data('trade');
        const tradeId = $(this).data('trade-id');
        
        // Populate modal
        $('#modalTradeId').text(tradeId);
        $('#editTradeId').val(tradeId);
        $('#editTraderName').val(trade.trader_name);
        $('#editSymbol').val(trade.symbol);
        $('#editType').val(trade.type);
        $('#editDirection').val(trade.direction);
        $('#editAmount').val(trade.amount);
        $('#editEntryPrice').val(trade.entry_price);
        $('#editProfit').val(trade.profit);
        $('#editStatus').val(trade.status);
        $('#editEntryDate').val(new Date(trade.entry_date).toISOString().slice(0, 16));
        $('#editExitPrice').val(trade.exit_price);
        $('#editExitDate').val(trade.exit_date ? new Date(trade.exit_date).toISOString().slice(0, 16) : '');
        $('#editNotes').val(trade.notes);
        
        // Toggle closed fields
        toggleClosedFields(trade.status);
        
        $('#editTradeModal').modal('show');
    });

    // Delete Trade Button Click
    $('.delete-btn').click(function() {
        const tradeId = $(this).data('trade-id');
        const tradeSymbol = $(this).data('trade-symbol');
        
        $('#deleteTradeSymbol').text(tradeSymbol);
        $('#confirmDeleteBtn').data('trade-id', tradeId);
        $('#deleteTradeModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function() {
    const tradeId = $(this).data('trade-id');
    const deleteBtn = $(this);
    
    deleteBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
    
    $.ajax({
        url: "{{ route('admin.trade.history.destroy', '') }}/" + tradeId,
        type: 'DELETE',
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            toastr.success(response.message);
            $('#trade-row-' + tradeId).remove();
            $('#deleteTradeModal').modal('hide');
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON.message || 'Error deleting trade');
            deleteBtn.prop('disabled', false).html('<i class="fas fa-trash"></i> Delete');
        }
    });
});

    // Edit Status Change
    $('#editStatus').change(function() {
        toggleClosedFields($(this).val());
    });

    function toggleClosedFields(status) {
        const showFields = status === 'closed';
        $('#editExitDateField, #editExitPriceField').toggle(showFields);
        
        if (showFields) {
            const now = new Date();
            const timezoneOffset = now.getTimezoneOffset() * 60000;
            const localISOTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);
            
            if (!$('#editExitDate').val()) {
                $('#editExitDate').val(localISOTime);
            }
        }
    }

   
});
</script>

<script>
    $(document).ready(function() {
        // Show/hide exit fields based on status
        $('#editStatus').change(function() {
            if ($(this).val() === 'closed') {
                $('#editExitDateField, #editExitPriceField').show();
                $('#editExitDate, #editExitPrice').prop('required', true);
            } else {
                $('#editExitDateField, #editExitPriceField').hide();
                $('#editExitDate, #editExitPrice').prop('required', false);
            }
        });

        // Edit form submission
        $('#editTradeForm').on('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            $('.text-danger').text('');
            
            // Disable button and show spinner
            $('#updateTradeBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
            
            // Get the trade ID
            const tradeId = $('#editTradeId').val();
            
            // Create FormData object
            let formData = new FormData(this);
            
            $.ajax({
                url: "{{ route('admin.trade.history.update', '') }}/" + tradeId,
                type: "POST", // Using POST with _method=PUT
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    
                    // Close modal after success
                    $('.modal').modal('hide');
                    
                    // Reload the page or update the table
                    setTimeout(() => {
                        window.location.reload(); // Or use datatable.ajax.reload() if using DataTables
                    }, 1500);
                },
                error: function(xhr) {
                    // Re-enable button and restore original text
                    $('#updateTradeBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Update Trade');
                    
                    if(xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $(`#edit-${key}-error`).text(value[0]);
                        });
                        toastr.error('Please fix the form errors');
                    } else {
                        toastr.error(xhr.responseJSON?.message || 'An error occurred while updating the trade');
                    }
                }
            });
        });

        // Function to populate edit form (call this when opening the modal)
        function populateEditForm(trade) {
            $('#editTradeId').val(trade.id);
            $('#editTraderName').val(trade.trader_name);
            $('#editSymbol').val(trade.symbol);
            $('#editType').val(trade.type);
            $('#editDirection').val(trade.direction);
            $('#editStatus').val(trade.status).trigger('change');
            $('#editAmount').val(trade.amount);
            $('#editEntryPrice').val(trade.entry_price);
            $('#editProfit').val(trade.profit);
            $('#editEntryDate').val(trade.entry_date ? trade.entry_date.replace(' ', 'T') : '');
            
            if (trade.status === 'closed') {
                $('#editExitDate').val(trade.exit_date ? trade.exit_date.replace(' ', 'T') : '');
                $('#editExitPrice').val(trade.exit_price);
            }
            
            $('#editNotes').val(trade.notes);
        }
    });
</script>

<script>
    $(document).ready(function() {
    // Initialize toastr (if not already done)
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };

    // Delete Trade Confirmation
    let tradeIdToDelete;
    $('.delete-trade').click(function() {
        tradeIdToDelete = $(this).data('id');
        const tradeName = $(this).data('name');
        $('#tradeToDelete').text(`(Trade ID: ${tradeIdToDelete}, Symbol: ${tradeName})`);
        $('#deleteTradeModal').modal('show');
    });

    // Confirm Delete Action
    $('#confirmDeleteTrade').click(function() {
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
        
        $.ajax({
            url: "{{ route('admin.trade.history.destroy', '') }}/" + tradeIdToDelete,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                toastr.success(response.message);
                $('#deleteTradeModal').modal('hide');
                
                // Reload the page or remove the row from the table
                setTimeout(() => {
                    window.location.reload(); // Or datatable.ajax.reload() if using DataTables
                }, 1500);
            },
            error: function(xhr) {
                $('#confirmDeleteTrade').prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Delete');
                
                if (xhr.status === 404) {
                    toastr.error('Trade not found');
                } else if (xhr.status === 403) {
                    toastr.error('You are not authorized to delete this trade');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred while deleting the trade');
                }
            }
        });
    });
});
</script>



@include('admin.footer')