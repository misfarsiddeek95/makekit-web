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

            <!-- Update password section -->
            <section class="my-account my-2 p-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 p-4">
                            <div class="alert d-none" role="alert"></div>
                            <h5 class="mb-3">הגדרת סיסמה חדשה</h5>
                            <form method="POST" class="needs-validation has-cart-button w-75" novalidate id="setNewPasswordForm">
                                <input type="hidden" id="token" name="token" value="<?=htmlspecialchars($this->input->get('token'))?>">
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">סיסמה חדשה</label>
                                    <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" required>
                                    <div class="invalid-feedback">נדרשת סיסמה חדשה</div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">אישור סיסמה חדשה</label>
                                    <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" required>
                                    <div class="invalid-feedback">יש לאשר את הסיסמה החדשה</div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" id="updatePwdButton" class="btn curved-button btn-add-to-cart">עדכן סיסמה</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
        <script>
            (function () {
                'use strict';

                const newPwdForm = document.getElementById('setNewPasswordForm');
                if (newPwdForm) {
                    newPwdForm.addEventListener('submit', function (event) {
                        event.preventDefault();
                        event.stopPropagation();

                        newPwdForm.classList.add('was-validated');
                        const pwd = document.getElementById('new_password');
                        const cpwd = document.getElementById('confirm_password');
                        if (pwd.value !== cpwd.value) {
                            cpwd.setCustomValidity('הסיסמאות אינן תואמות.');
                        } else {
                            cpwd.setCustomValidity('');
                        }

                        if (newPwdForm.checkValidity()) {
                            $('#updatePwdButton').html('מעדכן...').attr('disabled','disabled');
                            const formData = new FormData(newPwdForm);
                            $.ajax({
                                url: '<?=base_url()?>update-password',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    const resp = $.parseJSON(result);
                                    if (resp.status == 'success') {
                                        $('.alert').removeClass('d-none').removeClass('alert-danger').addClass('alert-success').text(resp.message);
                                        setTimeout(() => {
                                            location.href = '<?=base_url('my-account/');?>';
                                        }, 2000);
                                    } else {
                                        $('.alert').removeClass('d-none').removeClass('alert-success').addClass('alert-danger').text(resp.message);
                                    }
                                    $('#updatePwdButton').html('עדכן סיסמה').attr('disabled', false);
                                },
                                error: function(xhr, status, error) {
                                    console.error("AJAX Error:", error);
                                    $('#updatePwdButton').html('עדכן סיסמה').attr('disabled', false);
                                }
                            });
                        }
                    }, false);
                }
            })();
        </script>
    </body>
    </html>


