<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$pageMain->seo_title?></title>
    <meta name="description" content="<?=$pageMain->seo_description?>">
    <meta name="keywords" content="<?=$pageMain->seo_keywords?>">
    <!-- Stylesheets -->
    <?php $this->load->view('includes/head'); ?>
  </head>

  <body>
    <div class="page-wrapper">
      <!-- Preloader -->
      <?php $this->load->view('includes/cursor_preloader'); ?>
      <!-- Preloader End -->

      <!-- Main Header -->
      <?php $this->load->view('includes/header'); ?>
      <!-- End Main Header -->

      <!-- Page Title -->
      <section class="page-title">
        <div
          class="page-title-icon"
          style="background-image: url(<?=base_url()?>assets/images/icons/page-title_icon-1.png);"
        ></div>
        <div
          class="page-title-icon-two"
          style="background-image: url(<?=base_url()?>assets/images/icons/page-title_icon-2.png);"
        ></div>
        <div
          class="page-title-shadow"
          style="background-image: url(<?=base_url()?>assets/images/background/page-title-1.png);"
        ></div>
        <div
          class="page-title-shadow_two"
          style="background-image: url(<?=base_url()?>assets/images/background/page-title-2.png);"
        ></div>
        <div class="auto-container">
          <h2><?=$pageMain->headline?></h2>
          <ul class="bread-crumb clearfix">
            <li><a href="<?=base_url()?>">Home</a></li>
            <li><?=$pageMain->second_title?></li>
          </ul>
        </div>
      </section>
      <!-- End Page Title -->

      <!-- Contact Info -->
      <section class="contact-info">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Info Block One -->
            <div class="info-block_one col-lg-4 col-md-6 col-sm-12">
              <div class="info-block_one-inner">
                <div class="info-block_one-icon">
                  <i class="icon-phone"></i>
                </div>
                <h4><?=$pageContactBox1->seo_title?></h4>
                <a href="tel:<?=$pageContactBox1->headline?>"><?=$pageContactBox1->headline?></a> <br />
                <a href="tel:<?=$pageContactBox1->second_title?>"><?=$pageContactBox1->second_title?></a>
              </div>
            </div>

            <!-- Info Block One -->
            <div class="info-block_one active col-lg-4 col-md-6 col-sm-12">
              <div class="info-block_one-inner">
                <div class="info-block_one-icon">
                  <i class="icon-envelope"></i>
                </div>
                <h4><?=$pageContactBox2->seo_title?></h4>
                <a class="text-white" href="mailto:<?=$pageContactBox2->headline?>"><?=$pageContactBox2->headline?></a> <br />
                <a class="text-white" href="mailto:<?=$pageContactBox2->second_title?>"><?=$pageContactBox2->second_title?></a>
              </div>
            </div>

            <!-- Info Block One -->
            <div class="info-block_one col-lg-4 col-md-6 col-sm-12">
              <div class="info-block_one-inner">
                <div class="info-block_one-icon">
                  <i class="icon-map"></i>
                </div>
                <h4><?=$pageContactBox3->seo_title?></h4>
                <div class="text">
                  <?=$pageContactBox3->headline?> <br />
                  <?=$pageContactBox3->second_title?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Faq One -->

      <!-- Team Detail Form -->
      <section class="team-detail_form">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Column -->
            <div class="column col-lg-6 col-md-12 col-sm-12">
              <!-- Sec Title -->
              <div class="sec-title style-four">
                <div class="sec-title_title"><?=$pageContactMe->seo_title?></div>
                <h2 class="sec-title_heading">
                  <?=$pageContactMe->headline?> <span><?=$pageContactMe->second_title?></span>
                </h2>
                <div class="sec-title_text"><?=strip_tags($pageContactMe->page_text)?></div>
              </div>
              <!-- Social Box -->
              <div class="contact-social_box">
                <a href="<?=$socialMediaLinks->seo_title?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?=$socialMediaLinks->seo_description?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="<?=$socialMediaLinks->seo_url?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
              </div>
            </div>
            <!-- Column -->
            <div class="column col-lg-6 col-md-12 col-sm-12">
              <div class="default-form contact-form">
                <div class="alert alert-success d-flex align-items-center d-none" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </svg>
                  <div id="success-message"></div>
                </div>
                <div class="alert alert-danger d-flex align-items-center d-none" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  <div id="unsuccess-message"></div>
                </div>
                <form method="post" id="contact-form">
                  <div class="row clearfix">
                    <!--Form Group-->
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <input
                        type="text"
                        name="subject"
                        value=""
                        placeholder="Subject"
                        id="subject"
                        required
                        autocomplete="off"
                      />
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <input
                        type="text"
                        name="name"
                        value=""
                        placeholder="Full name"
                        id="name"
                        required
                        autocomplete="off"
                      />
                    </div>
                    <!--Form Group-->
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <input
                        type="email"
                        name="email"
                        value=""
                        placeholder="Email"
                        id="email"
                        required
                        autocomplete="off"
                      />
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <input
                        type="text"
                        name="phone"
                        value=""
                        placeholder="Phone"
                        id="phone"
                        required
                        autocomplete="off"
                      />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                      <textarea
                        class=""
                        name="message"
                        placeholder="Type comment here*"
                        id="message"
                        required
                        autocomplete="off"
                      ></textarea>
                    </div>
                    <input type="hidden" name="g_recaptcha_response" id="g-recaptcha-response">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <button type="submit" class="template-btn btn-style-one" id="contact-submit">
                        <span class="btn-wrap">
                          <span class="text-one">Send now</span>
                          <span class="text-two">Send now</span>
                        </span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Team Detail Form -->

      <!-- Map One -->
      <section class="map-one">
        <div class="auto-container">
          <div class="map-one_map">
            <iframe
              width="820"
              height="560"
              id="gmap_canvas"
              src="<?=strip_tags($pageMap->page_text)?>"
            ></iframe>
          </div>
        </div>
      </section>
      <!-- End Map One -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->
    <?php $this->load->view('includes/js'); ?>

    <script>
      grecaptcha.ready(function() {
        grecaptcha.execute('6LeltA4qAAAAAGd0nrTRqccI8iE4pxZGsUFgJB6r', {action: 'submit'}).then(function(token) {
          document.getElementById('g-recaptcha-response').value = token;
        });
      });

      if($('#contact-form').length){
        $('#contact-form').validate({
          rules: {
            name: {
              required: true
            },
            email: {
              required: true,
              email: true
            },
            phone: {
              required: true
            },
            message: {
              required: true
            }
          },
          submitHandler: function (form) {
            $('#contact-submit .text-one, #contact-submit .text-two').text('Loading...');
            $.ajax({
              url: '<?=base_url()?>send-email', // URL to submit the form data
              type: 'POST', // HTTP method
              data: $(form).serialize(), // Serialize the form data
              success: function(response) {
                const resp = $.parseJSON(response);
                if(resp.status == 'success') {
                  $('#success-message').text(resp.message).parent('div.alert').removeClass('d-none');
                  setTimeout(() => {
                      $('#success-message').text('').parent('div.alert').addClass('d-none');
                  }, 1000);
                  // Optionally, you can reset the form or perform other actions
                  $(form)[0].reset();
                } else {
                  $('#unsuccess-message').text(resp.message).parent('div.alert').removeClass('d-none');
                  setTimeout(() => {
                    $('#unsuccess-message').text('').parent('div.alert').addClass('d-none');
                  }, 1000);
                }
                $('#contact-submit .text-one, #contact-submit .text-two').text('Send now');
              },
              error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error response
                alert('Form submission failed: ' + textStatus);
              }
            });
          }
        });
      }
    </script>
  </body>
</html>
