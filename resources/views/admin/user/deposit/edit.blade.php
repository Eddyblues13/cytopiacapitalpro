@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content bg-dark">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-light">Edit Deposit for {{ $user->name }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow bg-dark">
                            <div class="card-body">
                                <form id="editDepositForm" method="POST"
                                    action="{{ route('admin.users.deposits.update', [$user->id, $deposit->id]) }}">
                                    @csrf
                                    @method('PUT')

                                    <div id="formErrors" class="alert alert-danger d-none"></div>

                                    <div class="form-group">
                                        <label class="text-light">Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" step="0.01" name="amount"
                                                class="form-control bg-dark text-light" value="{{ $deposit->amount }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Account Type</label>
                                        <select name="account_type" class="form-control bg-dark text-light" required>
                                            <option value="holding" {{ $deposit->account_type == 'holding' ? 'selected'
                                                : '' }}>Holding Account</option>
                                            <option value="trading" {{ $deposit->account_type == 'trading' ? 'selected'
                                                : '' }}>Trading Account</option>
                                            <option value="mining" {{ $deposit->account_type == 'mining' ? 'selected' :
                                                '' }}>Mining Account</option>
                                            <option value="staking" {{ $deposit->account_type == 'staking' ? 'selected'
                                                : '' }}>Staking Account</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-light">Status</label>
                                        <select name="status" class="form-control bg-dark text-light" required>
                                            <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : ''
                                                }}>Pending</option>
                                            <option value="approved" {{ $deposit->status == 'approved' ? 'selected' : ''
                                                }}>Approved</option>
                                            <option value="rejected" {{ $deposit->status == 'rejected' ? 'selected' : ''
                                                }}>Rejected</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Deposit</button>
                                        <a href="{{ route('admin.users.deposits.index', $user->id) }}"
                                            class="btn btn-secondary">Cancel</a>
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
    $('#editDepositForm').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        
        // Reset errors
        errorContainer.addClass('d-none').empty();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
        
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
                submitBtn.prop('disabled', false).html('Update Deposit');
                
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