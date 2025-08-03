@include('admin.header')
<div class="main-panel">
    <div class="content bg-dark ">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Manage clients Trade Histories</h1>
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
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Trader Name</th>
                                    <th>Asset</th>
                                    <th>Amount</th>
                                    <th>ROI</th>
                                    <th>Trade Duration</th>
                                    <th>Subscription Day</th>
                                    <th>Subscription Hour</th>
                                    <th>Expired At</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($tradeHistories as $trade)
                                <tr>
                                    <th scope="row">{{$trade->id}}</th>
                                    <td>{{$trade->user->name ?? 'N/A'}}</td>
                                    <td>{{$trade->user_email}}</td>
                                    <td>{{$trade->status}}</td>
                                    <td>{{$trade->trader_name}}</td>
                                    <td>{{$trade->asset}}</td>
                                    <td>${{number_format($trade->amount, 2, '.', ',')}}</td>
                                    <td>{{$trade->roi}}%</td>
                                    <td>{{$trade->trade_duration}} days</td>
                                    <td>{{$trade->subscription_day}}</td>
                                    <td>{{$trade->subscription_hour}}</td>
                                    <td>{{ \Carbon\Carbon::parse($trade->expired_at)->format('D, M j, Y g:i A') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($trade->created_at)->format('D, M j, Y g:i A') }}
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


    @include('admin.footer')