<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'FrontController';
$route['404_override'] = 'FrontController';
$route['translate_uri_dashes'] = FALSE;

$route['classes'] = 'FrontController/makeitClasses';
$route['wholesale'] = 'FrontController/makeitWholesale';
$route['drawings'] = 'FrontController/makeitDrawings';
$route['contact-us'] = 'FrontController/makeitContactUs';

$route['product-category/(:any)'] = 'FrontController/makekitProducts/$1';
$route['product-category/(:any)/page'] = 'FrontController/makekitProducts/$1/1';
$route['product-category/(:any)/page/(:num)'] = 'FrontController/makekitProducts/$1/$2';

$route['product/(:any)'] = 'FrontController/makekitProductDetail/$1';
$route['cart'] = 'FrontController/makekitCart';
$route['student-registration'] = 'FrontController/makekitStudentRegistraion';
$route['load-intitute-circles'] = 'FrontController/loadInstituteCircles';
$route['load-subject-instructor'] = 'FrontController/loadSubjectInstructor';
$route['register-student'] = 'FrontController/registerStudent';

$route['add-to-cart'] = 'FrontController/addToCart';
$route['remove-cart-item'] = 'FrontController/removeCartItem';
$route['checkout'] = 'FrontController/checkout';

$route['signin'] = 'FrontController/signIn';
$route['logout'] = 'FrontController/logout';

# USER ACCOUNT RELATED
$route['my-account'] = 'FrontController/makekitMyAccount';
$route['my-account/orders'] = 'FrontController/myOrders';
$route['my-account/downloads'] = 'FrontController/myDownloads';
$route['my-account/edit-address'] = 'FrontController/myAddress';
$route['my-account/save-address'] = 'FrontController/saveAddress';
$route['my-account/edit-account'] = 'FrontController/editAccount';
$route['my-account/makekit-questionnaires'] = 'FrontController/makeKitQuestionairePage';
$route['my-account/questionnaires'] = 'FrontController/makeKitQuestionaire';
$route['save-answers'] = 'FrontController/saveAnswers';