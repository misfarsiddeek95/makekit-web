<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <style>
            /* Optional: ensure uniform button height and no rounding */
            .qty-btn,
            #qtyInput {
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
            <section class="my-5 p-5 cart">
                <div class="table-responsive">
                    <table class="table cart-table text-center align-middle" dir="rtl">
                        <thead class="table-light">
                            <tr>
                                <th></th> <!-- For delete -->
                                <th></th> <!-- For image -->
                                <th>מוצר</th>
                                <th>מחיר</th>
                                <th>כמות</th>
                                <th>סכום ביניים</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="d-table-row d-md-table-row d-block d-md-table-row">
                                <!-- Remove -->
                                <td class="d-block d-md-table-cell text-end text-md-center">
                                    <button class="btn btn-outline-dark rounded-circle p-0" style="width: 24px; height: 24px;">
                                        ×
                                    </button>
                                </td>
                                <!-- Product Image -->
                                <td class="d-block d-md-table-cell text-end text-md-center">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product" width="40">
                                </td>
                                <!-- Product Name -->
                                <td data-label="מוצר" class="d-block d-md-table-cell text-md-start">
                                    <a href="#" class="text-decoration-none">!Scottie Go</a>
                                </td>
                                <!-- Price -->
                                <td data-label="מחיר" class="d-block d-md-table-cell text-md-center">₪54.40</td>
                                <!-- Quantity -->
                                <td data-label="כמות" align="center" class="d-block d-md-table-cell text-md-center">
                                    <div class="input-group justify-content-center" style="width: 110px;">
                                        <button class="btn btn-outline-secondary px-2 qty-btn" type="button" onclick="decreaseQty()">-</button>
                                        <input type="text" id="qtyInput" class="form-control text-center border-start-0 border-end-0" value="5" readonly>
                                        <button class="btn btn-outline-secondary px-2 qty-btn" type="button" onclick="increaseQty()">+</button>
                                    </div>
                                </td>
                                <!-- Subtotal -->
                                <td data-label="סכום ביניים" class="d-block d-md-table-cell text-md-center">₪272.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        <script>
            function decreaseQty() {
                const input = document.getElementById('qtyInput');
                let val = parseInt(input.value);
                if (val > 1) input.value = val - 1;
            }

            function increaseQty() {
                const input = document.getElementById('qtyInput');
                let val = parseInt(input.value);
                input.value = val + 1;
            }
        </script>
    </body>
</html>
