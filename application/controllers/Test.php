<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {
		
public function index()
  {
	  $this->load->model('model_test');
	  $this->load->view('test');
	  echo $this->model_test->test();
  }
}
