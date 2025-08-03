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
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 hero-carousel-col">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-touch="true">
                            <div class="carousel-inner">
                                <?php foreach ($pageSliderImages as $key => $row) { ?>
                                <div class="carousel-item <?=$key == 0 ? 'active' : ''?>" data-bs-interval="4000">
                                    <img src="<?=PHOTO_DOMAIN.'pages/'.$row->photo_path.'-org.'.$row->extension?>" class="d-block w-100" alt="<?=$row->photo_header?>">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 hero-text-col">
                        <h2><?=$pageSlider->headline?></h2>
                        <h2><?=$pageSlider->second_title?></h2>
                        <a href="<?=base_url()?>classes/" class="btn btn-hero curved-button">לתכנית חוגים</a>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
            // Map SEO URLs to icon SVGs, color, and RTL label
            $categoryIcons = [
                'harkava' => [
                    'color' => 'var(--dingy-dungeon)',
                    'label' => 'הרכבה',
                    'icon' => '<svg viewBox="0 0 16 16" class="bi bi-screwdriver" fill="currentColor" height="50" width="50" xmlns="http://www.w3.org/2000/svg"><path d="M0 .995.995 0l3.064 2.19a.995.995 0 0 1 .417.809v.07c0 .264.105.517.291.704l5.677 5.676.909-.303a.995.995 0 0 1 1.018.24l3.338 3.339a.995.995 0 0 1 0 1.406L14.13 15.71a.995.995 0 0 1-1.406 0l-3.337-3.34a.995.995 0 0 1-.24-1.018l.302-.909-5.676-5.677a.995.995 0 0 0-.704-.291H3a.995.995 0 0 1-.81-.417L0 .995Zm11.293 9.595a.497.497 0 1 0-.703.703l2.984 2.984a.497.497 0 0 0 .703-.703l-2.984-2.984Z"></path></svg>',
                ],
                'robotronic' => [
                    'color' => 'var(--royal-orange)',
                    'label' => 'רובוטרוניק',
                    'icon' => '<svg viewBox="0 0 16 16" class="bi bi-cpu" fill="currentColor" height="50" width="50" xmlns="http://www.w3.org/2000/svg"><path d="M5 0a.5.5 0 0 1 .5.5V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2A2.5 2.5 0 0 1 14 4.5h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14a2.5 2.5 0 0 1-2.5 2.5v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14A2.5 2.5 0 0 1 2 11.5H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2A2.5 2.5 0 0 1 4.5 2V.5A.5.5 0 0 1 5 0zm-.5 3A1.5 1.5 0 0 0 3 4.5v7A1.5 1.5 0 0 0 4.5 13h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 11.5 3h-7zM5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3zM6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"></path></svg>',
                ],
                'games' => [
                    'color' => 'var(--crayolas-maize)',
                    'label' => 'משחקים',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-emoji-wink" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path><path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm1.757-.437a.5.5 0 0 1 .68.194.934.934 0 0 0 .813.493c.339 0 .645-.19.813-.493a.5.5 0 1 1 .874.486A1.934 1.934 0 0 1 10.25 7.75c-.73 0-1.356-.412-1.687-1.007a.5.5 0 0 1 .194-.68z"></path></svg>',
                ],
                'science' => [
                    'color' => 'var(--light-sea-green)',
                    'label' => 'מדעים',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg>',
                ],
            ];
        ?>
        <section class="icon-section py-5">
            <div class="container">
                <!-- flex-column for mobile (default), flex-md-row for medium screens and up -->
                <div class="d-flex flex-column flex-md-row flex-md-row-reverse justify-content-evenly text-center">
                    <!-- CHANGED: HTML order is reversed to achieve correct visual order in RTL -->
                    <?php foreach ($categoryList as $category) {
                        $seo = $category->seo_url;
                        if (!isset($categoryIcons[$seo])) continue; // skip if not mapped
                        $iconData = $categoryIcons[$seo];
                    ?>
                        <a href="<?=base_url()?>product-category/<?=$seo?>/">
                            <div class="feature-icon mb-4 mb-md-0">
                                <div class="icon-circle" style="--icon-bg-color: <?= $iconData['color']; ?>;">
                                    <?= $iconData['icon']; ?>
                                </div>
                                <h4 style="--icon-text-color: <?= $iconData['color']; ?>;">
                                    <?= $category->category_second_title; ?>
                                </h4>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- Middle section -->
        <section class="middle-banner-section py-5 px-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 right-image-col mt-4 mt-lg-0">
                        <img 
                            decoding="async" 
                            class="img-fluid main-image" 
                            src="<?=PHOTO_DOMAIN.'pages/'.$pageWantToGuide->photo_path.'-org.'.$pageWantToGuide->extension?>" 
                            alt="Instructor" 
                            srcset="<?=PHOTO_DOMAIN.'pages/'.$pageWantToGuide->photo_path.'-org.'.$pageWantToGuide->extension?> 630w, <?=PHOTO_DOMAIN.'pages/'.$pageWantToGuide->photo_path.'-sma.'.$pageWantToGuide->extension?> 284w, <?=PHOTO_DOMAIN.'pages/'.$pageWantToGuide->photo_path.'-std.'.$pageWantToGuide->extension?> 600w" 
                            sizes="(max-width: 630px) 100vw, 630px"
                        >
                    </div>
                    <div class="col-lg-6 text-col">
                        <h1 class="underline-heading-1"><?=$pageWantToGuide->headline?></h1>
                        <div class="container-underline"></div>
                        <?=$pageWantToGuide->page_text?>
                        <a href="#" class="btn btn-middle curved-button">למידע נוסף</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product section -->
        <section class="product-section py-5 px-5">
            <div class="container">
                <div class="text-end mb-4">
                    <div class="section-title-container">
                        <h1 class="underline-heading-1"><?=$pageNewOnTheSite->headline?></h1>
                        <div class="container-underline"></div>
                    </div>
                    <p class="section-subtitle mb-1"><?=$pageNewOnTheSite->second_title?></p>
                </div>
                <div class="row">
                    <!-- Product 1 -->
                    <?php 
                        foreach ($latestProducts as $p) {
                            $cartQty = $p->qty > 5 ? 5 : $p->qty;
                    ?>
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
                            <button class="btn d-block curved-button btn-add-to-cart" onclick="addToCart(this,<?=$p->id?>,<?=$cartQty?>);">הוספה לסל</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>

    <?php $this->load->view('includes/footer') ?>

    <?php $this->load->view('includes/js') ?>

    <script>
        
        const addToCart = (elem, proId, qty) => {
            $(elem).html('טְעִינָה...').prop('disabled', true);
            $.ajax({
                url: '<?=base_url()?>add-to-cart',
                type: 'POST',
                data: {product_id: proId, qty},
                success: function(result) {
                    const resp = $.parseJSON(result);
                    if (resp.status == 'success') {
                        $(elem).html('הוספה לסל').prop('disabled', false);
                        $('.cart-count').text(resp.total_item_count).removeClass('d-none');
                    }
                },
                error: function(result) {
                    console.log('Error', result);
                }
            })
        }

    </script>
    
</body>
</html>
