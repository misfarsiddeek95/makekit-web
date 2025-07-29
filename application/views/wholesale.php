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
            <section class="wholesale-list my-5 p-5">
                <div class="row flex-row-reverse">
                    <?php foreach ($wholesaleContentList as $row) { ?>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center wholesale-item-card shadow">
                            <img src="<?=PHOTO_DOMAIN.'pages/'.$row->photo_path.'-org.'.$row->extension?>" class="card-img-top" alt="<?=$row->photo_header?>">

                            <div class="card-footer wholesale-card-footer">
                                <h3><?=$row->photo_header?></h3>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
