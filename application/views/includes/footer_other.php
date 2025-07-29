<footer class="main-footer">
    <div
        class="footer_pattern"
        style="background-image: url(<?=base_url()?>assets/images/background/footer-pattern.png);"
    ></div>
    <div class="auto-container">
        <div class="inner-container">
        <!-- Widgets Section -->
        <div class="widgets-section">
            <div class="row clearfix">
            <!-- Big Column -->
            <div class="big-column col-lg-5 col-md-12 col-sm-12">
                <div class="footer-newsletter">
                <h5 class="footer-title"><?=$newsLetter->headline?></h5>
                <div class="footer-newsletter_text"><?=strip_tags($newsLetter->page_text)?></div>
                <div class="newsletter-box">
                    <form method="post" id="other_news_letter">
                    <div class="form-group">
                        <span
                        class="icon fa-regular fa-envelope fa-fw"
                        ></span>
                        <input
                            type="email"
                            name="email"
                            value=""
                            placeholder="Enter your mail"
                            required
                            autocomplete="off"
                        />
                        <input type="hidden" name="g_recaptcha_response" id="other_news_letter-g-recaptcha-response">
                        <button
                            type="submit"
                            class="template-btn btn-style-one"
                        >
                            <span class="btn-wrap">
                                <span class="text-one">Subscribe</span>
                                <span class="text-two">Subscribe</span>
                            </span>
                        </button>
                    </div>
                    </form>
                </div>
                </div>
            </div>

            <!-- Big Column -->
            <div class="big-column col-lg-7 col-md-12 col-sm-12">
                <div class="footer-lists_outer">
                    <div class="row clearfix">
                        <!-- Column -->
                        <div class="column col-lg-5 col-md-4 col-sm-6">
                            <h5 class="footer-title">Services</h5>
                            <ul class="footer-pages_list">
                                <?php foreach ($footerServices as $ser) { ?>
                                    <li><a href="<?=base_url()?>services/<?=$ser->slug?>?select=<?=$ser->service_uuid?>"><?=$ser->title?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- Column -->
                        <div class="column col-lg-3 col-md-4 col-sm-6">
                            <h5 class="footer-title">resources</h5>
                            <ul class="footer-pages_list">
                                <li><a href="javascript:void(0);">Blog</a></li>
                                <li><a href="javascript:void(0);">FAQs</a></li>
                                <li><a href="<?=base_url('contact-us')?>">Help center</a></li>
                                <li><a href="<?=base_url('services')?>">Services</a></li>
                            </ul>
                        </div>
                        <!-- Column -->
                        <div class="column col-lg-4 col-md-4 col-sm-6">
                            <h5 class="footer-title">about us</h5>
                            <ul class="footer-pages_list">
                                <li><a href="<?=base_url('about-us')?>">Our story</a></li>
                                <li><a href="<?=base_url()?>about-us#team">Team</a></li>
                                <li><a href="javascript:void(0);">Careers</a></li>
                                <li><a href="<?=base_url()?>about-us#testimonials">Testimonials</a></li>
                                <li class="d-md-none d-lg-none d-xl-none d-xxl-none d-xl-block"><a style="color:rgb(219, 185, 35); border: 1px dashed rgb(219, 185, 35);" class="p-2 rounded" href="<?=base_url()?>get-a-quote">Get a Quote</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
        <div
            class="inner-container d-flex justify-content-between align-items-center flex-wrap"
        >
            <div class="footer-logo">
            <a href="<?=base_url()?>"
                ><img src="<?=base_url()?>assets/images/as-logo.png" alt="" title=""
            /></a>
            </div>
            <div class="footer-copyright">
            &copy; 2024 <a href="<?=base_url()?>">Arbol Soft.</a> All rights
            reserved.
            </div>
            <!-- Social Box -->
            <div class="footer-social_box">
                <a href="<?=$socialMediaLinks->seo_title?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?=$socialMediaLinks->seo_description?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="<?=$socialMediaLinks->seo_url?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        </div>
    </div>
</footer>