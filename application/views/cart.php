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
            <section class="my-5 p-5 cart has-cart-button">
                <div class="table-responsive">
                    <table class="table cart-table text-center align-middle" dir="rtl">
                        <thead class="table-light">
                            <tr>
                                <th></th> <!-- For delete -->
                                <th></th> <!-- For image -->
                                <th>מוצר</th>
                                <th>מחיר</th>
                                <th style="text-align: right;">כמות</th>
                                <th>סכום ביניים</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($this->cart->contents() as $item){
                                    $img = $item['options']['photo'] != null ? $item['options']['photo'] : base_url('assets/images/product_default.png');
                            ?>
                            <tr class="d-table-row d-md-table-row d-block d-md-table-row" id="rowId<?=$item['rowid']?>">
                                <!-- Remove -->
                                <td class="d-block d-md-table-cell text-end text-md-center">
                                    <button class="btn btn-outline-dark rounded-circle p-0" style="width: 24px; height: 24px;" onclick="removeCartItem('<?=$item['rowid']?>');">
                                        ×
                                    </button>
                                </td>
                                <!-- Product Image -->
                                <td class="d-block d-md-table-cell text-end text-md-center">
                                    <img src="<?=$img?>" alt="<?= $item['name'] ?>" width="100">
                                </td>
                                <!-- Product Name -->
                                <td data-label="מוצר" class="d-block d-md-table-cell text-md-center">
                                    <a href="#" class="text-decoration-none"><?= $item['name'] ?></a>
                                </td>
                                <!-- Price -->
                                <td data-label="מחיר" class="d-block d-md-table-cell text-md-center" id="price-td<?=$item['rowid']?>">
                                    <?php if ($item['options']['has_discount']) { ?>
                                        <del><?= $cur.number_format($item['options']['original_price'], 2) ?></del>
                                    <?php } ?>
                                    <?=$cur.number_format($item['price'], 2);?>
                                </td>
                                <!-- Quantity -->
                                <td data-label="כמות" class="d-block d-md-table-cell text-md-center">
                                    <div class="input-group justify-content-center" style="width: 110px;">
                                        <button class="btn btn-outline-secondary px-2 qty-btn" type="button" onclick="decreaseQty('<?=$item['rowid']?>')">-</button>
                                        <input type="text" id="qtyInput<?=$item['rowid']?>" product-id="<?=$item['id']?>" org-qty="<?=$item['options']['org_available_qty']?>" class="form-control text-center border-start-0 border-end-0 qtyInput" value="<?= $item['qty'] ?>" readonly>
                                        <button class="btn btn-outline-secondary px-2 qty-btn" type="button" onclick="increaseQty('<?=$item['rowid']?>')">+</button>
                                    </div>
                                </td>
                                <!-- Subtotal -->
                                <td data-label="סכום ביניים" class="d-block d-md-table-cell text-md-center"><?=$cur.number_format($item['subtotal'], 2);?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- action buttons d-flex flex-column flex-md-row justify-content-between -->
                <div class="row flex-column flex-column-reverse gap-2 gap-md-0 flex-md-row-reverse justify-content-between align-items-center mt-4 py-4 py-md-0 mobile-bg">
                    <!-- Left: Update Cart Button -->
                    <div class="col-12 col-md-6 text-md-start text-center mb-3 mb-md-0">
                        <button class="btn curved-button btn-add-to-cart" id="update-btn" disabled onclick="updateCart(this)">לעדכן סל קניות</button>
                    </div>

                    <!-- Right: Coupon Input + Button (Right-Aligned) -->
                    <div class="col-12 col-md-6 d-flex justify-content-start">
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control" style="width: 150px;" placeholder="הזן קופון">
                            <button class="btn curved-button btn-add-to-cart">החלת קופון</button>
                        </div>
                    </div>
                </div>

                <!-- summary -->
                <div class="row flex-column flex-column-reverse gap-2 gap-md-0 flex-md-row-reverse justify-content-between mt-4 py-4 py-md-0 cart-summary <?= empty($this->cart->contents()) ? 'd-none' : '' ?>">
                    <div class="col-12 col-md-6 text-md-end text-center">
                        <div class="section-title-container px-2">
                            <h1 class="underline-heading-1 fw-semibold">סה"כ בסל הקניות</h1>
                        </div>

                        <!-- Summary -->
                        <div class="container mt-4">
                            <div class="table-responsive summary-table">
                                <table class="table text-end align-middle">
                                    <tbody>
                                        <!-- Subtotal -->
                                        <tr>
                                            <th class="fw-semibold w-30 border-0">סכום ביניים</th>
                                            <td><?=$cur.number_format($this->cart->total(), 2)?></td>
                                        </tr>

                                        <!-- Shipping Methods -->
                                        <tr>
                                            <th class="fw-semibold d-none d-md-table-cell align-top border-0">משלוח</th>
                                            <td colspan="2" class="border-md-0 pt-4">
                                                <span class="d-block d-md-none fw-semibold mb-2">משלוח</span>
                                                <div class="bg-white small lh-lg">
                                                    <div class="form-check form-check-reverse">
                                                        <input class="form-check-input ms-2" type="radio" name="shipping" id="ship1">
                                                        <label class="form-check-label w-100" for="ship1">משלוח מהיר: ₪50.00</label>
                                                    </div>
                                                    <div class="form-check form-check-reverse">
                                                        <input class="form-check-input ms-2" type="radio" name="shipping" id="ship2">
                                                        <label class="form-check-label w-100" for="ship2">איסוף מקומי</label>
                                                    </div>
                                                    <div class="form-check form-check-reverse">
                                                        <input class="form-check-input ms-2" type="radio" name="shipping" id="ship3">
                                                        <label class="form-check-label w-100" for="ship3">אספקה דרך איש קשר (פרסים בלבד)</label>
                                                    </div>
                                                    <div class="text-muted mt-2">אפשרויות המשלוח יעודכנו במהלך התשלום בקופה.</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Total -->
                                        <tr class="fw-bold fs-5">
                                            <th class="fw-semibold">סה"כ</th>
                                            <td>₪322.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-grid mt-3">
                                <button class="btn curved-button btn-add-to-cart py-4">
                                מעבר לתשלום
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        <script>
            function decreaseQty(rowId) {
                $('#update-btn').prop('disabled', false);
                const input = document.getElementById('qtyInput' + rowId);

                const orgQty = input.getAttribute('org-qty');
                const minQty = orgQty > 5 ? 5 : orgQty;

                let val = parseInt(input.value);
                if (val > minQty) input.value = val - 1;
            }

            function increaseQty(rowId) {
                $('#update-btn').prop('disabled', false);

                const input = document.getElementById('qtyInput' + rowId);
                let val = parseInt(input.value);
                input.value = val + 1;
            }

            const updateCart = (elem) => {
                $(elem).html('טְעִינָה...').prop('disabled', true);
                
                const items = {};
                $('.qtyInput').each(function () {
                    const qty = $(this).val();
                    const proId = $(this).attr('product-id');

                    if (proId) {
                        items[proId] = qty;
                    }
                });

                $.ajax({
                    url: '<?=base_url()?>add-to-cart',
                    type: 'POST',
                    data: {items},
                    success: function(result) {
                        const resp = $.parseJSON(result);
                        if (resp.status == 'success') {
                            
                            Object.entries(resp.price_html).forEach(([rowId, htmlPrice]) => {
                                $(`#price-td${rowId}`).html(htmlPrice);
                            });

                            $(elem).html('לעדכן סל קניות').prop('disabled', true);
                            $('.cart-count').text(resp.total_item_count).removeClass('d-none');
                        }
                    },
                    error: function(result) {
                        console.log('Error', result);
                    }
                })
            }

            const removeCartItem = (rowId) => {
                $.ajax({
                    url: '<?=base_url()?>remove-cart-item',
                    type: 'POST',
                    data: {rowId},
                    success: function(result) {
                        const resp = $.parseJSON(result);
                        if (resp.status == 'success') {
                            $(`#rowId${rowId}`).remove();
                            if (resp.total_item_count == 0) {
                                $('.cart-count').addClass('d-none')
                            } else {
                                $('.cart-count').text(resp.total_item_count).removeClass('d-none');
                            }
                        }
                    },
                    error: function(result) {
                        console.log('Error', result);
                    }
                })
            }
        </script>
    </body>
</html>
