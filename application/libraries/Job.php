<?php

class Job {

    private $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function view($file, $data = array()) {
      //$folder = $this->ci->session->userdata('folder');
      $loader = $file;

      $header = "header";
      $footer = "footer";
      
      $this->ci->load->view($header, $data);
      $this->ci->load->view($loader, $data);
      $this->ci->load->view($footer, $data);
      
    }
}
