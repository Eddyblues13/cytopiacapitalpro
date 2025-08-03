@include('admin.header')

<div class="main-panel bg-dark">
    <div class="content bg-dark">
        <div class="page-inner">

            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif

            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Payment Setting</h1>
            </div>

            <div class="mb-5 row">
                <div class="col-12">
                    <div class="card p-md-5 p-2 shadow-lg bg-dark">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-light d-inline">Payment Methods</h3>
                            <a href="{{ route('payment.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus-circle"></i> Add New
                            </a>
                        </div>

                        @if($payments->isEmpty())
                        <div class="text-center text-light py-3">No payment methods found.</div>
                        @else
                        <div class="row">
                            @foreach($payments as $payment)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div
                                    class="card bg-dark shadow border-{{ $payment->status === 'enabled' ? 'success' : 'danger' }}">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($payment->icon)
                                            <img src="{{ asset('storage/' . $payment->icon) }}"
                                                alt="{{ $payment->wallet_name }}" class="img-fluid"
                                                style="max-height: 30px; max-width: 30px;">
                                            @endif
                                            <strong class="ml-2 text-light">{{ $payment->wallet_name }}</strong>
                                        </div>
                                        <span
                                            class="badge badge-{{ $payment->status === 'enabled' ? 'success' : 'danger' }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <small class="text-muted">Coin Code:</small>
                                            <p class="text-light">{{ $payment->coin_code }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Coin Name:</small>
                                            <p class="text-light">{{ $payment->coin_name }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Wallet Type:</small>
                                            <p class="text-light">{{ $payment->wallet_type }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Network Type:</small>
                                            <p class="text-light">{{ ucfirst($payment->network_type) }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Wallet Address:</small>
                                            <p class="text-light text-truncate">{{ $payment->wallet_address }}</p>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-dark">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('payment.edit', $payment->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            @if(in_array($payment->wallet_name, ['Ethereum', 'Bitcoin', 'Litecoin']))
                                            <button class="btn btn-danger btn-sm" disabled>
                                                <i class="fa fa-trash"></i> Default
                                            </button>
                                            @else
                                            <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this payment method?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')