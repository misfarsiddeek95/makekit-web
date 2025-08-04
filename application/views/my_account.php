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
                        <div class="col-12 col-md-6">
                            <ul class="nav flex-column user-sidebar-menu">
                                <li class="nav-item"><a class="nav-link active" href="#">לוח בקרה</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">הזמנות</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">הורדות</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">כתובות</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">פרטי חשבון</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">התנתקות</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">שאלונים</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
        <script>
            
        </script>

    </body>
</html>
