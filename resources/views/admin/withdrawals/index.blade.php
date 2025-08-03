"@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Manage Withdrawals</h1>
                </div>

                <!-- Search Box -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="searchInput" class="form-control bg-dark text-light"
                                placeholder="Search by user name...">
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-secondary filter-btn" data-filter="all">All</button>
                            <button type="button" class="btn btn-success filter-btn"
                                data-filter="approved">Approved</button>
                            <button type="button" class="btn btn-warning filter-btn"
                                data-filter="pending">Pending</button>
                            <button type="button" class="btn btn-danger filter-btn"
                                data-filter="rejected">Rejected</button>
                        </div>
                    </div>
                </div>

                <!-- Withdrawal Cards -->
                <div class="row" id="withdrawalsContainer">
                    @foreach($withdrawals as $withdrawal)
                    <div class="col-md-6 col-lg-4 mb-4 withdrawal-card"
                        data-user="{{ strtolower($withdrawal->user->first_name.' '.$withdrawal->user->last_name) }}"
                        data-status="{{ $withdrawal->status }}">
                        <div class="card bg-dark border-{{ 
                            $withdrawal->status == 'approved' ? 'success' : 
                            ($withdrawal->status == 'rejected' ? 'danger' : 'warning') 
                        }}">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title text-light mb-0">
                                        {{ $withdrawal->user->first_name }} {{ $withdrawal->user->last_name }}
                                    </h5>
                                    <span class="badge 
                                        @if($withdrawal->status == 'approved') badge-success
                                        @elseif($withdrawal->status == 'rejected') badge-danger
                                        @else badge-warning
                                        @endif">
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Amount:</strong>
                                    <span class="float-right">
                                        @if($withdrawal->account_type == 'crypto')
                                        {{ number_format($withdrawal->amount, 8) }} {{
                                        strtoupper($withdrawal->crypto_currency) }}
                                        @else
                                        ${{ number_format($withdrawal->amount, 2) }}
                                        @endif
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <strong>Account Type:</strong>
                                    <span class="float-right text-capitalize">
                                        {{ $withdrawal->crypto_currency }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <strong>Payment Details:</strong>
                                    <div class="mt-1 text-right">

                                        <div class="d-flex justify-content-between">
                                            <span>Crypto Type:</span>
                                            <span class="text-capitalize">{{ $withdrawal->crypto_currency }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <span>Wallet Address:</span>
                                            <div class="text-truncate wallet-address" style="max-width: 150px;"
                                                title="{{ $withdrawal->wallet_address }}"
                                                data-clipboard-text="{{ $withdrawal->wallet_address }}">
                                                {{ $withdrawal->wallet_address }}
                                            </div>
                                            <button class="btn btn-sm btn-outline-light copy-btn ml-1"
                                                title="Copy to clipboard">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <strong>Date:</strong>
                                    <span class="float-right">
                                        {{ $withdrawal->created_at->format('M d, Y H:i') }}
                                    </span>
                                </div>

                                @if($withdrawal->status == 'pending')
                                <div class="mt-4 pt-3 border-top">
                                    <div class="btn-group w-100">
                                        <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}"
                                            method="POST" class="w-50" data-ajax-form>
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-block">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}"
                                            method="POST" class="w-50" data-ajax-form>
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block">Reject</button>
                                        </form>
                                    </div>
                                </div>
                                @else
                                <div class="mt-4 pt-3 border-top text-center text-muted">
                                    No actions available
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Clipboard.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    $(document).ready(function () {
        // Initialize clipboard
        new ClipboardJS('.copy-btn', {
            text: function(trigger) {
                return $(trigger).prev('.wallet-address').data('clipboard-text');
            }
        });

        // Show tooltip when copied
        $('.copy-btn').tooltip({
            trigger: 'click',
            placement: 'top'
        });

        // Change tooltip text after copy
        $('.copy-btn').on('click', function() {
            $(this).attr('title', 'Copied!')
                   .tooltip('_fixTitle')
                   .tooltip('show');
            
            setTimeout(() => {
                $(this).attr('title', 'Copy to clipboard')
                       .tooltip('_fixTitle');
            }, 2000);
        });

        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            const filterStatus = $('.filter-btn.active').data('filter');
            
            $('.withdrawal-card').each(function() {
                const userName = $(this).data('user');
                const status = $(this).data('status');
                
                const matchesSearch = userName.includes(searchTerm);
                const matchesFilter = filterStatus === 'all' || status === filterStatus;
                
                if (matchesSearch && matchesFilter) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Filter functionality
        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            
            const filterStatus = $(this).data('filter');
            const searchTerm = $('#searchInput').val().toLowerCase();
            
            $('.withdrawal-card').each(function() {
                const userName = $(this).data('user');
                const status = $(this).data('status');
                
                const matchesSearch = userName.includes(searchTerm);
                const matchesFilter = filterStatus === 'all' || status === filterStatus;
                
                if (matchesSearch && matchesFilter) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Initialize with "All" filter active
        $('.filter-btn[data-filter="all"]').addClass('active');

        // Handle approve/reject with AJAX
        $('form[data-ajax-form]').submit(function(e) {
            e.preventDefault();
            
            const form = $(this);
            const button = form.find('[type="submit"]');
            const action = form.attr('action').includes('approve') ? 'approve' : 'reject';
            
            if(confirm(`Are you sure you want to ${action} this withdrawal?`)) {
                // Show loading state
                button.prop('disabled', true).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${action.charAt(0).toUpperCase() + action.slice(1)}ing...`);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status === 'success') {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        toastr.error(response.message || 'An error occurred');
                        button.prop('disabled', false).html(action.charAt(0).toUpperCase() + action.slice(1));
                    }
                });
            }
        });
    });
</script>

<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .filter-btn.active {
        border: 2px solid #fff;
    }

    .pagination .page-item.active .page-link {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .pagination .page-link {
        background-color: #343a40;
        color: #fff;
        border-color: #454d55;
    }

    .pagination .page-link:hover {
        background-color: #495057;
        color: #fff;
    }

    /* Wallet address styles */
    .wallet-address {
        cursor: pointer;
        display: inline-block;
        vertical-align: middle;
    }

    .wallet-address:hover {
        text-decoration: underline;
    }

    .copy-btn {
        padding: 0.15rem 0.3rem;
        font-size: 0.75rem;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1rem;
        }

        .btn-group.w-100 {
            flex-direction: column;
        }

        .btn-group.w-100 form {
            width: 100% !important;
            margin-bottom: 0.5rem;
        }
    }
</style>"