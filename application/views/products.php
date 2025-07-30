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
                            <?php
                                $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
                                $selectedLabel = 'Default arrangement';
                                switch ($orderby) {
                                    case 'popularity':
                                        $selectedLabel = 'Sort by popularity';
                                        break;
                                    case 'date':
                                        $selectedLabel = 'Sort by most recent';
                                        break;
                                    case 'price':
                                        $selectedLabel = 'Sort from cheap to expensive';
                                        break;
                                    case 'price-desc':
                                        $selectedLabel = 'Sort from expensive to cheap';
                                        break;
                                }
                            ?>
                            <div class="dropdown w-100 w-md-auto">
                                <button class="btn d-flex justify-content-between align-items-center border rounded px-3 py-2 w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h ms-2"></i>
                                    <span class="text-muted"><?= $selectedLabel ?></span>
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-value="menu_order">Default arrangement</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="popularity">Sort by popularity</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="date">Sort by most recent</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="price">Sort from cheap to expensive</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="price-desc">Sort from expensive to cheap</a></li>
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
                        <?php foreach ($products as $p) { ?>
                            <div class="col-6 col-lg-3 mb-4 text-center products">
                                <a href="#">
                                    <div class="card product-card">
                                        <?php 
                                            if (count($p->images) == 1) {
                                                $img = $p->images[0];
                                                $imgSrc = PHOTO_DOMAIN.'products/'.$img->photo_path.'-std.'.$img->extension;
                                        ?>
                                            <img src="<?= $imgSrc ?>" alt="<?= $p->name ?>" class="product-img img-main">
                                            <img src="<?= $imgSrc ?>" alt="<?= $p->name ?>" class="product-img img-hover">
                                        <?php 
                                            } else {
                                                foreach ($p->images as $key => $img) {
                                                    $hovCls = ($key % 2 == 0) ? 'img-main' : 'img-hover';
                                                    $imgSrc = PHOTO_DOMAIN.'products/'.$img->photo_path.'-std.'.$img->extension;
                                        ?>
                                            <img src="<?= $imgSrc ?>" alt="<?= $p->name ?>" class="product-img <?= $hovCls ?>">
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </div>
                                    <h2><?= $p->name ?></h2>
                                    <span class="price">החל מ: ₪<?= number_format($p->price, 2) ?></span>
                                </a>
                                <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mt-4">
                        <?= $pagination ?>
                    </div>

                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
        <script>
            $('.dropdown-item').on('click', function (e) {
                e.preventDefault();
                const selected = $(this).data('value');

                // Clean current URL
                const url = new URL(window.location.href);

                // Remove all existing orderby (even if duplicated)
                url.search = url.search.replace(/([&?])orderby=[^&]+/g, '');

                // Remove pagination from path like /page/2
                const pathname = url.pathname.replace(/\/page\/\d+/, '');
                url.pathname = pathname;

                if (selected) {
                    url.searchParams.set('orderby', selected);
                }

                // Redirect to clean URL
                window.location.href = url.toString();
            });


        </script>

    </body>
</html>
