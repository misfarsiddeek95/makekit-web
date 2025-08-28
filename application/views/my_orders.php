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
                                        <th>מספר הזמנה</th>
                                        <th>מצב תשלום</th>
                                        <th>שיטת תשלום</th>
                                        <th>סטטוס הזמנה</th>
                                        <th>סַך הַכֹּל</th>
                                        <th>תאריך הזמנה</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($orders as $row) {
                                            $payMethod = $row->payment_method == 1 ? 'סך התשלום' : 'מזומן במשלוח';

                                            switch ($row->payment_status) {
                                                case 2:
                                                    $payStatus = 'הַצלָחָה';
                                                    break;
                                                case 0:
                                                    $payStatus = 'תָלוּי וְעוֹמֵד';
                                                    break;
                                                case -1:
                                                    $payStatus = 'בּוּטלָה';
                                                    break;
                                                case -2:
                                                    $payStatus = 'נִכשָׁל';
                                                    break;
                                                case -3:
                                                    $payStatus = 'נטען בחזרה';
                                                    break;
                                                default:
                                                    $payStatus = 'תָלוּי וְעוֹמֵד';
                                                    break;
                                            }
                                    ?>
                                    <tr>
                                        <td><?=$row->order_code?></td>
                                        <td><?=$payStatus?></td>
                                        <td><?=$payMethod?></td>
                                        <td><?=$row->order_status?></td>
                                        <td><?=$row->cart_total?></td>
                                        <td><?=date('d/m/Y', strtotime($row->order_date))?></td>
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
