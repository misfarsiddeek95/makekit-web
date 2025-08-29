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
                        <div class="col-12 col-md-12 p-4">
                            <p>שכחת את הסיסמה? יש להזין את שם המשתמש או כתובת האימייל. הוראות איפוס הסיסמה ישלחו באימייל.</p>
                            <form method="POST" class="needs-validation has-cart-button w-75" novalidate>
                                <div class="mb-3">
                                    <label for="username" class="form-label">שם משתמש או כתובת אימייל</label>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="שם משתמש או כתובת אימייל " required>
                                    <div class="invalid-feedback">נדרש שם משתמש או דוא"ל</div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" id="submitButton" class="btn curved-button btn-add-to-cart">איפוס סיסמה</button>
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
