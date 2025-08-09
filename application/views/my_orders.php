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
                        <?php if(!$orders) { ?>
                        <div class="alert alert-primary d-flex justify-content-between flex-row-reverse" role="alert">
                            <a href="">לעיין במוצרים</a>
                            <span>אף הזמנה לא נעשתה עדיין.</span>
                        </div>
                        <?php } ?>

                        <?php if($orders) { ?>
                            <table class="table table-bordered table-responsive text-center">
                                <thead>
                                    <tr class="table-warning">
                                        <th>Order No</th>
                                        <th>Payment Status</th>
                                        <th>Payment Method</th>
                                        <th>Order Status</th>
                                        <th>Total</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $row) { ?>
                                    <tr>
                                        <td><?=$row->order_code?></td>
                                        <td><?=$row->payment_status?></td>
                                        <td><?=$row->payment_method?></td>
                                        <td><?=$row->order_status?></td>
                                        <td><?=$row->cart_total?></td>
                                        <td><?=date('d/m/Y', $row->order_date)?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
