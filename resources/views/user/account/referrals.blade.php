@include('user.layouts.header')

<!-- Main Content -->
<div class="container py-5">
    <div class="row g-4 ref-area">
        <!-- Left Column - Balance Card -->
        <div class="col-md-4">
            <div class="card bg-card-grey p-4 text-center">
                <h6 class="text-white mb-2 fs-5">{{ config('currencies.' . $user->currency,
                    '$') }}{{
                    number_format($referralBalance, 2) }}</h6>
                <p class="text-secondary mb-4">Referral Balance</p>
                <div class="flex justify-content-center">
                    <button class="btn btn-login text-uppercase fs-6 w-50 py-2">Withdraw</button>
                </div>
            </div>
        </div>

        <!-- Right Column - Referral Info -->
        <div class="col-md-8">
            <!-- Referral Link Card -->
            <div class="card bg-card-grey p-4 mb-4">
                <div class="form-group">
                    <input type="text" class="form-control mb-2"
                        value="{{ route('referral.signup', ['referral_code' => $user->referral_code]) }}" readonly>
                    <div class="text-center">
                        <label class="text-secondary text-center">Referral Link</label>
                    </div>
                </div>
            </div>

            <!-- No Referrals Card -->
            <!-- Referred Users Card -->
            <div class="card bg-card-grey p-4">
                <h6 class="text-white mb-3">Referred Users</h6>
                @if ($referredUsers->isEmpty())
                <p class="text-secondary text-center mb-0">No Referrals Yet</p>
                @else
                <ul class="list-group">
                    @foreach ($referredUsers as $referredUser)
                    <li class="list-group-item">{{ $referredUser->email }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>


@include('user.layouts.footer')