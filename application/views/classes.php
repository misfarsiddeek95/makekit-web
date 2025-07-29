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

        <!-- Middle section -->
        <section class="class-list my-5 py-4">
            <div class="container">
                <?php 
                    foreach ($classContentList as $index => $item){
                        $imageUrl = PHOTO_DOMAIN.'pages/'.$item->photo_path.'-org.'.$item->extension;
                        if ($index % 2 == 0) {
                            $contentSection =   '<div class="d-flex flex-md-row flex-column align-items-center my-5">
                                                    <div class="col-lg-6 right-image-col mt-lg-0">
                                                        <img 
                                                            fetchpriority="high" 
                                                            decoding="async" 
                                                            class="img-fluid main-image" 
                                                            src="'.$imageUrl.'" 
                                                            alt="'.htmlspecialchars($item->photo_header).'" 
                                                            title="'.htmlspecialchars($item->photo_title).'"
                                                            width="630" 
                                                            height="630"
                                                            sizes="(max-width: 630px) 100vw, 630px"
                                                        >
                                                    </div>
                                                    <div class="col-lg-6 text-col">
                                                        <h1 class="underline-heading-1">'.htmlspecialchars($item->photo_header).'</h1>
                                                        <div class="container-underline"></div>';
                                                            $paragraphs = array_filter(array_map('trim', explode("\n", $item->pdescription)));
                                                            foreach ($paragraphs as $para) {
                                                                $contentSection .= '<p>' . nl2br($para) . '</p>';
                                                            }
                                    $contentSection.= '</div>
                                                </div>';
                        } else {
                            $contentSection = '<div class="d-flex flex-md-row flex-column-reverse align-items-center my-5">
                                                <div class="col-lg-6 text-col">
                                                    <h1 class="underline-heading-1">'.htmlspecialchars($item->photo_header).'</h1>
                                                    <div class="container-underline"></div>';
                                                        $paragraphs = array_filter(array_map('trim', explode("\n", $item->pdescription)));
                                                        foreach ($paragraphs as $para) {
                                                            $contentSection .= '<p>' . nl2br($para) . '</p>';
                                                        }
                                               $contentSection .= '</div>
                                                <div class="col-lg-6 left-image-col mt-lg-0">
                                                    <img 
                                                        fetchpriority="high" 
                                                        decoding="async" 
                                                        class="img-fluid main-image" 
                                                        src="'.$imageUrl.'" 
                                                        alt="'.htmlspecialchars($item->photo_header).'" 
                                                        title="'.htmlspecialchars($item->photo_title).'"
                                                        width="630" 
                                                        height="630"
                                                        sizes="(max-width: 630px) 100vw, 630px"
                                                    >
                                                </div>
                                            </div>';
                        }
                ?>
                    <?=$contentSection?>
                <?php } ?>
               
            </div>
        </section>
    </main>

    <?php $this->load->view('includes/footer') ?>

    <?php $this->load->view('includes/js') ?>
    
</body>
</html>
