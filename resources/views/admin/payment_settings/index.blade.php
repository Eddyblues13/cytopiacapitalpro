@include('admin.header')
<div class="main-panel bg-dark">
    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif

            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Payment Settings</h1>
            </div>

            <div class="mb-5 row">
                <div class="col-12">
                    <div class="card p-md-5 p-2 shadow-lg bg-dark">
                        <h3 class="text-light d-inline">Payment Methods</h3>
                        <a href="{{ route('payment.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus-circle"></i> Add New
                        </a>

                        <div class="mt-4 table-responsive bg-dark text-light">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Method Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Used for</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->type }}</td>
                                        <td>{{ ucfirst($payment->type_for) }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $payment->status === 'enabled' ? 'badge-success' : 'badge-danger' }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('payment.edit', $payment->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @if(in_array($payment->name, ['Ethereum', 'Bitcoin', 'Litecoin']))
                                            <button class="btn btn-danger btn-sm" disabled>
                                                <i class="fa fa-trash"></i> Default
                                            </button>
                                            @else
                                            <form action="{{ route('payment.destroy', $payment->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')