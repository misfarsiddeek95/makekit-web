<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontController extends Base_Controller {
	public function __construct() {
    parent::__construct();
    $this->load->model('Front_model');

    $commonData['newsLetter'] = [];
    $this->load->vars($commonData);
  }
	
  # home page
  public function index() {
    $data['activePage'] = 'HOME';
    $this->load->view('index', $data);
  }

  # about us page
  public function makeitClasses() {
    $data['activePage'] = 'CLASS';
    
    // $data['pageMain'] = $this->Front_model->fetchPage(20);

    $this->load->view('classes', $data);
  }

  # services page
  public function makeitWholesale() {
    $data['activePage'] = 'WHOLESALE';

    $this->load->view('wholesale', $data);
  }

  public function makeitDrawings() {
    $data['activePage'] = 'DRAWINGS';

    $this->load->view('drawings', $data);
  }

  # products page
  public function ourProducsts() {
    $data['activePage'] = 'PRODUCT';

    $this->load->view('products', $data);
  }

  # product detail
  public function productDetail() {
    $data['activePage'] = 'PRODUCT';
    $this->load->view('product_detail', $data);
  }

  # contact us page
  public function makeitContactUs() {
    $data['activePage'] = 'CONTACT';
    $this->load->view('contact', $data);
  }
}