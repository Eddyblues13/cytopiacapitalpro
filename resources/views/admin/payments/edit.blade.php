@include('admin.header')

<div class="main-panel bg-dark">
    <div class="content bg-dark">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Edit Payment Method</h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card p-4 bg-dark shadow">
                        <form action="{{ route('payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="text-light">Coin Code</label>
                                <input type="text" name="coin_code" class="form-control bg-dark text-light" 
                                    value="{{ $payment->coin_code }}" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Coin Name</label>
                                <input type="text" name="coin_name" class="form-control bg-dark text-light" 
                                    value="{{ $payment->coin_name }}" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Wallet Name</label>
                                <input type="text" name="wallet_name" class="form-control bg-dark text-light" 
                                    value="{{ $payment->wallet_name }}" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Wallet Type</label>
                                <select name="wallet_type" class="form-control bg-dark text-light" required>
                                    <option value="crypto" {{ $payment->wallet_type == 'crypto' ? 'selected' : '' }}>Cryptocurrency</option>
                                    <option value="fiat" {{ $payment->wallet_type == 'fiat' ? 'selected' : '' }}>Fiat Currency</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Network Type</label>
                                <input type="text" name="network_type" class="form-control bg-dark text-light" 
                                    value="{{ $payment->network_type }}" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Wallet Address</label>
                                <input type="text" name="wallet_address" class="form-control bg-dark text-light" 
                                    value="{{ $payment->wallet_address }}" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Status</label>
                                <select name="status" class="form-control bg-dark text-light" required>
                                    <option value="enabled" {{ $payment->status == 'enabled' ? 'selected' : '' }}>Enabled</option>
                                    <option value="disabled" {{ $payment->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Icon (Optional)</label>
                                @if($payment->icon)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $payment->icon) }}" alt="Icon" style="max-height: 50px;">
                                    <a href="#" class="text-danger ml-2" onclick="event.preventDefault(); document.getElementById('remove-icon').value = '1';">Remove Icon</a>
                                    <input type="hidden" name="remove_icon" id="remove-icon" value="0">
                                </div>
                                @endif
                                <input type="file" name="icon" class="form-control-file bg-dark text-light">
                                <small class="text-muted">Recommended size: 64x64 pixels</small>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Payment Method</button>
                                <a href="{{ route('payment.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')