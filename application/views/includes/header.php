<!-- Main Header -->
<header class="main-header header-style-two">
    <!-- Header Top -->
    <?php if($activePage == 'HOME') { ?>
    <div class="header-top">
        <div class="text">
            <span class="icon">
                <img src="<?=base_url()?>assets/images/icons/header-top_icon.png" alt="" />
            </span>
            Unlock Seamless Conversations!
            <a href="#">
                Get Started Today <i class="fa-solid fa-angle-right fa-fw"></i>
            </a>
        </div>
        <span class="header-top_cross fa-solid fa-xmark fa-fw"></span>
    </div>
    <?php } ?>

    <!-- Header Lower -->
    <div class="header-lower">
        <div class="auto-container">
            <div class="inner-container">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="nav-outer d-flex align-items-center flex-wrap">
                        <div class="logo-box">
                            <div class="logo">
                                <a href="<?=base_url()?>">
                                    <img src="<?=base_url()?>assets/images/as-logo.png" alt="" title="" />
                                </a>
                            </div>
                        </div>
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="<?=$activePage == 'HOME' ? 'current' : '' ?>" ><a href="<?=base_url()?>">Home</a></li>
                                    <li class="<?=$activePage == 'ABOUT' ? 'current' : '' ?>" ><a href="<?=base_url()?>about-us">About</a></li>
                                    <li class="<?=$activePage == 'SERVICE' ? 'current' : '' ?>" ><a href="<?=base_url()?>services">Services</a></li>
                                    <li class="<?=$activePage == 'PRODUCT' ? 'current' : '' ?>"><a href="<?=base_url()?>products">Products</a></li>
                                    <li class="<?=$activePage == 'WORK' ? 'current' : '' ?>"><a href="<?=base_url()?>works">Works</a></li>
                                    <li class="<?=$activePage == 'CONTACT' ? 'current' : '' ?>"><a href="<?=base_url()?>contact-us">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <!-- Main Menu End-->
                    <div class="outer-box d-flex align-items-center flex-wrap">
                        <!-- Button Box -->
                        <div class="main-header_buttons">
                            <a href="<?=base_url()?>get-a-quote" class="template-btn btn-style-two">
                                <span class="btn-wrap">
                                    <span class="text-one">Get A Quote</span>
                                    <span class="text-two">Get A Quote</span>
                                </span>
                            </a>
                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class="mobile-nav-toggler">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 6l16 0" />
                                <path d="M4 12l16 0" />
                                <path d="M4 18l16 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Lower-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn">
            <span class="icon fa-solid fa-xmark fa-fw"></span>
        </div>

        <nav class="menu-box">
            <div class="nav-logo">
                <a href="<?=base_url()?>">
                    <img src="<?=base_url()?>assets/images/as-mobile-logo.png" alt="" title="" />
                </a>
            </div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>
<!-- End Main Header -->