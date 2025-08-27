<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontController extends Base_Controller {
	public function __construct() {
    parent::__construct();
    $this->clear_cache();
    $this->load->model('Front_model');

    $this->load->library('cart'); // load cart

    $cate_cond = array(
      array('field' => 'show_in_site', 'value' => 1),
    );
    $commonData['categoryList'] = $this->Front_model->get_data_with_conditions_and_joins('categories',['*'],[],$cate_cond);
    $this->load->vars($commonData);
  }

  function clear_cache(){
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
  }
	
  # home page
  public function index() {
    $data['activePage'] = 'HOME';

    $data['pageMain'] = $this->Front_model->fetchPage(1);
    $data['pageSlider'] = $this->Front_model->fetchPage(2);
    $data['pageSliderImages'] = $this->Front_model->fetchPageManyPics(2);
    $data['pageWantToGuide'] = $this->Front_model->fetchPage(3);
    $data['pageNewOnTheSite'] = $this->Front_model->fetchPage(4);

    $data['latestProducts'] = $this->Front_model->get_filtered_products(null,'date',8,0);

    $this->load->view('index', $data);
  }

  # about us page
  public function makeitClasses() {
    $data['activePage'] = 'CLASS';
    
    $data['pageMain'] = $this->Front_model->fetchPage(5);
    $data['classContentList'] = $this->Front_model->fetchPageManyPics(6);

    $this->load->view('classes', $data);
  }

  # services page
  public function makeitWholesale() {
    $data['activePage'] = 'WHOLESALE';

    $data['pageMain'] = $this->Front_model->fetchPage(7);
    $data['wholesaleContentList'] = $this->Front_model->fetchPageManyPics(8);
    $this->load->view('wholesale', $data);
  }

  public function makeitDrawings() {
    $data['activePage'] = 'DRAWINGS';

    $data['pageMain'] = $this->Front_model->fetchPage(9);
    $data['drawinList'] = $this->Front_model->fetchPageManyPics(10);
    $this->load->view('drawings', $data);
  }

  /* public function makekitProducts($slug, $page = 0) {
    $orderby = $this->input->get('orderby'); // From URL like ?orderby=POPULAR

    $selectedCate = $this->Front_model->get_category_by_slug($slug);
    if (!$selectedCate) show_404();

    $limit = 4;
    $offset = ($page > 0) ? ($page - 1) * $limit : 0;

    $products = $this->Front_model->get_filtered_products($selectedCate->cate_id, $orderby, $limit, $offset);
    $total_products = $this->Front_model->count_products_by_category($selectedCate->cate_id, $orderby);

    // Pagination Config
    $this->load->library('pagination');
    $config['base_url'] = base_url("product-category/{$slug}/page");
    $config['total_rows'] = $total_products;
    $config['per_page'] = $limit;
    $config['uri_segment'] = 4; // "page" segment (i.e., product-category/slug/page/X)
    $config['use_page_numbers'] = TRUE;

    // Ensure ?orderby=xyz is preserved
    $config['reuse_query_string'] = TRUE;
    $config['suffix'] = ($orderby) ? '?orderby=' . $orderby : '';
    $config['first_url'] = base_url("product-category/{$slug}") . $config['suffix'];

    $this->pagination->initialize($config);

    $data = [
        'activePage' => 'PRODUCT',
        'pageMain' => [],
        'selectedCate' => $selectedCate,
        'products'     => $products,
        'pagination'   => $this->pagination->create_links(),
    ];

    $this->load->view('products', $data);
  } */

  # Products
  public function makekitProducts($slug, $page = 1) {

    $orderby = $this->input->get('orderby'); // LOW_TO_EXP, EXP_TO_LOW, etc.

    // Load category
    $selectedCate = $this->Front_model->get_category_by_slug($slug);
    if (!$selectedCate) show_404();

    if ($page === null || !is_numeric($page) || $page < 1) {
      $page = 1;
    }

    // Pagination setup
    $limit = 12; // products per page
    $offset = ($page - 1) * $limit;

    // Get products
    $products = $this->Front_model->get_filtered_products($selectedCate->cate_id, $orderby, $limit, $offset);
    $total_products = $this->Front_model->count_products_by_category($selectedCate->cate_id, $orderby);

    // Prepare pagination
    $this->load->library('pagination');
    $config['base_url'] = base_url("product-category/{$slug}/page"); // NOTE: No query string here
    $config['total_rows'] = $total_products;
    $config['per_page'] = $limit;
    $config['uri_segment'] = 4;
    $config['use_page_numbers'] = TRUE;
    $config['reuse_query_string'] = TRUE;

    // --- Bootstrap Pagination Styling ---
    $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = false; // hide "First"
    $config['last_link'] = false;  // hide "Last"

    $config['next_link'] = '←'; // right arrow ››
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '→'; // left arrow ‹‹
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    $start_result = ($total_products > 0) ? ($offset + 1) : 0;
    $end_result = min($offset + $limit, $total_products);
    // $result_text = "Showing {$start_result}–{$end_result} of {$total_products} results";
    $result_text = "מציג {$start_result}–{$end_result} מתוך {$total_products} תוצאות";

    // student available points.
    $isLoggedIn = $this->session->userdata('user_logged_in') != null;

    if ($isLoggedIn) {
      $userId = $this->session->userdata['user_logged_in']['user_id'];
    
      $_conditions = array(
        array('field' => 'eu.id', 'value' => $userId),
      );
  
      $loggedUser = $this->Front_model->get_data_with_conditions_and_joins('external_users eu', ['points_earned', 'points_spent'], [], $_conditions, 1);
      
      $availablePoints = (int)$loggedUser->points_earned - (int)$loggedUser->points_spent;
    }

    $data = [
      'activePage'    => 'PRODUCT',
      'pageMain'      => [],
      'selectedCate'  => $selectedCate,
      'products'      => $products,
      'pagination'    => $this->pagination->create_links(),
      'result_text'   => $result_text,
      'is_logged_id'  => $isLoggedIn,
      'available_points'  => $isLoggedIn ? $availablePoints : 'NOT_LOGGED_IN'
    ];

    /* print '<pre>';
    print_r($data);
    exit; */

    $this->load->view('products', $data);
  }
  
  # product detail
  public function makekitProductDetail($slugUrl) {
    $data['activePage'] = 'PRODUCT';
    $data['pageMain'] = [];


    $productDetail = $this->Front_model->product_detail($slugUrl);

    if (!$productDetail) {
      redirect(base_url());
    }

    $data['productDetail'] = $productDetail;
    $data['selectedCate'] = $productDetail->cate_url;
    $data['relatedProducts'] = $this->Front_model->get_filtered_products($productDetail->cate_id, 'related_products', 4, 0, $productDetail->id);

    /* print '<pre>';
    print_r($productDetail);
    exit; */

    $this->load->view('product_detail', $data);
  }

  # contact us page
  public function makeitContactUs() {
    $data['activePage'] = 'CONTACT';

    $data['pageMain'] = $this->Front_model->fetchPage(11);
    $data['pageEmail'] = $this->Front_model->fetchPage(12);
    $data['pageWhatsApp'] = $this->Front_model->fetchPage(13);
    $data['pagePhone'] = $this->Front_model->fetchPage(14);
    $data['pageAddress'] = $this->Front_model->fetchPage(15);

    $this->load->view('contact', $data);
  }

  # Cart
  public function makekitCart() {
    $data['activePage'] = 'CART';
    $data['pageMain'] = $this->Front_model->fetchPage(16);

    $data['delCharge'] = $this->getDelCharge();

    $this->load->view('cart', $data);
  }

  private function getDelCharge() {
    $_fields = array('initial_charge');
    $_order = array(
      array('field' => 'charges_id', 'order_by_type' => 'DESC'),
    );
    $delCharge = $this->Front_model->get_data_with_conditions_and_joins('delivery_charges', $_fields, [], [], 1, $_order);
    return !empty($delCharge) ? $delCharge->initial_charge : 50;
  }

  # sign in
  public function signIn() {
    try {
      $username = ($this->input->post('username'));
      $password = $this->input->post('password');

      $_fields = array('eu.id as user_id','eu.user_type', 'eu.name as person_name', 'eu.status', 'eu.password');
      
      $_conditions = array(
        array('field' => 'eu.parent_email', 'value' => $username),
      );

      $result = $this->Front_model->get_data_with_conditions_and_joins('external_users eu', $_fields, [], $_conditions, 1);

      if ($result) {
        if ($result->user_type == '' || $result->user_type == null) {
          throw new Exception("Invalid user.");
        }

        if($result->status==1 && password_verify($password, $result->password)) {
          $log_array = array(
            'user_id' => $result->user_id,
            'name' => $result->person_name,
            'user_type' => $result->user_type
          );

          $this->session->set_userdata('user_logged_in', $log_array);
          $message = array("status" => "success","message" => "logged in successfully", 'redirect_url' => 'my-account');

        } else if(!password_verify($password, $result->password)){
          $message = array("status" => "error","message" => "סיסמה לא חוקית. נסה שוב.");
        }else{
          $message = array("status" => "error","message" => "משתמש חסום. אנא צור קשר עם מנהל המערכת.");
        }
      } else {
        $message = array("status"=>"error","message"=>"האימייל לא מוכר. בדוק שוב או נסה להשתמש בשם משתמש.");
      }

    } catch (Exception $ex) {
      $message = array("status"=>"error","message"=>$ex->getMessage());
    }
    echo json_encode($message);
  }

  # Student registration
  public function makekitStudentRegistraion() {
    $data['activePage'] = 'STUDENT-REGISTRATION';
    $data['pageMain'] = $this->Front_model->fetchPage(18);

    $data['loadInstitutes'] = $this->Front_model->getAll('class');
    $data['loadCities'] = $this->Front_model->getAll('cities');
    $this->load->view('student_registration', $data);
  }

  public function loadInstituteCircles() {
    try {
      $instituteId = $this->input->get('institute_id');
      
      if(!$instituteId) throw new Exception("משהו לא השתבש בהעברת תעודת הזהות של המוסד");

      $_fields = array('s.sub_id','s.subject_name');
      $_joins = array(
        array('table' => 'subjects s', 'on' => 's.sub_id=cs.subject_id', 'type' => 'left'),
      );
      $_conditions = array(
        array('field' => 'cs.class_id', 'value' => $instituteId),
      );
      
      $result = $this->Front_model->get_data_with_conditions_and_joins('class_subjects cs',$_fields,$_joins,$_conditions);
      
      $message = array("status" => "success","data" => $result);

    } catch (Exception $ex) {
      $message = array("status" => "error","message" => $ex->getMessage());
    }
    echo json_encode($message);
  }

  public function loadSubjectInstructor() {
    try {
      $instituteId = $this->input->get('institute_id');
      $subjectId = $this->input->get('subject_id');
      
      if(!$instituteId || !$subjectId) throw new Exception("משהו לא השתבש בהעברת מזהה המכון / מעגל.");

      $_fields = array('su.user_id as teacher_id', 'CONCAT_WS(" ", su.fname, su.lname) AS teacher_name');
      $_joins = array(
        array('table' => 'staff_users su', 'on' => 'su.user_id=sa.teacher_id', 'type' => 'left'),
      );
      $_conditions = array(
        array('field' => 'sa.class_id', 'value' => $instituteId),
        array('field' => 'sa.subject_id', 'value' => $subjectId),
      );
      
      $result = $this->Front_model->get_data_with_conditions_and_joins('subject_assign sa',$_fields,$_joins,$_conditions);
      
      $message = array("status" => "success","data" => $result);

    } catch (Exception $ex) {
      $message = array("status" => "error","message" => $ex->getMessage());
    }
    echo json_encode($message);
  }

  public function registerStudent() {
    try {
      $user_id = $this->input->post('user_id');
      $add_id = $this->input->post('add_id');
      $name = $this->input->post('name');
      $institute_id = $this->input->post('institute_id');
      $subject_id = $this->input->post('subject_id');
      $instructor_id = $this->input->post('instructor_id');

      $parent_name = $this->input->post('parent_name');
      $parent_phone = $this->input->post('parent_phone');

      $address = '';
      $city = $this->input->post('city');

      $parent_email = $this->input->post('parent_email'); // username
      $password= trim($this->input->post('password'));

      $date = date("Y-m-d H:i:s");

      $user_array = array(
        'name' => $name,
        'user_type' => 3,
        'role_number' => NULL,
        'city_id' => $city,
        'class_id' => $institute_id,
        'subject_id' => $subject_id,
        'instructor_id' => $instructor_id,
        'gender' => NULL,
        'parent_name' => $parent_name,
        'parent_phone' => $parent_phone,
        'status' => 1
      );

      $addr_array = array(
        'fname' => $name,
        'lname' => null,
        'address' => $address,
        'city_id' => $city,
        'phone' => $parent_phone,
        'add_type' => 0,
        'user_type' => 2, // student / external users
        'status' => 1,
      );

      if ($password!='') {
        $user_array['password'] = $this->get_encrypted_password($password);
      }

      if (isset($_POST['parent_email'])) {
        $parent_email = $this->input->post('parent_email');
        $checkuser = $this->Front_model->checkField('external_users','parent_email',$parent_email);
        if ($checkuser) {
          throw new Exception("שם משתמש כבר קיים. אנא נסה אחר.");
        }else{
          $user_array['parent_email'] = $parent_email;
        }
      }

      if ($user_id == 0 && $add_id==0) {
        $user_array['created_at'] = $date;
        $type = 'save';
        $msg = 'רישום הסטודנטים הסתיים בהצלחה.';
      }else if ($user_id != 0 && $add_id!=0) {
        $type = 'update';
        $msg = 'תלמיד עודכן בהצלחה.';
      }else{
        throw new Exception("משהו השתבש. אנא נסה שוב.");
      }

      $returnedUserId = $this->Front_model->register_external_user($user_id,$add_id,$user_array,$addr_array);

      $message = array("status" => "success","message" => $msg);
        
    } catch (Exception $ex) {
      $message = array("status" => "error","message" => $ex->getMessage());
    }
    echo json_encode($message);
  }

  /* public function addToCart() {
    try {
      $addFrom = $this->input->post('added_from');
      $productId = $this->input->post('product_id');
      $qty = $this->input->post('qty');

      $productDetail = $this->Front_model->get_product_for_cart($productId, $qty);

      if (!$productDetail) {
        throw new Exception("Product is not available.");
      }

      if ($qty > $productDetail->qty) {
        throw new Exception("Requested quantity is not available.");
      }

      $productPrice = $productDetail->price;

      // calculate discount price.
      if (isset($productDetail->discount_value) && in_array($productDetail->discount_type, [0, 1])) {
        switch ($productDetail->discount_type) {
          case 0: // flat rate
            $productPrice -= $productDetail->discount_value;
            break;

          case 1: // percentage
            $productPrice -= $productPrice * ($productDetail->discount_value / 100);
            break;
        }
      }

      // Round and sanitize final price
      $productPrice = max(0, round($productPrice, 2));
      
      $item = array(
        'id' => $productDetail->id,
        'qty' => $qty,
        'price' => $productPrice,
        'name' => $productDetail->name
      );

      if ($this->cart->insert($data)) {
        $message = array('status' => 'success', 'message' => 'Item added to the cart successfully.');
      }

    } catch (Exception $ex) {
      $message = array('status' => 'error', 'message' => $ex->getMessage());
    }
    echo json_encode($message);
  } */

  public function addToCart() {
    try {
      $items = $this->input->post('items'); // for bulk update
      $productId = $this->input->post('product_id'); // for single add
      $qty = (int)$this->input->post('qty');
      
      // CASE 1: Bulk update (from cart page)
      if (!empty($items) && is_array($items)) {
        $htmlPrice = []; // initiation of the html show price list to show instantly when update.
        $htmlSubtotal = []; // initialization of the subtotal of cart item after updated.

        foreach ($items as $prodId => $newQty) {
          $newQty = (int)$newQty;

          if ($newQty <= 0) {
            // remove item from cart if qty is 0
            foreach ($this->cart->contents() as $rowId => $item) {
              if ($item['id'] == $prodId) {
                $this->cart->remove($rowId);
                break;
              }
            }
            continue;
          }

          $productDetail = $this->Front_model->get_product_for_cart($prodId, $newQty);
          if (!$productDetail) continue;

          if ($newQty > $productDetail->qty) {
            continue; // Skip if qty exceeds stock
          }

          // apply discount
          $productPrice = $productDetail->price;
          $originalPrice = $productPrice;

          $hasDiscount = isset($productDetail->discount_value) && in_array($productDetail->discount_type, [0, 1]);

          if ($hasDiscount) {
            switch ($productDetail->discount_type) {
              case 0: $productPrice -= $productDetail->discount_value; break;
              case 1: $productPrice -= $productPrice * ($productDetail->discount_value / 100); break;
            }
          }
          
          // round and sanitize
          $productPrice = max(0, round($productPrice, 2));
          $originalPrice = round($originalPrice, 2);

          // update cart item
          foreach ($this->cart->contents() as $rowId => $item) {
            if ($item['id'] == $prodId) {
              $this->cart->update([
                'rowid' => $rowId,
                'qty' => $newQty,
                'price' => $productPrice,
                'options' => [
                  'original_price' => $originalPrice,
                  'has_discount' => $hasDiscount ? 1 : 0,
                  'photo' => $productDetail->photo_path ? PHOTO_DOMAIN.'products/'.$productDetail->photo_path.'-std.'.$productDetail->extension : null,
                  'org_available_qty' => $productDetail->qty,
                ]
              ]);
              break;
            }
          }

          // to show instantly when update the cart items from the cart page.
          $updatedPriceShow = '';
          $updatedSubtotal = '';
          if (!empty($hasDiscount) && $hasDiscount) {
            $updatedPriceShow .= '<del>' . $this->cur . number_format($originalPrice, 2) . '</del> ';
          }
          $updatedPriceShow .= $this->cur . number_format($productPrice, 2);

          $htmlPrice[$rowId] = $updatedPriceShow;

          $calculateSubTotal = floatval($productPrice) * $newQty;

          $htmlSubtotal[$rowId] = $this->cur . number_format($calculateSubTotal, 2);
        }

        $message = ['status' => 'success', 'message' => 'Cart updated successfully.', 'total_item_count' => $this->cart->total_items(), 'price_html' => $htmlPrice, 'subtotal_html' => $htmlSubtotal, 'cart_total' => round($this->cart->total(),2), 'cart_total_html' => $this->cur . number_format($this->cart->total(), 2)];
      }
        // CASE 2: Single item add/update (from product page)
      elseif ($productId && $qty) {
        if ($qty <= 0) throw new Exception("Invalid quantity.");

        // check if item exists
        $existingRowId = null;
        $existingQty = 0;
        foreach ($this->cart->contents() as $rowId => $item) {
          if ($item['id'] == $productId) {
            $existingRowId = $rowId;
            $existingQty = (int)$item['qty'];
            break;
          }
        }

        $finalQty = $qty + $existingQty;

        $productDetail = $this->Front_model->get_product_for_cart($productId, $finalQty);
        if (!$productDetail) throw new Exception("Product not available.");

        if ($finalQty > $productDetail->qty) {
          throw new Exception("Only {$productDetail->qty} items available.");
        }

        $productPrice = $productDetail->price;
        $originalPrice = $productPrice;

        $hasDiscount = isset($productDetail->discount_value) && in_array($productDetail->discount_type, [0, 1]);

        if ($hasDiscount) {
          switch ($productDetail->discount_type) {
            case 0: $productPrice -= $productDetail->discount_value; break;
            case 1: $productPrice -= $productPrice * ($productDetail->discount_value / 100); break;
          }
        }
        // round and sanitize
        $productPrice = max(0, round($productPrice, 2));
        $originalPrice = round($originalPrice, 2);

        if ($existingRowId) {
          $this->cart->update([
            'rowid' => $existingRowId,
            'qty' => $finalQty,
            'price' => $productPrice,
            'options' => [
              'original_price' => $originalPrice,
              'has_discount' => $hasDiscount ? 1 : 0,
              'photo' => $productDetail->photo_path ? PHOTO_DOMAIN.'products/'.$productDetail->photo_path.'-std.'.$productDetail->extension : null,
              'org_available_qty' => $productDetail->qty,
            ]
          ]);
        } else {
          $this->cart->insert([
            'id' => $productDetail->id,
            'qty' => $qty,
            'price' => $productPrice,
            'name' => $productDetail->name,
            'options' => [
              'original_price' => $originalPrice,
              'has_discount' => $hasDiscount ? 1 : 0,
              'photo' => $productDetail->photo_path ? PHOTO_DOMAIN.'products/'.$productDetail->photo_path.'-std.'.$productDetail->extension : null,
              'org_available_qty' => $productDetail->qty,
            ]
          ]);
        }

        $message = ['status' => 'success', 'message' => 'Item added/updated in cart.', 'total_item_count' => $this->cart->total_items(), 'cart_total' => number_format($this->cart->total(),2), 'cart_total_html' => $this->cur . number_format($this->cart->total(), 2)];
      } else {
        throw new Exception("Invalid input.");
      }
    } catch (Exception $ex) {
      $message = ['status' => 'error', 'message' => $ex->getMessage()];
    }
    echo json_encode($message);
  }

  public function removeCartItem() {
    $rowId = $this->input->post('rowId');

    if ($rowId) {
      $this->cart->remove($rowId);
      $message = ['status' => 'success', 'message' => 'Item removed from cart.', 'total_item_count' => $this->cart->total_items(), 'cart_total' => number_format($this->cart->total(),2), 'cart_total_html' => $this->cur . number_format($this->cart->total(), 2)];
    } else {
      $message = ['status' => 'error', 'message' => 'Invalid request.'];
    }

    echo json_encode($message);
  }

  // logout
  public function logout() {
    if($this->session->userdata('user_logged_in') != null){
      $sess_array = array(
        'user_id' => '',
        'name' => '',
        'user_type' => '',
      );
      $this->session->unset_userdata($sess_array);
      $this->session->sess_destroy();
      $this->clear_cache();
      redirect(base_url());
    }
  }

  // USER ACCOUNT - SECTION
  
  # My account
  public function makekitMyAccount() {
    $data['activePage'] = 'MY-ACCOUNT';
    $data['pageMain'] = $this->Front_model->fetchPage(17);

    if($this->session->userdata('user_logged_in')==null){
      $this->load->view('login', $data);
    } else {
      $data['activeUserPage'] = 'MY_ACCOUNT';

      $this->load->view('my_account', $data);
    }
  }

  // check logged in or not
  private function check_login_redirect() {
    if ($this->session->userdata('user_logged_in') === null) {
      redirect(base_url('my-account/'));
      exit;
    }
  }

  # My orders
  public function myOrders() {
    $this->check_login_redirect();

    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'MY_ORDERS';
    $data['pageMain'] = $this->Front_model->fetchPage(19);

    $userId = $this->session->userdata['user_logged_in']['user_id'];

    $_fields = array('o.order_code','o.payment_status', 'o.payment_method', 'o.cart_total', 'o.order_status', 'o.order_date');
   
    $_conditions = array(
      array('field' => 'o.cust_id', 'value' => $userId),
    );
    
    $data['orders'] = $this->Front_model->get_data_with_conditions_and_joins('orders o',$_fields,[],$_conditions);

    $this->load->view('my_orders', $data);
  }

  public function myDownloads() {
    $this->check_login_redirect();

    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'MY_DOWNLOADS';
    $data['pageMain'] = $this->Front_model->fetchPage(20);

    $this->load->view('my_downloads', $data);
  }

  public function myAddress() {
    $this->check_login_redirect();

    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'MY_ADDRESS';
    $data['pageMain'] = $this->Front_model->fetchPage(21);

    $data['loadCities'] = $this->Front_model->getAll('cities');

    $userId = $this->session->userdata['user_logged_in']['user_id'];

    list($data['primaryAddress'], $data['secondaryAddress']) = $this->Front_model->my_address($userId);

    $this->load->view('my_address', $data);
  }

  public function getSingleAddress() {
    $addType = $this->input->post('addType');
    $addId = $this->input->post('addId');
    $userId = $this->session->userdata['user_logged_in']['user_id'];

    $result = $this->Front_model->fetch_single_address($addType,$userId,$addId);

    echo json_encode($result);
  }

  public function saveAddress() {
    try {
      $this->check_login_redirect();

      $userId = $this->session->userdata['user_logged_in']['user_id'];

      $add_id = $this->input->post('add_id');
      $add_type = $this->input->post('add_type');

      $firstName = $this->input->post('firstName');
      $lastName = $this->input->post('lastName');
      $company = $this->input->post('company');
      $address = $this->input->post('address');
      $zip = $this->input->post('zip');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $email = $this->input->post('email');

      $_arr = array(
        'fname' => $firstName,
        'lname' => $lastName,
        'address' => $address,
        'city_id' => $city,
        'phone' => $phone ? $phone : null,
        'postal_code' => $zip,
        'add_type' => $add_type == 'PRIMARY' ? 0 : 1,
        'company' => $company ? $company : null,
        'user_id' => $userId,
        'status' => 1,
        'user_type' => 2,
        'email' => $email,
      );

      if ($add_id == 0) {
        $type = 'save';
        $msg = 'הכתובת נשמרה בהצלחה.';
      } {
        $type = 'update';
        $msg = 'הכתובת עודכנה בהצלחה.';
      }

      $is_submitted = $this->Front_model->upsert($add_id,$_arr,'addresses','add_id');

      $message = array('status' => 'success', 'message' => $msg);

    } catch (Exception $ex) {
      $message = array('status' => 'error', 'message' => $ex->getMessage());
    }
    echo json_encode($message);
  }

  public function editAccount() {
    $this->check_login_redirect();

    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'EDIT_ACCOUNT';
    $data['pageMain'] = $this->Front_model->fetchPage(22);

    $this->load->view('edit_account', $data);
  }

  public function makeKitQuestionairePage() {
    $this->check_login_redirect();

    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'MAKEKIT_QUESTIONAIRE';
    $data['pageMain'] = $this->Front_model->fetchPage(23);

    $userId = $this->session->userdata['user_logged_in']['user_id'];

    $user_condition = array(
      array('field' => 'id', 'value' => $userId),
    );

    $studentRecord = $this->Front_model->get_data_with_conditions_and_joins('external_users', ['class_id', 'subject_id'],[],$user_condition,1);

    if (!$studentRecord) {
      redirect(base_url('my-account'));
    }

    $data['questionaires'] = $this->Front_model->questionaires($studentRecord->class_id,$studentRecord->subject_id,$userId);

    $data['summary'] = $this->Front_model->get_student_summary($userId);

    /* print '<pre>';
    print_r($data);
    exit; */

    $this->load->view('questionaire_page', $data);
  }

  public function makeKitQuestionaire() {
    $this->check_login_redirect();

    $paperId = $this->input->get('formId');

    if (!$paperId) {
      redirect(base_url('my-account'));
    }

    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'MAKEKIT_QUESTIONAIRE';
    $data['pageMain'] = $this->Front_model->fetchPage(23);

    $userId = $this->session->userdata['user_logged_in']['user_id'];

    $user_condition = array(
      array('field' => 'id', 'value' => $userId),
    );

    $studentRecord = $this->Front_model->get_data_with_conditions_and_joins('external_users', ['class_id', 'subject_id'],[],$user_condition,1);

    if (!$studentRecord) {
      redirect(base_url('my-account'));
    }

    $paperId = base64_decode($paperId);

    $paper_detail = $this->Front_model->makekit_questions($paperId);

    $attempt_id = $this->Front_model->start_attempt($userId, $paper_detail['paper_id']);

    $data['attempt_id'] = $attempt_id;
    $data['paper_detail'] = $paper_detail;


    if (!$attempt_id) {
      $data['paper_detail'] = [];
      $data['attempt_id'] = 0;
    }
    
    /* print '<pre>';
    print_r($data);
    exit; */

    $this->load->view('make_it_currency_questionaire', $data);
  }

  public function saveAnswers() {
    try {
      $attempt_id = $this->input->post('attempt_id');
      $paper_id   = $this->input->post('paper_id');
      $answers    = $this->input->post('q'); // question_id => answer_id

      if (!$attempt_id || !$paper_id || !is_array($answers)) {
        throw new Exception("Invalid submission.");
      }

      $_condition = array(
        array('field' => 'paper_id', 'value' => $paper_id),
      );
  
      $score_value = $this->Front_model->get_data_with_conditions_and_joins('question_paper_main', ['score_per_mcq', 'score_per_structure', 'score_per_essay'],[],$_condition,1);

      $student_answers = [];

      $total_awarded_marks = 0;

      $userId = $this->session->userdata['user_logged_in']['user_id'];
      $user_condition = array(
        array('field' => 'id', 'value' => $userId),
      );
      $studentRecord = $this->Front_model->get_data_with_conditions_and_joins('external_users', ['points_earned'],[],$user_condition,1);

      foreach ($answers as $que => $ans) {
        $is_correct = $this->Front_model->is_correct_answer($que, $ans);
        $mark_awarded = $is_correct ? $score_value->score_per_mcq : 0;

        $_data = array(
          'attempt_id' => $attempt_id,
          'question_id' => $que,
          'selected_option' => $ans,
          'is_correct' => $is_correct,
          'marks_awarded' => $mark_awarded,
          'answered_at' => date('Y-m-d H:i:s')
        );

        $student_answers[] = $_data;

        $total_awarded_marks += $mark_awarded;
      }

      $answered = $this->Front_model->save_answer($student_answers);

      if ($answered) {
        $update_attempts = [
          'end_time' => date('Y-m-d H:i:s'),
          'score' => $total_awarded_marks,
          'status' => 'completed'
        ];

        $this->Front_model->update('attempt_id', $attempt_id, 'student_attempts', $update_attempts);

        $score_data = [
          'student_id' => $userId,
          'paper_id' => $paper_id,
          'attempt_id' => $attempt_id,
          'points' => $total_awarded_marks,
          'earned_date' => date('Y-m-d H:i:s')
        ];

        $this->Front_model->insert_me('student_points', $score_data);

        // update the score in the students table.
        $actualTotalScore = $this->Front_model->get_total_score($userId);
        $u_data = [
          'points_earned' => $actualTotalScore
        ];
        $this->Front_model->update('id', $userId, 'external_users', $u_data);

        $message = array('status' => 'success', 'message' => 'Successfully submitted the answers.');
      }
      
    } catch (Exception $ex) {
      $message = array('status' => 'error', 'message' => $ex->getMessage());
    }

    echo json_encode($message);
  }

  public function checkout() {
    $data['activePage'] = 'MY-ACCOUNT';
    $data['activeUserPage'] = 'CHECKOUT';
    $data['pageMain'] = $this->Front_model->fetchPage(24);

    $data['loadCities'] = $this->Front_model->getAll('cities');
    $data['delCharge'] = $this->getDelCharge();

    $isLoggedIn = $this->session->userdata('user_logged_in') != null;
    if ($isLoggedIn) {
      $userId = $this->session->userdata['user_logged_in']['user_id'];
      list($data['primaryAddress'], $data['secondaryAddress']) = $this->Front_model->my_address($userId);
    } else {
      $data['primaryAddress'] = [];
      $data['secondaryAddress'] = [];
    }
    
    $this->load->view('checkout', $data);
  }

  public function applyCoupon() {
    try {
        $coupon = $this->input->post('coupon');
        if ($coupon != '') {
            $result = $this->Front_model->checkCouponCode($coupon);
            if ($result) {
                if ($this->session->userdata('coupons') != null) {
                    $coupon_arr = array(
                        'co_id' => '', 
                        'coupon_type' => '', 
                        'coupon_amount' => '', 
                    ); 
                    $this->session->unset_userdata('coupons',$coupon_arr);
                }
                $coupon_arr = array(
                    'co_id' => $result->cp_id, 
                    'coupon_type' => $result->coupon_type, 
                    'coupon_amount' => $result->coupon_amount, 
                );        
                $this->session->set_userdata('coupons', $coupon_arr);      
                if ($result->coupon_type == 0) {
                  $message = 'הרווחת הנחה של '.$this->cur.''.($result->coupon_amount+0).' מהסכום הכולל שלך.';
                } else {
                  $message = 'הרווחת הנחה של '.($result->coupon_amount+0).'% מהסכום הכולל שלך.';
                }
              
                $msg = array('status' => 'success', 'message' => $message);                          
            }else{
                throw new Exception("Coupon code is not valid.");
            }
        }else{
            throw new Exception("Coupon code should not be empty.");
        }
    } catch (Exception $ex) {
        $msg = array('status' => 'error', 'message' => $ex->getMessage());       
    }
    echo json_encode($msg);
  }

  // not completed.
  public function placeOrder() {
    try {
      $orderId = 0;
      if ($this->session->userdata('user_logged_in') != null) {
        $cust_id = $this->session->userdata['user_logged_in']['user_id'];
      }else{
        $cust_id = 0;
      }
      
      $lasTOredered = $this->Front_model->get_last_order();

      $cartProducts = [];
      if ($this->cart->contents()) {
        $cartProducts = $this->cart->contents();
      }

      if (empty($cartProducts)) {
        throw new Exception("אין מוצרים זמינים בעגלה לקופה.");
      }

      $shippingMethod = $this->input->post('shipping');
      $paymentMethod = $this->input->post('paymentMethod');

      $firstName = $this->input->post('firstName');
      $lastName = $this->input->post('lastName');
      $company = $this->input->post('company');
      $address = $this->input->post('address');
      $zip = $this->input->post('zip');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $email = $this->input->post('email');
      $note = $this->input->post('note');

      $ip = $this->input->ip_address();

      $shippingAddressCheck = isset($_POST['shippingAddressCheck']);

      $shippingArr = [];
      if ($shippingAddressCheck) {
        $sFname = $this->input->post('shipping_first_name');
        $sLname = $this->input->post('shipping_last_name');
        $sCompany = $this->input->post('shipping_company');
        $sAddress = $this->input->post('shipping_address');
        $sZip = $this->input->post('shipping_zip');
        $sCity = $this->input->post('shipping_city');
      }

      if ($lasTOredered) {
        $order_code = '#'.str_pad($lasTOredered->order_id + 1, 8, "0", STR_PAD_LEFT);
      } else {
        $order_code = '#00000001';
      }
       
      $date = date('Y-m-d H:i:s');

      // delivery charge
      $delCharge = [];
      if($shippingMethod == 'DEL') {
        $_fields = array('initial_charge','charges_id');
        $_order = array(
          array('field' => 'charges_id', 'order_by_type' => 'DESC'),
        );
        $delCharge = $this->Front_model->get_data_with_conditions_and_joins('delivery_charges', $_fields, [], [], 1, $_order);
      }

      $totalwithcoupon = 0;
      if($this->session->userdata('coupons') != null){ 
        $coup_id = $this->session->userdata['coupons']['co_id'];
        if ($this->session->userdata['coupons']['coupon_type'] == 0) {
          $coup_amount = floatval($this->session->userdata['coupons']['coupon_amount']+0);
          $totalwithcoupon = $this->cart->total() - $coup_amount;
        }else{
          $coup_amount = floatval((($this->session->userdata['coupons']['coupon_amount']+0) / 100) * $this->cart->total());
          $totalwithcoupon = floatval($this->cart->total() - $coup_amount);
        }
      }else{
        $coup_id = 0;
        $coup_amount = 0;
        $totalwithcoupon = floatval($this->cart->total());
      }

      if ($delCharge) {
        $cartTotal = round($totalwithcoupon + $delCharge->initial_charge, 2);
      } else {
        $cartTotal = round($totalwithcoupon, 2);
      }

      // city related
      $selectedCity = $shippingAddressCheck ? $sCity : $city;

      $city_condition = array(
        array('field' => 'city_id', 'value' => $selectedCity),
      );
      $cityRelated = $this->Front_model->get_data_with_conditions_and_joins(
        'cities',
        ['reg_id', 'country_id'],
        [],
        $city_condition, // was $_condition by mistake
        1
      );

      if ($shippingAddressCheck) {
        $addr_arr = array(
          'fname'       => $sFname, 
          'lname'       => $sLname, 
          'address'     => $sAddress, 
          'city_id'     => $sCity, 
          'reg_id'      => $cityRelated->reg_id,
          'country_id'  => $cityRelated->country_id, 
          'phone'       => $phone,       // usually stays billing phone
          'email'       => $email,       // usually stays billing email
          'postal_code' => $sZip,
          'add_type'    => 3, 
          'company'     => $sCompany,
          'user_id'     => $cust_id,
          'status'      => 1, 
          'user_type'   => 2
        );
      } else {
        $addr_arr = array(
          'fname'       => $firstName, 
          'lname'       => $lastName, 
          'address'     => $address, 
          'city_id'     => $city, 
          'reg_id'      => $cityRelated->reg_id,
          'country_id'  => $cityRelated->country_id, 
          'phone'       => $phone, 
          'email'       => $email,
          'postal_code' => $zip,
          'add_type'    => 3, 
          'company'     => $company,
          'user_id'     => $cust_id,
          'status'      => 1, 
          'user_type'   => 2
        );
      }

      $order_arr = array(
        'order_code' => $order_code, 
        'cust_id' => $cust_id, 
        'order_email' => $email,
        'delc_id' => !empty($delCharge) ? $delCharge->charges_id : NULL,
        // 'cart_subtotal' => $this->cart->total(),
        'del_charge' => !empty($delCharge) ? $delCharge->initial_charge : 0,
        'coupon_id' => $coup_id,
        'discount' => $coup_amount,
        'cart_total' => $this->cart->total(),
        'payment_total' => $cartTotal,
        'paid_total' => 0,
        'balance' => $cartTotal,
        'payment_method' => $paymentMethod,
        'payment_status' => 0,
        'note' => $note,
        'order_status' => 1,
        'order_date' => $date,
        'ordered_ip' => $ip
      );

      $ins_orider_id = $this->Front_model->place_order($orderId,$addr_arr,$order_arr);

      if (!$ins_orider_id) {
        throw new Exception("שגיאה בהוספת ההזמנה למסד הנתונים.");
      }

      // insert order_details and prepare items HTML for email
      $itemsHtml = '';
      $itemsSubtotal = 0.0;
      $currency = isset($this->cur) ? $this->cur : '₪';

      foreach ($cartProducts as $item) {
        $hasDiscount = isset($item['options']['has_discount']) ? $item['options']['has_discount'] : false;

        $discountPerc = 0;
        if ($hasDiscount) {
          $discountPerc = $this->getDiscountPercentage($item['options']['original_price'], $item['price']);
        }

        $order_detail = array(
          'order_id' => $ins_orider_id, 
          'pro_id' => $item['id'], 
          'qty' => $item['qty'],
          'act_unit_price' => isset($item['options']['original_price']) ? $item['options']['original_price'] : $item['price'],
          'discount_percentage' => $discountPerc,
          'billed_unit_price' => $item['price'],
          'subtotal' => $item['subtotal'],
        );
        $ins = $this->Front_model->insert_me('order_details',$order_detail);

        // item row for email (RTL)
        $itemsHtml .= '<tr>';
        $itemsHtml .= '<td style="padding:12px 8px;border:1px solid #e6e6e6; text-align:right;">' . htmlspecialchars($item['name']) . '</td>';
        $itemsHtml .= '<td style="padding:12px 8px;border:1px solid #e6e6e6; text-align:center;">' . intval($item['qty']) . '</td>';
        $itemsHtml .= '<td style="padding:12px 8px;border:1px solid #e6e6e6; text-align:center;">' . $currency . number_format($item['price'], 2) . '</td>';
        $itemsHtml .= '</tr>';

        $itemsSubtotal += floatval($item['subtotal']);
      }

      // Build the email HTML (RTL / Hebrew)
      // You can replace logo URLs with your real assets via base_url('path/to/image')
      $logoUrl = base_url('assets/images/email-header.png'); // replace or remove if not needed
      $adminEmail = 'sales@yourdomain.com'; // <--- replace with real admin email or config


      $emailHtml = '
      <div dir="rtl" lang="he" style="font-family: Arial, Helvetica, sans-serif; color:#444;">
        <div style="background:#5a12d6; color:#fff; padding:40px 20px; border-radius:6px 6px 0 0; text-align:center;">
          <h1 style="margin:0; font-size:36px; font-weight:700;">תודה על הזמנתך</h1>
        </div>

        <div style="background:#fff; padding:30px; border:1px solid #e6e6e6; border-top:none;">
          <p style="margin:0 0 18px; font-size:16px; color:#666; text-align:right;">
            שלום ' . htmlspecialchars($firstName) . ',
          </p>

          <p style="text-align:right; color:#666; font-size:14px;">
            לידיעתך - קיבלנו את ההזמנה שביצעת מס\'' . htmlspecialchars($order_code) . '\', בתאריך ' . date('d M, Y', strtotime($date)) . '.
          </p>

          <p style="margin-top:18px; text-align:right; color:#666;">
            תודה על ביצוע ההזמנה, על מנת שנוכל לספק את הסחורה יש לבצע את הדברים הבאים:
          </p>

          <ul style="text-align:right; color:#666; margin:8px 0 20px 0; padding-right:18px;">
            <li>הדפסת ההזמנה שקיבלתם בדוא"ל.</li>
            <li>לאשר את ההזמנה + מספר הזמנת רכישה.</li>
            <li>להעלות את הקובץ דרך לשונית "צור קשר".</li>
            <li>אנו ניצור קשר מיד לאחר מכן.</li>
          </ul>

          <h3 style="color:#7b24d6; text-align:center; margin:20px 0;">הזמנה ' . htmlspecialchars($order_code) . '</h3>

          <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:20px;">
            <thead>
              <tr>
                <th style="background:#fafafa; text-align:right; padding:12px; border:1px solid #eee;">מוצר</th>
                <th style="background:#fafafa; text-align:center; padding:12px; border:1px solid #eee;">כמות</th>
                <th style="background:#fafafa; text-align:center; padding:12px; border:1px solid #eee;">מחיר</th>
              </tr>
            </thead>
            <tbody>' . $itemsHtml . '</tbody>
          </table>

          <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; margin-bottom:18px;">
            <tr>
              <td style="border:1px solid #eee; text-align:right; width:70%;">סכום ביניים:</td>
              <td style="border:1px solid #eee; text-align:center;">' . $currency . number_format($itemsSubtotal, 2) . '</td>
            </tr>
            <tr>
              <td style="border:1px solid #eee; text-align:right;">משלוח:</td>
              <td style="border:1px solid #eee; text-align:center;">' . ($delChargeAmount ? $currency . number_format($delChargeAmount, 2) . ' (משלוח מהיר)' : 'ללא' ) . '</td>
            </tr>
            <tr>
              <td style="border:1px solid #eee; text-align:right;">אמצעי תשלום:</td>
              <td style="border:1px solid #eee; text-align:center;">' . htmlspecialchars($paymentMethod) . '</td>
            </tr>
            <tr>
              <td style="border:1px solid #eee; text-align:right; font-weight:700;">סך הכל:</td>
              <td style="border:1px solid #eee; text-align:center; font-weight:700;">' . $currency . number_format($cartTotal, 2) . '</td>
            </tr>
            <tr>
              <td style="border:1px solid #eee; text-align:right;">הערה:</td>
              <td style="border:1px solid #eee; text-align:center;">' . nl2br(htmlspecialchars($note)) . '</td>
            </tr>
          </table>

          <div style="display:flex; gap:20px; flex-wrap:wrap; justify-content:space-between;">
            <div style="flex:1; min-width:260px; border:1px solid #e6e6e6; padding:18px;">
              <h4 style="margin-top:0; color:#7b24d6; text-align:center;">כתובת לחיוב</h4>
              <div style="text-align:right; color:#666;">
                <div>' . htmlspecialchars($firstName . ' ' . $lastName) . '</div>
                <div>' . htmlspecialchars($company) . '</div>
                <div>' . htmlspecialchars($address) . '</div>
                <div>' . htmlspecialchars($city) . '</div>
                <div>' . htmlspecialchars($zip) . '</div>
                <div>' . htmlspecialchars($phone) . '</div>
                <div>' . htmlspecialchars($email) . '</div>
              </div>
            </div>

            <div style="flex:1; min-width:260px; border:1px solid #e6e6e6; padding:18px;">
              <h4 style="margin-top:0; color:#7b24d6; text-align:center;">כתובת משלוח</h4>
              <div style="text-align:right; color:#666;">
                <div>' . htmlspecialchars(($shippingAddressCheck ? $sFname . ' ' . $sLname : $firstName . ' ' . $lastName)) . '</div>
                <div>' . htmlspecialchars(($shippingAddressCheck ? $sCompany : $company)) . '</div>
                <div>' . htmlspecialchars(($shippingAddressCheck ? $sAddress : $address)) . '</div>
                <div>' . htmlspecialchars(($shippingAddressCheck ? $sCity : $city)) . '</div>
                <div>' . htmlspecialchars(($shippingAddressCheck ? $sZip : $zip)) . '</div>
                <div>' . htmlspecialchars(($shippingAddressCheck ? ($this->input->post('shipping_phone') ? $this->input->post('shipping_phone') : $phone) : $phone)) . '</div>
                <div>' . htmlspecialchars(($shippingAddressCheck ? ($this->input->post('shipping_email') ? $this->input->post('shipping_email') : $email) : $email)) . '</div>
              </div>
            </div>
          </div>

          <p style="text-align:center; margin-top:30px; color:#999; font-size:13px;">
            תודה שהשתמשת ב- <a href="' . base_url() . '" style="color:#7b24d6; text-decoration:none;">' . htmlspecialchars(parse_url(base_url(), PHP_URL_HOST)) . '</a>!
          </p>
        </div>
      </div>';

      // --- SEND EMAIL (CI Email) ---
      // configure email (use SMTP or default mail)
      $config = array();
      $config['protocol'] = 'mail'; // or 'smtp'
      $config['mailtype'] = 'html';
      $config['charset']  = 'utf-8';
      $config['newline']  = "\r\n";
      $config['crlf']     = "\r\n";

      /* // Example SMTP config (uncomment & fill to use SMTP)
      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'smtp.yourhost.com';
      $config['smtp_user'] = 'user@yourhost.com';
      $config['smtp_pass'] = 'yourpass';
      $config['smtp_port'] = 587;
      $config['smtp_crypto'] = 'tls';
      */

      $this->load->library('email');
      $this->email->initialize($config);
      $this->email->clear(TRUE);

      // from address
      $fromEmail = 'no-reply@yourdomain.com'; // replace with your from
      $fromName  = parse_url(base_url(), PHP_URL_HOST);

      $this->email->from($fromEmail, $fromName);
      $this->email->to($email);
      // optionally BCC / admin
      $this->email->bcc($adminEmail);

      $this->email->subject("אישור הזמנה " . $order_code);
      $this->email->message($emailHtml);

      // send but don't break order if fails
      try {
        $sent = $this->email->send();
        if (!$sent) {
          // log the detailed debug (but do not throw)
          log_message('error', 'Order email failed for order_id: ' . $ins_orider_id . ' debug: ' . $this->email->print_debugger(['headers']));
        }
      } catch (Exception $e) {
        // log but continue
        log_message('error', 'Email exception for order_id ' . $ins_orider_id . ': ' . $e->getMessage());
      }


      $message = array('status'=>'success','message' => 'ההזמנה בוצעה בהצלחה.');
      if ($this->session->userdata('coupons') != null) {
        $coupon_arr = array(
          'co_id' => '', 
          'coupon_type' => '', 
          'coupon_amount' => '', 
        ); 
        $this->session->unset_userdata('coupons',$coupon_arr);
      }
      $this->cart->destroy();
      
    } catch (Exception $ex) {
      $message = array('status' => 'error', 'message' => $ex->getMessage());
    }
    echo json_encode($message);
  }

  private function getDiscountPercentage($actualPrice, $givenPrice) {
    if ($actualPrice <= 0) return 0; // prevent division by zero
    $discount = (($actualPrice - $givenPrice) / $actualPrice) * 100;
    return number_format($discount, 2); // 2 decimals
  }

  function generateRandomString($length = 10,$table,$field) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $mr_code = '';
    for ($i = 0; $i < $length; $i++) {
      $mr_code .= $characters[rand(0, $charactersLength - 1)];
    }
    $ext = $this->Front_model->checkField($table,$field,$mr_code);
    if ($ext) {
        $this->generateRandomString($length = 10,$table,$field);
    }else{
        return 'MR'.$mr_code;
    }
  }

}