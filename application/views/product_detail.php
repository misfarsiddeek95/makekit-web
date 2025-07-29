<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?=$pageMain->seo_title?></title>
    <meta name="description" content="<?=$pageMain->seo_description?>">
    <meta name="keywords" content="<?=$pageMain->seo_keywords?>">
    <!-- Stylesheets -->
    <?php $this->load->view('includes/head'); ?>
    <style>
        .team-detail_text p {
            color: var(--color-six);
        }
        .team-detail_text p {
            display: none;
        }
        .team-detail_text p:nth-child(-n+1) {
            display: block;
        }
        .error {
            border-color: red;
        }
        .overflow {
            height: 300px;
        }
    </style>
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
            <div class="page-title-icon" style="background-image: url(<?=base_url()?>assets/images/icons/page-title_icon-1.png);"
            ></div>
            <div class="page-title-icon-two" style="background-image: url(<?=base_url()?>assets/images/icons/page-title_icon-2.png);"
            ></div>
            <div class="page-title-shadow" style="background-image: url(<?=base_url()?>assets/images/background/page-title-1.png);"
            ></div>
            <div class="page-title-shadow_two" style="background-image: url(<?=base_url()?>assets/images/background/page-title-2.png);"
            ></div>
            <div class="auto-container">
            <h2><?=$pageMain->headline?></h2>
            <ul class="bread-crumb clearfix">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li><?=$pageMain->headline?></li>
            </ul>
            </div>
        </section>
        <!-- End Page Title -->

        <!-- Team Detail -->
        <section class="team-detail">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Team Block One -->
                    <div class="team-detail_image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="team-detail_image-outer">
                            <div class="team-detail_image">
                                <?php 
                                    $img = $productDetail->image != null && $productDetail->image != '' ? PHOTO_DOMAIN.'products/'.$productDetail->image : base_url().'assets/images/resource/team-7.jpg';
                                ?>
                                <img src="<?=$img?>" alt="<?=$productDetail->title?>" />
                            </div>
                        </div>
                    </div>

                    <!-- Team Block One -->
                    <div class="team-detail_content-column col-lg-6 col-md-12 col-sm-12">
                        <div class="team-detail_content-outer">
                            <div class="team-detail_subtitle"><?=$pageMain->second_title?></div>
                            <h2 class="team-detail_title"><?=$productDetail->title?></h2>
                            <div class="team-detail_text"><?=$productDetail->product_desc?></div>

                            <div class="team-detail_button">
                                <button type="button" class="template-btn btn-style-one" id="know-more-btn" btn-status="SHOW">
                                    <span class="btn-wrap">
                                        <span class="text-one">KNOW MORE</span>
                                        <span class="text-two">KNOW MORE</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($productFeatures) { ?>
                <div class="team-detail_subtitle">Product Features</div>
                <div class="team-detail_info-outer" style="border: none;">
                    <div class="row clearfix">
                        <?php foreach ($productFeatures as $row) { ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="team-detail_info">
                                <span><i class="fa-solid fa-check fa-fw" style="color: rgb(187, 144, 22);"></i> <?=$row->product_point?></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <!-- End Team Detail -->

        <!-- Team Detail Experiance -->
        <?php if($productImages){ ?>
        <section class="team-one">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Team Column -->
                    <div class="team-one_team-column col-lg-12 col-md-12 col-sm-12">
                        <div class="team-one_team-outer">
                            <div class="team-carousel swiper-container">
                                <div class="swiper-wrapper">
                                    <!-- Slide -->
                                    <?php foreach ($productImages as $image) { ?>
                                    <div class="swiper-slide">
                                    <!-- Team Block One -->
                                        <div class="team-block_one">
                                            <div class="team-block_one-inner">
                                                <div class="team-block_one-image">
                                                    <a href="javascript:void(0);" >
                                                        <img src="<?=PHOTO_DOMAIN.'products/'.$image->photo_path.'-org.'.$image->extension?>" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!-- End Team Detail Experiance -->

        <?php if($pageRequestDemo) { ?>
        <section class="team-detail_form" id="request-demo-form">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                    <!-- Sec Title -->
                        <div class="sec-title style-four">
                            <div class="sec-title_title">Request a demo</div>
                            <h2 class="sec-title_heading">
                            <?=$pageRequestDemo->headline?> <span><?=$pageRequestDemo->second_title?></span>
                            </h2>
                            <div class="sec-title_text"><?=strip_tags($pageRequestDemo->page_text)?></div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="default-form">
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
                            <form method="post" id="inputmasks">
                                <div class="row clearfix">
                                    <!--Form Group-->
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="name" value="" placeholder="Name" required  autocomplete="off"/>
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input type="email" name="email" value="" placeholder="Email" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <select name="country_id" class="custom-select-box" required id="country_id">
                                            <option disabled selected>Select Country</option>
                                            <?php foreach ($countryList as $country) { ?>
                                                <option value="<?=$country->id?>" phone-code="<?=$country->phonecode?>" ><?=$country->nicename?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="phone" value="" placeholder="Phone" required autocomplete="off" />
                                    </div>
                                    <!--Form Group-->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <select name="products" class="custom-select-box" disabled>
                                            <option disabled selected>Select Product</option>
                                            <?php 
                                                foreach ($productList as $product) { 
                                                    $sel = '';
                                                    if($product->productId == $productDetail->productId) {
                                                        $sel = 'selected="selected"';
                                                    }
                                            ?>
                                            <option value="<?=$product->productId?>" <?=$sel?>><?=$product->title?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="product_id" value="<?=$productDetail->productId?>">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea class="" name="message" placeholder="Type Comment here*" autocomplete="off"></textarea>
                                    </div>
                                    <input type="hidden" name="g_recaptcha_response" id="g-recaptcha-response">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="template-btn btn-style-one" id="requestBtn">
                                            <span class="btn-wrap">
                                                <span class="text-one">Send Request</span>
                                                <span class="text-two">Send Request</span>
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
        <?php } ?>

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

        // when click the KNOW MORE button in our story section.
        $('#know-more-btn').click(function() {
            const buttonStatus = $(this).attr('btn-status');
            if(buttonStatus == 'SHOW') {
                $('.team-detail_text p').show('slow');
                $(this).find('span span').text("KNOW LESS");
                $(this).attr('btn-status', 'HIDE');
            } else if(buttonStatus == 'HIDE') {
                $('.team-detail_text p').hide();
                $('.team-detail_text p:nth-child(-n+1)').show('slow');
                $(this).find('span span').text("KNOW MORE");
                $(this).attr('btn-status', 'SHOW');
            }
        });

        // $('#country_id').selectmenu();

        // Handle change event using Selectmenu's change method
        $('#country_id').selectmenu({
            change: function(event, ui) {
                var selectedValue = $(this).val();
                var selectedPhoneCode = $(this).find('option:selected').attr('phone-code');
                $('input[name="phone"]').val(selectedPhoneCode)
            }
        }).selectmenu( "menuWidget" ).addClass( "overflow" );

        $("#inputmasks").on('submit', function(e) {
            e.preventDefault(); // prevent the form from submitting normally
            // Clear any previous errors
            $('input, select, textarea').removeClass('error');
            $('.error-message').remove();

            // Validate form fields
            var isValid = true;
            var name = $('input[name="name"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();

            if (name === "") {
                isValid = false;
                $('input[name="name"]').addClass('error').after('<span class="error-message text-danger">Name is required</span>');
            }
            if (phone === "") {
                isValid = false;
                $('input[name="phone"]').addClass('error').after('<span class="error-message text-danger">Phone is required</span>');
            } else if (!validatePhone(phone)) {
                isValid = false;
                $('input[name="phone"]').addClass('error').after('<span class="error-message text-danger">Please enter a valid phone number</span>');
            }
            // Email is optional, validate if it's not empty
            if (email !== '' && !validateEmail(email)) {
                isValid = false;
                $('input[name="email"]').addClass('error').after('<span class="error-message text-danger">Invalid email address</span>');
            }
          
            if (isValid) {
                // If form is valid, submit via AJAX
                $('#requestBtn').prop('disabled', true).find('span span').text('Sending...');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url()?>request-product-demo",
                    data: $(this).serialize(),
                    success: function(response) {
                        const resp = $.parseJSON(response);
                        if(resp.status == 'success') {
                            $('#success-message').text(resp.message).parent('div.alert').removeClass('d-none');
                            setTimeout(() => {
                                $('#success-message').text('').parent('div.alert').addClass('d-none');
                            }, 1000);

                            // Clear the form fields except the select box and hidden input
                            $('#inputmasks').find('input[type="text"], input[type="email"], textarea').val('');
                            $('#country_id').val('').selectmenu('destroy').selectmenu(); 
                            $('input[name="product_id"]').val($('select[name="products"]').val());
                        } else {
                            $('#unsuccess-message').text(resp.message).parent('div.alert').removeClass('d-none');
                            setTimeout(() => {
                                $('#unsuccess-message').text('').parent('div.alert').addClass('d-none');
                            }, 1000);
                        }
                        $('#requestBtn').prop('disabled', false).find('span span').text('Send Request');
                    },
                    error: function() {}
                });
            }
        });

        const validateEmail = (email) => {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.[^<>()[\]\.,;:\s@"]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        const validatePhone = (phone) => {
            // Validate phone number format (e.g., 123-456-7890 or (123) 456-7890 or 1234567890 or +94761850206)
            var re = /^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4}$/; // local format (e.g., 123-456-7890)
            var reInt = /^\+\d{11}$/; // international format (e.g., +94761850206)

            return re.test(phone) || reInt.test(phone);
        }
    </script>
  </body>
</html>