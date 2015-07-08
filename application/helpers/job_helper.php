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
    $user_id = $ci->session->userdata('id');
    if (isset($user_id) && !empty($user_id)) {
        return $user_id;
    } else {
        redirect('index');
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
    $user_id = $ci->session->userdata('id');
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
