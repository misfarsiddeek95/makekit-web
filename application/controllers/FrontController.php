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
  public function makekitProductDetail() {
    $data['activePage'] = 'PRODUCT';
    $data['pageMain'] = [];
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
}