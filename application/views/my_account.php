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
                            <p> שלום <strong><?=$this->session->userdata['user_logged_in']['name']?></strong> (לא <strong><?=$this->session->userdata['user_logged_in']['name']?></strong>? <a href="<?=base_url('logout');?>">התנתק</a>)</p>
                            <p>
	                            ב‬לוח הבקרה של החשבון ‫שלך ‬ניתן לראות את ה<a href="<?=base_url('orders/');?>">הזמנות האחרונות</a>, לנהל את <a href="<?=base_url('edit-address/');?>">כתובות המשלוח והחיוב</a>, ו<a href="<?=base_url('my-account/edit-account/');?>">לערוך את הסיסמה ופרטי החשבון</a>‫, להגיש בקשת החזרה של פריט ואפשרויות מתקדמות נוספות‬.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
