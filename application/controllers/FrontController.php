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

  # products page
  public function makekitProducsts($seoUrl) {
    $data['activePage'] = 'PRODUCT';

    $data['pageMain'] = [];

    $conditions = [
      ['field' => 'seo_url', 'value' => $seoUrl]
    ];
  
    $data['selectedCate'] = $this->Front_model->get_data_with_conditions_and_joins('categories',['category_second_title','seo_url'],[],$conditions,1);

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

    $data['pageMain'] = $this->Front_model->fetchPage(11);
    $data['pageEmail'] = $this->Front_model->fetchPage(12);
    $data['pageWhatsApp'] = $this->Front_model->fetchPage(13);
    $data['pagePhone'] = $this->Front_model->fetchPage(14);
    $data['pageAddress'] = $this->Front_model->fetchPage(15);

    $this->load->view('contact', $data);
  }
}