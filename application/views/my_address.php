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
                           <p>הכתובות הנ"ל תשמשו כברירת מחדל במהלך התשלום.</p>

                            <div class="row flex-row-reverse">
                                <!-- Billing Address -->
                                <div class="col-md-6">
                                    <h2>כתובת לחיוב</h2>
                                    <div class="d-flex">
                                        <a href="" class="me-auto">להוסיף כתובת לחיוב</a>
                                    </div>
                                    <address class="fst-italic">לא הגדרת כתובת זאת עדיין.</address>
                                </div>

                                <!-- Shipping Address -->
                                <div class="col-md-6">
                                    <h2>כתובת משלוח</h2>
                                    <div class="d-flex">
                                        <a href="" class="me-auto">להוסיף כתובת משלוח</a>
                                    </div>
                                    <address class="fst-italic">לא הגדרת כתובת זאת עדיין.</address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
