@include('home.header')
<div class="contact-main bg-black py-5">
    <div class="signup-container">
        <h6 class="signup-title text-secondary fs-6">Have a question or want to get in touch? Fill out the form below,
            and we’ll get back to you as soon as possible!</h6>

        <form class="signup-form">

            <div class="form-group">
                <label class="form-label">Your Name</label>
                <input type="text" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Your Email</label>
                <input type="email" class="form-input" required>
            </div>
            <div class="form-group mb-4">
                <label class="form-label">Message</label>
                <textarea name="" id="" class="form-input"></textarea>
            </div>
            <button type="submit" class="submit-button">Send</button>
        </form>
    </div>
</div>
@include('home.footer')