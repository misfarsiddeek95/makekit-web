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

      <!-- Services One -->
      <section class="data-one">
        <div class="auto-container">
          <!-- Sec Title -->
          <div class="sec-title style-three centered">
            <div class="sec-title_icon">
              <i class="fa-solid fa-font-awesome fa-fw"></i>
            </div>
            <h2 class="sec-title_heading">
              <?=$pageHeading->headline?> <br /> <span><?=$pageHeading->second_title?></span>
            </h2>
          </div>

          <div class="data-blocks_outer" id="product-list">
            <!-- Data Block One -->
            <!-- <?php
              foreach ($productList as $key => $row) {
                $img = $row->image != '' && $row->image != null ? PHOTO_DOMAIN.'products/'.$row->image : base_url().'assets/images/resource/data-1.jpg';
                $text = strip_tags($row->product_desc);
                $url = base_url().'products/'.$row->slug_url.'?select='.$row->uuid;

                $column1 = '';
                $column2 = '';

                if ($key % 2 == 0) {
                    $column1 = '<div class="data-block_one-image-column col-lg-6 col-md-12 col-sm-12">
                                  <div class="data-block_one-image">
                                    <img src="'.$img.'" alt="'.$row->title.'" />
                                  </div>
                                </div>';

                    $column2 = '<div class="data-block_one-content-column col-lg-6 col-md-12 col-sm-12">
                                  <div class="data-block_one-content">
                                    <div class="data-block_one-number">'.str_pad(($key + 1), 2, "0", STR_PAD_LEFT).'</div>
                                    <h3 class="data-block_one-title">'.$row->title.'</h3>
                                    <div class="data-block_one-text">'.(strlen($text) > 179 ? substr($text, 0, 179) . "..." : $text).'</div>
                                    <ul class="data-block_one-list">';
                                      foreach ($row->features as $feat) {
                                          $column2 .= '<li>
                                                        <i class="fa-solid fa-check fa-fw"></i>'.$feat->product_point.'
                                                      </li>';
                                      }

                    $column2 .= '</ul>
                                  <div class="data-block_one-button">
                                    <a href="'.$url.'" class="template-btn btn-style-one">
                                      <span class="btn-wrap">
                                        <span class="text-one">VIEW IN DETAIL</span>
                                        <span class="text-two">VIEW IN DETAIL</span>
                                      </span>
                                    </a>
                                    <a href="'.$url.'#request-demo-form" class="template-btn btn-style-two ms-2">
                                      <span class="btn-wrap">
                                        <span class="text-one">REQUEST A DEMO</span>
                                        <span class="text-two">REQUEST A DEMO</span>
                                      </span>
                                    </a>
                                  </div>
                                </div>
                              </div>';
                } else {
                    $column2 = '<div class="data-block_one-image-column col-lg-6 col-md-12 col-sm-12">
                                  <div class="data-block_one-image">
                                    <img src="'.$img.'" alt="" />
                                  </div>
                                </div>';

                    $column1 = '<div class="data-block_one-content-column col-lg-6 col-md-12 col-sm-12">
                                  <div class="data-block_one-content">
                                    <div class="data-block_one-number">'.str_pad(($key + 1), 2, "0", STR_PAD_LEFT).'</div>
                                    <h3 class="data-block_one-title">'.$row->title.'</h3>
                                    <div class="data-block_one-text">'.(strlen($text) > 179 ? substr($text, 0, 179) . "..." : $text).'</div>
                                    <ul class="data-block_one-list">';
                                      foreach ($row->features as $feat) {
                                          $column1 .= '<li>
                                                        <i class="fa-solid fa-check fa-fw"></i>'.$feat->product_point.'
                                                      </li>';
                                      }

                    $column1 .= '</ul>
                                  <div class="data-block_one-button">
                                    <a href="'.$url.'" class="template-btn btn-style-one">
                                      <span class="btn-wrap">
                                        <span class="text-one">VIEW IN DETAIL</span>
                                        <span class="text-two">VIEW IN DETAIL</span>
                                      </span>
                                    </a>
                                    <a href="'.$url.'#request-demo-form" class="template-btn btn-style-two ms-2">
                                      <span class="btn-wrap">
                                        <span class="text-one">REQUEST A DEMO</span>
                                        <span class="text-two">REQUEST A DEMO</span>
                                      </span>
                                    </a>
                                  </div>
                                </div>
                              </div>';
                }
            ?>
            <div class="data-block_one">
              <div class="data-block_one-inner">
                <div class="row clearfix">
                  <?=$column1?>
                  <?=$column2?>
                </div>
              </div>
            </div>
            <?php } ?> -->
          </div>
          <div id="loader">
            <img src="<?=base_url()?>assets/images/spinner.gif" alt="Loading...">
          </div>
        </div>
      </section>
      <!-- End Services One -->

      <!-- Faq One -->
      <section class="faq-one style-three"></section>
      <!-- End Faq One -->

      <!-- Main Footer -->
      <?php $this->load->view('includes/footer_other'); ?>
    </div>
    <!-- End PageWrapper -->

    <?php $this->load->view('includes/js'); ?>
    <script>
      let loading = false;
      let offset = 0;
      
      localStorage.setItem('productCounter', 0)

      const loadData = () => {
        if (!loading) {
          loading = true;

          $('#loader').show(); // show loader
          $.ajax({
            type: 'GET',
            url: '<?=base_url()?>load-products',
            data: 'offset=' + offset,
            success: function (result) {
              const resp = $.parseJSON(result);
              if (resp.length > 0) {
                resp.forEach((el, index) => {
                  const img = el.image != '' && el.image != null ? '<?=PHOTO_DOMAIN?>products/' + el.image : '<?=base_url()?>assets/images/product_default.png';
                  const text = stripTags(el.product_desc);
                  const url = '<?=base_url()?>products/' + el.slug_url + '?select=' + el.uuid;

                  let column1 = ``;
                  let column2 = ``;

                  const counter = parseInt(localStorage.getItem('productCounter')) + 1;

                  localStorage.setItem('productCounter', counter);

                  if ((counter - 1) % 2 == 0) {
                    column1 = `<div class="data-block_one-image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="data-block_one-image">
                                  <img src="${img}" alt="${el.title}" />
                                </div>
                              </div>`;
                    
                    column2 = `<div class="data-block_one-content-column col-lg-6 col-md-12 col-sm-12">
                                  <div class="data-block_one-content">
                                    <div class="data-block_one-number">${counter.toString().padStart(2,'0')}</div>
                                    <h3 class="data-block_one-title">${el.title}</h3>
                                    <div class="data-block_one-text">${truncateText(text,179)}</div>
                                    <ul class="data-block_one-list">`;
                                      el.features.forEach(feat => {
                                        column2 += `<li>
                                                      <i class="fa-solid fa-check fa-fw"></i>${feat.product_point}
                                                    </li>`;
                                      });

                        column2 += `</ul>
                                      <div class="data-block_one-button">
                                        <a href="${url}" class="template-btn btn-style-one">
                                          <span class="btn-wrap">
                                            <span class="text-one">VIEW IN DETAIL</span>
                                            <span class="text-two">VIEW IN DETAIL</span>
                                          </span>
                                        </a>
                                        <a href="${url}#request-demo-form" class="template-btn btn-style-two ms-lg-2 ms-md-2 ms-xl-2 ms-xxl-2">
                                          <span class="btn-wrap">
                                            <span class="text-one">REQUEST A DEMO</span>
                                            <span class="text-two">REQUEST A DEMO</span>
                                          </span>
                                        </a>
                                      </div>
                                    </div>
                                  </div>`;
                  } else {
                    column2 = `<div class="data-block_one-image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="data-block_one-image">
                                  <img src="${img}" alt="${el.title}" />
                                </div>
                              </div>`;
                    
                    column1 = `<div class="data-block_one-content-column col-lg-6 col-md-12 col-sm-12">
                                  <div class="data-block_one-content">
                                    <div class="data-block_one-number">${counter.toString().padStart(2,'0')}</div>
                                    <h3 class="data-block_one-title">${el.title}</h3>
                                    <div class="data-block_one-text">${truncateText(text,179)}</div>
                                    <ul class="data-block_one-list">`;
                                      el.features.forEach(feat => {
                                        column1 += `<li>
                                                      <i class="fa-solid fa-check fa-fw"></i>${feat.product_point}
                                                    </li>`;
                                      });

                        column1 += `</ul>
                                      <div class="data-block_one-button">
                                        <a href="${url}" class="template-btn btn-style-one">
                                          <span class="btn-wrap">
                                            <span class="text-one">VIEW IN DETAIL</span>
                                            <span class="text-two">VIEW IN DETAIL</span>
                                          </span>
                                        </a>
                                        <a href="${url}#request-demo-form" class="template-btn btn-style-two ms-lg-2 ms-md-2 ms-xl-2 ms-xxl-2">
                                          <span class="btn-wrap">
                                            <span class="text-one">REQUEST A DEMO</span>
                                            <span class="text-two">REQUEST A DEMO</span>
                                          </span>
                                        </a>
                                      </div>
                                    </div>
                                  </div>`;
                  }

                  const $html = $(`<div class="data-block_one item">
                                    <div class="data-block_one-inner">
                                      <div class="row clearfix">
                                        ${column1}
                                        ${column2}
                                      </div>
                                    </div>
                                  </div>`);

                  $('#product-list').append($html);

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

      const stripTags = (input) => {
        var doc = new DOMParser().parseFromString(input, 'text/html');
        return doc.body.textContent || "";
      }

      const truncateText = (text, maxLength) => {
        return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
      }
    </script>
  </body>
</html>