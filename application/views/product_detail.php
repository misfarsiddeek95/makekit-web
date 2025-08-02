<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <style>
            #mainImage {
                transition: opacity 0.3s ease-in-out;
            }

            img#mainImage {
                width: 100%;
                height: auto;
                max-height: none; /* or increase max-height */
                object-fit: contain; /* keep aspect ratio */
            }

            /* Remove number input spinners */
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
                appearance: textfield;
            }

            /* Remove hover effect */
            .btn-no-hover:hover {
                background-color: inherit;
                border-color: inherit;
                color: inherit;
            }

            /* Optional: ensure uniform button height and no rounding */
            .qty-btn,
            #qtyInput {
                border-radius: 0 !important;
                height: 42px;
                border: 1px solid rgba(0,0,0,.1)
            }
            .qty-btn:hover {
                border: 1px solid rgba(0,0,0,.1)
            } 
        </style>

    </head>
    <body>
        <?php $this->load->view('includes/header'); ?>
        <main>
            <!-- Slider section -->
            <section class="banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h1><?=$productDetail->name?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Product section -->
            <section class="product-detail has-cart-button py-5 px-5">
                <div class="container">
                    <hr/>
                    <div class="text-end mb-4">
                        <nav aria-label="Breadcrumb" class="breadcrumb">
                            <a href="<?=base_url()?>">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">עמוד הבית</font>
                                </font>
                            </a>
                            <a href="<?=base_url()?>product-category/<?=$productDetail->cate_url?>/">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">&nbsp;/ <?=$productDetail->cate_short_name?></font>
                                </font>
                            </a>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"> &nbsp;/ <?=$productDetail->name?></font>
                            </font>
                        </nav>
                    </div>
                    <hr/>
                    
                    <div class="d-flex flex-column flex-column-reverse flex-md-row flex-md-row-reverse justify-content-between gap-3">
                        <div class="col-12 col-md-6">
                            <p class="price">
                                <span class="amount">
                                    <bdi><span class="currency-symbol"><?=$cur?></span><?=number_format($productDetail->price,2)?></bdi>
                                </span>
                            </p>

                            <?php if ($productDetail->short_description != '') { ?>
                            <div class="short-description">
                                <p><?=$productDetail->short_description?></p>
                            </div>
                            <?php } ?>

                            <?php if ($productDetail->description != '') { ?>
                            <div class="short-description">
                                <?=$productDetail->description?>
                            </div>
                            <?php } ?>

                            <?php if ($productDetail->ingredients != '') { ?>
                            <div class="short-description">
                                <?=$productDetail->ingredients?>
                            </div>
                            <?php } ?>

                            <?php if ($productDetail->how_to_use != '') { ?>
                            <div class="short-description">
                                <?=$productDetail->how_to_use?>
                            </div>
                            <?php } ?>

                            <?php
                                if($productDetail->discountList) {
                                    $basePrice = (float) $productDetail->price;
                                    $discounts = $productDetail->discountList;

                                    // Sort discountList by min_item_count ascending
                                    usort($discounts, function($a, $b) {
                                        return $a->min_item_count - $b->min_item_count;
                                    });
                            ?>
                            <table class="table table-responsive table-bordered my-4" dir="rtl">
                                <thead>
                                    <tr>
                                        <th>כמות</th>
                                        <th>הנחה</th>
                                        <th>מחיר יחידה</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($discounts as $index => $row) {
                                        $isLast = $index === count($discounts) - 1;
                                        $nextMin = $discounts[$index + 1]->min_item_count ?? null;

                                        // Quantity range display
                                        if ($isLast) {
                                            $qtyRange = '+' . $row->min_item_count;
                                        } else {
                                            $qtyRange = $row->min_item_count . '-' . ($nextMin - 1);
                                        }

                                        // Discount calculation
                                        if ($row->discount_type == 1) {
                                            // percentage
                                            $discountLabel = rtrim(rtrim($row->discount_value, '0'), '.') . '%';
                                            $unitPrice = $basePrice - ($basePrice * ($row->discount_value / 100));
                                        } else {
                                            // flat amount
                                            $discountLabel = $cur . number_format($row->discount_value, 2);
                                            $unitPrice = $basePrice - $row->discount_value;
                                        }
                                    ?>
                                        <tr class="discount-tr" min-count="<?=$row->min_item_count?>" next-min="<?=$nextMin?>">
                                            <td><?= $qtyRange ?></td>
                                            <td><?= $discountLabel ?></td>
                                            <td><?=$cur?><?= number_format($unitPrice, 2) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php } ?>

                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <!-- Quantity Input with +/- -->
                                <div class="input-group" style="width: 130px;">
                                    <button class="btn btn-outline-secondary btn-no-hover qty-btn" type="button" onclick="decreaseQty()">−</button>
                                    <input type="number" id="qtyInput" class="form-control text-center" value="<?=$productDetail->qty > 5 ? 5 : $productDetail->qty ?>" min="1" max="99">
                                    <button class="btn btn-outline-secondary btn-no-hover qty-btn" type="button" onclick="increaseQty()">+</button>
                                </div>

                                <!-- Add to Cart Button -->
                                <button class="btn d-block curved-button btn-add-to-cart" onclick="addToCart()">הוספה לסל</button>
                            </div>

                            <hr/>
                            
                            <div class="my-3 category-preview">
                                <p>קטגוריה: <a href="<?=base_url()?>product-category/<?=$productDetail->cate_url?>/"><?=$productDetail->cate_short_name?></a></p>
                            </div>
                        </div>
                        <?php if($productDetail->images) { ?>
                        <div class="col-12 col-md-6 d-flex justify-content-md-start">
                            <div class="product-image-wrapper text-center">

                                <!-- Main Image with Zoom Icon -->
                                <div class="position-relative d-inline-block">
                                    <img id="mainImage" src="<?=PHOTO_DOMAIN.'products/'.$productDetail->images[0]->photo_path.'-org.'.$productDetail->images[0]->extension ?>" class="img-fluid border rounded" alt="Product" />
                                
                                    <button class="btn btn-light rounded-pill position-absolute top-0 start-0 m-2 bg-white" style="transform: scaleX(-1);" data-bs-toggle="modal" data-bs-target="#zoomModal" title="Zoom">
                                    🔍
                                    </button>
                                </div>

                                <!-- Thumbnails -->
                                <div class="mt-3 d-flex flex-wrap justify-content-start gap-2">
                                    <?php foreach ($productDetail->images as $key => $img) { ?>
                                    <img src="<?=PHOTO_DOMAIN.'products/'.$img->photo_path.'-org.'.$img->extension ?>" class="thumb-img img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;" onclick="setMainImage(this, <?=$key?>)">
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-fullscreen modal-lg">
                                    <div class="modal-content bg-dark border-0">
                                        <div class="modal-header justify-content-end">
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div id="carouselZoom" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php 
                                                        foreach ($productDetail->images as $key => $img) {
                                                            $act = $key == 0 ? 'active' : '';
                                                    ?>
                                                    <div class="carousel-item <?=$act?>">
                                                        <img src="<?=PHOTO_DOMAIN.'products/'.$img->photo_path.'-org.'.$img->extension ?>" class="d-block w-100 img-fluid" style="max-height: 90vh; object-fit: contain;" alt="Zoom Image <?=$key + 1?>">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselZoom" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselZoom" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <?php if ($relatedProducts) { ?>
            <section class="related-product-section py-5 px-5">
                <div class="container px-0">
                    <div class="text-end mb-4">
                        <div class="section-title-container">
                            <h1 class="underline-heading-1">מוצרים קשורים</h1>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Product 1 -->
                        <?php foreach ($relatedProducts as $p) { ?>
                            <div class="col-6 col-lg-3 mb-4 text-center products <?= $p->qty < 1 ? 'disabled' : '' ?>">
                                <a href="<?=base_url()?>product/<?=$p->product_url?>/">
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
                                    <span class="price">החל מ: <?=$cur?><?= number_format($p->price, 2) ?></span>
                                </a>
                                <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <?php } ?>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        <script>
            function setMainImage(el, index) {
                const mainImage = document.getElementById('mainImage');

                // Fade out
                mainImage.style.opacity = 0;

                setTimeout(() => {
                mainImage.src = el.src; // change the image
                mainImage.style.opacity = 1; // fade in
                }, 150);
            }

            const imgContainer = document.querySelector('.product-detail .position-relative');
            const mImage = imgContainer.querySelector('img');

            imgContainer.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left; // x position within the container
                const y = e.clientY - rect.top;  // y position within the container
                
                const xPercent = (x / rect.width) * 100;
                const yPercent = (y / rect.height) * 100;
                
                mImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
                mImage.style.transform = 'scale(2)';  // zoom scale
            });

            imgContainer.addEventListener('mouseleave', function() {
                mImage.style.transformOrigin = 'center center';
                mImage.style.transform = 'scale(1)';
            });

            function decreaseQty() {
                const input = document.getElementById('qtyInput');
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                    
                    // Manually trigger change
                    $(input).trigger('change');
                }

            }

            function increaseQty() {
                const input = document.getElementById('qtyInput');
                let value = parseInt(input.value);
                input.value = value + 1;

                // Manually trigger change
                $(input).trigger('change');
            }

            function addToCart() {
                const quantity = document.getElementById('qtyInput').value;
                // You can perform your AJAX or form submission here
                alert('Added ' + quantity + ' item(s) to the cart!');
            }

            $(document).on('change input', '#qtyInput', function() {
                const qtyVal = this.value;
                tableActivate(qtyVal);
            });

            const tableActivate = (qtyVal) => {
                $('.discount-tr').each(function() {
                    const min = parseInt($(this).attr('min-count'));
                    const nextMin = $(this).attr('next-min');
                    const next = nextMin !== '' ? parseInt(nextMin) : null;

                    // Remove previously active class
                    $(this).removeClass('active');

                    // Check if qtyVal is in this range
                    if (next === null) {
                        if (qtyVal >= min) {
                            $(this).addClass('active');
                        }
                    } else if (qtyVal >= min && qtyVal < next) {
                        $(this).addClass('active');
                    }
                });
            }

        </script>

    </body>
</html>
