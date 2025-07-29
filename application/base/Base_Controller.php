<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $availabeAllViews = array(
            'cur' => '$',
        );
        $this->load->vars($availabeAllViews);
        $this->folder = $_SERVER['DOCUMENT_ROOT'] . "/makekit-web";
    }
}