<div class="progress-wrap">
    <svg
        class="progress-circle svg-content"
        width="100%"
        height="100%"
        viewBox="-1 -1 102 102"
    >
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<script src="<?=base_url()?>assets/js/jquery.js"></script>
<script src="<?=base_url()?>assets/js/popper.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/appear.js"></script>
<script src="<?=base_url()?>assets/js/parallax.min.js"></script>
<script src="<?=base_url()?>assets/js/tilt.jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.paroller.min.js"></script>
<script src="<?=base_url()?>assets/js/wow.js"></script>
<script src="<?=base_url()?>assets/js/swiper.min.js"></script>
<script src="<?=base_url()?>assets/js/backtotop.js"></script>
<script src="<?=base_url()?>assets/js/odometer.js"></script>
<script src="<?=base_url()?>assets/js/parallax-scroll.js"></script>

<script src="<?=base_url()?>assets/js/gsap.min.js"></script>
<script src="<?=base_url()?>assets/js/SplitText.min.js"></script>
<script src="<?=base_url()?>assets/js/ScrollTrigger.min.js"></script>
<script src="<?=base_url()?>assets/js/ScrollToPlugin.min.js"></script>
<script src="<?=base_url()?>assets/js/ScrollSmoother.min.js"></script>

<script src="<?=base_url()?>assets/js/touchspin.js"></script>
<script src="<?=base_url()?>assets/js/jquery.marquee.min.js"></script>
<script src="<?=base_url()?>assets/js/magnific-popup.min.js"></script>
<script src="<?=base_url()?>assets/js/nav-tool.js"></script>
<script src="<?=base_url()?>assets/js/jquery-ui.js"></script>
<script src="<?=base_url()?>assets/js/element-in-view.js"></script>

<?php if($activePage == 'CONTACT') { ?>
    <script src="assets/js/validate.js"></script>
<?php } ?>

<script src="<?=base_url()?>assets/js/script.js"></script>

<!--[if lt IE 9
    ]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script
><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

<script>
    $(document).ready(function() {
        $('div.grecaptcha-badge').addClass('invisible');
    });

    <?php if($activePage == 'HOME') { ?>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeltA4qAAAAAGd0nrTRqccI8iE4pxZGsUFgJB6r', {action: 'submit'}).then(function(token) {
                document.getElementById('home_news_letter-g-recaptcha-response').value = token;
            });
        });

        grecaptcha.ready(function() {
            grecaptcha.execute('6LeltA4qAAAAAGd0nrTRqccI8iE4pxZGsUFgJB6r', {action: 'submit'}).then(function(token) {
                document.getElementById('banner_news_letter-g-recaptcha-response').value = token;
            });
        });
    <?php } else { ?>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeltA4qAAAAAGd0nrTRqccI8iE4pxZGsUFgJB6r', {action: 'submit'}).then(function(token) {
                document.getElementById('other_news_letter-g-recaptcha-response').value = token;
            });
        });
    <?php } ?>

    $('#home_news_letter,#banner_news_letter,#other_news_letter').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        var $form = $(this);
        $.ajax({
            url: '<?=base_url()?>subscribe-email', // The URL to submit the form data to
            type: 'POST', // The HTTP method to use
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                const resp = $.parseJSON(response);
                // Handle the success response
                if (resp.status == 'success') {
                    $form.find('button[type="submit"]').find('span span').text('DONE');
                    setTimeout(() => {
                        $form.find('button[type="submit"]').find('span span').text('Subscribe');
                    }, 2000);
                    console.log('Your message has been sent successfully!');
                    $form[0].reset(); // Optionally, reset the form
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error response
                console.log('There was an error sending your message: ' + textStatus);
            }
        });
    });
</script>