@include('user.layouts.header')

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-white">My Copied Trades</h2>
            <p class="text-muted">View all traders you're currently copying</p>
        </div>
    </div>

    <!-- Status Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary filter-btn active" data-status="all">All</button>
                <button type="button" class="btn btn-outline-success filter-btn" data-status="active">Active</button>
                <button type="button" class="btn btn-outline-warning filter-btn" data-status="pending">Pending</button>
                <button type="button" class="btn btn-outline-danger filter-btn" data-status="closed">Closed</button>
            </div>
        </div>
    </div>

    <!-- Copied Trades Table -->
    <div class="card bg-dark border-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Trader</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tradingHistory as $history)
                        <tr class="trade-row" data-status="{{ strtolower($history->status) }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($history->trader->picture) }}" alt="{{ $history->trader->name }}"
                                        class="rounded-circle me-3" width="40">
                                    <div>
                                        <strong>{{ $history->trader->name }}</strong>
                                        <div class="small text-muted">
                                            Return: {{ $history->trader->return_rate }}%
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>${{ number_format($history->amount, 2) }}</td>
                            <td>
                                <span class="badge 
                                    @if($history->status == 'active') bg-success
                                    @elseif($history->status == 'pending') bg-warning
                                    @elseif($history->status == 'closed') bg-secondary
                                    @else bg-info @endif">
                                    {{ ucfirst($history->status) }}
                                </span>
                            </td>
                            <td>{{ $history->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                @if($history->status == 'active')
                                <button class="btn btn-sm btn-outline-danger stop-trade"
                                    data-trade-id="{{ $history->id }}" title="Stop Copying">
                                    <i class="fas fa-stop"></i>
                                </button>
                                @endif
                                <a href="#" class="btn btn-sm btn-outline-info" title="View Trader">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-exchange-alt fa-2x mb-2"></i>
                                    <p>You haven't copied any traders yet</p>
                                    <a href="{{route('copy.trade')}}" class="btn btn-primary">
                                        Browse Traders
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($tradingHistory->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $tradingHistory->links() }}
            </div>
            @endif
        </div>
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
    // Filter trades by status
    $('.filter-btn').click(function() {
        const status = $(this).data('status');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        // Show/hide rows
        if (status === 'all') {
            $('.trade-row').show();
        } else {
            $('.trade-row').hide();
            $(`.trade-row[data-status="${status}"]`).show();
        }
    });

    // Stop trade functionality
    $('.stop-trade').click(function() {
        const button = $(this);
        const tradeId = button.data('trade-id');
        
        if (!confirm('Are you sure you want to stop copying this trader?')) {
            return;
        }

        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '{{ route("copied.traders.stop") }}',
            type: 'POST',
            data: {
                trade_id: tradeId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    // Reload after 1 second
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(response.message);
                    button.prop('disabled', false).html('<i class="fas fa-stop"></i>');
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred. Please try again.');
                button.prop('disabled', false).html('<i class="fas fa-stop"></i>');
            }
        });
    });

    // Toastr configuration
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
});
</script>

<style>
    .table-dark {
        background-color: #1a202c;
        color: #fff;
    }

    .table-dark th {
        border-bottom: 1px solid #2d3748;
    }

    .table-dark td {
        border-top: 1px solid #2d3748;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #2d3748;
    }

    .filter-btn.active {
        color: #fff !important;
    }

    .filter-btn.active[data-status="all"] {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .filter-btn.active[data-status="active"] {
        background-color: #198754;
        border-color: #198754;
    }

    .filter-btn.active[data-status="pending"] {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000 !important;
    }

    .filter-btn.active[data-status="closed"] {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>