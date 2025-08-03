@include('user.layouts.header')

<!-- Main Content -->
<div class="mx-3 my-4">
    <!-- Notification (only shown if session flag is set) -->
    @if(session('show_notification'))
    <div class="notification" id="deposit-notification">
        <div class="notification-text">
            deposit will be pending until there are sufficient confirmations on the blockchain.
        </div>
        <button class="close-button" id="close-notification">&times;</button>
    </div>
    @endif
    @if($deposits->isEmpty())
    <div class="deposit-card text-white text-center py-5">
        No Deposits yet
    </div>
    @else


    @foreach($deposits as $deposit)
    <div class="transaction-card">
        <div class="date-section">
            <div class="month fs-6 fw-bold">{{ $deposit->created_at->format('M') }}</div>
            <div class="day fs-2">{{ $deposit->created_at->format('d') }}</div>
        </div>
        <div class="transaction-details">
            <div class="amount text-silverish">FUND {{ config('currencies.' . Auth::user()->currency, '$') }}{{
                number_format($deposit->amount, 2) }}</div>
            <div class="deposit-description">{{ strtoupper($deposit->account_type) }} BALANCE TOTAL</div>
        </div>
        <div class="deposit-status">{{ ucfirst($deposit->status) }}</div>
    </div>
    @endforeach


    @endif
</div>

@include('user.layouts.footer')

<!-- Fixed Action Button -->
<button type="button" class="fixed-action-btn" aria-label="Add new item">
    <a href="{{ route('deposit.one') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
        </svg>
    </a>
</button>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Close notification
    document.querySelector('.close-button').addEventListener('click', function() {
        this.closest('.notification').style.display = 'none';
    });

    // Handle sidebar visibility and dropdowns
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');

        // Open all dropdowns when the sidebar is shown
        sidebar.addEventListener('shown.bs.offcanvas', () => {
            document.querySelectorAll('.dropdown-content').forEach(content => {
                content.classList.add('active');
                const arrow = content.previousElementSibling.querySelector('.arrow');
                if (arrow) {
                    arrow.classList.add('up');
                }
            });
        });

        // Optional: Close all dropdowns when the sidebar is hidden
        sidebar.addEventListener('hidden.bs.offcanvas', () => {
            document.querySelectorAll('.dropdown-content').forEach(content => {
                content.classList.remove('active');
                const arrow = content.previousElementSibling.querySelector('.arrow');
                if (arrow) {
                    arrow.classList.remove('up');
                }
            });
        });

        // Dropdown button functionality
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', () => {
                const dropdown = button.nextElementSibling;
                const arrow = button.querySelector('.arrow');
                
                // Close all other dropdowns
                document.querySelectorAll('.dropdown-content').forEach(content => {
                    if (content !== dropdown && content.classList.contains('active')) {
                        content.classList.remove('active');
                        content.previousElementSibling.querySelector('.arrow').classList.remove('up');
                    }
                });

                // Toggle current dropdown
                dropdown.classList.toggle('active');
                arrow.classList.toggle('up');
            });
        });
    });
</script>

<style>
    .deposit-card {
        background-color: #1E1E2D;
        border-radius: 8px;
    }

    .transaction-card {
        display: flex;
        align-items: center;
        background-color: #1E1E2D;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
    }

    .date-section {
        text-align: center;
        padding: 0 15px;
        color: white;
    }

    .transaction-details {
        flex-grow: 1;
        padding: 0 15px;
    }

    .amount {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .deposit-description {
        color: #6C757D;
        font-size: 0.9rem;
    }

    .deposit-status {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: bold;
    }

    .deposit-status.pending {
        background-color: #FFC107;
        color: #000;
    }

    .deposit-status.approved {
        background-color: #28A745;
        color: #FFF;
    }

    .deposit-status.rejected {
        background-color: #DC3545;
        color: #FFF;
    }

    .notification {
        position: relative;
        background-color: #2D2D42;
        color: white;
        padding: 15px;
        margin: 15px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-button {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .fixed-action-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #0D6EFD;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        z-index: 1000;
    }

    .fixed-action-btn svg {
        fill: white;
        width: 24px;
        height: 24px;
    }

    .text-silverish {
        color: #B8B8B8;
    }
</style>

</body>

</html>