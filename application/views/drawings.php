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
                            <h1>ציורים להדפסה</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Wholesale item section -->
            <section class="drawings-list my-5 p-5">
                <p>הציורים צוירו ע"י צייר הבית, לביא כהן. ניתן להזמין ציורים מותאמים אישית.</p>
                <div class="row flex-row-reverse">
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center drawings-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/11/drawing-shield-600x849.jpg" class="card-img-top" alt="wholesale-item">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center drawings-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/11/drawing-spinner.jpg" class="card-img-top" alt="wholesale-item">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center drawings-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/11/drawing-unicorn.jpg" class="card-img-top" alt="wholesale-item">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 my-4">
                        <div class="card text-center drawings-item-card shadow">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/11/drawing-lion.jpg" class="card-img-top" alt="wholesale-item">
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
