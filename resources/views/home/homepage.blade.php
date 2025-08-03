@include('home.header')

<div class="container text-center py-5" data-aos="fade-up">
    <div class="category-label">
        TRAINING & COMMUNITY
    </div>

    <h1 class="hero-heading">
        Learn how to <span class="gradient-invest">invest</span><br>
        <span class="gradient-successfully">successfully</span>
        <span class="gradient-and">&</span>
        <span class="gradient-safely">safely</span>
    </h1>

    <p class="hero-subtitle">
        Absolute top experts show you how to invest strategically to make your
        money work for you sustainably.
    </p>

    <div class="buttons mb-5 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
        <a href="{{route('login')}}" class="btn btn-login">Login my account</a>
        <a href="{{route('register')}}" class="btn btn-create">Create account</a>
    </div>

    <div class="participants-section" data-aos="zoom-in" data-aos-delay="200">
        <div class="avatar-group">
            <img src="assets/img/CRYParticipants.webp" width="250" alt="">
        </div>
        <div class="participants-text">
            <span id="participants-count">1M+</span> successful participants
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const min = 1000000;
        const max = 4000000;
        const finalCount = Math.floor(Math.random() * (max - min + 1)) + min;
        const formattedCount = (finalCount / 1000000).toFixed(2).replace(/\.00$/, '') + 'M+';
        document.getElementById('participants-count').textContent = formattedCount;
    });
    </script>

</div>

<div class="container section-container" data-aos="fade-up">
    <h2 class="section-reason-title my-5" style="color: #CBD5E1">
        The best time to invest in<br> Bitcoin was 2009.<br>
        <span class="gradient-text">The second best time is now.</span>
    </h2>

    <div class="row g-4 mb-3">
        <div class="col-12" data-aos="zoom-in" data-aos-delay="150">
            <div class="text-center">
                <img src="{{ asset('assets/img/crypChart.png') }}" alt="Crypto Chart"
                    class="img img-fluid w-75 crypto-chart0">
            </div>
        </div>
    </div>
</div>

<div class="container section-container">
    <h2 class="section-reason-title my-5" style="color: #CBD5E1" data-aos="fade-up">
        <span class="gradient-text">7 Reasons</span> Why Cryptocurrencies<br> Will Change All of Our Lives
    </h2>

    <div class="row g-4 mb-3">
        @php $reasons = [
        ['label' => 'REASON 1', 'img' => 'CryReason1.avif', 'title' => 'decentralization and independence', 'desc' =>
        'Bitcoin & Co. are not controlled...'],
        ['label' => 'REASON 2', 'img' => 'CryReason2.avif', 'title' => 'protection against crises and inflation', 'desc'
        => 'Cryptocurrencies like Bitcoin...'],
        ['label' => 'REASON 3', 'img' => 'CryReason3.avif', 'title' => 'High return opportunities', 'desc' => 'Bitcoin
        alone has achieved...'],
        ]; @endphp

        @foreach ($reasons as $index => $reason)
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
            <div class="reason-card">
                <div class="card-header">
                    <div class="reason-label">{{ $reason['label'] }}</div>
                    <img src="{{ asset('assets/img/' . $reason['img']) }}" alt="{{ $reason['title'] }}"
                        class="reason-icon">
                </div>
                <h3 class="reason-title">{{ $reason['title'] }}</h3>
                <p class="reason-description">{{ $reason['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4 mb-3">
        <div class="col-12 col-md-6" data-aos="fade-up">
            <div class="reason-card">
                <div class="card-header">
                    <div class="reason-label">REASON 4</div>
                    <img src="{{ asset('assets/img/CryReason4.avif') }}" alt="Digital Gold" class="reason-icon"
                        style="height: 180px; width: 180px">
                </div>
                <h3 class="reason-title">Bitcoin as digital gold</h3>
                <p class="reason-description">Bitcoin & Co. are not controlled by a central authority or government...
                </p>
            </div>
        </div>

        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="150">
            <div class="reason-card">
                <div class="card-header">
                    <div class="reason-label">REASON 5</div>
                    <img src="https://capitalfidel.com/assets/images/site/CryReason5.avif" alt="Growing Acceptance"
                        class="reason-icon" style="height: 180px; width: 180px">
                </div>
                <h3 class="reason-title">Growing acceptance as a means of payment</h3>
                <p class="reason-description">Companies like Tesla and Microsoft now accept crypto...</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6" data-aos="fade-up">
            <div class="reason-card">
                <div class="card-header">
                    <div class="reason-label">REASON 6</div>
                    <img src="https://capitalfidel.com/assets/images/site/CryReason6.avif" alt="Low Barrier"
                        class="reason-icon" style="height: 180px; width: 180px">
                </div>
                <h3 class="reason-title">Low entry barrier</h3>
                <p class="reason-description">Getting started in the crypto market is easy...</p>
            </div>
        </div>

        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="150">
            <div class="reason-card">
                <div class="card-header">
                    <div class="reason-label">REASON 7</div>
                    <img src="https://capitalfidel.com/assets/images/site/CryReason7.avif" alt="New Era"
                        class="reason-icon" style="height: 180px; width: 180px">
                </div>
                <h3 class="reason-title">A new era has dawned</h3>
                <p class="reason-description">Blockchain is changing finance forever...</p>
            </div>
        </div>
    </div>
</div>

<div class="container section-container">
    <h2 class="section-reason-title my-5 text-start" style="color: #CBD5E1" data-aos="fade-up">
        Profit from the market in record time with the
        <span class="gradient-text"> cytopia capital pro framework </span>
    </h2>

    <div class="row g-4 mb-3">
        @php $framework = [
        ['img' => 'CryIcon3.avif', 'title' => 'Recognize market movements', 'desc' => 'Learn how to read the
        market...'],
        ['img' => 'CryIcon1.avif', 'title' => 'Understanding Bitcoin & Blockchain', 'desc' => 'Learn how blockchain
        works...'],
        ['img' => 'CryIcon4.avif', 'title' => 'Proven Strategies', 'desc' => 'Systematize your trading strategy...'],
        ]; @endphp

        @foreach ($framework as $index => $item)
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
            <div class="reason-card">
                <div class="card-header d-flex justify-content-start">
                    <img src="https://capitalfidel.com/assets/images/site/{{ $item['img'] }}" alt="{{ $item['title'] }}"
                        class="reason-icon" style="width: 70px; height: 70px;">
                </div>
                <h3 class="reason-title">{{ $item['title'] }}</h3>
                <p class="reason-description">{{ $item['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container home-faq" data-aos="fade-up">
    <h2 class="section-heading text-center py-4">
        <span class="gradient-text">Frequently Asked</span> Questions
    </h2>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="accordion" id="faqAccordion1">
                @php $faqs = [
                ['title' => 'How to start trading with cytopia capital pro?', 'body' => 'Create an account...'],
                ['title' => 'How to create an account and confirm email?', 'body' => 'Click the Sign-Up button...'],
                ['title' => 'Confirm your ID and eligibility?', 'body' => 'Upload your passport or driver\'s
                license...'],
                ['title' => 'How to deposit funds?', 'body' => 'Go to Dashboard > Deposit and follow instructions...'],
                ['title' => 'Is cytopia capital pro regulated?', 'body' => 'We recommend having at least $3000...'],
                ['title' => 'How to withdraw?', 'body' => 'Navigate to Withdraw > Select method > Confirm.'],
                ]; @endphp

                @foreach ($faqs as $index => $faq)
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}">
                            {{ $faq['title'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                        <div class="accordion-body">{{ $faq['body'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('home.footer')