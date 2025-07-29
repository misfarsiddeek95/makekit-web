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

      <!-- Page Title -->
      <section class="page-title">
        <div
          class="page-title-icon"
          style="background-image: url(<?=base_url()?>assets/images/icons/page-title_icon-1.png);"
        ></div>
        <div
          class="page-title-icon-two"
          style="background-image: url(<?=base_url()?>assets/images/icons/page-title_icon-2.png);"
        ></div>
        <div
          class="page-title-shadow"
          style="background-image: url(<?=base_url()?>assets/images/background/page-title-1.png);"
        ></div>
        <div
          class="page-title-shadow_two"
          style="background-image: url(<?=base_url()?>assets/images/background/page-title-2.png);"
        ></div>
        <div class="auto-container">
          <h2><?=$pageMain->headline?></h2>
          <ul class="bread-crumb clearfix">
            <li><a href="<?=base_url()?>">Home</a></li>
            <li><?=$pageMain->second_title?></li>
          </ul>
        </div>
      </section>
      <!-- End Page Title -->

      <!-- Services One -->
      <section class="services-one style-two">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Service Block One -->
            <?php 
              $classes = ['fadeInLeft', 'fadeInUp', 'fadeInRight'];
              foreach ($services as $key => $row) { 
                $fadeClass = $classes[$key % count($classes)];
                $text = strip_tags($row->service_text);
            ?>
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
              <div
                class="service-block_one-inner wow <?=$fadeClass?>"
                data-wow-delay="0ms"
                data-wow-duration="1500ms"
              >
                <div class="service-block_one-icon">
                  <i class="<?=$row->class_name?>"></i>
                </div>
                <h5 class="service-block_one-heading">
                  <a href="<?=base_url()?>services/<?=$row->slug?>?select=<?=$row->service_uuid?>"><?=$row->title?></a>
                </h5>
                <div class="service-block_one-text">
                  <?=(strlen($text) > 97) ? substr($text, 0, 97) . '...' : $text?>
                </div>
                <div
                  class="lower-box d-flex justify-content-between align-items-center flex-wrap"
                >
                  <div class="service-block_one-number"><?=str_pad(($key + 1), 2, "0", STR_PAD_LEFT)?></div>
                  <a class="service-block_one-join" href="<?=base_url()?>services/<?=$row->slug?>?select=<?=$row->service_uuid?>"
                    >View now <i class="fa-solid fa-plus fa-fw"></i
                  ></a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <!-- End Services One -->

      <!-- Video One -->
      <?php if($pageVideoMain) { ?>
      <section class="video-one">
        <div class="video-one_image">
          <img src="<?=PHOTO_DOMAIN.'pages/'.$pageVideoMain->photo_path.'-org.'.$pageVideoMain->extension?>" alt="service banner" />
          <?php 
            if($pageVideoMain->seo_url != '' && $pageVideoMain->seo_url != null) { 
              $videoId = explode("?v=", $pageVideoMain->seo_url); // For videos like http://www.youtube.com/watch?v=...
              if (empty($videoId[1])) {
                $videoId = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
              }
              $videoId = explode("&", $videoId[1]); // Deleting any other params
              $videoId = $videoId[0];
          ?>
          <a
            href="https://www.youtube.com/watch?v=<?=$videoId?>"
            class="lightbox-video video-one_play"
            ><span class="fa-solid fa-play fa-fw"><i class="ripple"></i></span
          ></a>
          <?php } ?>
        </div>
      </section>
      <?php } ?>
      <!-- End Video One -->

      <!-- Social media reach -->
      <section class="choose-three">
        <div class="auto-container">
          <div class="inner-container">
            <div class="row clearfix">
              <!-- Counter Block One -->
              <?php if($pageInstagram) { ?>
              <div class="counter-block_one col-lg-4 col-md-6 col-sm-12">
                <div
                  class="counter-block_one-inner wow fadeInLeft"
                  data-wow-delay="0ms"
                  data-wow-duration="1500ms"
                >
                  <div
                    class="counter-block_one-icon fa-brands fa-instagram fa-fw"
                  ></div>
                  <div class="counter-block_one-count">
                    <span class="odometer" data-count="<?=$pageInstagram->headline?>"></span><i>+</i>
                  </div>
                  <div class="counter-block_one-text text-white"><?=$pageInstagram->second_title?></div>
                </div>
              </div>
              <?php } ?>

              <!-- Counter Block One -->
              <?php if($pageFacebook) { ?>
              <div class="counter-block_one col-lg-4 col-md-6 col-sm-12">
                <div
                  class="counter-block_one-inner wow fadeInLeft"
                  data-wow-delay="150ms"
                  data-wow-duration="1500ms"
                >
                  <div
                    class="counter-block_one-icon fa-brands fa-facebook fa-fw"
                  ></div>
                  <div class="counter-block_one-count">
                    <span class="odometer" data-count="<?=$pageFacebook->headline?>"></span><i>+</i>
                  </div>
                  <div class="counter-block_one-text text-white"><?=$pageFacebook->second_title?></div>
                </div>
              </div>
              <?php } ?>

              <!-- Counter Block One -->
              <?php if($pageTwitter) { ?>
              <div class="counter-block_one col-lg-4 col-md-6 col-sm-12">
                <div
                  class="counter-block_one-inner wow fadeInLeft"
                  data-wow-delay="300ms"
                  data-wow-duration="1500ms"
                >
                  <div
                    class="counter-block_one-icon fa-brands fa-twitter fa-fw"
                  ></div>
                  <div class="counter-block_one-count">
                    <span class="odometer" data-count="<?=$pageTwitter->headline?>"></span><i>+</i>
                  </div>
                  <div class="counter-block_one-text text-white"><?=$pageTwitter->second_title?></div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <!-- End social media reach -->

      <!-- Faq One -->
      <?php if($pageFAQ && $serviceFaqs) { ?>
      <section class="faq-one style-three">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Tab Column -->
            <div class="faq-one_title-column col-lg-5 col-md-12 col-sm-12">
              <div class="faq-one_title-outer">
                <!-- Sec Title -->
                <div class="sec-title">
                  <div class="sec-title_title"><?=$pageFAQ->seo_title?></div>
                  <h2 class="sec-title_heading">
                    <?=$pageFAQ->headline?> <span><?=$pageFAQ->second_title?></span>
                  </h2>
                  <div class="sec-title_text"><?=strip_tags($pageFAQ->page_text)?></div>
                </div>
                <div class="faq-one_button">
                  <a href="<?=base_url()?>" class="template-btn btn-style-one">
                    <span class="btn-wrap">
                      <span class="text-one">Contact now</span>
                      <span class="text-two">Contact now</span>
                    </span>
                  </a>
                </div>
              </div>
            </div>

            <!-- Accordian Column -->
            <div class="faq-one_accordian-column col-lg-7 col-md-12 col-sm-12">
              <div class="faq-one_accordian-outer">
                <!-- Accordion Box -->
                <ul class="accordion-box_two">
                  <!-- Block -->
                  <?php foreach ($serviceFaqs as $faq) { ?>
                  <li class="accordion block">
                    <div class="acc-btn">
                      <div class="icon-outer">
                        <span
                          class="icon icon-plus fa-solid fa-plus fa-fw"
                        ></span>
                      </div>
                      <?=$faq->question?>
                    </div>
                    <div class="acc-content">
                      <div class="content">
                        <div class="text"><?=strip_tags($faq->answer)?></div>
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
      <?php } ?>
      <!-- End Faq One -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->
    <?php $this->load->view('includes/js'); ?>
  </body>
</html>