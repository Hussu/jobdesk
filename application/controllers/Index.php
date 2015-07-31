<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

	public function index()
	{       $data['front_page'] = 123;
		$this->load->view('header', $data);
		$this->load->view('index/index');
		$this->load->view('footer');
                
	}
}
