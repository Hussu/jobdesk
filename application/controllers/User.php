<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_m');
        $this->load->library('form_validation');
    }
    public function account()
    {
	$this->jobdesk->view('user/account');
    }

    public function register() {
        $this->load->library('facebook');
        $act = $this->uri->segment(3);
        switch ($act) {
            default :
                $data['login_url'] = $this->facebook->getLoginUrl(array(
                    'redirect_uri' => site_url('user/register/facebook'),
                    'scope' => array("email") // permissions here
                ));
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required');
                $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
                $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
                $this->form_validation->set_rules('address', 'Address', 'required');
               if ($this->form_validation->run() == FALSE){
                   $this->jobdesk->view('user/register', $data);
               }else{
                unset($_POST['confirm_password']);
                $_POST['password'] = md5($this->input->post('password'));
                if ($this->global_m->insert('users', $_POST)) {redirect('profile');} else { redirect('user/register');}
               }
                break;
                
            case 'facebook':
                   $data = $this->global_m->fb_register();
                break;
            
            case 'twitter':
                break;
        }
        
    }

    public function login() {
        $this->load->helper('cookie');
        $this->load->library('facebook'); // Automatically picks appId and secret from config
         $data['login_url'] = $this->facebook->getLoginUrl(array(
                    'redirect_uri' => site_url('user/register/facebook'),
                    'scope' => array("email") // permissions here
                ));
        
        /**** Validating the form****/
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
       if ($this->form_validation->run() == FALSE){
           $this->jobdesk->view('user/login', $data);
       }else{
          
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $result = $this->global_m->login($email, $password);
            $sess_array = array();
            if ($result) {
                $sess_array = array(
                    'id' => $result->id,
                    'username' => $result->first_name . ' ' . $result->last_name,
                    'email' => $result->email,
                    'role' => $result->role
                );
                /******** Remember me *********/
                if(isset($_POST['remember-me'])):
//                print_r($_POST); die;
                    $this->input->set_cookie(
                            array(
                                'name'   => 'logined',
                                'value'  => $result->id,
                                'expire' => '86500',
                                'path'   => '/'
                             )
                    );
                endif;
                $this->session->set_userdata($sess_array);
                $url = !empty($this->input->post('redirect_url'))? $this->input->post('redirect_url') : 'dashboard'; 
                $this->session->unset_userdata('current_url');
                redirect($url);
            } else {
                $this->session->set_flashdata('error', 'Wrong email or password.');
                redirect('user/login');
            }
        }
        
    }

    public function profile() {
        validate_login();
        $this->jobdesk->view('dashboard');
    }

    public function logout() {
        $this->load->helper('cookie');
        $this->session->sess_destroy();
        delete_cookie('logined');
        if (validate_login()) {
            redirect('user/login');
        }
    }

}
