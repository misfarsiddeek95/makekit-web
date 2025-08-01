<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $availabeAllViews = array(
            'cur' => '₪',
        );
        $this->load->vars($availabeAllViews);
        $this->folder = $_SERVER['DOCUMENT_ROOT'] . "/makekit-web";
    }

    function get_encrypted_password($password) {
        $options = [
            'cost' => 10
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}