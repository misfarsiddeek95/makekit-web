<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
if (isset($CI)) {
	$CI->output->set_status_header('404');
	
	// Load required models and libraries
	$CI->load->model('Front_model');
	$CI->load->library('cart');
	$CI->load->library('session');
	
	$all_cats_cond = array(
	  array('field' => 'status', 'value' => 0)
	);
	$all_categories = $CI->Front_model->get_data_with_conditions_and_joins('categories', ['*'], [], $all_cats_cond);
	
	$commonData['categoryList'] = array();
	$commonData['categoryListForWidget'] = array();
	
	if (!empty($all_categories)) {
		foreach ($all_categories as $cat) {
			if ($cat->show_in_site == 1) $commonData['categoryList'][] = $cat;
			if ($cat->show_as_widget == 1) $commonData['categoryListForWidget'][] = $cat;
		}
	}
	$CI->load->vars($commonData);
	
	$activePage = '404';
	$pageMain = (object) array(
		'seo_title' => 'שגיאה 404 - העמוד לא נמצא – Makekit',
		'seo_description' => 'העמוד שחיפשת לא קיים במערכת.',
		'seo_keywords' => '404, error, makekit'
	);
}
?>
<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php if(isset($CI)) $CI->load->view('includes/head', array('activePage' => $activePage, 'pageMain' => $pageMain)); else echo '<title>404 Page Not Found</title>'; ?>
    </head>
    <body>
        <?php if(isset($CI)) $CI->load->view('includes/header'); ?>

        <main>
            <!-- Banner section -->
            <section class="banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center">
                            <h1>שגיאה 404 - העמוד לא נמצא</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Content section -->
            <section class="py-5">
                <div class="container text-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="mb-4">אופס! העמוד שחיפשת לא קיים.</h2>
                            <p class="mb-5 fs-5">
                                ייתכן שהעמוד הוסר, שמו השתנה, או שהוא אינו זמין כעת.
                                אנא בדוק את כתובת ה-URL שהזנת או חזור לדף הבית שלנו.
                            </p>
                            <a href="<?=isset($CI) ? base_url() : '/'?>" class="btn btn-primary btn-lg rounded-pill px-5 py-3">חזור לדף הבית</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php 
        if(isset($CI)) {
            $CI->load->view('includes/footer');
            $CI->load->view('includes/js');
        } 
        ?>
    </body>
</html>