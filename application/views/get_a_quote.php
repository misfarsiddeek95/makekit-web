<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$pageMain->seo_title?></title>
    <meta name="description" content="<?=$pageMain->seo_description?>">
    <meta name="keywords" content="<?=$pageMain->seo_keywords?>">
    <!-- Stylesheets -->
    <?php $this->load->view('includes/head'); ?>
    <style>
        .file-input {
            position: relative;
            overflow: hidden;
            width: 100%;
            text-align: center;
            border: 1px dashed rgb(219, 185, 35);
            color: #fff;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .file-input input[type="file"] {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-input label {
            font-size: 1em;
            cursor: pointer;
        }

        .file-input:hover {
            background-color: rgb(187, 144, 22);
        }

        .thumbnail-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .thumbnail {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 10px;
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .thumbnail embed,
        .thumbnail img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .remove-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.8);
            border-radius: 20%;
            padding: 5px;
            cursor: pointer;
            color: #fff;
            font-weight: 700;
        }
        .error {
            color: red;
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

      <!-- Team Detail Form -->
      <section class="team-detail_form">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Column -->
            <div class="column col-lg-5 col-md-12 col-sm-12">
              <!-- Sec Title -->
              <div class="sec-title style-four">
                <div class="sec-title_title"><?=$pageMiddleSection->seo_title?></div>
                <h2 class="sec-title_heading">
                  <?=$pageMiddleSection->headline?> <span><?=$pageMiddleSection->second_title?></span>
                </h2>
                <div class="sec-title_text"><?=strip_tags($pageMiddleSection->page_text)?></div>
              </div>
            </div>
            <!-- Column -->
            <div class="column col-lg-7 col-md-12 col-sm-12">
              <div class="default-form quote-form">
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
                <form method="post" id="quote-form">
                  <div class="row clearfix">
                    <!--Form Group-->
                    <div class="row" id="project_info">
                        <h5 class="sec-title_heading"><span>PROJECT INFO </span></h5> <hr>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <select name="service_id" class="custom-select-box" required id="service_id">
                                <option disabled selected>Select Service</option>
                                <?php foreach ($serviceList as $service) { ?>
                                    <option value="<?=$service->service_id?>"><?=$service->service_name?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <input
                                type="text"
                                name="budget"
                                value=""
                                placeholder="Budget (mention the currency also. eg: $5,000)"
                                id="budget"
                                required
                                autocomplete="off"
                            />
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="file-input">
                                <input type="file" id="fileInput" name="file" />
                                <label for="fileInput"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <br> Select a File (Optional)</label>
                            </div>
                            <div id="thumbnailContainer" class="thumbnail-container">
                                <!-- Thumbnails will be added dynamically here -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                            <textarea
                                class=""
                                name="description"
                                placeholder="Type your project description here"
                                id="description"
                                autocomplete="off"
                            ></textarea>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                            <textarea
                                class=""
                                name="project_additional_notes"
                                placeholder="Type your additional notes here"
                                id="project_additional_notes"
                                autocomplete="off"
                            ></textarea>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <button type="button" class="template-btn btn-style-one float-end" id="next" onclick="changeForm('client_info','project_info');">
                                <span class="btn-wrap">
                                <span class="text-one">NEXT</span>
                                <span class="text-two">NEXT</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="row" id="client_info">
                        <h5 class="sec-title_heading"><span>CLIENT INFO </span></h5> <hr>
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
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="country_id" class="custom-select-box" required id="country_id">
                                <option disabled selected>Select Country</option>
                                <?php foreach ($countryList as $country) { ?>
                                    <option value="<?=$country->id?>" phone-code="<?=$country->phonecode?>" ><?=$country->nicename?></option>
                                <?php } ?>
                            </select>
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
                        <!--Form Group-->
                        <div class="form-group col-lg-12 col-md-6 col-sm-6">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea
                                class=""
                                name="address"
                                placeholder="Type address here*"
                                id="address"
                                required
                                autocomplete="off"
                            ></textarea>
                        </div>
                        <input type="hidden" name="g_recaptcha_response" id="g-recaptcha-response">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <button type="button" class="template-btn btn-style-one" onclick="changeForm('project_info','client_info');">
                                <span class="btn-wrap">
                                <span class="text-one">PREVIOUS</span>
                                <span class="text-two">PREVIOUS</span>
                                </span>
                            </button>
                            <button type="submit" class="template-btn btn-style-one float-end" id="quote-submit">
                                <span class="btn-wrap">
                                <span class="text-one">SUBMIT</span>
                                <span class="text-two">SUBMIT</span>
                                </span>
                            </button>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Team Detail Form -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->
    <?php $this->load->view('includes/js'); ?>
    <script src="<?=base_url()?>assets/js/validate.js"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LeltA4qAAAAAGd0nrTRqccI8iE4pxZGsUFgJB6r', {action: 'submit'}).then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
        });

        $('#client_info').hide();
        
        $('#fileInput').on('change', function() {
            var file = this.files[0];
            if (file && file.size <= 1048576) { // 1MB in bytes (1024 * 1024)
                var fileType = file.type.split('/')[0]; // Get the main file type (image, application)

                // Check if the file type is image, application/pdf, or application/msword
                if (fileType === 'image' || file.type === 'application/pdf' || file.type === 'application/msword' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    handleFile(file);
                } else {
                    alert('Please select an image, PDF, or Word document.');
                    $('#fileInput').val(''); // Clear selected file from input
                }
            } else {
                alert('Please select a file that is less than or equal to 1MB.');
                $('#fileInput').val(''); // Clear selected file from input
            }
        });

        $(document).on('click', '.remove-icon', function() {
            $(this).closest('.thumbnail').remove();
            $('#fileInput').val(''); // Clear selected file from input
        });

        function handleFile(file) {
            var thumbnailContainer = $('#thumbnailContainer');
            thumbnailContainer.empty(); // Clear previous thumbnails

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var thumbnail = $('<div class="thumbnail">');
                    
                    if (file.type === 'application/pdf') {
                        var pdfUrl = URL.createObjectURL(file);
                        var pdfPreview = $('<embed src="' + pdfUrl + '">');
                        thumbnail.append(pdfPreview);
                    } else if (file.type === 'application/msword' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        thumbnail.append('<p>Word Document</p>');
                    } else {
                        var image = $('<img>').attr('src', e.target.result);
                        thumbnail.append(image);
                    }

                    var removeIcon = $('<div class="remove-icon"><i class="fas fa-times"></i></div>');
                    thumbnail.append(removeIcon);
                    thumbnailContainer.append(thumbnail);
                };

                reader.readAsDataURL(file); // Convert file to DataURL
            }
        }

        $('#service_id').selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );

        // Handle change event using Selectmenu's change method
        $('#country_id').selectmenu({
            change: function(event, ui) {
                var selectedValue = $(this).val();
                var selectedPhoneCode = $(this).find('option:selected').attr('phone-code');
                $('input[name="phone"]').val(selectedPhoneCode)
            }
        }).selectmenu( "menuWidget" ).addClass( "overflow" );

        const changeForm = (showForm,hideForm) => {
            if (showForm === 'client_info') {
                $('input, select, textarea').removeClass('error');
                $('.error-message').remove();

                // Validate form fields
                var isValid = true;
                var service_id = $('select[name="service_id"]').val();
                var budget = $('input[name="budget"]').val();

                if (service_id === "" || service_id == undefined || service_id == null) {
                    isValid = false;
                    $('select[name="service_id"]').addClass('error').siblings('span').after('<span class="error-message text-danger">Service is required</span>');
                }
                if (budget === "") {
                    isValid = false;
                    $('input[name="budget"]').addClass('error').after('<span class="error-message text-danger">Budget is required</span>');
                }
                if(!isValid) {
                    return;
                }
            }
            $(`#${showForm.toLowerCase()}`).show(500);
            $(`#${hideForm.toLowerCase()}`).hide(500);
        }

        $('#quote-form').validate({
          rules: {
            service_id: {
                required: true
            },
            budget: {
                required: true
            },
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
            country_id: {
                required: true
            },
            address: {
              required: true
            }
          },
          submitHandler: function (form) {
            var formData = new FormData(form);
            $('#quote-submit .text-one, #quote-submit .text-two').text('Loading...');
            $.ajax({
                url: '<?=base_url()?>submit-quote', // URL to submit the form data
                type: 'POST', // HTTP method
                data: formData, // Serialize the form data
                cache:false,
                contentType: false,
                processData: false,
                success: function(response) {
                    const resp = $.parseJSON(response);
                    if(resp.status == 'success') {
                        $('#success-message').text(resp.message).parent('div.alert').removeClass('d-none');
                        setTimeout(() => {
                            $('#success-message').text('').parent('div.alert').addClass('d-none');
                        }, 1000);
                        // Optionally, you can reset the form or perform other actions
                        $(form)[0].reset();
                        $('.remove-icon').trigger('click');
                    } else {
                        $('#unsuccess-message').text(resp.message).parent('div.alert').removeClass('d-none');
                        setTimeout(() => {
                            $('#unsuccess-message').text('').parent('div.alert').addClass('d-none');
                        }, 1000);
                    }
                    $('#quote-submit .text-one, #quote-submit .text-two').text('SUBMIT');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle the error response
                    alert('Form submission failed: ' + textStatus);
                }
            });
          }
        });
    </script>
  </body>
</html>
