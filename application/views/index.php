<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?=$pageMain->seo_title?></title>
    <meta name="description" content="<?=$pageMain->seo_description?>">
    <meta name="keywords" content="<?=$pageMain->seo_keywords?>">
    <!-- Stylesheets -->
    <?php $this->load->view('includes/head'); ?>
  </head>

  <body>
    <div class="page-wrapper">
      <!-- Preloader -->
      <?php $this->load->view('includes/cursor_preloader'); ?>
      <!-- Preloader End -->

      <!-- Main Header -->
      <?php $this->load->view('includes/header'); ?>
      <!-- End Main Header -->

      <!-- Banner One -->
      <section class="banner-one">
        <div
          class="banner-one_shadow"
          style="background-image: url(<?=base_url()?>assets/images/main-slider/banner-bg.png)"
        ></div>
        <div class="auto-container">
          <!-- Content Column -->
          <div class="banner-one_content">
            <div class="banner-one_content-inner">
              <div class="banner-one_title">
                <i><img src="<?=base_url()?>assets/images/main-slider/hand.png" alt="" /></i>
                Effortless communication
              </div>
              <h1 class="banner-one_heading">
                <?=$pageBanner->seo_description?> <span><?=$pageBanner->headline?></span> <?=$pageBanner->second_title?>
              </h1>
              <div class="banner-one_text"><?=strip_tags($pageBanner->page_text)?></div>
              <div class="banner-one_newsletter">
                <div class="newsletter-box">
                  <form method="post" id="banner_news_letter">
                    <div class="form-group">
                      <span class="icon fa-regular fa-envelope fa-fw"></span>
                      <input
                        type="email"
                        name="email"
                        value=""
                        placeholder="Enter business email"
                        required
                        autocomplete="off"
                      />
                      <input type="hidden" name="g_recaptcha_response" id="banner_news_letter-g-recaptcha-response">
                      <button type="submit" class="template-btn btn-style-one">
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
          </div>
          <div
            class="banner-one_icon"
            style="background-image: url(<?=base_url()?>assets/images/main-slider/banner-icon.png);"
          ></div>
          <div class="banner-one_image">
            <?php $bannerImage = $pageBanner->photo_path ? PHOTO_DOMAIN.'pages/'.$pageBanner->photo_path.'-org.'.$pageBanner->extension : base_url().'assets/images/main-slider/banner.png'; ?>
            <img src="<?=$bannerImage?>" alt="" />
          </div>
        </div>
      </section>
      <!-- End Main Banner One -->

      <!-- Services -->
      <section class="assistance-one">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-two centered">
            <div class="sec-title_title"><?=$pageServices->seo_title?></div>
            <h2 class="sec-title_heading">
            <?=$pageServices->headline?> <br />
              <span><?=$pageServices->second_title?></span>
            </h2>
          </div>
          <div class="three-item_carousel swiper-container">
            <div class="swiper-wrapper">
              <!-- Slide -->
              <?php 
                foreach ($services as $key => $row) { 
                  $text = strip_tags($row->service_text);
              ?>
              <div class="swiper-slide">
                <!-- Service Block Three -->
                <div class="service-block_three">
                  <div
                    class="service-block_three-inner wow fadeInLeft"
                    data-wow-delay="0ms"
                    data-wow-duration="1500ms"
                  >
                    <div
                      class="service-block_three-dots"
                      style="background-image: url(<?=base_url()?>assets/images/icons/icon-2.png);"
                    ></div>
                    <div
                      class="service-block_three-circles"
                      style="background-image: url(<?=base_url()?>assets/images/icons/service-three_circle.png);"
                    ></div>
                    <div class="color-layer"></div>
                    <div class="service-block_three-icon">
                      <i class="<?=$row->class_name?>"></i>
                    </div>
                    <h5 class="service-block_three-heading">
                      <a href="<?=base_url()?>services/<?=$row->slug?>?select=<?=$row->service_uuid?>"><?=$row->title?></a>
                    </h5>
                    <div class="service-block_three-text"><?=(strlen($text) > 97) ? substr($text, 0, 97) . '...' : $text?></div>
                    <a
                      class="service-block_three-more"
                      href="<?=base_url()?>services/<?=$row->slug?>?select=<?=$row->service_uuid?>"
                      >View more <i class="fa-solid fa-arrow-right fa-fw"></i
                    ></a>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <!-- If we need pagination -->
            <div class="three-item_carousel-pagination"></div>
          </div>
        </div>
      </section>
      <!-- End Services -->

      <!-- About -->
      <section class="livechat">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Image Column -->
            <div class="livechat_image-column col-lg-6 col-md-12 col-sm-12">
              <div class="livechat_image-outer">
                <div class="livechat-agent">
                  <i
                    ><img src="<?=base_url()?>assets/images/icons/livechat-stars.png" alt=""
                  /></i>
                </div>
                <div
                  class="livechat-layer"
                  style="background-image: url(<?=base_url()?>assets/images/background/service-three_bg.png);"
                ></div>
                <div
                  class="livechat-icon"
                  style="background-image: url(<?=base_url()?>assets/images/icons/livechat-icon.png);"
                ></div>
                <div class="color-layer"></div>
                <?php $aboutImage = $pageAbout->photo_path ? PHOTO_DOMAIN.'pages/'.$pageAbout->photo_path.'-org.'.$pageAbout->extension : base_url().'assets/images/resource/livechat.png'; ?>
                <img src="<?=$aboutImage?>" alt="" />
              </div>
            </div>

            <!-- Content Column -->
            <div class="livechat_content-column col-lg-6 col-md-12 col-sm-12">
              <div class="livechat_content-outer">
                <!-- Sec Title -->
                <div class="sec-title style-two title-anim">
                  <div class="sec-title_title"><?=$pageAbout->seo_title?></div>
                  <h2 class="sec-title_heading">
                    <?=$pageAbout->seo_description?> <span><?=$pageAbout->headline?></span> <?=$pageAbout->second_title?>.
                  </h2>
                  <div class="sec-title_text"><?=strip_tags($pageAbout->page_text)?></div>
                </div>
                <div
                  class="livechat-options d-flex align-items-center flex-wrap"
                >
                  <div class="livechat_button">
                    <a href="<?=base_url('about-us')?>" class="template-btn btn-style-one">
                      <span class="btn-wrap">
                        <span class="text-one">Learn more</span>
                        <span class="text-two">Learn more</span>
                      </span>
                    </a>
                  </div>
                  <a class="livechat-now" href="<?=base_url('contact-us')?>"
                    ><i><img src="<?=base_url()?>assets/images/icons/chat.png" alt="" /></i>
                    Contact us</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End LiveChat -->

      <!-- Why Choose Us -->
      <section class="counter-one">
        <div class="auto-container">
          <div class="inner-container">
            <!-- Sec Title -->
            <div class="sec-title style-two centered">
              <div class="sec-title_title"><?=$pageWCUTitle->seo_title?></div>
              <h2 class="sec-title_heading">
              <?=$pageWCUTitle->headline?> <br />
                <span class="text-capitalize"><?=$pageWCUTitle->second_title?></span>
              </h2>
            </div>
            <div class="row clearfix">
              <!-- Counter Block Two -->
              <?php if($pageWCUBoxOne) { ?>
              <div class="counter-block_two col-lg-3 col-md-6 col-sm-6">
                <div
                  class="counter-block_two-inner wow fadeInLeft"
                  data-wow-delay="0ms"
                  data-wow-duration="1500ms"
                >
                  <div class="color-layer"></div>
                  <div class="counter-block_two-count">
                    <span class="odometer" data-count="<?=$pageWCUBoxOne->seo_keywords?>"></span><i><?=$pageWCUBoxOne->seo_description?></i>
                  </div>
                  <h5 class="counter-block_two-title"><?=$pageWCUBoxOne->headline?></h5>
                  <div class="counter-block_two-text"><?=$pageWCUBoxOne->second_title?></div>
                </div>
              </div>
              <?php } ?>

              <!-- Counter Block Two -->
              <?php if($pageWCUBoxTwo) { ?>
              <div class="counter-block_two col-lg-3 col-md-6 col-sm-6">
                <div
                  class="counter-block_two-inner wow fadeInLeft"
                  data-wow-delay="150ms"
                  data-wow-duration="1500ms"
                >
                  <div class="color-layer"></div>
                  <div class="counter-block_two-count">
                    <span class="odometer" data-count="<?=$pageWCUBoxTwo->seo_keywords?>"></span><i><?=$pageWCUBoxTwo->seo_description?></i>
                  </div>
                  <h5 class="counter-block_two-title"><?=$pageWCUBoxTwo->headline?></h5>
                  <div class="counter-block_two-text"><?=$pageWCUBoxTwo->second_title?></div>
                </div>
              </div>
              <?php } ?>

              <!-- Counter Block Two -->
              <?php if($pageWCUBoxThree) { ?>
              <div class="counter-block_two col-lg-3 col-md-6 col-sm-6">
                <div
                  class="counter-block_two-inner wow fadeInLeft"
                  data-wow-delay="300ms"
                  data-wow-duration="1500ms"
                >
                  <div class="color-layer"></div>
                  <div class="counter-block_two-count">
                    <span class="odometer" data-count="<?=$pageWCUBoxThree->seo_keywords?>"></span><i><?=$pageWCUBoxThree->seo_description?></i>
                  </div>
                  <h5 class="counter-block_two-title"><?=$pageWCUBoxThree->headline?></h5>
                  <div class="counter-block_two-text"><?=$pageWCUBoxThree->second_title?></div>
                </div>
              </div>
              <?php } ?>

              <!-- Counter Block Two -->
              <?php if($pageWCUBoxFour) { ?>
              <div class="counter-block_two col-lg-3 col-md-6 col-sm-6">
                <div
                  class="counter-block_two-inner wow fadeInLeft"
                  data-wow-delay="450ms"
                  data-wow-duration="1500ms"
                >
                  <div class="color-layer"></div>
                  <div class="counter-block_two-count">
                    <span class="odometer" data-count="<?=$pageWCUBoxFour->seo_keywords?>"></span><i><?=$pageWCUBoxFour->seo_title?></i>
                  </div>
                  <h5 class="counter-block_two-title"><?=$pageWCUBoxFour->headline?></h5>
                  <div class="counter-block_two-text"><?=$pageWCUBoxFour->second_title?></div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <!-- End Why Choose Us -->

      <!-- Business Excellence -->
      <section class="order-one">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Column -->
            <div class="order-one_skill-column col-lg-6 col-md-12 col-sm-12">
              <div class="order-one_skill-outer">
                <div class="image">
                  <?php $beImage = $pageBusinessExcellence->photo_path ? PHOTO_DOMAIN.'pages/'.$pageBusinessExcellence->photo_path.'-org.'.$pageBusinessExcellence->extension : base_url().'assets/images/resource/skill.png'; ?>
                  <img src="<?=$beImage?>" alt="<?=$pageBusinessExcellence->seo_title?>" />
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="order-one_content-column col-lg-6 col-md-12 col-sm-12">
              <div class="order-one_content-outer">
                <!-- Sec Title -->
                <div class="sec-title style-two title-anim">
                  <div class="sec-title_title"><?=$pageBusinessExcellence->seo_title?></div>
                  <h2 class="sec-title_heading">
                  <?=$pageBusinessExcellence->headline?> <span class="text-capitalize"><?=$pageBusinessExcellence->second_title?></span>
                  </h2>
                </div>

                <!-- Accordion Box Three -->
                <ul class="accordion-box_three">
                  <!-- Block -->
                  <?php if($pageBEAccOne) { ?>
                  <li class="accordion block active-block">
                    <div class="acc-btn active">
                      <div class="icon-outer">
                        <span class="icon fa-solid fa-user fa-fw"></span>
                      </div>
                      <?=$pageBEAccOne->headline?>
                    </div>
                    <div class="acc-content current">
                      <div class="content">
                        <div class="text">
                          <?=strip_tags($pageBEAccOne->page_text)?>
                        </div>
                        <a class="learn-more" href="<?=base_url('contact-us')?>">Learn More <i class="fa-solid fa-plus fa-fw"></i
                        ></a>
                      </div>
                    </div>
                  </li>
                  <?php } ?>

                  <!-- Block -->
                  <?php if($pageBEAccTwo) { ?>
                  <li class="accordion block">
                    <div class="acc-btn">
                      <div class="icon-outer">
                        <span class="icon fa-solid fa-flag fa-fw"></span>
                      </div>
                      <?=$pageBEAccTwo->headline?>
                    </div>
                    <div class="acc-content">
                      <div class="content">
                        <div class="text">
                          <?=strip_tags($pageBEAccTwo->page_text)?>
                        </div>
                        <a class="learn-more" href="<?=base_url('contact-us')?>">Learn More <i class="fa-solid fa-plus fa-fw"></i
                        ></a>
                      </div>
                    </div>
                  </li>
                  <?php } ?>

                  <!-- Block -->
                  <?php if($pageBEAccThree) { ?>
                  <li class="accordion block">
                    <div class="acc-btn">
                      <div class="icon-outer">
                        <span class="icon fa-solid fa-thumbs-up fa-fw"></span>
                      </div>
                      <?=$pageBEAccThree->headline?>
                    </div>
                    <div class="acc-content">
                      <div class="content">
                        <div class="text">
                          <?=strip_tags($pageBEAccThree->page_text)?>
                        </div>
                        <a class="learn-more" href="<?=base_url('contact-us')?>">Learn More <i class="fa-solid fa-plus fa-fw"></i
                        ></a>
                      </div>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Business Excellence -->

      <!-- Testimonial Two -->
      <?php if($pageTestimonial && $testimonialList) { ?>
      <section class="testimonial-one">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-two centered">
            <div class="sec-title_title"><?=$pageTestimonial->seo_title?></div>
            <h2 class="sec-title_heading">
              <?=$pageTestimonial->headline?> <br />
              <span><?=$pageTestimonial->second_title?></span>
            </h2>
          </div>
          <div class="inner-container">
            <div class="three-item_carousel swiper-container">
              <div class="swiper-wrapper">
                <!-- Slide -->
                <?php 
                  foreach ($testimonialList as $testimonial) { 
                    $img = $testimonial->image != '' && $testimonial->image != null ? PHOTO_DOMAIN.'testimonials/'.$testimonial->image : base_url().'assets/images/testimonial_default.jpg';
                ?>
                <div class="swiper-slide">
                  <!-- Testimonial Block One -->
                  <div class="testimonial-block_one">
                    <div class="testimonial-block_one-inner">
                      <div class="testimonial-block_one-rating">
                        <?=str_repeat('<span class="fa fa-star"></span>', $testimonial->stars)?>
                      </div>
                      <div class="testimonial-block_one-text">
                        <?=strip_tags($testimonial->content)?>
                      </div>
                      <div class="testimonial-block_one-author_box">
                        <div class="testimonial-block_one-author-image">
                          <img
                            src="<?=$img?>"
                            alt="<?=$testimonial->name?>"
                          />
                        </div>
                          <?=$testimonial->name?> <span><?=$testimonial->designation?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <!-- If we need pagination -->
              <div class="three-item_carousel-pagination"></div>
            </div>
          </div>
        </div>
      </section>
      <?php } ?>
      <!-- End Testimonial Two -->

      <!-- Steps One -->
      <section class="steps-one">
        <div
          class="steps-one_bg"
          style="background-image: url(<?=base_url()?>assets/images/background/step-1_bg.png)"
        ></div>
        <div
          class="steps-one_icon"
          style="background-image: url(<?=base_url()?>assets/images/icons/step.png)"
        ></div>
        <div class="auto-container">
          <div class="inner-container">
            <div class="circle-layer"></div>
            <div class="dots-layer">
              <span class="dot-one"></span>
              <span class="dot-two"></span>
            </div>

            <!-- Sec Title -->
            <div class="sec-title style-two">
              <div class="sec-title_title"><?=$pageHowItWorks->seo_title?></div>
              <h2 class="sec-title_heading">
                <?=$pageHowItWorks->seo_keywords?> <span><?=$pageHowItWorks->headline?></span> <br /> <?=$pageHowItWorks->second_title?>
              </h2>
            </div>
            <div class="steps-one_button">
              <a href="<?=base_url('contact-us')?>" class="template-btn btn-style-two">
                <span class="btn-wrap">
                  <span class="text-one">Know more</span>
                  <span class="text-two">Know more</span>
                </span>
              </a>
            </div>
            <div class="row clearfix">
              <!-- Column -->
              <?php if($pageHowItWorksStepOne) { ?>
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <!-- Step Block One -->
                <div class="step-block_one">
                  <div class="step-block_one-inner">
                    <div class="step-block_one-steps"><?=$pageHowItWorksStepOne->seo_title?></div>
                    <h5 class="step-block_one-title"><?=$pageHowItWorksStepOne->headline?></h5>
                    <div class="step-block_one-text text-white"><?=strip_tags($pageHowItWorksStepOne->page_text)?></div>
                    <div class="step-block_one-content">
                      <div class="image">
                        <?php $stepOneImage = $pageHowItWorksStepOne->photo_path ? PHOTO_DOMAIN.'pages/'.$pageHowItWorksStepOne->photo_path.'-org.'.$pageHowItWorksStepOne->extension : base_url().'assets/images/resource/step-1.png'; ?>
                        <img src="<?=$stepOneImage?>" alt="<?=$pageHowItWorksStepOne->headline?>" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- Column -->
              <?php if($pageHowItWorksStepTwo) { ?>
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <!-- Step Block One -->
                <div class="step-block_one">
                  <div class="step-block_one-inner">
                    <div class="step-block_one-steps"><?=$pageHowItWorksStepTwo->seo_title?></div>
                    <h5 class="step-block_one-title"><?=$pageHowItWorksStepTwo->headline?></h5>
                    <div class="step-block_one-text text-white"><?=strip_tags($pageHowItWorksStepTwo->page_text)?></div>
                    <div class="step-block_one-content">
                      <div class="image">
                        <?php $stepTwoImage = $pageHowItWorksStepTwo->photo_path ? PHOTO_DOMAIN.'pages/'.$pageHowItWorksStepTwo->photo_path.'-org.'.$pageHowItWorksStepTwo->extension : base_url().'assets/images/resource/step-2.png'; ?>
                        <img src="<?=$stepTwoImage?>" alt="<?=$pageHowItWorksStepTwo->headline?>" />
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>

                <!-- Step Block One -->
                <?php if($pageHowItWorksStepThree) { ?>
                <div class="step-block_one">
                  <div class="step-block_one-inner">
                    <div class="step-block_one-steps"><?=$pageHowItWorksStepThree->seo_title?></div>
                    <h5 class="step-block_one-title"><?=$pageHowItWorksStepThree->headline?></h5>
                    <div class="step-block_one-text text-white"><?=strip_tags($pageHowItWorksStepThree->page_text)?></div>
                    <div class="step-block_one-content">
                      <div class="image">
                        <?php $stepThreeImage = $pageHowItWorksStepThree->photo_path ? PHOTO_DOMAIN.'pages/'.$pageHowItWorksStepThree->photo_path.'-org.'.$pageHowItWorksStepThree->extension : base_url().'assets/images/resource/step-3.png'; ?>
                        <img src="<?=$stepThreeImage?>" alt="<?=$pageHowItWorksStepThree->headline?>" />
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Steps One -->

      <!-- News One -->
      <section class="news-one style-two">
        <div
          class="news-one_shadow-two"
          style="background-image: url(<?=base_url()?>assets/images/background/news-shadow-2.png);"
        ></div>
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-two">
            <div
              class="d-flex justify-content-between align-items-end flex-wrap"
            >
              <div class="left-box">
                <div class="sec-title_title"><?=$pageOurWorks->seo_title?></div>
                <h2 class="sec-title_heading">
                  <?=$pageOurWorks->headline?> <span><?=$pageOurWorks->second_title?></span>
                </h2>
              </div>
              <div class="news-two_button">
                <div class="livechat_button">
                  <a href="<?=base_url('works')?>" class="template-btn btn-style-one">
                    <span class="btn-wrap">
                      <span class="text-one">Learn more</span>
                      <span class="text-two">Learn more</span>
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="three-item_carousel swiper-container">
            <div class="swiper-wrapper">
              <!-- Slide -->
              <div class="swiper-slide">
                <!-- News Block One -->
                <div class="news-block_one">
                  <div class="news-block_one-inner">
                    <div class="news-block_one-image">
                      <a href="news-detail.html"
                        ><img src="<?=base_url()?>assets/images/resource/news-1.jpg" alt=""
                      /></a>
                    </div>
                    <div class="news-block_one-content">
                      <div class="news-block_one-time">
                        By Admin <span>6 min read</span>
                      </div>
                      <h5 class="news-block_one-title">
                        <a href="news-detail.html"
                          >Transforming industries and shaping the future</a
                        >
                      </h5>
                      <a class="news-block_one-more" href="service-detail.html"
                        >Read more <i class="fa-solid fa-plus fa-fw"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide -->
              <div class="swiper-slide">
                <!-- News Block One -->
                <div class="news-block_one">
                  <div class="news-block_one-inner">
                    <div class="news-block_one-image">
                      <a href="news-detail.html"
                        ><img src="<?=base_url()?>assets/images/resource/news-2.jpg" alt=""
                      /></a>
                    </div>
                    <div class="news-block_one-content">
                      <div class="news-block_one-time">
                        By Admin <span>6 min read</span>
                      </div>
                      <h5 class="news-block_one-title">
                        <a href="news-detail.html"
                          >Exploring the cutting-edge of artificial
                          intelligence</a
                        >
                      </h5>
                      <a class="news-block_one-more" href="service-detail.html"
                        >Read more <i class="fa-solid fa-plus fa-fw"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide -->
              <div class="swiper-slide">
                <!-- News Block One -->
                <div class="news-block_one">
                  <div class="news-block_one-inner">
                    <div class="news-block_one-image">
                      <a href="news-detail.html"
                        ><img src="<?=base_url()?>assets/images/resource/news-3.jpg" alt=""
                      /></a>
                    </div>
                    <div class="news-block_one-content">
                      <div class="news-block_one-time">
                        By Admin <span>6 min read</span>
                      </div>
                      <h5 class="news-block_one-title">
                        <a href="news-detail.html"
                          >Understanding the basics of artificial
                          intelligence</a
                        >
                      </h5>
                      <a class="news-block_one-more" href="service-detail.html"
                        >Read more <i class="fa-solid fa-plus fa-fw"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- If we need pagination -->
            <div class="three-item_carousel-pagination"></div>
          </div>
        </div>
      </section>
      <!-- End News One -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_home'); ?>
    </div>
    <!-- End PageWrapper -->
    <?php $this->load->view('includes/js'); ?>
  </body>
</html>