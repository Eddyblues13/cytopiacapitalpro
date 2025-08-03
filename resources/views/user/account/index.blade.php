@include('user.layouts.header')

<div class="container py-5">
    <!-- Profile Section -->


    <!-- Settings Grid -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="text-center mb-5">
                <img src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('assets/img/human.png') }}"
                    class="account-profile-avatar mx-auto mb-3"></img>
                <h4 class="text-white mb-2">{{Auth::user()->first_name}}
                    {{Auth::user()->last_name}}</h4>
                <p class="text-secondary mb-3">Bronze</p>

                <a href="#" class="text-primary text-decoration-none"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>

                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <!-- Left Column -->
        <div class="col-md-4">
            <a href="{{ route('account.transfer') }}" class="text-decoration-none">
                <!-- Transfer -->
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-teal me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                        </svg>
                    </div>
                    <span class="text-info">Transfer</span>
                </div>
            </a>


            <!-- Referrals -->
            <a href="{{ route('account.referrals') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-teal me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path
                                d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                        </svg>
                    </div>
                    <span class="text-info">Referrals</span>
                </div>
            </a>

            <!-- Notifications -->
            <a href="{{ route('account.notification') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-blue me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path
                                d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                        </svg>
                    </div>
                    <span class="text-info">Notifications</span>
                </div>
            </a>

            <!-- Push Notifications -->
            <a href="{{ route('account.notification') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-coral me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                            <path
                                d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>
                    </div>
                    <span class="text-info">Push Notifications</span>
                </div>
            </a>

            <a href="{{ route('verifications.index') }}" class="text-decoration-none">
                <!-- Account Verifications -->
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-purple me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path
                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </div>
                    <span class="text-info">Account Verifications</span>
                </div>
            </a>
        </div>


        <!-- Right Column -->
        <div class="col-md-4">
            <!-- Update Email -->
            <a href="{{ route('account.email') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-teal me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z" />
                        </svg>
                    </div>
                    <span class="text-info">Update Email</span>

                </div>
            </a>


            <!-- Update Password -->
            <a href="{{ route('account.password') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-blue me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg>
                    </div>
                    <span class="text-info">Update Password</span>
                </div>
            </a>

            <!-- Update Contact Info -->
            <a href="{{ route('account.address') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-teal me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path
                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                    </div>
                    <span class="text-info">Update Contact Info</span>
                </div>
            </a>

            <!-- Update Profile Photo -->
            <a href="{{ route('account.photo') }}" class="text-decoration-none">
                <div class="settings-card rounded-3 p-3 mb-3 d-flex align-items-center">
                    <div class="icon-box icon-purple me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path
                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
                        </svg>
                    </div>
                    <span class="text-info">Update Profile Photo</span>
                </div>
            </a>
        </div>
    </div>
</div>



@include('user.layouts.footer')