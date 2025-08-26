<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <style>
            /* Optional: ensure uniform button height and no rounding */
            .qty-btn,
            .qtyInput {
                border-radius: 0 !important;
                height: 42px;
                border: 1px solid rgba(0,0,0,.1)
            }
            .qty-btn:hover {
                border: 1px solid rgba(0,0,0,.1)
            } 
        </style>
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

            <!-- Cart item section -->
            <section class="my-account my-5 p-5 cart has-cart-button">
                <!-- summary -->
                <form class="needs-validation" novalidate>
                    <div class="row flex-column flex-column-reverse gap-2 gap-md-0 flex-md-row-reverse justify-content-between mt-4 py-4 py-md-0 cart-summary <?= empty($this->cart->contents()) ? 'd-none' : '' ?>">
                        <div class="col-12 col-md-6 text-md-end text-center">
                            <div class="section-title-container px-2">
                                <h1 class="underline-heading-1 fw-semibold">פרטי ההזמנה</h1>
                            </div>

                            <!-- Summary -->
                            <div class="container mt-4">
                                <div class="table-responsive">
                                    <table class="table text-end align-middle" dir="rtl">
                                        <thead>
                                            <tr>
                                                <th>מוצר</th>
                                                <th>סכום ביניים</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($this->cart->contents() as $item) { ?>
                                                <tr id="rowId<?=$item['rowid']?>">
                                                    <td>
                                                        <strong><?=$item['qty']?> ×</strong> <?=$item['name']?>
                                                    </td>
                                                    <td><?=$cur.number_format($item['subtotal'], 2)?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive summary-table">
                                    <table class="table text-end align-middle">
                                        <tbody>
                                            <!-- Subtotal -->
                                            <tr>
                                                <th class="fw-semibold w-30 border-0">סכום ביניים</th>
                                                <td id="cart_total_td" cart-total="<?=$this->cart->total()?>"><?=$cur.number_format($this->cart->total(), 2)?></td>
                                            </tr>

                                            <!-- Shipping Methods -->
                                            <tr>
                                                <th class="fw-semibold d-none d-md-table-cell align-top border-0">משלוח</th>
                                                <td colspan="2" class="border-md-0 pt-4">
                                                    <span class="d-block d-md-none fw-semibold mb-2">משלוח</span>
                                                    <div class="bg-white small lh-lg">
                                                        <div class="form-check form-check-reverse">
                                                            <input class="form-check-input" type="radio" name="shipping" id="ship1" value="DEL" del-charge="50" checked>
                                                            <label class="form-check-label w-100" for="ship1">משלוח מהיר: ₪50.00</label>
                                                        </div>
                                                        <div class="form-check form-check-reverse">
                                                            <input class="form-check-input" type="radio" name="shipping" id="ship2" value="LOCAL_PICK">
                                                            <label class="form-check-label w-100" for="ship2">איסוף מקומי</label>
                                                        </div>
                                                        <div class="form-check form-check-reverse">
                                                            <input class="form-check-input" type="radio" name="shipping" id="ship3" value="DEL_VIA_CONTACT">
                                                            <label class="form-check-label w-100" for="ship3">אספקה דרך איש קשר (פרסים בלבד)</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Total -->
                                            <tr class="fw-bold fs-5">
                                                <th class="fw-semibold">סה"כ</th>
                                                <td id="final_total_td"><?=$cur.number_format(($this->cart->total() +  50), 2)?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn curved-button btn-add-to-cart py-4" id="submitButton">שליחת הזמנה</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-md-end">
                            <div class="section-title-container px-2">
                                <h1 class="underline-heading-1 fw-semibold">פרטי חיוב</h1>
                            </div>
                            <div class="container my-4">
                                <div class="row justify-content-start">
                                    <!-- Set column width for different screen sizes -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-container">
                                            <!-- The 'needs-validation' class enables Bootstrap's built-in form validation -->
                                            
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
                                                    <input type="text" class="form-control form-control-lg" id="zip" name="zip" placeholder="מיקוד / תא דואר" required>
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

                                                <!-- Checkbox for different shipping address -->
                                                <div class="form-check form-check-reverse text-end mb-3">
                                                <input class="form-check-input" type="checkbox" value="" id="shippingAddressCheck" name="shippingAddressCheck">
                                                    <label class="form-check-label" for="shippingAddressCheck">
                                                        משלוח לכתובת אחרת?
                                                    </label>
                                                </div>

                                                <!-- SHIPPING ADDRESS FORM (Initially hidden) -->
                                            <div id="shippingAddressForm" style="display: none;">
                                                    <!-- Shipping First Name and Last Name -->
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <input type="text" class="form-control form-control-lg" id="shippingFirstName" name="shipping_first_name" placeholder="שם פרטי">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <input type="text" class="form-control form-control-lg" id="shippingLastName" name="shipping_last_name" placeholder="שם משפחה">
                                                        </div>
                                                    </div>

                                                    <!-- Shipping Company Name -->
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control form-control-lg" id="shippingCompany" name="shipping_company" placeholder="שם החברה">
                                                    </div>

                                                    <!-- Shipping Street and House Number -->
                                                    <div class="mb-3">
                                                        <label for="shippingAddress" class="form-label fw-bold">ישראל</label>
                                                        <input type="text" class="form-control form-control-lg" id="shippingAddress" name="shipping_address" placeholder="מספר בית ושם רחוב">
                                                    </div>

                                                    <!-- Shipping Postal Code -->
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control form-control-lg" id="shippingZip" name="shipping_zip" placeholder="מיקוד / תא דואר">
                                                    </div>
                                                    
                                                    <!-- Shipping City -->
                                                    <div class="mb-3">
                                                        <select class="form-select form-select-lg" id="shipping_city" name="shipping_city" aria-label="shipping_city">
                                                            <option selected disabled value="">בחר עיר</option>
                                                            <?php foreach ($loadCities as $row) { ?>
                                                                <option value="<?=$row->city_id?>"><?=$row->city_name?> [ <?=$row->city_name_hebrew?>  ]</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- END SHIPPING ADDRESS FORM -->

                                                <!-- Order Notes -->
                                                <div class="mb-3">
                                                    <textarea class="form-control form-control-lg" id="notes" name="notes" rows="3" placeholder="הערות להזמנה"></textarea>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        <script>
            $(document).ready(function() {
                const selectedShippingMethod = sessionStorage.getItem('shipping_method');
                if (selectedShippingMethod != null) {
                const $radio = $(`input[name="shipping"][value="${selectedShippingMethod}"]`);
                if ($radio.length) {
                    $radio.prop('checked', true).trigger('change'); 
                }
                }


                // Listen for changes on the checkbox
                $('#shippingAddressCheck').on('change', function() {
                    // Check if the checkbox is checked
                    if ($(this).is(':checked')) {
                        // If checked, slowly show the shipping form
                        $('#shippingAddressForm').slideDown('slow');
                        // Make the inputs inside the shipping form required for validation
                        $('#shippingAddressForm').find('input, select').prop('required', true);
                    } else {
                        // If unchecked, slowly hide the shipping form
                        $('#shippingAddressForm').slideUp('slow');
                        // Remove the required attribute so the form can be submitted without them
                        $('#shippingAddressForm').find('input, select').prop('required', false);
                    }
                });
            });

            $('input[name="shipping"]').on('change', function() {
                const rValue = this.value;
                let delCharge = 0;
                const cartTotal = parseFloat($('#cart_total_td').attr('cart-total'));

                sessionStorage.setItem('shipping_method', rValue);

                if (rValue == 'DEL') {
                    delCharge = parseFloat($(this).attr('del-charge'));
                }

                const finalTotal = cartTotal + delCharge;
                const currency = '<?=$cur?>';

                const finalOutput = formatCurrency(finalTotal, currency);

                $('#final_total_td').html(finalOutput);
            });

            const updateFinalTotal = (cartTotalVal) => {
                const currency = '<?=$cur?>';

                const selectedShippingMethod = sessionStorage.getItem('shipping_method');
                let delCharge = 0;
                if (selectedShippingMethod == 'DEL') {
                    delCharge = 50;
                }

                const finalTotalCalc = parseFloat(cartTotalVal) + parseFloat(delCharge);
                $('#final_total_td').html(formatCurrency(finalTotalCalc, currency));
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
                                url: '<?=base_url()?>checkout/save',
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
