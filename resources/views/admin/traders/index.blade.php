@include('admin.header')

<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            <!-- Message Display Section -->
            <div class="message-container">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <ul class="mb-0 pl-3">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="title1 text-light">Expert Traders</h1>
                <a href="{{ route('traders.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Add New Trader
                </a>
            </div>

            <div class="row">
                @forelse($traders as $trader)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card bg-dark border-0 shadow-lg h-100">
                        <div class="card-body">
                            <!-- Trader Header -->
                            <div class="text-center mb-3">
                                <img src="{{ $trader->picture_url }}" alt="{{ $trader->name }}"
                                    class="rounded-circle mb-3" width="120" height="120"
                                    onerror="this.src='https://via.placeholder.com/120'">

                                @if($trader->is_verified)
                                <span class="badge badge-success mb-2">
                                    <i class="fas fa-check-circle"></i> Verified
                                </span>
                                @endif

                                <h3 class="h4 text-light mt-2">{{ $trader->name }}</h3>
                                <p class="text-muted">Expert Trader</p>
                            </div>

                            <!-- Trader Stats -->
                            <div class="trader-stats">
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary">
                                    <span class="text-muted">Followers:</span>
                                    <span class="text-light">{{ number_format($trader->followers) }}</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary">
                                    <span class="text-muted">Return Rate:</span>
                                    <span class="text-success">{{ number_format($trader->return_rate, 2) }}%</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary">
                                    <span class="text-muted">Min Amount:</span>
                                    <span class="text-light">${{ number_format($trader->min_amount, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-secondary">
                                    <span class="text-muted">Max Amount:</span>
                                    <span class="text-light">${{ number_format($trader->max_amount, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Profit Share:</span>
                                    <span class="text-warning">{{ number_format($trader->profit_share, 2) }}%</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('traders.edit', $trader->id) }}"
                                    class="btn btn-sm btn-primary flex-grow-1 mr-2">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <form action="{{ route('traders.destroy', $trader->id) }}" method="POST"
                                    class="flex-grow-1"
                                    onsubmit="return confirm('Are you sure you want to delete this trader?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card bg-dark">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-light">No Traders Found</h4>
                            <p class="text-muted">Click the button above to add your first trader</p>
                            <a href="{{ route('traders.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus mr-2"></i> Add Trader
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($traders->hasPages())
            <div class="mt-4">
                {{ $traders->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@include('admin.footer')

<style>
    .message-container {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 9999;
        width: 350px;
    }

    .alert {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #28a745;
    }

    .alert-danger {
        border-left-color: #dc3545;
    }

    .trader-stats {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 15px;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>

<script>
    // Auto-dismiss alerts after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeTo(500, 0).slideUp(500, function() {
                $(this).remove(); 
            });
        }, 5000);
        
        // Manual dismiss
        $('.alert .close').on('click', function() {
            $(this).parent().fadeTo(500, 0).slideUp(500, function() {
                $(this).remove(); 
            });
        });
    });
</script>