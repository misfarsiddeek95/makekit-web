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
                            <h1><?=$selectedCate->category_second_title?></h1>
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
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"> &nbsp;/ <?=$selectedCate->category_second_title?></font>
                            </font>
                        </nav>
                    </div>
                    <hr/>
                    <div class="row flex-column justify-content-between flex-md-row-reverse my-5">
                        <div class="col-sm-12 col-md-6 text-md-start">
                            <div class="dropdown w-100 w-md-auto">
                                <button class="btn d-flex justify-content-between align-items-center border rounded px-3 py-2 w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h ms-2"></i>
                                    <span class="text-muted">Default arrangement</span>
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Default arrangement</a></li>
                                    <li><a class="dropdown-item" href="#">Sort by popularity</a></li>
                                    <li><a class="dropdown-item" href="#">Sort by most recent</a></li>
                                    <li><a class="dropdown-item" href="#">Sort from cheap to expensive</a></li>
                                    <li><a class="dropdown-item" href="#">Sort from expensive to cheap</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 "> 
                            <font style="font-size:14px;">
                                מציגים את כל ⁦7⁩ התוצאות
                            </font> 
                        </div>
                    </div>
                    <div class="row">
                        <!-- Product 1 -->
                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
