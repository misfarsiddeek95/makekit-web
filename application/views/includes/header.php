<header class="site-header">
    <!-- ============================================= -->
    <!-- ============== DESKTOP HEADER =============== -->
    <!-- ============================================= -->
    <div class="desktop-header d-none d-lg-block">
        <!-- Top White Nav -->
        <div class="desktop-top-nav">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Left Side: Logo -->
                    <div>
                        <a class="navbar-brand" href="<?=base_url()?>">
                            <img src="https://makesmart.co.il/wp-content/uploads/2023/08/logo.png" alt="MakeKit Logo" class="desktop-logo">
                        </a>
                    </div>
                    
                    <!-- Right Side: Icons and Menu -->
                    <div class="d-flex align-items-center">
                        <ul class="desktop-main-menu flex-row-reverse">
                            <li><a class="nav-link <?= $activePage == 'CONTACT' ? 'active' : '' ?>" href="<?=base_url()?>contact-us/">צור קשר</a></li>
                            <li><a class="nav-link <?= $activePage == 'DRAWINGS' ? 'active' : '' ?>" href="<?=base_url()?>drawings/">ציודים להדפסה</a></li>
                            <li><a class="nav-link <?= $activePage == 'WHOLESALE' ? 'active' : '' ?>" href="<?=base_url()?>wholesale/">מוצרים בסיטונאות</a></li>
                            <li><a class="nav-link <?= $activePage == 'CLASS' ? 'active' : '' ?>" href="<?=base_url()?>classes/">תכניות חוגים</a></li>
                            <li><a class="nav-link <?= $activePage == 'HOME' ? 'active' : '' ?>" href="<?=base_url()?>">ראשי</a></li>
                        </ul>

                        <div class="desktop-header-icons">
                            <a href="#" class="icon"><i class="fa-regular fa-user"></i></a>
                            <a href="#" class="icon"><i class="fa-solid fa-shopping-basket"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Red Nav -->
        <div class="desktop-bottom-nav">
            <div class="container-fluid">
                <ul class="desktop-bottom-menu flex-row-reverse bottom-nav">
                    <?php foreach ($categoryList as $navCate) { ?>
                        <li><a class="nav-link <?=$navCate->seo_url == $this->uri->segment(2) ? 'active' : '' ?>" href="<?=base_url()?>product-category/<?=$navCate->seo_url?>/"><?=$navCate->category?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- ============================================= -->
    <!-- =============== MOBILE HEADER =============== -->
    <!-- ============================================= -->
    <div class="d-lg-none">
        <!-- Mobile Main Header (Logo and top icons) -->
        <div class="mobile-header-top">
            <a class="navbar-brand mobile-logo-link" href="<?=base_url()?>">
                    <img src="https://makesmart.co.il/wp-content/uploads/2023/08/logo.png" alt="MakeKit Logo" class="mobile-logo">
            </a>
            <div class="mobile-icons-top">
                <!-- Non-scrolled order (Toggler on right in RTL) -->
                <button class="navbar-toggler mobile-main-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenuMobile" aria-controls="mainMenuMobile" aria-expanded="false" aria-label="Toggle main navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="#" class="mobile-icon icon-user"><i class="fa-regular fa-user"></i></a>
                <a href="#" class="mobile-icon icon-basket"><i class="fa-solid fa-shopping-basket"></i></a>
            </div>
        </div>
        <!-- MENU 1: Fullscreen Overlay -->
        <div class="collapse" id="mainMenuMobile">
                <button class="main-menu-close-btn" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenuMobile" aria-controls="mainMenuMobile" aria-expanded="true" aria-label="Close main navigation">
                <i class="fa-solid fa-times"></i>
                </button>
                <ul class="main-menu-mobile-content">
                <li><a class="nav-link <?= $activePage == 'HOME' ? 'active' : '' ?>" href="<?=base_url()?>">ראשי</a></li>
                <li><a class="nav-link <?= $activePage == 'CLASS' ? 'active' : '' ?>" href="<?=base_url()?>classes/">תכניות חוגים</a></li>
                <li><a class="nav-link <?= $activePage == 'WHOLESALE' ? 'active' : '' ?>" href="<?=base_url()?>wholesale/">מוצרים בסיטונאות</a></li>
                <li><a class="nav-link <?= $activePage == 'DRAWINGS' ? 'active' : '' ?>" href="<?=base_url()?>drawings/">ציודים להדפסה</a></li>
                <li><a class="nav-link <?= $activePage == 'CONTACT' ? 'active' : '' ?>" href="<?=base_url()?>contact-us/">צור קשר</a></li>
                </ul>
        </div>

        <!-- Mobile Bottom Nav -->
        <div class="mobile-bottom-nav">
                <!-- TOGGLER 2 -->
            <a class="mobile-store-toggler collapsed" data-bs-toggle="collapse" href="#storeMenuMobile" role="button" aria-expanded="false" aria-controls="storeMenuMobile">
                <span>חנויות</span>
                <span>
                    <i class="fa-solid fa-bars"></i>
                    <i class="fa-solid fa-times"></i>
                </span>
            </a>
        </div>
            <!-- MENU 2: Dropdown -->
        <div class="collapse store-menu-collapse bottom-nav" id="storeMenuMobile">
            <ul>
                <?php foreach (array_reverse($categoryList) as $navCate) { ?>
                <li><a class="nav-link <?=$navCate->seo_url == $this->uri->segment(2) ? 'active' : '' ?>" href="<?=base_url()?>product-category/<?=$navCate->seo_url?>/"><?=$navCate->category?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>