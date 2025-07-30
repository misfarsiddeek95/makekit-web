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
                            <h1>Azaqod</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Product section -->
            <section class="product-section py-5 px-5">
                <div class="container">
                    <hr/>
                    <div class="text-end mb-4">
                        <nav aria-label="Breadcrumb" class="breadcrumb">
                            <a href="<?=base_url()?>">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">עמוד הבית</font>
                                </font>
                            </a>
                            <a href="<?=base_url()?>">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">&nbsp;/ עמוד הבית</font>
                                </font>
                            </a>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"> &nbsp;/ Azakod</font>
                            </font>
                        </nav>
                    </div>
                    <hr/>
                    
                  
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
