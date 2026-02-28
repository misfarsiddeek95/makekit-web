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
                <div class="container d-flex justify-content-center">
                    <form method="POST" class="needs-validation has-cart-button w-75" novalidate>
                        <input type="hidden" name="user_id" id="user_id" value="0" />
                        <input type="hidden" name="add_id" id="add_id" value="0" />
                        <div class="mb-3">
                            <label for="institute_id" class="form-label">מכון</label>
                            <select class="form-select form-select-lg" id="institute_id" name="institute_id" aria-label="institute_id" required>
                                <option selected disabled value="">לִבחוֹר</option>
                                <?php foreach ($loadInstitutes as $row) { ?>
                                    <option value="<?=$row->class_id?>"><?=$row->class_name?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">אנא בחר מכון.</div>
                        </div>

                        <div class="mb-3">
                            <label for="subject_id" class="form-label">חוג</label>
                                <select class="form-select form-select-lg" id="subject_id" name="subject_id" aria-label="subject_id" required>
                                    <option selected disabled value="">לִבחוֹר</option>
                                </select>
                            <div class="invalid-feedback">אנא בחר מעגל.</div>
                        </div>

                        <div class="mb-3">
                            <label for="instructor_id" class="form-label">מַדְרִיך</label>
                                <select class="form-select form-select-lg" id="instructor_id" name="instructor_id" aria-label="instructor_id" required>
                                    <option selected disabled value="">לִבחוֹר</option>
                                </select>
                            <div class="invalid-feedback">אנא בחר מדריך.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">שם הילד</label>
                            <input class="form-control form-control-lg" id="name" name="name" type="text" aria-label="name" required>
                            <div class="invalid-feedback">שם הילד נדרש.</div>
                        </div>

                        <div class="mb-3">
                            <label for="parent_name" class="form-label">שם ההורה</label>
                            <input class="form-control form-control-lg" id="parent_name" name="parent_name" type="text" aria-label="parent_name" required>
                            <div class="invalid-feedback">שם ההורה נדרש.</div>
                        </div>

                        <div class="mb-3">
                            <label for="city_dropdown_btn" class="form-label">עיר</label>
                            
                            <div class="dropdown" id="city_dropdown_container">
                                <!-- Hidden Input for Form Submission -->
                                <input type="hidden" name="city" id="city_id" required>
                                
                                <!-- Trigger Button (styled exactly like .my-account select) -->
                                <button class="form-select form-select-lg text-start d-flex justify-content-between align-items-center" 
                                        type="button" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false" 
                                        id="city_dropdown_btn"
                                        style="background-color: #fff; border: 1px solid rgba(32, 7, 7, 0.8); border-radius: 4px; padding: 0.5em; padding-left: 2.5rem; line-height: 2; height: auto; background-position: left 0.75rem center;">
                                    <span id="city_btn_text">לִבחוֹר</span>
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div class="dropdown-menu w-100 p-0" aria-labelledby="city_dropdown_btn">
                                    <div class="p-2 border-bottom">
                                        <input type="text" class="form-control" id="city_search_input" placeholder="חיפוש..." autocomplete="off">
                                    </div>
                                    <ul class="list-unstyled mb-0" id="city_list" style="max-height: 250px; overflow-y: auto;">
                                        <?php foreach ($loadCities as $city) { ?>
                                            <li>
                                                <button class="dropdown-item text-end" type="button" 
                                                        data-id="<?=$city->city_id?>" 
                                                        data-name="<?=$city->city_name_hebrew?>">
                                                    <?=$city->city_name_hebrew?>
                                                </button>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="city_error">אנא בחר עיר.</div>
                        </div>

                        <div class="mb-3">
                            <label for="parent_phone" class="form-label">טלפון הורה</label>
                            <input class="form-control form-control-lg" id="parent_phone" name="parent_phone" type="text" aria-label="parent_phone" required>
                            <div class="invalid-feedback">נדרש טלפון של ההורה.</div>
                        </div>

                        <div class="mb-3">
                            <label for="parent_email" class="form-label">דוא"ל הורה</label>
                            <input class="form-control form-control-lg" id="parent_email" name="parent_email" type="email" aria-label="parent_email" required>
                            <div class="invalid-feedback">נדרשת כתובת דוא"ל של ההורה.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">סיסמה</label>
                            <input class="form-control form-control-lg" id="password" name="password" type="password" aria-label="password" required>
                            <div class="invalid-feedback">נדרשת סיסמה.</div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">סיסמה</label>
                            <input class="form-control form-control-lg" id="confirm_password" name="confirm_password" type="password" aria-label="confirm_password" required>
                            <div class="invalid-feedback">נדרשת סיסמה.</div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" id="submitButton" class="btn curved-button btn-add-to-cart">התחברות</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        <script>
            // Custom Dropdown Logic
            // 1. Search Filtering
            $('#city_search_input').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#city_list li').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // 2. Selection Handling
            $('#city_list .dropdown-item').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                // Update UI and Hidden Value
                $('#city_btn_text').text(name);
                $('#city_id').val(id);
                
                // Clear validation error if any
                $('#city_id')[0].setCustomValidity('');
                $('#city_dropdown_container').removeClass('is-invalid'); // Optional visual cue
                $('#city_error').hide();
            });

            // 3. Validation Logic Override
            // We need to ensure the hidden input is checked on form submit
            $('.needs-validation').on('submit', function(event) {
                if ($('#city_id').val() === '') {
                     $('#city_id')[0].setCustomValidity('Please select a city');
                     $('#city_error').show(); // Show custom error div
                     event.preventDefault();
                     event.stopPropagation();
                }
            });

            // Focus search input when dropdown opens
            $('#city_dropdown_container').on('shown.bs.dropdown', function () {
                $('#city_search_input').trigger('focus');
            });
            
            
            $('#institute_id').on('change', function() {
                $('#subject_id').html(`<option>טְעִינָה...</option>`);
                const val = this.value;
                $.ajax({
                    url : '<?=base_url()?>load-intitute-circles',
                    type: 'GET',
                    data: {institute_id: val},
                    success: function (result) {
                        const resp = $.parseJSON(result);
                        if (resp.status == 'error') {
                            return console.error(resp.message);
                        }
                        const data = resp.data;
                        let opt = `<option selected disabled value="">לִבחוֹר</option>`;

                        data.forEach(el => {
                            opt += `<option value="${el.sub_id}">${el.subject_name}</option>`;
                        });
                        $('#subject_id').html(opt);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                })
            });

            $('#subject_id').on('change', function() {
                const instituteId = $('#institute_id option:selected').val();
                const val = this.value;

                $('#instructor_id').html(`<option>טְעִינָה...</option>`);
                $.ajax({
                    url : '<?=base_url()?>load-subject-instructor',
                    type: 'GET',
                    data: {institute_id: instituteId, subject_id: val},
                    success: function (result) {
                        const resp = $.parseJSON(result);
                        if (resp.status == 'error') {
                            return console.error(resp.message);
                        }
                        const data = resp.data;
                        let opt = `<option selected disabled value="">לִבחוֹר</option>`;

                        data.forEach(el => {
                            opt += `<option value="${el.teacher_id}">${el.teacher_name}</option>`;
                        });
                        $('#instructor_id').html(opt);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                })
            });

            (function () {
                'use strict';

                const forms = document.querySelectorAll('.needs-validation');

                Array.prototype.slice.call(forms).forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        event.stopPropagation();

                        const password = form.querySelector('#password');
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
                                url: '<?=base_url()?>register-student',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    const resp = $.parseJSON(result);
                                    console.log(resp);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
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
