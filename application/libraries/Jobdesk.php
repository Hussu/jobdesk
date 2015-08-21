<?php

class Jobdesk{

    private $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function view($file, $data = array()) {
        
        $role = $this->ci->session->userdata('role');
        if (empty($role)):
            $id = isset($_COOKIE['logined']) ? $_COOKIE['logined'] : '';
             $role = user_meta('role'); 
        endif;
        if ($role == '2') {
            $folder = 'user/seller/';
        } elseif ($role == '3') {
            $folder = 'user/buyer/';
        } else {
            $folder = '';
        }

        //print_r($_SESSION); die;
        $loader = $folder . $file;

        $header = $folder . "header";
        $footer = $folder . "footer";

        $this->ci->load->view($header, $data);
        $this->ci->load->view($loader, $data);
        $this->ci->load->view($footer, $data);
    }

    /**
     * To include all the css files
     */    
    function css($files = '') {
        $css = '';
        $CI = & get_instance();
        if (!empty($files)) {

            foreach ($files as $file):
                $css .= '<link href="' . $CI->config->slash_item("base_url") . 'assets/css/' . $file . '" rel="stylesheet">';
                echo "\n";
            endforeach;
            return $css;
        }
    }
    
    
    function script($files = '') {
        $js = '';
        $CI = & get_instance();
        if (!empty($files)) {

            foreach ($files as $file):
               $js .= '<script src="' . $CI->config->slash_item("base_url") . 'assets/js/' . $file . '"></script>';
                echo "\n";
            endforeach;
            return $js;
        }
    }

}
