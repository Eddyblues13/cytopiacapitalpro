@include('user.layouts.header')


<div class="container py-5">
    <!-- Profile Section -->


    <!-- Settings Grid -->
    <div class="row g-4">
        <div class="col-md-12">
            <div class="text-center mb-5">
                <img src="{{ Auth::user()->profile_photo_url ? asset(Auth::user()->profile_photo_url) : asset('assets/img/human.png') }}"
                    class="account-profile-avatar mx-auto mb-3"></img>
                <h4 class="text-white mb-2 fs-1">{{Auth::user()->first_name}}
                    {{Auth::user()->last_name}}</h4>
                <p class="text-secondary mb-3 fs-4">VERIFICATIONS</p>
            </div>
        </div>
    </div>

    <div class="row g-4 d-flex justify-content-center">
        <div class="col-md-8">
            <!-- Transfer -->
            <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                <div class="icon-box icon-teal me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"
                        fill="white">
                        <path
                            d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z" />
                    </svg>
                </div>
                @if($email_verification)
                <div class="text-header"><span class="text-success">Email Verification</span> Completed</div>
                @else
                <a href="{{ route('home') }}" class="text-header text-decoration-none">
                    <span class="text-success">Email Verification</span> Skipped
                </a>
                @endif
            </div>

            <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                <div class="icon-box icon-teal me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"
                        fill="white">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                </div>
                @if($id_verification)
                <div class="text-header"><span class="text-success">Identity Verification</span> Completed</div>
                @else
                <a href="{{ route('verifications.identity') }}" class="text-header text-decoration-none">
                    <span class="text-success">Identity Verification</span> Skipped
                </a>
                @endif
            </div>

            <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                <div class="icon-box icon-teal me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"
                        fill="white">
                        <path
                            d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                    </svg>
                </div>
                @if($address_verification)
                <div class="text-header"><span class="text-success">Address Verification</span> Completed</div>
                @else
                <a href="{{ route('verifications.address') }}" class="text-header text-decoration-none">
                    <span class="text-success">Address Verification</span> Skipped
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')