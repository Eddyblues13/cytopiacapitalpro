@include('admin.header')
<div class="main-panel">
    <div class="content bg-dark ">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Manage Clients Stock History</h1>
            </div>
            <div>
            </div>
            <div>
            </div>
            <div class="mb-5 row">
                <div class="col-12">
                    <small class="text-light">if you can't see the image, try switching your uploaded location to
                        another option from your admin settings page.</small>
                </div>
                <div class="col-12 card shadow p-4 bg-dark">
                    <div class="table-responsive" data-example-id="hoverable-table">
                        <table id="ShipTable" class="table table-hover text-light">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client Name</th>
                                    <th>Stock Name</th>
                                    <th>Amount</th>
                                    <th>ROI</th>
                                    <th>Status</th>
                                    <th>Subscription Date</th>
                                    <th>Expires At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockHistories as $history)
                                <tr>
                                    <th scope="row">{{$history->id}}</th>
                                    <td>{{ $history->user ? $history->user->name : 'N/A' }}</td>
                                    <td>{{$history->stock_name}}</td>
                                    <td>${{ number_format($history->amount, 2, '.', ',') }}</td>
                                    <td>{{$history->roi}}%</td>
                                    <td>{{$history->status}}</td>
                                    <td>{{ \Carbon\Carbon::parse($history->subscription_day)->format('D, M j, Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($history->expired_at)->format('D, M j, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('admin.footer')