<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontController extends Base_Controller {
	public function __construct() {
    parent::__construct();
    $this->load->model('Front_model');

    $commonData['categoryList'] = $this->Front_model->getAll('categories');
    $this->load->vars($commonData);
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

    $data = [
        'activePage'    => 'PRODUCT',
        'pageMain'      => [],
        'selectedCate'  => $selectedCate,
        'products'      => $products,
        'pagination'    => $this->pagination->create_links(),
        'result_text'   => $result_text,
    ];

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

    /* print '<pre>';
    print_r($productDetail);
    exit; */
    $data['productDetail'] = $productDetail;
    $data['selectedCate'] = $productDetail->cate_url;
    $data['relatedProducts'] = $this->Front_model->get_filtered_products($productDetail->cate_id, 'related_products', 4, 0, $productDetail->id);
    
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

    $this->load->view('cart', $data);
  }

  # My account
  public function makekitMyAccount() {
    $data['activePage'] = 'MY-ACCOUNT';
    $data['pageMain'] = $this->Front_model->fetchPage(17);

    $this->load->view('login', $data);
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

}