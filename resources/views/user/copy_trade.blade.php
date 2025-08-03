@include('user.layouts.header')

<!-- Main Content -->
<div class="trading-main-content mx-4 my-4">

    <!-- Balance Display -->
    <div class="balance-display mb-4 p-3 bg-dark rounded">
        <h5 class="text-white">Trading Balance: $<span id="currentTradingBalance">{{ number_format($tradingBalance, 2)
                }}</span></h5>
    </div>

    <!-- Search -->
    <div class="search-container mb-4">
        <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search traders by name...">
        <a href="{{ route('copied.traders') }}" class="btn btn-info ms-3">
            <i class="fas fa-list-check me-2"></i> My Trades
        </a>
    </div>


    <!-- Trader Cards Container -->
    <div id="tradersContainer">
        @foreach($traders as $trader)
        <div class="row mb-3 trader-card-wrapper">
            <div class="col-12">
                <div class="trader-card p-4 bg-dark rounded">
                    <div class="row align-items-center">
                        <!-- Left Column with Image and Button -->
                        <div class="col-md-3 text-center">
                            <img src="{{ asset($trader->picture_url) }}" alt="{{ $trader->name }}"
                                class="profile-image mb-3 rounded-circle" width="100">
                            <button class="btn btn-primary copy-button w-100 py-2" data-trader-id="{{ $trader->id }}"
                                data-min-amount="{{ $trader->min_amount }}" data-trader-name="{{ $trader->name }}">
                                COPY TRADE
                            </button>
                        </div>

                        <!-- Right Column with Info and Stats -->
                        <div class="col-md-9">
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="h4 me-2 text-white">{{ $trader->name }}</span>
                                    @if($trader->is_verified)
                                    <span class="verified-badge fs-5 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#0d6efd">
                                            <path
                                                d="m344-60-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm34-102 102-44 104 44 56-96 110-26-10-112 74-84-74-86 10-112-110-24-58-96-102 44-104-44-56 96-110 24 10 112-74 86 74 84-10 114 110 24 58 96Zm102-318Zm-42 142 226-226-56-58-170 170-86-84-56 56 142 142Z" />
                                        </svg>
                                    </span>
                                    @endif
                                    <span class="trophy ms-2" title="Top Trader">🏆</span>
                                </div>
                                <div class="trader-label badge bg-secondary mb-3">{{ $trader->category ?? 'Professional
                                    Trader' }}</div>

                                <div class="row stats-row">
                                    <div class="col-md-4 stat-item">
                                        <div class="stat-value text-success">{{ $trader->return_rate }}%</div>
                                        <div class="stat-label">Avg. Return</div>
                                    </div>
                                    {{-- <div class="col-md-4 stat-item">
                                        <div class="stat-value text-info">{{ number_format($trader->followers) }}</div>
                                        <div class="stat-label">Followers</div>
                                    </div> --}}
                                    <div class="col-md-4 stat-item">
                                        <div class="stat-value text-warning">{{ $trader->profit_share }}%</div>
                                        <div class="stat-label">Profit Share</div>
                                    </div>
                                </div>

                                {{-- <div class="mt-3">
                                    <small class="text-muted">Min. Investment: ${{ number_format($trader->min_amount, 2)
                                        }}</small>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('user.layouts.footer')

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
    // Search functionality
    $('#searchInput').on('input', function() {
        const searchQuery = this.value.toLowerCase();
        $('.trader-card-wrapper').each(function() {
            const traderName = $(this).find('.h4').text().toLowerCase();
            $(this).toggle(traderName.includes(searchQuery));
        });
    });

    // Copy trade functionality
    $('.copy-button').on('click', function() {
        const button = $(this);
        const traderId = button.data('trader-id');
        const amount = parseFloat(button.data('min-amount'));
        const traderName = button.data('trader-name');
        
        // Confirm dialog with trader details
        if (!confirm(`Confirm copying ${traderName} with $${amount.toFixed(2)}?`)) {
            return;
        }

        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

        $.ajax({
            url: '{{ route("copy.trader") }}',
            type: 'POST',
            data: {
                trader_id: traderId,
                amount: amount,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    button.removeClass('btn-primary')
                         .addClass('btn-success')
                         .html('<i class="fas fa-check"></i> Copied');
                    
                    // Update balance display
                    if (response.new_balance !== undefined) {
                        $('#currentTradingBalance').text(response.new_balance.toFixed(2));
                    }
                    
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                    button.prop('disabled', false).text('COPY TRADE');
                }
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Failed to process request';
                toastr.error(errorMsg);
                button.prop('disabled', false).text('COPY TRADE');
            }
        });
    });
});

// Initialize Toastr
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000"
};
</script>


<script>
    $(document).ready(function() {
        // Search functionality
        $('#searchInput').on('input', function() {
            const searchQuery = this.value.toLowerCase();
            $('.trader-card-wrapper').each(function() {
                const traderName = $(this).find('.h4').text().toLowerCase();
                $(this).toggle(traderName.includes(searchQuery));
            });
        });

        // Copy trade functionality
        $('.copy-button').on('click', function() {
            const button = $(this);
            const traderId = button.data('trader-id');
            const amount = parseFloat(button.data('min-amount'));
            
            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

            $.ajax({
                url: '{{ route("copy.trader") }}',
                type: 'POST',
                data: {
                    trader_id: traderId,
                    amount: amount,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        button.removeClass('btn-primary')
                             .addClass('btn-success')
                             .html('<i class="fas fa-check"></i> Copied');
                        
                        // Update balance display
                        if (response.new_balance !== undefined) {
                            $('#currentTradingBalance').text(response.new_balance.toFixed(2));
                        }
                        
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                        button.prop('disabled', false).text('COPY TRADE');
                    }
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.message || 'Failed to process request';
                    toastr.error(errorMsg);
                    button.prop('disabled', false).text('COPY TRADE');
                }
            });
        });
    });

    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
</script>

<style>
    .trader-card {
        border: 1px solid #2d3748;
        transition: transform 0.2s;
    }

    .trader-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        border: 3px solid #0d6efd;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #adb5bd;
    }

    .trader-label {
        font-size: 0.8rem;
        text-transform: uppercase;
    }

    .search-bar {
        background-color: #2d3748;
        border: none;
        color: white;
        padding: 10px 15px;
    }

    .search-bar:focus {
        background-color: #2d3748;
        color: white;
        box-shadow: none;
    }

    .copy-button {
        transition: all 0.3s;
    }

    .verified-badge {
        color: #0d6efd;
    }
</style>