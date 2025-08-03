<footer class="footer mx-2">
  <div class="footer-content">
    <div class="brand">cytopia capital pro</div>

    <div class="row">
      <div class="col-6 col-md-4 mb-5">
        <h6>Top Instrument</h6>
        <p><a href="{{ url('/tesla-chart') }}">Tesla</a></p>
        <p><a href="{{ url('/apple-chart') }}">Apple</a></p>
        <p><a href="{{ url('/nvidia-chart') }}">Nvidia</a></p>
        <p><a href="{{ url('/msft-chart') }}">Microsoft</a></p>
      </div>
      <div class="col-6 col-md-4 mb-5">
        <h6>Learn More</h6>
        <p><a href="{{ url('/about') }}">About Us</a></p>
        <p><a href="{{ url('/what-is-leverage') }}">What is Leverage</a></p>
        <p><a href="{{ url('/responsible-trading') }}">Responsible Trading</a></p>
        <p><a href="{{ url('/copy-trade') }}">How Copy Trading Works</a></p>
      </div>
      <div class="col-6 col-md-4 mb-5">
        <h6>Privacy</h6>
        <p><a href="{{ url('/cookie-policy') }}">Cookie Policy</a></p>
        <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></p>
        <p><a href="{{ url('/terms-of-service') }}">Terms and Condition</a></p>
        <p><a href="{{ url('/general-risk-disclosure') }}">General Risk Disclosure</a></p>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="copyright">Copyright © 2023 by cytopia capital pro</div>
    </div>
  </div>

  <div class="glow-arc"></div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
      once: true,           // animate only once
      duration: 800,        // animation duration
      easing: 'ease-out-cubic',
    });
  });
</script>

<script src="{{ asset('alert/ui/js/jquery-2.2.3.js') }}"></script>
<script src="{{ asset('alert/ui/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('alert/js/jquery.fake-notification.min.js') }}"></script>
<script>
  $(document).ready(function() {
        $('#notification-1').Notification({
            // Notification variables
            Varible1: ["Dirk", "Johnny", "Watkin ", "Alejandro", "Vina", "Tony", "Ahmed","Jackson", "Noah", "Aiden", "Darren", "Isabella", "Aria", "John", "Greyson", "Peter", "Mohammed", "William",
            "Lucas", "Amelia", "Mason", "Mathew", "Richard", "Chris", "Mia", "Oliver"],
            Varible2: ["USA","UAE","ITALY", "FLORIDA", "MEXICO", "INDIA", "CHINA", "CAMBODIA", "UNITED KINGDOM", "GERMANY", "AUSTRALIA", "BANGLADESH", "SWEDEN", "PAKISTAN", "MALDIVES", "SEYCHELLES", 
            "BOLIVIA", "SOUTH AFRICA", "ZAMBIA", "ZIMBABWE", "LEBANESE", "SAUDI ARABIA", "CHILE", "PEUTO RICO"],
            
            Amount: [900620, 250620,500620,662669,446240,796289,706252],          
            Content: '[Varible1] from [Varible2] has just Earned <b>$[Amount]</b>',
            // Timer
            Show: ['stable', 5, 10],
            Close: 5,
            Time: [0, 23],
            // Notification style 
            LocationTop: [true, '50%'],
            LocationBottom:[false, '10%'],
            LocationRight: [false, '10%'],            
            LocationLeft:[true, '10px'],
            Background: '#000000',
            BorderRadius: 5,
            BorderWidth: 1,
            BorderColor: '#ff9900',
            TextColor: 'white',
            IconColor: '#ffffff',
            // Notification Animated   
            AnimationEffectOpen: 'slideInUp',
            AnimationEffectClose: 'slideOutDown',
            // Number of notifications
            Number: 40,
            // Notification link
            Link: [false, 'index.html', '_blank']
        });     
    });

    $("form#contact-form").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
            url: 'process-contact.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btnContact').html("Sending Message <i class='fa fa-spinner fa-spin'></i>").attr("disabled", true);
            },
            success: function (data) {
                $('#btnContact').html("Send Message <i class='fa fa-rocket'></i>").attr("disabled", false);
                if (data == "Done") {
                    swal("Message Sent", "You message was successfully sent to support. You will get a feedback soon", "success");
                    $("form#contact-form").trigger("reset");
                } else {
                    swal("Error", data, "warning");
                }   
            },
            error:function(){
                swal("Network Unavailable", "Please check your internet connection", "warning");
                $('#btnContact').html("Send Message <i class='fa fa-rocket'></i>").attr("disabled", false);
            }
        });
    });
</script>

</body>

</html>