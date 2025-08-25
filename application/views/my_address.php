<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php $this->load->view('includes/head'); ?>
    </head>
    <body>

        <?php $this->load->view('includes/header'); ?>

        <main>
            <!-- Slider section -->
            <section class="banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h1><?=$pageMain->headline?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Wholesale item section -->
            <section class="my-account my-2 p-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <?php $this->load->view('includes/account/user_header'); ?>
                        </div>
                        <div class="col-12 col-md-9 p-4">
                            
                            <div class="row flex-row-reverse" id="form-type-section">
                                <p>הכתובות הנ"ל תשמשו כברירת מחדל במהלך התשלום.</p>
                                <!-- Billing Address -->
                                <div class="col-md-6">
                                    <h2>כתובת לחיוב</h2>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="me-auto" onclick="showForm('PRIMARY');">להוסיף כתובת לחיוב</a>
                                    </div>
                                    <address class="fst-italic">לא הגדרת כתובת זאת עדיין.</address>
                                </div>

                                <!-- Shipping Address -->
                                <div class="col-md-6">
                                    <h2>כתובת משלוח</h2>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="me-auto" onclick="showForm('SECONDARY');">להוסיף כתובת משלוח</a>
                                    </div>
                                    <address class="fst-italic">לא הגדרת כתובת זאת עדיין.</address>
                                </div>
                            </div>
                            <div class="container my-4" id="shippingAddressForm" style="display: none;">
                                <div class="alert" role="alert"></div>
                                <h2 id="form-title"></h2>
                                <form method="POST" class="needs-validation has-cart-button w-75" novalidate>
                                    <input type="hidden" name="add_id" id="add_id" value="0" />
                                    <input type="hidden" name="add_type" id="add_type" value="" />
                                    <!-- First Name and Last Name in one row -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control form-control-lg" id="firstName" name="firstName" placeholder="שם פרטי" required>
                                            <div class="invalid-feedback">
                                                שם פרטי הוא שדה חובה.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control form-control-lg" id="lastName" name="lastName" placeholder="שם משפחה" required>
                                            <div class="invalid-feedback">
                                                שם משפחה הוא שדה חובה.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Company Name -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" id="company" name="company" placeholder="שם החברה">
                                    </div>

                                    <!-- Street and House Number -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="מספר בית ושם רחוב" required>
                                        <div class="invalid-feedback">
                                            אנא הזן את כתובתך.
                                        </div>
                                    </div>

                                    <!-- Postal Code -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" id="zip" name="zip" placeholder="מיקוד / תא דואר">
                                    </div>
                                    
                                    <!-- City -->
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg" id="city" name="city" aria-label="city" required>
                                            <option selected disabled value="">בחר עיר</option>
                                            <?php foreach ($loadCities as $row) { ?>
                                                <option value="<?=$row->city_id?>"><?=$row->city_name?> [ <?=$row->city_name_hebrew?>  ]</option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">אנא בחר עיר.</div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="mb-3">
                                        <input type="tel" class="form-control form-control-lg" id="phone" name="phone" placeholder="טלפון" >
                                        <div class="invalid-feedback">
                                            אנא הזן מספר טלפון.
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="כתובת אימייל" required>
                                        <div class="invalid-feedback">
                                            אנא הזן כתובת אימייל חוקית.
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <button type="submit" id="submitButton" class="btn curved-button btn-add-to-cart">שמירת כתובת</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
        <script>
            const showForm = (addType) => {
                if (addType == 'PRIMARY') {
                    $('#form-title').text('כתובת לחיוב');
                } else {
                    $('#form-title').text('כתובת משלוח');
                }

                // This line is okay, but slideDown will work even without it if the element is already hidden.
                $('#shippingAddressForm').hide(); 
                $('#form-type-section').hide();
                
                $('#shippingAddressForm').slideDown('slow');
                $('#add_type').val(addType);

                // Select all inputs EXCEPT #company and #phone, and all selects
                const fieldsToValidate = $('#shippingAddressForm').find('input:not(#company, #phone), select');
                
                // Make only the selected fields required
                fieldsToValidate.prop('required', true);
            }

            (function () {
                'use strict';

                const forms = document.querySelectorAll('.needs-validation');

                Array.prototype.slice.call(forms).forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        event.stopPropagation();

                        // Add Bootstrap validation styles
                        form.classList.add('was-validated');

                        // Submit with AJAX if valid
                        if (form.checkValidity()) {
                            $('#submitButton').html('הַגָשָׁה...').attr('disabled','disabled')
                            const formData = new FormData(form);
                            $.ajax({
                                url: '<?=base_url()?>my-account/save-address',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    const resp = $.parseJSON(result);

                                    if (resp.status == 'success') {
                                        $('.alert').addClass('alert-success').text(resp.message);

                                        setTimeout(() => {
                                            location.reload();
                                        }, 3000);
                                    } else {
                                        $('.alert').addClass('alert-danger').text(resp.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("AJAX Error:", error);
                                }
                            });

                        }
                    }, false);
                });
            })();
        </script>
    </body>
</html>
