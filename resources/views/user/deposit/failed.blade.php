@include('user.layouts.header')

<div class="payment-failed-container">
    <div class="payment-failed-card">
        <div class="failed-icon">
            <i class="fas fa-times-circle"></i>
        </div>
        <h2>Payment Failed</h2>

        @if(request('reason') == 'timeout')
        <p class="reason">Your payment time has expired. The transaction was not completed within the allowed time.</p>
        <p class="details">Please initiate a new transaction if you still wish to proceed with your payment.</p>
        @else
        <p class="reason">We couldn't process your payment.</p>
        <p class="details">Please check your payment details and try again.</p>
        @endif

        <div class="transaction-details">
            <p><strong>Transaction ID:</strong> {{ request('txn_id') ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('deposit.one') }}" class="btn-retry">
                <i class="fas fa-redo"></i> Try Again
            </a>
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fas fa-home"></i> Return Home
            </a>
        </div>
    </div>
</div>

<style>
    .payment-failed-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .payment-failed-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .failed-icon {
        color: #e74c3c;
        font-size: 72px;
        margin-bottom: 20px;
    }

    h2 {
        color: #e74c3c;
        margin-bottom: 15px;
        font-size: 28px;
    }

    .reason {
        color: #333;
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .details {
        color: #666;
        margin-bottom: 25px;
        font-size: 16px;
    }

    .transaction-details {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin: 25px 0;
        text-align: left;
    }

    .transaction-details p {
        margin: 5px 0;
        color: #555;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-retry,
    .btn-home {
        padding: 12px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-retry {
        background-color: #3498db;
        color: white;
        border: 2px solid #3498db;
    }

    .btn-retry:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .btn-home {
        background-color: white;
        color: #495057;
        border: 2px solid #dee2e6;
    }

    .btn-home:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
    }
</style>

@include('user.layouts.footer')