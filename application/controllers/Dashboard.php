<?php

/* 
 * To show dashboard.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Dashboard extends CI_Controller{
    public function __construct() {
        parent::__construct();
        validate_login();
    }
    public function index(){
        $this->load->helper('text');
        $this->load->model('Dashboard_m');
        $id = user_meta('id');
        $data['posted_jobs'] = $this->Dashboard_m->query("select count(*)as total from job where user_id = $id");
        $data['hourlies_data'] = $this->Dashboard_m->get_trending_hourlies();
        $this->jobdesk->view('dashboard', $data);
    }
}

