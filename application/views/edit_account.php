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
                        <div class="col-12 col-md-9 px-4">
                            <div class="container my-4">
                                <div class="alert" role="alert"></div>
                                <form method="POST" class="needs-validation has-cart-button w-75" novalidate>
                                    <input type="hidden" name="user_id" id="user_id" value="<?=$accountDetail->user_id?>" />

                                    <!-- Fullname -->
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">שם מלא</label>
                                        <input type="text" class="form-control form-control-lg" id="full_name" name="full_name" placeholder="שם מלא" value="<?=$accountDetail->full_name?>" required>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">כתובת אימייל</label>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="כתובת אימייל" value="<?=$accountDetail->email?>" required>
                                        <div class="invalid-feedback">
                                            אנא הזן כתובת אימייל חוקית.
                                        </div>
                                    </div>

                                    <p>שינוי סיסמה</p>

                                    <div class="mb-3 position-relative">
                                        <label for="current_password" class="form-label">סיסמה נוכחית (כדי להשאיר ללא שינוי יש להשאיר ריק)</label>
                                        <input class="form-control form-control-lg" id="current_password" name="current_password" type="password" aria-label="current_password" placeholder="הסיסמה הנוכחית">
                                        <!-- Eye Icon Button -->
                                        <button
                                            type="button"
                                            class="btn border-0 bg-transparent p-0 position-absolute start-0"
                                            style="top: 70%; transform: translateY(-50%); margin-left: 0.75rem;"
                                            onclick="togglePasswordField(this);"
                                        >
                                            <i class="fa fa-eye-slash fs-5"></i>
                                        </button>

                                        <div class="invalid-feedback">נדרשת סיסמה נוכחית.</div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label for="new_password" class="form-label">סיסמה חדשה (כדי להשאיר ללא שינוי יש להשאיר ריק)</label>
                                        <input class="form-control form-control-lg" id="new_password" name="new_password" type="password" aria-label="new_password" placeholder="סיסמה חדשה">
                                        <!-- Eye Icon Button -->
                                        <button
                                            type="button"
                                            class="btn border-0 bg-transparent p-0 position-absolute start-0"
                                            style="top: 70%; transform: translateY(-50%); margin-left: 0.75rem;"
                                            onclick="togglePasswordField(this);"
                                        >
                                            <i class="fa fa-eye-slash fs-5"></i>
                                        </button>

                                        <div class="invalid-feedback">נדרשת סיסמה נוכחית.</div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label for="confirm_password" class="form-label">יש לאשר את הסיסמה החדשה</label>
                                        <input class="form-control form-control-lg" id="confirm_password" name="confirm_password" type="password" aria-label="confirm_password" placeholder="לאשר את הסיסמה">
                                        <!-- Eye Icon Button -->
                                        <button
                                            type="button"
                                            class="btn border-0 bg-transparent p-0 position-absolute start-0"
                                            style="top: 70%; transform: translateY(-50%); margin-left: 0.75rem;"
                                            onclick="togglePasswordField(this);"
                                        >
                                            <i class="fa fa-eye-slash fs-5"></i>
                                        </button>

                                        <div class="invalid-feedback">נדרשת סיסמה נוכחית.</div>
                                    </div>

                                    <div class="mt-2">
                                        <button type="submit" id="submitButton" class="btn curved-button btn-add-to-cart">שמירת שינויים</button>
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
            
            // Toggle password field.
            function togglePasswordField(button) {
                const $btn = $(button);
                const $input = $btn.siblings("input"); // get related input
                const $icon = $btn.find("i");

                if ($input.attr("type") === "password") {
                    $input.attr("type", "text");
                    $icon.removeClass("fa-eye-slash").addClass("fa-eye");
                } else {
                    $input.attr("type", "password");
                    $icon.removeClass("fa-eye").addClass("fa-eye-slash");
                }
            }

            $('#current_password').on('change', function() {
                const value = this.value;
                if (value !== '') {
                    $('input[type="password"]').attr('required','required');
                } else {
                    $('input[type="password"]').removeAttr('required');
                }
            });

            (function () {
                'use strict';

                const forms = document.querySelectorAll('.needs-validation');

                Array.prototype.slice.call(forms).forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        event.stopPropagation();

                        const password = form.querySelector('#new_password');
                        const confirmPassword = form.querySelector('#confirm_password');

                        // Reset previous custom validity
                        confirmPassword.setCustomValidity('');

                        // Custom validation for confirm password
                        if (password && confirmPassword && password.value !== confirmPassword.value) {
                            confirmPassword.setCustomValidity('הסיסמאות אינן תואמות.');
                        }

                        // Add Bootstrap validation styles
                        form.classList.add('was-validated');

                        // Submit with AJAX if valid
                        if (form.checkValidity()) {
                            $('#submitButton').html('הַגָשָׁה...').attr('disabled','disabled')
                            const formData = new FormData(form);
                            $.ajax({
                                url: '<?=base_url()?>update-account',
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
                                        }, 1000);
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
