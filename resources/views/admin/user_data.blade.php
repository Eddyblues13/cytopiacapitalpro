@include('admin.header')
<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div>
            </div>
            <div>
            </div> <!-- Beginning of  Dashboard Stats  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 card bg-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h1 class="d-inline text-primary">{{$user->name}}</h1>
                                    <span></span>
                                    <div class="d-inline">
                                        <div class="float-right btn-group">
                                            <a class="btn btn-primary btn-sm" href="{{route('manage.users.page')}}"> <i
                                                    class="fa fa-arrow-left"></i> back</a> &nbsp;
                                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                data-toggle="dropdown" data-display="static" aria-haspopup="true"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg-right">
                                                <a class="dropdown-item" href="">Login Activity</a>
                                                <a href="#" data-toggle="modal" data-target="#holdingBalanceModal"
                                                    class="dropdown-item">Credit/Debit Holding Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#tradingBalanceModal"
                                                    class="dropdown-item">Credit/Debit Trading Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#stakingBalanceModal"
                                                    class="dropdown-item">Credit/Debit Staking Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#miningBalanceModal"
                                                    class="dropdown-item">Credit/Debit Mining Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#referralBalanceModal"
                                                    class="dropdown-item">Credit/Debit Referral Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#profitBalanceModal"
                                                    class="dropdown-item">Credit/Debit Profit</a>

                                                <a href="{{ route('admin.users.deposits.index', ['user' => $user->id]) }}"
                                                    class="dropdown-item">Edit Deposit</a>
                                                <a href="{{ route('admin.users.withdrawals.index', ['user' => $user->id]) }}"
                                                    class="dropdown-item">Edit Withdrawal</a>

                                                <a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal"
                                                    class="dropdown-item">Send Email</a>
                                                <a href="#" data-toggle="modal" data-target="#switchuserModal"
                                                    class="dropdown-item text-success">Gain Access</a>
                                                <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                    class="dropdown-item text-danger">Delete {{$user->name}}</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 mt-4 border rounded row text-light">
                                <div class="col-md-3">
                                    <h5 class="text-bold">Deposit Balance</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($trading_balance, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-bold">Holding Balance</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($holding_balance, 2, '.', ',')}}</p>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="text-bold">Trading Balance</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($trading_balance, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-bold">Mining Balance</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($mining_balance, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-bold">Referral Balance</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($referral_balance, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-bold">Profit</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($profit_balance, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Total Deposit</h5>
                                    <p>{{ config('currencies.' . $user->currency, '$')
                                        }}{{number_format($successful_deposits_sum, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5>User Account Status</h5>
                                    <span class="badge badge-success">Active</span>
                                </div>
                                <div class="col-md-3">
                                    <h5>Trades</h5>
                                    <a class="btn btn-sm btn-primary d-inline"
                                        href="{{ route('admin.users.trading-histories.index', ['user' => $user->id]) }}">Add
                                        Trade</a>
                                </div>
                                <div class="col-md-3">
                                    <h5>Manage User</h5>
                                    <a class="btn btn-sm btn-primary d-inline"
                                        href="{{ route('admin.users.edit', ['user' => $user->id]) }}">Edit User</a>
                                </div>
                                <div class="col-md-3">
                                    <h5>ID Verification</h5>
                                    <a class="btn btn-sm btn-primary d-inline"
                                        href="{{ route('admin.users.identity-verifications.index', ['user' => $user->id]) }}">View</a>
                                </div>
                                <div class="col-md-3">
                                    <h5>Address Verification</h5>
                                    <a class="btn btn-sm btn-primary d-inline"
                                        href="{{ route('admin.users.address-verifications.index', ['user' => $user->id]) }}">View</a>
                                </div>
                                <div class="col-md-3">
                                    <h5>Signal Strength</h5>
                                    <span class="badge badge-success">{{$user->signal_strength}}%</span>
                                </div>

                                <!-- New status toggles -->
                                <div class="col-md-3">
                                    <h5>Top Up Mail</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="top_up_mail" {{ $user->top_up_mail ? 'checked' : ''
                                        }} onchange="updateStatus('top_up_mail', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="top_up_mail_status"
                                        class="badge {{ $user->top_up_mail ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->top_up_mail ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                <div class="col-md-3">
                                    <h5>Notification Status</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="notification_status" {{ $user->notification_status ?
                                        'checked' : '' }} onchange="updateStatus('notification_status', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="notification_status_status"
                                        class="badge {{ $user->notification_status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->notification_status ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                <div class="col-md-3">
                                    <h5>Network Status</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="network_status" {{ $user->network_status ? 'checked'
                                        : '' }} onchange="updateStatus('network_status', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="network_status_status"
                                        class="badge {{ $user->network_status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->network_status ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                <div class="col-md-3">
                                    <h5>Upgrade Status</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="upgrade_status" {{ $user->upgrade_status ? 'checked'
                                        : '' }} onchange="updateStatus('upgrade_status', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="upgrade_status_status"
                                        class="badge {{ $user->upgrade_status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->upgrade_status ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                <div class="col-md-3">
                                    <h5>Confirmed Registration Fee</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="confirmed_registration_fee" {{
                                            $user->confirmed_registration_fee ? 'checked' : '' }}
                                        onchange="updateStatus('confirmed_registration_fee', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="confirmed_registration_fee_status"
                                        class="badge {{ $user->confirmed_registration_fee ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->confirmed_registration_fee ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                <div class="col-md-3">
                                    <h5>Top Up Status</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="top_up_status" {{ $user->top_up_status ? 'checked' :
                                        '' }} onchange="updateStatus('top_up_status', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="top_up_status_status"
                                        class="badge {{ $user->top_up_status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->top_up_status ? 'ON' : 'OFF' }}
                                    </span>
                                </div>

                                <div class="col-md-3">
                                    <h5>Subscription Status</h5>
                                    <label class="switch">
                                        <input type="checkbox" id="subscription_status" {{ $user->subscription_status ?
                                        'checked' : '' }} onchange="updateStatus('subscription_status', this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="subscription_status_status"
                                        class="badge {{ $user->subscription_status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->subscription_status ? 'ON' : 'OFF' }}
                                    </span>
                                </div>
                            </div>

                            <style>
                                /* Switch styling */
                                .switch {
                                    position: relative;
                                    display: inline-block;
                                    width: 60px;
                                    height: 34px;
                                }

                                .switch input {
                                    opacity: 0;
                                    width: 0;
                                    height: 0;
                                }

                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: #ccc;
                                    -webkit-transition: .4s;
                                    transition: .4s;
                                }

                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 26px;
                                    width: 26px;
                                    left: 4px;
                                    bottom: 4px;
                                    background-color: white;
                                    -webkit-transition: .4s;
                                    transition: .4s;
                                }

                                input:checked+.slider {
                                    background-color: #2196F3;
                                }

                                input:focus+.slider {
                                    box-shadow: 0 0 1px #2196F3;
                                }

                                input:checked+.slider:before {
                                    -webkit-transform: translateX(26px);
                                    -ms-transform: translateX(26px);
                                    transform: translateX(26px);
                                }

                                /* Rounded sliders */
                                .slider.round {
                                    border-radius: 34px;
                                }

                                .slider.round:before {
                                    border-radius: 50%;
                                }
                            </style>

                            <script>
                                function updateStatus(field, value) {
    fetch("{{ route('admin.update.user.status') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            user_id: "{{ $user->id }}",
            field: field,
            value: value ? 1 : 0
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const statusElement = document.getElementById(`${field}_status`);
            statusElement.textContent = value ? 'ON' : 'OFF';
            statusElement.className = `badge ${value ? 'badge-success' : 'badge-danger'}`;
            toastr.success('Status updated successfully');
        } else {
            toastr.error('Error updating status');
            // Revert the switch if there was an error
            document.getElementById(field).checked = !value;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        toastr.error('Error updating status');
        // Revert the switch if there was an error
        document.getElementById(field).checked = !value;
    });
}
                            </script>
                            <div class="mt-3 row text-light">
                                <div class="col-md-12">
                                    <h5>USER INFORMATION</h5>
                                </div>
                            </div>
                            @php
                            $fields = [
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'email' => 'Email Address',
                            'phone_number' => 'Mobile Number',
                            'currency' => 'Currency',
                            'country' => 'Country',
                            'city' => 'City',
                            'profile_photo' => 'Profile Photo',
                            'email_verification' => 'Email Verification',
                            'id_verification' => 'ID Verification',
                            'address_verification' => 'Address Verification',
                            'user_status' => 'User Status',
                            'signal_strength' => 'Signal Strength',
                            'referral_code' => 'Referral Code',
                            'referred_by' => 'Referred By',
                            ];
                            @endphp

                            @foreach($fields as $key => $label)
                            <div class="p-3 border row text-light">
                                <div class="col-md-4 border-right">
                                    <h5>{{ $label }}</h5>
                                </div>
                                <div class="col-md-8">
                                    @if($key === 'profile_photo')
                                    <span id="display-{{ $key }}">
                                        <img src="{{ asset($user->$key) }}" alt="Profile Photo"
                                            style="width:100px; height:auto;">
                                    </span>
                                    <input type="file" class="form-control d-none" id="input-{{ $key }}"
                                        accept="image/*">
                                    @elseif($key === 'email_verification')
                                    <span id="display-{{ $key }}">
                                        {{ $user->$key == 1 ? 'Verified' : 'Not Verified' }}
                                    </span>
                                    <select class="form-control d-none" id="input-{{ $key }}">
                                        <option value="1" {{ $user->$key == 1 ? 'selected' : '' }}>Verified</option>
                                        <option value="0" {{ $user->$key == 0 ? 'selected' : '' }}>Not Verified</option>
                                    </select>
                                    @elseif($key === 'id_verification')
                                    <span id="display-{{ $key }}">
                                        {{ $user->$key == 1 ? 'Verified' : 'Not Verified' }}
                                    </span>
                                    <select class="form-control d-none" id="input-{{ $key }}">
                                        <option value="1" {{ $user->$key == 1 ? 'selected' : '' }}>Verified</option>
                                        <option value="0" {{ $user->$key == 0 ? 'selected' : '' }}>Not Verified</option>
                                    </select>
                                    @elseif($key === 'address_verification')
                                    <span id="display-{{ $key }}">
                                        {{ $user->$key == 1 ? 'Verified' : 'Not Verified' }}
                                    </span>
                                    <select class="form-control d-none" id="input-{{ $key }}">
                                        <option value="1" {{ $user->$key == 1 ? 'selected' : '' }}>Verified</option>
                                        <option value="0" {{ $user->$key == 0 ? 'selected' : '' }}>Not Verified</option>
                                    </select>
                                    @elseif($key === 'password' || $key === 'plain')
                                    <span id="display-{{ $key }}">********</span> <!-- Masked for security -->
                                    <input type="password" class="form-control d-none" id="input-{{ $key }}" value="">
                                    @else
                                    <span id="display-{{ $key }}">{{ $user->$key }}</span>
                                    <input type="text" class="form-control d-none" id="input-{{ $key }}"
                                        value="{{ $user->$key }}">
                                    @endif
                                    <button class="btn btn-sm btn-primary edit-btn"
                                        data-field="{{ $key }}">Edit</button>
                                    <button class="btn btn-sm btn-success save-btn d-none"
                                        data-field="{{ $key }}">Save</button>
                                </div>
                            </div>
                            @endforeach
                            <div class="p-3 border row text-light">
                                <div class="col-md-4 border-right">
                                    <h5>Password</h5>
                                </div>
                                <div class="col-md-8">
                                    <h5>{{$plain}}</h5>
                                </div>
                            </div>

                            <div class="p-3 border row text-light">
                                <div class="col-md-4 border-right">
                                    <h5>Registered</h5>
                                </div>
                                <div class="col-md-8">
                                    <h5>{{ \Carbon\Carbon::parse($user->created_at)->format('D, M j, Y g:i A') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Up Modal first -->
    <div id="topupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Credit/Debit {{$user->name}}
                        account.</strong></h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{route('credit-debit')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}">
                        </div>
                        <div class="form-group">
                            <input class="form-control bg-dark text-light" placeholder="Enter amount" type="text"
                                name="amount" required>
                        </div>
                        <div class="form-group">
                            <h5 class="text-light">Select where to Credit/Debit</h5>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="" selected disabled>Select Column</option>
                                <option value="Profit">Profit</option>
                                {{-- <option value="Ref_Bonus">Ref_Bonus</option> --}}
                                <option value="balance">Account Balance</option>
                                <option value="Deposit">Deposit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 class="text-light">Select credit to add, debit to subtract.</h5>
                            <select class="form-control bg-dark text-light" name="t_type" required>
                                <option value="">Select type</option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                            </select>
                            <small> <b>NOTE:</b> You cannot debit deposit</small>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-light" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /deposit for a plan Modal -->




    <!-- Top Up Modal -->
    <div id="topupxModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Fund/Debit {{$user->name}} WALLET.</strong></h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <input class="form-control bg-dark text-light" placeholder="Enter amount" type="text"
                                name="amount" required>
                        </div>
                        <div class="form-group">
                            <h5 class="text-light">Select Wallet to Credit/Debit</h5>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="" selected disabled>Select Wallet</option>
                                <option value="Bitcoin">Bitcoin</option>
                                <option value="Ethereum">Ethereum</option>
                                <option value="LTC">LTC</option>
                                <option value="BNB">BNB</option>
                                <option value="Doge">Doge</option>
                                <option value="USDT">USDT</option>
                                <option value="Dash">Dash</option>
                                <option value="Tron">Tron</option>
                                <option value="XRP">XRP</option>
                                <option value="EOS">EOS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 class="text-light">Select credit to add, debit to subtract.</h5>
                            <select class="form-control bg-dark text-light" name="t_type" required>
                                <option value="">Select type</option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                            </select>
                            <small> <b>NOTE:</b> You cannot debit deposit</small>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="151">
                            <input type="submit" class="btn btn-light" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /deposit for a plan Modal -->












    <!-- send a single user email Modal-->
    <div id="sendmailtooneuserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Send Email</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <p class="text-light">This message will be sent to {{$user->name}}</p>
                    <form style="padding:3px;" role="form" method="post" action="{{ route('admin.send.mail')}}">

                        @csrf
                        <input type="hidden" name="email" value="{{$user->email}}">
                        <div class=" form-group">
                            <input type="text" name="subject" class="form-control bg-dark text-light"
                                placeholder="Subject" required>
                        </div>
                        <div class=" form-group">
                            <textarea placeholder="Type your message here" class="form-control bg-dark text-light"
                                name="message" row="8" placeholder="Type your message here" required></textarea>
                        </div>
                        <div class=" form-group">

                            <input type="submit" class="btn btn-light" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Trading History Modal -->

    <div id="TradingModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Add Signal strength for {{$user->name}} </h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form role="form" method="post" action="{{ route('admin.add_signal_strength') }}">
                        @csrf

                        <div class="form-group">
                            <h5 class="text-light">Signal Strength</h5>
                            <input type="number" name="signal_strength" class="form-control bg-dark text-light" min="0"
                                max="100" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-light" value="Add Signal Strength">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /send a single user email Modal -->

    <!-- Edit user Modal -->
    <div id="edituser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Edit {{$user->name}} details</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form role="form" method="post" action="{{ route('admin.updateUser', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="text-light">First Name</label>
                            <input class="form-control bg-dark text-light" id="input1" value="{{$user->name}}"
                                type="text" name="username" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Last Name</label>
                            <input class="form-control bg-dark text-light" value="{{$user->last_name}}" type="text"
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Email</label>
                            <input class="form-control bg-dark text-light" value="{{$user->email}}" type="text"
                                name="email" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Phone Number</label>
                            <input class="form-control bg-dark text-light" value="{{$user->phone}}" type="text"
                                name="phone" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Country</label>
                            <input class="form-control bg-dark text-light" value="{{$user->country}}" type="text"
                                name="country">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-light" value="Update">
                        </div>
                    </form>
                </div>
                <script>
                    $('#input1').on('keypress', function(e) {
                    return e.which !== 32; // Disallow spaces in username
                });
                </script>
            </div>
        </div>
    </div>
    <!-- /Edit user Modal -->


    <!-- Reset user password Modal -->
    <div id="resetpswdModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Reset Password</strong></h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <p class="text-light">Are you sure you want to reset password for {{$user->name}} to <span
                            class="text-primary font-weight-bolder">user01236</span></p>
                    <a class="btn btn-light" href="{{ route('reset.password', $user->id) }}">Reset Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Reset user password Modal -->

    <!-- Switch useraccount Modal -->
    <div id="switchuserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">You are about to login as {{$user->name}}.</strong></h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <a class="btn btn-success" href="{{ route('users.impersonate', $user->id) }}">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Switch user account Modal -->

    <!-- Clear account Modal -->
    <div id="clearacctModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Clear Account</strong></h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <p class="text-light">You are clearing account for {{$user->name}} to $0.00</p>
                    <a class="btn btn-light" href="{{route('clear.account',$user->id)}}">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Clear account Modal -->

    <!-- Delete user Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-dark">

                    <h4 class="modal-title text-light">Delete User</strong></h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark p-3">
                    <p class="text-light">Are you sure you want to delete {{$user->name}}
                        Account? Everything
                        associated
                        with this account will be loss.</p>
                    <a class="btn btn-danger" href="{{ route('delete.user', $user->id) }}">Yes i'm sure</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete user Modal -->

    <!-- Holding Balance Modal -->
    <div id="holdingBalanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Update {{$user->first_name}}'s Holding Balance</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('update.holding.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-light">Amount</label>
                            <input class="form-control bg-dark text-light" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Type</label>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Description</label>
                            <textarea class="form-control bg-dark text-light" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mining Balance Modal -->
    <div id="miningBalanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Update {{$user->first_name}}'s Mining Balance</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('update.mining.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-light">Amount</label>
                            <input class="form-control bg-dark text-light" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Type</label>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Description</label>
                            <textarea class="form-control bg-dark text-light" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Referral Balance Modal -->
    <div id="referralBalanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Update {{$user->first_name}}'s Referral Balance</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('update.referral.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-light">Amount</label>
                            <input class="form-control bg-dark text-light" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Type</label>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Description</label>
                            <textarea class="form-control bg-dark text-light" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Staking Balance Modal -->
    <div id="stakingBalanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Update {{$user->first_name}}'s Staking Balance</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('update.staking.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-light">Amount</label>
                            <input class="form-control bg-dark text-light" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Type</label>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Description</label>
                            <textarea class="form-control bg-dark text-light" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profit Balance Modal -->
    <div id="profitBalanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Update {{$user->first_name}}'s Profit</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('update.profit.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-light">Amount</label>
                            <input class="form-control bg-dark text-light" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Type</label>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Description</label>
                            <textarea class="form-control bg-dark text-light" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Trading Balance Modal -->
    <div id="tradingBalanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light">Update {{$user->first_name}}'s Trading Balance</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('update.trading.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-light">Amount</label>
                            <input class="form-control bg-dark text-light" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Type</label>
                            <select class="form-control bg-dark text-light" name="type" required>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-light">Description</label>
                            <textarea class="form-control bg-dark text-light" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".edit-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let field = this.dataset.field;
                    document.getElementById(`display-${field}`).classList.add("d-none");
                    document.getElementById(`input-${field}`).classList.remove("d-none");
                    this.classList.add("d-none");
                    document.querySelector(`.save-btn[data-field='${field}']`).classList.remove("d-none");
                });
            });
    
            document.querySelectorAll(".save-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let field = this.dataset.field;
                    let newValue;
    
                    if (field === 'profile_photo') {
                        let fileInput = document.getElementById(`input-${field}`);
                        let file = fileInput.files[0];
    
                        if (!file) {
                            toastr.error("Please select a photo to upload.");
                            return;
                        }
    
                        let formData = new FormData();
                        formData.append('photo', file); // Use 'photo' as the key to match backend validation
                        formData.append('user_id', "{{ $user->id }}");
    
                        fetch("{{ route('admin.updateUser') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`display-${field}`).innerHTML = `<img src="${data.new_value}" alt="Profile Photo" style="width:100px; height:auto;">`;
                                document.getElementById(`display-${field}`).classList.remove("d-none");
                                document.getElementById(`input-${field}`).classList.add("d-none");
                                button.classList.add("d-none");
                                document.querySelector(`.edit-btn[data-field='${field}']`).classList.remove("d-none");
                                toastr.success(data.message);
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            } else {
                                toastr.error(data.message || "Error updating profile photo.");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            toastr.error("An error occurred while updating the photo.");
                        });
                    } else if (field === 'password' || field === 'plain') {
                        newValue = document.getElementById(`input-${field}`).value;
    
                        fetch("{{ route('admin.updateUser') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                field: field,
                                value: newValue,
                                user_id: "{{ $user->id }}"
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`display-${field}`).textContent = "********"; // Mask the updated value
                                document.getElementById(`display-${field}`).classList.remove("d-none");
                                document.getElementById(`input-${field}`).classList.add("d-none");
                                button.classList.add("d-none");
                                document.querySelector(`.edit-btn[data-field='${field}']`).classList.remove("d-none");
                                toastr.success("Password updated successfully!");
                            } else {
                                toastr.error("Error updating password.");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });
                    } else {
                        newValue = document.getElementById(`input-${field}`).value;
    
                        fetch("{{ route('admin.updateUser') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                field: field,
                                value: newValue,
                                user_id: "{{ $user->id }}"
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`display-${field}`).textContent = newValue;
                                document.getElementById(`display-${field}`).classList.remove("d-none");
                                document.getElementById(`input-${field}`).classList.add("d-none");
                                button.classList.add("d-none");
                                document.querySelector(`.edit-btn[data-field='${field}']`).classList.remove("d-none");
                                toastr.success("User updated successfully!");
                            } else {
                                toastr.error("Error updating data.");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });
                    }
                });
            });
        });
    </script>

    @include('admin.footer')