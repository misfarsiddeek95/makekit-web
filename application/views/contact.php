<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <style>
            .cursor {
                cursor: pointer;
            }
        </style>
    </head>
    <body>

        <?php $this->load->view('includes/header'); ?>

        <main>
            <!-- Banner -->
            <section class="banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h1><?=$pageMain->headline?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Icons -->
            <section class="icon-section py-5">
                <div class="container">
                    <!-- flex-column for mobile (default), flex-md-row for medium screens and up -->
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-4 text-center">
                        <!-- CHANGED: HTML order is reversed to achieve correct visual order in RTL -->
                        <div class="feature-icon mb-4 mb-md-0 w-15">
                            <div class="icon-circle" style="--icon-bg-color: var(--dingy-dungeon);">
                                <svg viewBox="0 0 16 16" class="bi bi-geo-fill" fill="currentColor" height="50" width="50" xmlns="http://www.w3.org/2000/svg">   <path d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z" fill-rule="evenodd"></path> </svg>
                            </div>
                            <h4 style="--icon-text-color: var(--dingy-dungeon);"><?=$pageAddress->headline?></h4>
                            <p><?=$pageAddress->second_title?>/p>
                        </div>
                        <div class="feature-icon mb-4 mb-md-0 w-15 cursor" onclick="location.href='tel:<?=$pagePhone->seo_url?>'">
                            <div class="icon-circle" style="--icon-bg-color: var(--royal-orange);">
                                <svg viewBox="0 0 16 16" class="bi bi-phone" fill="currentColor" height="50" width="50" xmlns="http://www.w3.org/2000/svg">   <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"></path>   <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path> </svg>
                            </div>
                            <h4 style="--icon-text-color: var(--royal-orange);"><?=$pagePhone->headline?></h4>
                            <p><?=$pagePhone->second_title?></p>
                        </div>
                        <div class="feature-icon mb-4 mb-md-0 w-15 cursor" onclick="window.open('<?=$pageWhatsApp->seo_url?>', '_blank')">
                            <div class="icon-circle" style="--icon-bg-color: var(--crayolas-maize);">
                            <svg viewBox="0 0 16 16" class="bi bi-whatsapp" fill="currentColor" height="50" width="50" xmlns="http://www.w3.org/2000/svg">   <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path> </svg>
                            </div>
                            <h4 style="--icon-text-color: var(--crayolas-maize);"><?=$pageWhatsApp->headline?></h4>
                            <p><?=$pageWhatsApp->second_title?></p>
                        </div>
                        <a href="mailto:<?=$pageEmail->second_title?>">
                            <div class="feature-icon mb-4 mb-md-0">
                                <div class="icon-circle" style="--icon-bg-color: var(--light-sea-green);">
                                <svg viewBox="0 0 16 16" class="bi bi-envelope-open-heart" fill="currentColor" height="50" width="50" xmlns="http://www.w3.org/2000/svg">   <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l3.235 1.94a2.76 2.76 0 0 0-.233 1.027L1 7.384v5.733l3.479-2.087c.15.275.335.553.558.83l-4.002 2.402A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738l-4.002-2.401c.223-.278.408-.556.558-.831L15 13.117V7.383l-3.002 1.801a2.76 2.76 0 0 0-.233-1.026L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM7.06.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" fill-rule="evenodd"></path> </svg>
                                </div>
                                <h4 style="--icon-text-color: var(--light-sea-green);"><?=$pageEmail->headline?></h4>
                                <p><?=$pageEmail->second_title?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

          
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
