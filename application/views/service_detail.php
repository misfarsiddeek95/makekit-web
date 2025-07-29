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

      <!-- Services Detail -->
      <section class="services-detail">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-four">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap"
            >
              <div class="left-box">
                <!-- <div class="sec-title_title">content marketers</div> -->
                <?php 
                  $serviceTitle = $serviceDetail->title;
                  $words = preg_split('/\s+/', trim($serviceTitle));
                  $word_count = count($words);
                  $titleText = $titleText2 = '';
                  if($word_count == 1 || $word_count == 2) {
                    $titleText = $serviceTitle;
                    $titleText2 = '';
                  } elseif($word_count == 3) {
                    $last_word = array_pop($words);
                    $titleText = implode(' ', $words);
                    $titleText2 = $last_word;
                  } elseif($word_count > 3) {
                    $last_word = array_pop($words);
                    $second_last_word = array_pop($words);

                    $titleText = implode(' ', $words);
                    $titleText2 = $second_last_word.' '.$last_word;
                  }
                ?>
                <h2 class="sec-title_heading">
                  <?=$titleText?>
                  <span><?=$titleText2?></span>
                </h2>
              </div>
              <div class="right-box">
                <?=$serviceDetail->service_text?>
              </div>
            </div>
          </div>
          <?php if($serviceDetail->image != '' && $serviceDetail->image != null) { ?>
          <div class="service-detail_image">
            <img src="<?=PHOTO_DOMAIN.'services/'.$serviceDetail->image?>" alt="<?=$serviceDetail->title?> image" />
          </div>
          <?php } ?>
        </div>
      </section>
      <!-- End Services One -->

      <!-- Services Two -->
      <?php if($pageServiceBenefitsMain) { ?>
      <div class="services-two">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-four centered">
            <div class="sec-title_title"><?=$pageServiceBenefitsMain->seo_title?></div>
            <h2 class="sec-title_heading">
              <span><?=$pageServiceBenefitsMain->headline?></span> <?=$pageServiceBenefitsMain->second_title?>
            </h2>
          </div>
          <div class="row clearfix">
            <!-- Service Block Four -->
            <?php if($pageServiceBenefitsBox1) { ?>
            <div class="service-block_four col-lg-3 col-md-6 col-sm-12">
              <div class="service-block_four-inner">
                <div class="service-block_four-icon">
                  <i class="icon-heart-hand"></i>
                </div>
                <h4 class="service-block_four-title"><?=$pageServiceBenefitsBox1->headline?></h4>
                <div class="service-block_four-text"><?=strip_tags($pageServiceBenefitsBox1->page_text)?></div>
              </div>
            </div>
            <?php } ?>

            <!-- Service Block Four -->
            <?php if($pageServiceBenefitsBox2) { ?>
            <div class="service-block_four col-lg-3 col-md-6 col-sm-12">
              <div class="service-block_four-inner">
                <div class="service-block_four-icon">
                  <i class="icon-eye"></i>
                </div>
                <h4 class="service-block_four-title"><?=$pageServiceBenefitsBox2->headline?></h4>
                <div class="service-block_four-text"><?=strip_tags($pageServiceBenefitsBox2->page_text)?></div>
              </div>
            </div>
            <?php } ?>

            <!-- Service Block Four -->
            <?php if($pageServiceBenefitsBox3) { ?>
            <div class="service-block_four col-lg-3 col-md-6 col-sm-12">
              <div class="service-block_four-inner">
                <div class="service-block_four-icon">
                  <i class="icon-seo"></i>
                </div>
                <h4 class="service-block_four-title"><?=$pageServiceBenefitsBox3->headline?></h4>
                <div class="service-block_four-text"><?=strip_tags($pageServiceBenefitsBox3->page_text)?></div>
              </div>
            </div>
            <?php } ?>

            <!-- Service Block Four -->
            <?php if($pageServiceBenefitsBox4) { ?>
            <div class="service-block_four col-lg-3 col-md-6 col-sm-12">
              <div class="service-block_four-inner">
                <div class="service-block_four-icon">
                  <i class="icon-magnet-1"></i>
                </div>
                <h4 class="service-block_four-title"><?=$pageServiceBenefitsBox4->headline?></h4>
                <div class="service-block_four-text"><?=strip_tags($pageServiceBenefitsBox4->page_text)?></div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
      <!-- End Services Two -->

      <!-- Faq One -->
      <section class="faq-one style-three"></section>
      <!-- End Faq One -->
      <?php if($prev_next_records) { ?>
      <div class="more-options">
        <div class="auto-container">
          <!-- Post Share Options-->
          <div class="post-share-options"></div>

          <div class="service-detail_posts">
            <div
              class="d-flex align-items-center flex-wrap justify-content-between"
            > 
              <div class="new-post">
                <?php if($prev_next_records['prev']) { ?>
                <a href="<?=base_url()?>services/<?=$prev_next_records['prev']->slug_url?>?select=<?=$prev_next_records['prev']->service_uuid?>"
                  ><i class="fa-solid fa-angle-left fa-fw"></i> Previous</a
                >
                <h4><?=$prev_next_records['prev']->title?></h4>
                <?php } ?>
              </div>
              <div class="new-post text-right">
                <?php if($prev_next_records['next']) { ?>
                <a href="<?=base_url()?>services/<?=$prev_next_records['next']->slug_url?>?select=<?=$prev_next_records['next']->service_uuid?>"
                  >next <i class="fa-solid fa-angle-right fa-fw"></i
                ></a>
                <h4><?=$prev_next_records['next']->title?></h4>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->

    <?php $this->load->view('includes/js'); ?>
  </body>
</html>
