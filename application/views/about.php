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
    <style>
      .story-para p {
        display: none;
      }
      .story-para p:nth-child(-n+2) {
        display: block;
      }
    </style>
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
            <li><a href="index.html">Home</a></li>
            <li><?=$pageMain->headline?></li>
          </ul>
        </div>
      </section>
      <!-- End Page Title -->

      <!-- Story One -->
      <section class="story-one">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Image Column -->
            <div class="story-one_image-column col-lg-6 col-md-12 col-sm-12">
              <div class="story-one_image-outer">
                <div class="story-one_image">
                  <?php $ourStoryImage = $pageOurStory->photo_path ? PHOTO_DOMAIN.'pages/'.$pageOurStory->photo_path.'-org.'.$pageOurStory->extension : base_url().'assets/images/resource/story.png'; ?>
                  <img src="<?=$ourStoryImage?>" alt="<?=$pageOurStory->seo_title?>" />
                </div>
              </div>
            </div>

            <!-- Image Column -->
            <div class="story-one_content-column col-lg-6 col-md-12 col-sm-12">
              <div class="story-one_content-outer">
                <!-- Sec Title -->
                <div class="sec-title style-four">
                  <div class="sec-title_title"><?=$pageOurStory->seo_title?></div>
                  <h2 class="sec-title_heading">
                    <?=$pageOurStory->headline?> <span class="text-capitalize"><?=$pageOurStory->second_title?></span>
                  </h2>
                </div>
                <div class="story-para">
                  <?=$pageOurStory->page_text?>
                </div>
                <div class="story-one_button">
                  <button type="button" class="template-btn btn-style-one" id="know-more-btn" btn-status="SHOW">
                    <span class="btn-wrap">
                      <span class="text-one">Know more</span>
                      <span class="text-two">Know more</span>
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Assistance One -->

      <!-- Value One -->
      <?php if($pageCoreValueMain) { ?>
      <section class="value-one">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-four centered">
            <div class="sec-title_title"><?=$pageCoreValueMain->seo_title?></div>
            <h2 class="sec-title_heading">
              <?=$pageCoreValueMain->seo_description?> <span><?=$pageCoreValueMain->headline?></span> <br />
              <?=$pageCoreValueMain->second_title?>
            </h2>
          </div>
          <div class="row clearfix">
            <!-- Value Block One -->
            <div class="value-block_one col-lg-4 col-md-6 col-sm-12">
              <div class="value-block_one-inner">
                <div class="value-block_one-icon">
                  <i class="icon-users-4"></i>
                </div>
                <h5 class="value-block_one-title"><?=$pageCoreValuePeople->headline?></h5>
                <div class="value-block_one-text"><?=strip_tags($pageCoreValuePeople->page_text)?></div>
              </div>
            </div>

            <!-- Value Block One -->
            <div class="value-block_one active col-lg-4 col-md-6 col-sm-12">
              <div class="value-block_one-inner">
                <div class="value-block_one-icon">
                  <i class="icon-bulb1"></i>
                </div>
                <h5 class="value-block_one-title"><?=$pageCoreValueInnovation->headline?></h5>
                <div class="value-block_one-text text-white"><?=strip_tags($pageCoreValueInnovation->page_text)?></div>
              </div>
            </div>

            <!-- Value Block One -->
            <div class="value-block_one col-lg-4 col-md-6 col-sm-12">
              <div class="value-block_one-inner">
                <div class="value-block_one-icon">
                  <i class="fa-solid fa-bullseye fa-fw"></i>
                </div>
                <h5 class="value-block_one-title"><?=$pageCoreValueMission->headline?></h5>
                <div class="value-block_one-text"><?=strip_tags($pageCoreValueMission->page_text)?></div>
              </div>
            </div>
          </div>

          <!-- Button Box -->
          <div class="value-one_button text-center">
            <a href="<?=base_url('contact-us')?>" class="template-btn btn-style-two">
              <span class="btn-wrap">
                <span class="text-one">Contact Arbol Soft today</span>
                <span class="text-two">Contact Arbol Soft today</span>
              </span>
            </a>
          </div>
        </div>
      </section>
      <?php } ?>
      <!-- End Value One -->

      <!-- Social One -->
      <section class="social-one">
        <div
          class="social-one_bg-shadow"
          style="background-image: url(<?=base_url()?>assets/images/background/social-bg.png)"
        ></div>
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-four centered">
            <div class="sec-title_title"><?=$pageIntegrationMain->seo_title?></div>
            <h2 class="sec-title_heading">
              <?=$pageIntegrationMain->headline?> <br />
              <span><?=$pageIntegrationMain->second_title?></span>
            </h2>
          </div>
          <div class="social-one_logo">
            <span
              ><img src="<?=base_url()?>assets/images/icons/social-logo2.png" alt=""
            /></span>
          </div>
          <div class="inner-container">
            <div
              class="social-one_bg"
              style="background-image: url(<?=base_url()?>assets/images/background/social-one_pattern.png);"
            ></div>
            <div
              class="social-one_bg-two"
              style="background-image: url(<?=base_url()?>assets/images/background/social-one_pattern-two.png);"
            ></div>

            <?php if($pageIntegrationLeftMove) { ?>
            <div class="social-box_one">
              <div class="animation_mode">
                <!-- Icon -->
                <?php 
                  foreach ($pageIntegrationLeftMove as $leftIcon) {
                    $leftImage = PHOTO_DOMAIN.'pages/'.$leftIcon->photo_path.'-org.'.$leftIcon->extension;
                ?>
                <div class="social_icon-box">
                  <a href="javascript:void(0);">
                    <img src="<?=$leftImage?>" alt="<?=$leftIcon->photo_header?>" />
                  </a>
                </div>
                <?php } ?>
                <!-- Icon -->
              </div>
            </div>
            <?php } ?>

            <?php if($pageIntegrationRightMove) { ?>
            <div class="social-box">
              <div class="animation_mode_two">
                <!-- Icon -->
                <?php 
                  foreach ($pageIntegrationRightMove as $rightIcon) {
                    $rightImage = PHOTO_DOMAIN.'pages/'.$rightIcon->photo_path.'-org.'.$rightIcon->extension;
                ?>
                <div class="social_icon-box">
                  <a href="javascript:void(0);">
                    <img src="<?=$rightImage?>" alt="<?=$rightIcon->photo_header?>" />
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <!-- End Social One -->

      <!-- Team One -->
      <?php if($pageOurTeamMain) { ?>
      <section class="team-one" id="team">
        <div class="auto-container">
          <div class="row clearfix">
            <!-- Title Column -->
            <div class="team-one_title-column col-lg-4 col-md-12 col-sm-12">
              <div class="team-one_title-outer">
                <!-- Sec Title -->
                <div class="sec-title style-four">
                  <div class="sec-title_title"><?=$pageOurTeamMain->seo_title?></div>
                  <h2 class="sec-title_heading">
                    <?=$pageOurTeamMain->headline?> <span><?=$pageOurTeamMain->second_title?></span>
                  </h2>
                  <div class="sec-title_text"><?=strip_tags($pageOurTeamMain->page_text)?></div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="team-one_arrows">
                  <div
                    class="team_carousel-prev fa-solid fa-angle-left fa-fw"
                  ></div>
                  <div
                    class="team_carousel-next fa-solid fa-angle-right fa-fw"
                  ></div>
                </div>
              </div>
            </div>

            <!-- Team Column -->
            <?php if($pageOurTeamImages) { ?>
            <div class="team-one_team-column col-lg-8 col-md-12 col-sm-12">
              <div class="team-one_team-outer">
                <div class="team-carousel swiper-container">
                  <div class="swiper-wrapper">
                    <!-- Slide -->
                    <?php foreach ($pageOurTeamImages as $team) { ?>
                    <div class="swiper-slide">
                      <!-- Team Block One -->
                      <div class="team-block_one">
                        <div class="team-block_one-inner">
                          <div class="team-block_one-image">
                            <a href="javascript:void(0);"
                              ><img
                                src="<?=PHOTO_DOMAIN.'pages/'.$team->photo_path.'-org.'.$team->extension?>"
                                alt="team image"
                            /></a>
                          </div>
                          <div class="team-block_one-content">
                            <h4 class="team-block_one-title">
                              <a href="javascript:void(0);"><?=$team->photo_header?></a>
                            </h4>
                            <div class="team-block_one-designation"><?=$team->psub_header?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <?php } ?>
      <!-- End Team One -->

      <!-- Testimonial Three -->
      <?php if($pageTestimonialMain && $testimonialList) { ?>
      <section class="testimonial-three" id="testimonials">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-four centered">
            <div class="sec-title_title"><?=$pageTestimonialMain->seo_title?></div>
            <h2 class="sec-title_heading">
              <?=$pageTestimonialMain->headline?> <br /><span><?=$pageTestimonialMain->second_title?></span>
            </h2>
          </div>

          <div class="three-item_carousel">
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
                        <img src="<?=$img?>" alt="<?=$testimonial->name?>" />
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
      </section>
      <?php } ?>
      <!-- End Testimonial Three -->

      <!-- Clients Two -->
      <?php if($pageTrustedOrganizationMain && $pageTrustedOrganizationsImages) { ?>
      <section class="clients-two">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title centered">
            <div class="sec-title_title"><?=$pageTrustedOrganizationMain->headline?></div>
          </div>
          <div class="clients_slider swiper-container">
            <div class="swiper-wrapper">
              <!-- Slide -->
              <?php foreach ($pageTrustedOrganizationsImages as $client) { ?>
              <div class="swiper-slide">
                <div class="client-image">
                  <a href="javascript:void(0);"
                    ><img src="<?=PHOTO_DOMAIN.'pages/'.$client->photo_path.'-org.'.$client->extension?>" alt="clients"
                  /></a>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <?php } ?>
      <!-- End Clients Two -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->
    <?php $this->load->view('includes/js'); ?>
    <script>

      // when click the know more button in our story section.
      $('#know-more-btn').click(function() {
        const buttonStatus = $(this).attr('btn-status');
        if(buttonStatus == 'SHOW') {
          $('.story-para p').show('slow');
          $(this).find('span span').text("Know less");
          $(this).attr('btn-status', 'HIDE');
        } else if(buttonStatus == 'HIDE') {
          $('.story-para p').hide('slow');
          $('.story-para p:nth-child(-n+2)').show('slow');
          $(this).find('span span').text("Know more");
          $(this).attr('btn-status', 'SHOW');
        }
      });
    </script>
  </body>
</html>