<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

	
	
public function index()
	{

                $this->load->model('model_load');
		$this->load->view('welcome_message');
	
}

}
