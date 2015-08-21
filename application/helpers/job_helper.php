<?php

/*
 * LOOK Helper
 */

// Assets path
function assets_path($path = '') {
    $path = ($path != "") ? "/$path" : "";
    return base_url('assets' . $path);
}

// Validate login
function validate_login() {
    $ci = & get_instance();
    $ci->load->library('facebook'); // Automatically picks appId and secret from config
         $data['login_url'] = $ci->facebook->getLoginUrl(array(
                    'redirect_uri' => site_url('user/register/facebook'),
                    'scope' => array("email") // permissions here
                ));
    $user_id = $ci->session->userdata('jobdesk_id');
    if(empty($user_id)):
        $user_id = !empty($_COOKIE['logined']) ? $_COOKIE['logined'] : '';
    endif;
    
    if (isset($user_id) && !empty($user_id)) {
        return $user_id;
    } else {
        $data['current_url'] = current_url();
        $ci->session->set_userdata(array('current_url' => current_url()));
//        $ci->job->view('user/login', $data);
        redirect('user/login');
    }
}

// Get Role
function get_role() {
    $ci = & get_instance();
    $role = $ci->session->userdata('role');
    if (isset($role) && !empty($role)) {
        return $role;
    }
}

function role(){
   $ci = & get_instance();
   $role = $ci->session->userdata('role');
   
   if(empty($role)):
     $id = $_COOKIE['logined'];
       $role = user_meta('role');
   endif;
   
   if($role == 1){
       return 'admin';
   }elseif($role == 2){
       return 'seller';
   }elseif($role == 3){
       return 'buyer';
   }
}

function user_meta($key = ''){
    $ci = & get_instance();
    $id = $ci->session->userdata('jobdesk_id');
    if(empty($id)):
        $id = isset($_COOKIE['logined']) ? $_COOKIE['logined'] : '' ;
    endif;
    $ci->db->where('id', $id);
    if(!empty($key)):
        $ci->db->select($key);
    endif;
    $data  = $ci->db->get('users');
    $result = $data->result_object();
    if(!empty($id)){
        
        if(!empty($key)):
            if(!empty($result)):
               return $result[0]->$key;
            endif;
        else:
            if(!empty($result)):
                return $result[0];
            endif;
        endif;
    }
}

function is_logged_in() {
    $ci = & get_instance();
    $id = $ci->session->userdata('jobdesk_id');
    //print_r($_SESSION);
    if(empty($id)):
        $id = isset($_COOKIE['logined']) ? $_COOKIE['logined'] : '' ;
    endif;
    if(!empty($id)):
        return $id;
    else:
        return FALSE;
    endif;
}

// Validate Role
function validate_role() {
    $ci = & get_instance();
    $role = $ci->session->userdata('role');
    if (isset($role) && !empty($role) && $role == 'admin' ) {
        return $role;
    } else {
        redirect('admin');
    }
}

// Validate login
function validate_login2() {
    $ci = & get_instance();
    $user_id = $ci->session->userdata('jobdesk_id');
    echo $user_name = $ci->session->userdata('user_name');
    if (isset($user_name) && !empty($user_name)) {
        redirect('admin/home');
    } else {
        redirect('admin/login_form');
    }
}

// Check current user authority
function current_user_have_role($role_id, $redirect = true) {
    $ci = & get_instance();
    $user_id = validate_login();
    $user_role = get_user_role($user_id);

    if ($user_role != $role_id) {
        $location = $ci->router->fetch_class();

        if ($redirect) {
            redirect($location);
        }

        return false;
    }else{
        return true;
    }
}

// Get user role
function get_user_role($user_id) {
    $ci = & get_instance();

    $ci->load->model('user');

    $role_id = $ci->user->get_user_role($user_id);
    if ($role_id) {
        return $role_id;
    } else {
        return false;
    }
}

// Get user data
function get_user_info($user_id = false) {
    if ($user_id) {
        $uid = $user_id;
    } else {
        $uid = validate_login();
    }
    $ci = & get_instance();
    $ci->load->model('user');
    $user_data = $ci->user->get_user_info($uid);
    return $user_data;
}

function get_relation_by($select, $field, $value) {
    $ci = & get_instance();
    $data = $ci->user->get_relation_by($select, $field, $value);
    if ($data) {

        if ($select === "org_id") {
            $ci->load->model('organisation_model');
            $orgDat = $ci->organisation_model->get_organisations($data->org_id);
            $result = $orgDat[0];
        } else if ($select === "role_id") {
            $result = $ci->user->get_role_info($data->role_id);
        } else if ($select === "user_id") {
            $result = $ci->user->get_user_info($data->user_id);
        } else {
            $result = false;
        }
    } else {
        $result = false;
    }
    return $result;
}


function days_left($date){
    $cur_date = new DateTime();
    $now =  $cur_date->getTimestamp();
//    echo $now.'---'.strtotime((string) $date); die;
    $new =  ($now) -  (strtotime((string) $date));
//    echo $new; die;
    return $left = date('t') - date('d', $new);
//    echo $new;
}


function total_proposals($id){
    $ci = & get_instance();
    $ci->db->where('job_id', $id);
    $ci->db->from('proposals');
    return $ci->db->count_all_results();
//    echo $ci->db->last_query(); die;
    
}

function job_data($key, $val, $get = ''){
    $ci = & get_instance();
    $ci->db->where($key, $val);
    if(!empty($get)):
        $gets = is_array($get)? implode(',', $get):$get;
        $ci->db->select($gets);
    endif;
    $data  = $ci->db->get('job');
    $result = $data->result_object();
    if(!empty($get)):
        if(!empty($result)):
           return $result[0];
        endif;
    else:
        if(!empty($result)):
            return $result[0];
        endif;
    endif;
     
}
    
function get_user_data($id, $key  = ''){
    $ci = & get_instance();
    $ci->db->where('id', $id);
    if(!empty($key)):
        $ci->db->select($key);
    endif;
    $data  = $ci->db->get('users');
    $result = $data->result_object();
        if(!empty($key)):
            if(!empty($result)):
               return $result[0]->$key;
            endif;
        else:
            if(!empty($result)):
                return $result[0];
            endif;
        endif;
    
}