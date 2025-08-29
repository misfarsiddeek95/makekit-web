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
                <div class="container px-0">
                    <div class="text-end mb-4">
                        <div class="section-title-container">
                            <h1 class="underline-heading-1 fw-semibold">התחברות</h1>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="alert alert-danger d-none" id="error-alert" role="alert"></div>
                    <form class="needs-validation has-cart-button" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">שם משתמש או כתובת אימייל </label>
                            <input class="form-control form-control-lg" id="username" name="username" type="email" aria-label="username" required>
                            <div class="invalid-feedback">נדרש שם משתמש או דוא"ל</div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">סיסמה</label>
                            <input class="form-control form-control-lg" id="password" name="password" type="password" aria-label="password" required>
                            <!-- Eye Icon Button -->
                            <button
                                type="button"
                                id="togglePassword"
                                class="btn border-0 bg-transparent p-0 position-absolute start-0"
                                style="top: 70%; transform: translateY(-50%); margin-left: 0.75rem;"
                            >
                                <i class="fa fa-eye-slash fs-5"></i>
                            </button>

                            <div class="invalid-feedback">נדרשת סיסמה.</div>
                        </div>
                        <div class="mt-2 d-flex flex-row align-items-center gap-2">
                            <button type="submit" class="btn curved-button btn-add-to-cart" id="submitButton">התחברות</button>
                            <div class="form-check form-check-reverse">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember_me" value="1">
                                <label class="form-check-label" for="flexCheckDefault">זכור אותי</label>
                            </div>
                        </div>
                        <div class="mt-2 d-flex flex-column gap-4">
                            <a href="#">איפוס סיסמה</a>
                            <a href="<?=base_url('student-registration/');?>">הרשמה</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
        <script>
            document.getElementById("togglePassword").addEventListener("click", function () {
                const passwordInput = document.getElementById("password");
                const icon = this.querySelector("i");
                const isHidden = passwordInput.type === "password";
                passwordInput.type = isHidden ? "text" : "password";
                icon.classList.toggle("fa-eye");
                icon.classList.toggle("fa-eye-slash");
            });


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
                            $('#submitButton').html('הַגָשָׁה...').prop('disabled', true)
                            const formData = new FormData(form);
                            $.ajax({
                                url: '<?=base_url()?>signin',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    const resp = $.parseJSON(result);
                                    if (resp.status == 'success') {
                                        location.href=`<?=base_url()?>${resp.redirect_url}/`;
                                    } else {
                                        console.error(resp.message);
                                        $('#error-alert').html(resp.message).removeClass('d-none');
                                    }

                                    $('#submitButton').html('התחברות').prop('disabled', false);
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
