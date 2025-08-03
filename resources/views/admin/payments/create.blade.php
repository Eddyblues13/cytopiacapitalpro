@include('admin.header')

<div class="main-panel bg-dark">
    <div class="content bg-dark">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Add New Payment Method</h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card p-4 bg-dark shadow">
                        <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="text-light">Coin Code</label>
                                <input type="text" name="coin_code" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Coin Name</label>
                                <input type="text" name="coin_name" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Wallet Name</label>
                                <input type="text" name="wallet_name" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Wallet Type</label>
                                <select name="wallet_type" class="form-control bg-dark text-light" required>
                                    <option value="crypto">Cryptocurrency</option>
                                    <option value="fiat">Fiat Currency</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Network Type</label>
                                <input type="text" name="network_type" class="form-control bg-dark text-light" required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Wallet Address</label>
                                <input type="text" name="wallet_address" class="form-control bg-dark text-light"
                                    required>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Status</label>
                                <select name="status" class="form-control bg-dark text-light" required>
                                    <option value="enabled">Enabled</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-light">Icon (Optional)</label>
                                <input type="file" name="icon" class="form-control-file bg-dark text-light">
                                <small class="text-muted">Recommended size: 64x64 pixels</small>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Payment Method</button>
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