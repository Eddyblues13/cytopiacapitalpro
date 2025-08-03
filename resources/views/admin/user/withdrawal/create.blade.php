@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Create Withdrawal for {{ $user->name }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <form id="createWithdrawalForm" method="POST" action="{{ route('admin.users.withdrawals.store', $user->id) }}">
                                    @csrf
                                    
                                    <div id="formErrors" class="alert alert-danger d-none"></div>
                                    
                                    <div class="form-group">
                                        <label class="text-light">Amount</label>
                                        <input type="number" step="0.00000001" name="amount" class="form-control bg-dark text-light" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="text-light">Account Type</label>
                                        <select name="account_type" id="accountType" class="form-control bg-dark text-light" required>
                                            <option value="">Select Account Type</option>
                                            <option value="bank">Bank</option>
                                            <option value="crypto">Crypto</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group" id="cryptoCurrencyGroup" style="display: none;">
                                        <label class="text-light">Crypto Currency</label>
                                        <select name="crypto_currency" class="form-control bg-dark text-light">
                                            <option value="">Select Currency</option>
                                            <option value="btc">Bitcoin (BTC)</option>
                                            <option value="eth">Ethereum (ETH)</option>
                                            <option value="usdt">Tether (USDT)</option>
                                            <!-- Add more crypto currencies as needed -->
                                        </select>
                                    </div>
                                    
                                    <div class="form-group" id="walletAddressGroup" style="display: none;">
                                        <label class="text-light">Wallet Address</label>
                                        <input type="text" name="wallet_address" class="form-control bg-dark text-light">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="text-light">Status</label>
                                        <select name="status" class="form-control bg-dark text-light" required>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create Withdrawal</button>
                                        <a href="{{ route('admin.users.withdrawals.index', $user->id) }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
$(document).ready(function() {
    // Show/hide crypto fields based on account type selection
    $('#accountType').change(function() {
        if ($(this).val() === 'crypto') {
            $('#cryptoCurrencyGroup').show();
            $('#walletAddressGroup').show();
            $('[name="crypto_currency"]').prop('required', true);
            $('[name="wallet_address"]').prop('required', true);
        } else {
            $('#cryptoCurrencyGroup').hide();
            $('#walletAddressGroup').hide();
            $('[name="crypto_currency"]').prop('required', false);
            $('[name="wallet_address"]').prop('required', false);
        }
    });

    $('#createWithdrawalForm').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        
        // Reset errors
        errorContainer.addClass('d-none').empty();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Create Withdrawal');
                
                if(xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="mb-0">';
                    
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    
                    errorHtml += '</ul>';
                    errorContainer.html(errorHtml).removeClass('d-none');
                } else {
                    // Other errors
                    const response = xhr.responseJSON;
                    toastr.error(response.message || 'An error occurred');
                }
            }
        });
    });
});
</script>