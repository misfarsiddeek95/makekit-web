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
                            <h1>מוצרים בסיטונאות</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Wholesale item section -->
            <section class="wholesale-list my-5 p-5">
                <div class="row flex-row-reverse">
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center wholesale-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/10/wholesale-lego-s.png" class="card-img-top" alt="wholesale-item">

                            <div class="card-footer wholesale-card-footer">
                                <h3>פטריות</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center wholesale-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/10/wholesale-lego-m.png" class="card-img-top" alt="wholesale-item">

                            <div class="card-footer wholesale-card-footer">
                                <h3>לגו בינוני</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center wholesale-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/10/wholesale-lego-l.png" class="card-img-top" alt="wholesale-item">

                            <div class="card-footer wholesale-card-footer">
                                <h3>לגו גדול</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center wholesale-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/10/wholesale-mushroom.png" class="card-img-top" alt="wholesale-item">

                            <div class="card-footer wholesale-card-footer">
                                <h3>פטריות</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center wholesale-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/10/wholesale-yopi.png" class="card-img-top" alt="wholesale-item">

                            <div class="card-footer wholesale-card-footer">
                                <h3>יופי</h3>
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
