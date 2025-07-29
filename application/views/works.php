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
      .item {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
      }
      .item.visible {
        opacity: 1;
      }
      #loader {
        text-align: center;
        margin: 10px;
        display: none;
      }
      html {
        scroll-behavior: smooth;
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
            <li><a href="<?=base_url()?>">Home</a></li>
            <li><?=$pageMain->second_title?></li>
          </ul>
        </div>
      </section>
      <!-- End Page Title -->

      <!-- Team Two -->
      <section class="team-two">
        <div class="auto-container">
          <div class="row clearfix" id="work-list"></div>
          <div id="loader">
            <img src="<?=base_url()?>assets/images/progress2.gif" alt="Loading...">
          </div>

        </div>
      </section>
      <!-- End Team Two -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->
    <?php $this->load->view('includes/js'); ?>
    <script>
      let loading = false;
      let offset = 0;

      const loadData = () => {
        if(!loading) {
          loading = true;
          $('#loader').show(); // show loader
          $.ajax({
            type: 'GET',
            url: '<?=base_url()?>load-works',
            data: 'offset=' + offset,
            success: function (result) {
              const resp = $.parseJSON(result);
              if(resp.length > 0) {
                resp.forEach(el => {
                  const img = el.image != '' && el.image != null ? '<?=PHOTO_DOMAIN?>works/' + el.image : '<?=base_url()?>assets/images/works_default.png';
                  const url = el.link != null && el.link != '' ? el.link : 'javascript:(0);';
                  const workType = el.pt_name != '' ? el.pt_name : '';
                  const targetAttr = el.link != null && el.link != '' ? 'target="_blank"' : '';

                  const $html = $(`<div class="team-block_one col-lg-4 col-md-6 col-sm-12 item">
                                    <div class="team-block_one-inner">
                                      <div class="team-block_one-image">
                                        <a href="${url}" ${targetAttr}><img src="${img}" alt="${el.title}"/></a>
                                      </div>
                                      <div class="team-block_one-content">
                                        <h4 class="team-block_one-title">
                                          <a href="${url}" ${targetAttr}>${el.title}</a>
                                        </h4>
                                        <div class="team-block_one-designation">${workType}</div>
                                      </div>
                                    </div>
                                  </div>`);
                  $('#work-list').append($html);

                  // Smoothly display the new item
                  setTimeout(function() {
                    $html.addClass('visible');
                  }, 10); 
                });
                offset += resp.length;
              } else {
                $(window).off('scroll'); // No more data to load
              }
            },
            error: function (xhr, status, error) {
              console.error('Error fetching data:', error);
            },
            complete: function () {
              loading = false;
              $('#loader').hide(); // Hide loader
            }
          });
        }
      }

      // load initial data
      loadData();

      // Detect scroll event for infinite scrolling
      $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
          loadData();
        }
      });
    </script>
  </body>
</html>