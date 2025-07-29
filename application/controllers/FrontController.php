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
    $this->load->view('home', $data);
  }

  private function loadTestimonials() {
    $_fields = array('wt.id as testimonialId','wt.name','wt.designation','CONCAT_WS("-std.", wt.image, wt.extension) as image','wt.content', 'wt.stars');
    $_condition = array(
      array('field' => 'wt.status', 'value' => 1),
    );
    return $this->Front_model->get_data_with_conditions_and_joins('web_testimonials wt',$_fields,[],$_condition);
  }

  # about us page
  public function aboutUs() {
    $data['activePage'] = 'ABOUT';
    
    $data['pageMain'] = $this->Front_model->fetchPage(20);
    $data['pageOurStory'] = $this->Front_model->fetchPage(21);

    $data['pageCoreValueMain'] = $this->Front_model->fetchPage(22); # core value main section
    $data['pageCoreValuePeople'] = $this->Front_model->fetchPage(23); # core value people
    $data['pageCoreValueInnovation'] = $this->Front_model->fetchPage(24); # core value innovation
    $data['pageCoreValueMission'] = $this->Front_model->fetchPage(25); # core value mission

    $data['pageIntegrationMain'] = $this->Front_model->fetchPage(26); # integration

    $integration_logo_fields = array('p.*');
    $integration_logo_conditions = array(
      array('field' => 'p.table', 'value' => 'pages'),
      array('field' => 'p.field_id', 'value' => 27),
    );
    
    $pageIntegrationLogos = $this->Front_model->get_data_with_conditions_and_joins('photo p',$integration_logo_fields,[],$integration_logo_conditions);
    list($data['pageIntegrationLeftMove'], $data['pageIntegrationRightMove']) = $this->divideArray($pageIntegrationLogos);

    $data['pageOurTeamMain'] = $this->Front_model->fetchPage(28); # our team section
    
    $team_fiels = array('p.*');
    $team_conditions = array(
      array('field' => 'p.table', 'value' => 'pages'),
      array('field' => 'p.field_id', 'value' => 29),
    );
    $data['pageOurTeamImages'] = $this->Front_model->get_data_with_conditions_and_joins('photo p',$team_fiels,[],$team_conditions);

    $data['pageTestimonialMain'] = $this->Front_model->fetchPage(30); # testimonial
    $data['testimonialList'] = $this->loadTestimonials();
    
    $data['pageTrustedOrganizationMain'] = $this->Front_model->fetchPage(31); # trusted organizations section
    $organization_fields = array('p.*');
    $organization_conditions = array(
      array('field' => 'p.table', 'value' => 'pages'),
      array('field' => 'p.field_id', 'value' => 31),
    );
    $data['pageTrustedOrganizationsImages'] = $this->Front_model->get_data_with_conditions_and_joins('photo p',$organization_fields,[],$organization_conditions);

    $this->load->view('about', $data);
  }

  private function divideArray($array) {
    $totalElements = count($array);
    $halfSize = ceil($totalElements / 2);  // Calculate the size of the first array

    // Split the array into two parts
    $firstArray = array_slice($array, 0, $halfSize);
    $secondArray = array_slice($array, $halfSize);

    return [$firstArray, $secondArray];
  }


  # services page
  public function ourServices() {
    $data['activePage'] = 'SERVICE';

    $data['pageMain'] = $this->Front_model->fetchPage(32);
    $data['pageVideoMain'] = $this->Front_model->fetchPage(33);
    $data['pageInstagram'] = $this->Front_model->fetchPage(34);
    $data['pageFacebook'] = $this->Front_model->fetchPage(35);
    $data['pageTwitter'] = $this->Front_model->fetchPage(36);
    $data['pageFAQ'] = $this->Front_model->fetchPage(37);

    $faq_fields = array('f.*');
    $faq_conditions = array(
      array('field' => 'f.faq_type', 'value' => 1),
    );
    $data['serviceFaqs'] = $this->Front_model->get_data_with_conditions_and_joins('faqs f',$faq_fields,[],$faq_conditions);

    $data['services'] = $this->serviceList();

    $this->load->view('services', $data);
  }

  public function serviceDetail() {
    if (!isset($_GET['select'])) {
			return redirect(base_url('404_override'));
		}
    $data['activePage'] = 'SERVICE';

    $serviceUuid = trim($this->input->get('select'));

    $service_fields = array('ws.id as serviceId','ws.uuid as service_uuid','ws.title','DATE_FORMAT(ws.added_at,"%d/%m/%Y") as added_at','CONCAT_WS("-big.", ws.image, ws.extension) as image','ws.status',
    'CONCAT_WS(" ", su.fname, su.lname) as added_person','ws.added_by','ws.icon_class','ws.service_text','ic.class_name');
    $service_joins = array(
        array('table' => 'staff_users su', 'on' => 'su.user_id=ws.added_by', 'type' => 'left outer'),
        array('table' => 'icon_class ic', 'on' => 'ic.id=ws.icon_class', 'type' => 'left outer'),
    );
    $service_conditions = array(
        array('field' => 'ws.uuid', 'value' => $serviceUuid),
        array('field' => 'ws.status', 'value' => 1),
    );
    $data['serviceDetail'] = $this->Front_model->get_data_with_conditions_and_joins('web_services ws',$service_fields,$service_joins,$service_conditions,1);

    if(!$data['serviceDetail']) {
      return redirect(base_url('404_override'));
    }

    $data['pageMain'] = $this->Front_model->fetchPage(38);

    $data['pageServiceBenefitsMain'] = $this->Front_model->fetchPage(39);
    $data['pageServiceBenefitsBox1'] = $this->Front_model->fetchPage(40);
    $data['pageServiceBenefitsBox2'] = $this->Front_model->fetchPage(41);
    $data['pageServiceBenefitsBox3'] = $this->Front_model->fetchPage(42);
    $data['pageServiceBenefitsBox4'] = $this->Front_model->fetchPage(43);

    # get the previous & next record detail
    $_fields = array('ws.slug_url','ws.uuid as service_uuid','ws.title');
    $prev_condition = array(
      array('field' => 'ws.id <', 'value' => $data['serviceDetail']->serviceId)
    );
    $prev_order_by = array(
      array('field' => 'ws.id', 'order_by_type' => 'desc'),
    );
    $prev_record = $this->Front_model->get_data_with_conditions_and_joins('web_services ws',$_fields,[],$prev_condition,1,$prev_order_by);

    $next_condition = array(
      array('field' => 'ws.id >', 'value' => $data['serviceDetail']->serviceId)
    );
    $next_order_by = array(
      array('field' => 'ws.id', 'order_by_type' => 'asc'),
    );

    $next_record = $this->Front_model->get_data_with_conditions_and_joins('web_services ws',$_fields,[],$next_condition,1,$next_order_by);

    $data['prev_next_records'] = array(
      'prev' => $prev_record,
      'next' => $next_record
    );

    $this->load->view('service_detail', $data);
  }

  # service list fetching common function
  private function serviceList($limit=null,$orderBy='ASC') {
    # services
    $service_fields = array('ws.id as serviceId','ws.uuid as service_uuid','ws.title','ws.icon_class','ws.service_text','ws.slug_url as slug','ic.class_name');
    $service_joins = array(
      array('table' => 'icon_class ic', 'on' => 'ic.id=ws.icon_class', 'type' => 'left outer'),
    );
    $service_conditions = array(
      array('field' => 'ws.status', 'value' => 1),
    );
    $order_by = array(
      array('field' => 'ws.id', 'order_by_type' => $orderBy),
    );
    return $this->Front_model->get_data_with_conditions_and_joins('web_services ws',$service_fields,$service_joins,$service_conditions,$limit,$order_by);
  }

  # products page
  public function ourProducsts() {
    $data['activePage'] = 'PRODUCT';
    
    $data['pageMain'] = $this->Front_model->fetchPage(44);
    $data['pageHeading'] = $this->Front_model->fetchPage(45);
    
    // $data['productList'] = $this->Front_model->load_products();

    $this->load->view('products', $data);
  }

  # load products
  public function loadProducts() {
    $offset = $this->input->get('offset');
    $result = $this->Front_model->load_products(10, $offset);
    echo json_encode($result);
  }

  # product detail
  public function productDetail() {
    if (!isset($_GET['select'])) {
			return redirect(base_url('404_override'));
		}
    $data['activePage'] = 'PRODUCT';

    $prodcutUuid = trim($this->input->get('select'));
    
    $data['pageMain'] = $this->Front_model->fetchPage(46);
    $data['pageRequestDemo'] = $this->Front_model->fetchPage(47);

    # product details
    $product_fields = array('wp.id as productId,wp.title,wp.product_uuid as uuid,wp.slug_url,wp.product_desc,CONCAT_WS("-std.", wp.thum_image, wp.extension) as image');
    $product_condition = array(
      array('field' => 'wp.product_uuid', 'value' => $prodcutUuid),
      array('field' => 'wp.status', 'value' => 1)
    );
    $data['productDetail'] = $this->Front_model->get_data_with_conditions_and_joins('web_products wp',$product_fields,[],$product_condition,1);

    if(!$data['productDetail']) {
      return redirect(base_url('404_override'));
    }
    
    # product features
    $points_fields = array('wpp.*');
    $points_condition = array(
        array('field' => 'wpp.web_product_id', 'value' => $data['productDetail']->productId),
    );
    $data['productFeatures'] = $this->Front_model->get_data_with_conditions_and_joins('web_products_point wpp',$points_fields,[],$points_condition);

    # product images
    $photo_fields = array('p.*');
    $photo_conditions = array(
      array('field' => 'p.table', 'value' => 'products'),
      array('field' => 'p.field_id', 'value' => $data['productDetail']->productId),
    );
    $data['productImages'] = $this->Front_model->get_data_with_conditions_and_joins('photo p',$photo_fields,[],$photo_conditions);

    $data['productList'] = $this->Front_model->load_products();
    $data['countryList'] = $this->Front_model->getAll('country');

    $this->load->view('product_detail', $data);
  }

  # request a product demo
  public function requestDemo() {
    try {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'valid_email'); // email is optional but must be valid if present
      $this->form_validation->set_rules('phone', 'Phone', 'required');
      $this->form_validation->set_rules('country_id', 'Country', 'required');

      if($this->form_validation->run() == FALSE) {
        throw new Exception("Kindly review all fields and ensure there are no errors before submitting the form. Thank you!");
      }

      // Validation passed, verify reCAPTCHA
      $recaptcha_response = $this->input->post('g_recaptcha_response');
      $response = $this->verify_recaptcha($recaptcha_response);

      if ($response['success']) {
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $country_id = $this->input->post('country_id');
        $message = $this->input->post('message');
  
        $productId = $this->input->post('product_id');
        if($productId == null || $productId == '') {
          throw new Exception("Please select the product for the demo.");
        }
  
        $_field = array('wp.title');
        $_condition = array(
          array('field' => 'wp.id', 'value' => $productId),
          array('field' => 'wp.status', 'value' => 1)
        );
  
        $productName = $this->Front_model->get_data_with_conditions_and_joins('web_products wp',$_field,[],$_condition,1)->title;
  
        $_arr = array(
          'person_name' => $name,
          'person_email' => $email,
          'person_phone' => $phone,
          'country_id' => $country_id,
          'product_id' => $productId,
          'product_name' => $productName,
          'any_comments' => $message
        );
  
        $inserted_id = $this->Front_model->insert_me('web_product_demo_request', $_arr);
  
        if(!$inserted_id) {
          throw new Exception("Something wrong in submitting your request. Please try again later.");
        }
  
        # EMAIL TRIGGER CODE SHOULD BE ADDED HERE.
  
        $message = array('status' => 'success', 'message' => 'Request form submitted succesfully.');
      } else {
        throw new Exception("reCAPTCHA verification failed. Please reload the page and try again.");
      }
    } catch (Exception $ex) {
      $message = array('status' => 'error', 'message' => $ex->getMessage());
    }
    echo json_encode($message);
  }
  
  # portfolio page
  public function ourWorks() {
    $data['activePage'] = 'WORK';
    $data['pageMain'] = $this->Front_model->fetchPage(48);
    $this->load->view('works', $data);
  }

  # load portfolios
  public function loadWorks() {
    $offset = $this->input->get('offset');
    $result = $this->Front_model->load_works(9, $offset);
    echo json_encode($result);
  }

  # contact us page
  public function contactUs() {
    $data['activePage'] = 'CONTACT';

    $data['pageMain'] = $this->Front_model->fetchPage(49);
    $data['pageContactBox1'] = $this->Front_model->fetchPage(50);
    $data['pageContactBox2'] = $this->Front_model->fetchPage(51);
    $data['pageContactBox3'] = $this->Front_model->fetchPage(52);
    $data['pageContactMe'] = $this->Front_model->fetchPage(53);
    $data['pageMap'] = $this->Front_model->fetchPage(54);

    $this->load->view('contact', $data);
  }

  # send contact email.
  /* public function sendEmail() {
    try {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('subject', 'Subject', 'required');
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'valid_email'); // email is optional but must be valid if present
      $this->form_validation->set_rules('phone', 'Phone', 'required');
      $this->form_validation->set_rules('message', 'Message', 'required');

      if($this->form_validation->run() == FALSE) {
        throw new Exception("Kindly review all fields and ensure there are no errors before submitting the form. Thank you!");
      }

      $mail_subject = $this->input->post('subject', true);
      $name = $this->input->post('name', true);
      $email = $this->input->post('email', true);
      $phone = $this->input->post('phone', true);
      $message = $this->input->post('message', true);

      # email to company
      $mail_temp = file_get_contents(base_url().'assets/mail/contact-form.html');
      $_replace_arr = array(
        '[COMPANY_LOGO]' => base_url().'assets/images/as-logo-white-line.png',
        '[COMPANY_NAME]' => COMPANY_NAME,
        '[NAME]' => $name,
        '[EMAIL]' => $email,
        '[PHONE]' => $phone,
        '[MESSAGE]' => $message,
        '[YEAR]' => date('Y'),
        '[WEBSITE_LINK]' => base_url()
      );

      $subject = $mail_subject;
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: '.$name.'<'.$email.'>' . "\r\n";

      $mail_temp = strtr($mail_temp, $_replace_arr);
      $sent = mail(COMPANY_COMMON_EMAIL_ID,$subject,$mail_temp,$headers);

      if($sent) {
        $msg = array('status' => 'success','message' => 'Mail sent successfully.','redirect_to' => base_url());

        # email to the user
        $user_mail_temp = file_get_contents(base_url().'assets/mail/auto-reply-email.html');

        $user_subject = $mail_subject;
        $user_headers = "MIME-Version: 1.0" . "\r\n";
        $user_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $user_headers .= 'From: '.COMPANY_NAME.'<'.COMPANY_COMMON_EMAIL_ID.'>' . "\r\n";

        $user_mail_temp = strtr($user_mail_temp, $_replace_arr);
        mail($email,$user_subject,$user_mail_temp,$user_headers);

      } else {
        $msg = array('status' => 'error','message' => 'Something went wrong in sending email.');
      }

    } catch (Exception $ex) {
      $msg = array('status' => 'error','message' => $ex->getMessage());
    }
    echo json_encode($msg);
  } */

  public function sendEmail() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('subject', 'Subject', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'valid_email'); // email is optional but must be valid if present
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('message', 'Message', 'required');

    if($this->form_validation->run() == FALSE) {
      echo json_encode(array('status' => 'error', 'message' => "Kindly review all fields and ensure there are no errors before submitting the form. Thank you!"));
      return;
    }

    $recaptcha_response = $this->input->post('g_recaptcha_response');
    $response = $this->verify_recaptcha($recaptcha_response);

    if ($response['success']) {
      $mail_subject = $this->input->post('subject', true);
      $name = $this->input->post('name', true);
      $email = $this->input->post('email', true);
      $phone = $this->input->post('phone', true);
      $message = $this->input->post('message', true);

      $mail_temp = file_get_contents(base_url().'assets/mail/contact-form.html');
      $_replace_arr = array(
          '[COMPANY_LOGO]' => base_url().'assets/images/as-logo-white-line.png',
          '[COMPANY_NAME]' => COMPANY_NAME,
          '[NAME]' => $name,
          '[EMAIL]' => $email,
          '[PHONE]' => $phone,
          '[MESSAGE]' => $message,
          '[YEAR]' => date('Y'),
          '[WEBSITE_LINK]' => base_url()
      );

      $mail_temp = strtr($mail_temp, $_replace_arr);

      // Load PHPMailer
      $mail = new PHPMailer\PHPMailer\PHPMailer();

      try {
        //Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'mail.arbolsoft.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username = 'info@arbolsoft.com';  // SMTP username
        $mail->Password = ']-NgT-IklNUd';  // SMTP password
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('info@arbolsoft.com', COMPANY_NAME);
        $mail->addAddress(COMPANY_COMMON_EMAIL_ID);                 // Add a recipient
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $mail_subject;
        $mail->Body    = $mail_temp;
        $mail->AltBody = strip_tags($mail_temp);

        if($mail->send()) {
          $msg = array('status' => 'success','message' => 'Mail sent successfully.','redirect_to' => base_url());

          // Email to the user
          $user_mail_temp = file_get_contents(base_url().'assets/mail/auto-reply-email.html');
          $user_mail_temp = strtr($user_mail_temp, $_replace_arr);

          $mail->clearAddresses();
          $mail->addAddress($email);
          $mail->Subject = $mail_subject;
          $mail->Body    = $user_mail_temp;
          $mail->AltBody = strip_tags($user_mail_temp);
          $mail->send();
        } else {
          $msg = array('status' => 'error','message' => 'Something went wrong in sending email.');
        }
      } catch (Exception $e) {
        $msg = array('status' => 'error','message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
      }

      echo json_encode($msg);
    } else {
      echo json_encode(array('status' => 'error', 'message' => "reCAPTCHA verification failed. Please reload the page and try again."));
      return;
    }
  }

  public function subscribeEmail() {
    try {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 

      if($this->form_validation->run() == FALSE) {
        throw new Exception("Kindly review all fields and ensure there are no errors before submitting the form. Thank you!");
      }

      // Validation passed, verify reCAPTCHA
      $recaptcha_response = $this->input->post('g_recaptcha_response');
      $response = $this->verify_recaptcha($recaptcha_response);

      if ($response['success']) {
        $email = $this->input->post('email', true);

        if($email == null || $email == '') {
          throw new Exception("Please enter your email address.");
        }
        
        $_field = array('ms.*');
        $_condition = array(
          array('field' => 'ms.mail', 'value' => $email),
        );
  
        $emailExists = $this->Front_model->get_data_with_conditions_and_joins('mail_subscriptions ms',$_field,[],$_condition,1);
  
        if(!$emailExists) {
          $data = array(
            'mail' => $email,
            'added_date' => date('Y-m-d H:i:s'),
            'is_subscribed' => 1
          );
          $inserted = $this->Front_model->insert_me('mail_subscriptions', $data);
  
          if($inserted) {
            $msg = array('status' => 'success', 'message' => 'Subscribed successfully.');
          } else {
            $msg = array('status' => 'error', 'message' => 'Something went wrong in subscribing.');
          }
        } else {
          $msg = array('status' => 'error', 'message' => 'This email already in the subscription list');
        }
      } else {
        throw new Exception("reCAPTCHA verification failed. Please reload the page and try again.");
      }
    } catch (Exception $ex) {
      $msg = array('status' => 'error', 'message' => $ex->getMessage());
    }
    echo json_encode($msg);
  }

  # get a quote page
  public function getAQuote() {
    $data['activePage'] = 'GETAQUOTE';
    $data['pageMain'] = $this->Front_model->fetchPage(57);
    $data['pageMiddleSection'] = $this->Front_model->fetchPage(58);

    # get services
    $service_fields = array('ws.id as service_id','ws.title as service_name');
    $service_conditions = array(
        array('field' => 'ws.status', 'value' => 1),
    );
    $data['serviceList'] = $this->Front_model->get_data_with_conditions_and_joins('web_services ws',$service_fields,[],$service_conditions);

    $data['countryList'] = $this->Front_model->getAll('country');

    $this->load->view('get_a_quote', $data);
  }

  public function submitQuote() {
    try {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('service_id', 'Service', 'required');
      $this->form_validation->set_rules('budget', 'Budget', 'required');
      $this->form_validation->set_rules('name', 'Client name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'valid_email'); // email is optional but must be valid if present
      $this->form_validation->set_rules('phone', 'Phone', 'required');
      $this->form_validation->set_rules('address', 'Client address', 'required');

      if($this->form_validation->run() == FALSE) {
        throw new Exception("Kindly review all fields and ensure there are no errors before submitting the form. Thank you!");
      }

      // Validation passed, verify reCAPTCHA
      $recaptcha_response = $this->input->post('g_recaptcha_response');
      $response = $this->verify_recaptcha($recaptcha_response);

      if ($response['success']) {
        $serviceId = $this->input->post('service_id');
        $budget = $this->input->post('budget');
        $description = $this->input->post('description');
        $additionalNotes = $this->input->post('project_additional_notes');
        $name = $this->input->post('name');
        $countryId = $this->input->post('country_id');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
  
        $_arr = array(
          'inquired_service' => $serviceId,
          'project_budget' => $budget,
          'project_description' => $description,
          'additional_comments' => $additionalNotes,
          'customer_name' => $name,
          'customer_email' => $email,
          'customer_phone' => $phone,
          'customer_country' => $countryId,
          'customer_address' => $address,
          'is_responded' => 0
        );
  
        if (isset($_FILES['file']) && $_FILES['file']['name'] != '') {
          $folder = $this->folder."/documents/inquiries/";
          if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
          }
          
          $filename = $_FILES['file']['name'];
          $encryptedName = md5(date('YmdHis').$filename);
          $filetype = pathinfo($filename, PATHINFO_EXTENSION);
          $file_org = $folder.$encryptedName.'.'.$filetype;
      
          if (!@move_uploaded_file($_FILES['file']['tmp_name'], $file_org)) {
            throw new Exception('Cannot upload original file...');
          }
      
          if ($encryptedName != '') {
            $_arr['attachment'] = $encryptedName;
            $_arr['extension'] = $filetype;
          }
        }
        
        $inserted = $this->Front_model->insert_me('web_inquiries', $_arr);
        if($inserted) {
          $msg = array('status' => 'success', 'message' => 'Your request successfully submitted.');
        } else {
          $msg = array('status' => 'error', 'message' => 'Something went wrong in submitting the form.');
        }
      } else {
        throw new Exception("reCAPTCHA verification failed. Please reload the page and try again.");
      }
    } catch (Exception $ex) {
      $msg = array('status' => 'error', 'message' => $ex->getMessage());
    }
    echo json_encode($msg);
  }

  private function verify_recaptcha($recaptcha_response) {
    $secret_key = '6LeltA4qAAAAAMLVJce3sinvFOe4k7EiRkrMame2';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}");
    return json_decode($response, true);
  }

  public function removeUnwantedDocuments() {
    try {
      $directory = $this->folder.'/documents/inquiries/'; // defining the file directory.
     
      if(!is_dir($directory)) {
        throw new Exception("Directory does not exists.");
      }

      $all_files = scandir($directory);

      $_fields = array('CONCAT_WS(".", wi.attachment, wi.extension) as attachment');
      $db_files = $this->Front_model->get_data_with_conditions_and_joins('web_inquiries wi',$_fields,[],[]);

      // Extract filenames from database records
      $db_file_names = array_map(function($item) {
        return $item->attachment;
      }, $db_files);

      // Loop through all files in the directory
      foreach ($all_files as $file) {
        if ($file === '.' || $file === '..') {
          continue; // Skip . and .. directories
        }

        $file_path = $directory . $file;

        // Check if the file is not in the database
        if (!in_array($file, $db_file_names)) {
          if (unlink($file_path)) {
            echo "Deleted: $file\n";
          } else {
            echo "Failed to delete: $file\n";
          }
        }
      }
    } catch (Exception $ex) {
      redirect(base_url());
    }
  }
}