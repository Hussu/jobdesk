<?php

$config = array(
        'postjob' => array(
                array(
                        'field' => 'job[title]',
                        'label' => 'Title',
                        'rules' => 'required|min_length[8]'
                ),
                array(
                        'field' => 'job[cat_id]',
                        'label' => 'Category',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'job[subcat_id]',
                        'label' => 'Sub Category',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'job[description]',
                        'label' => 'Description',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'job[type]',
                        'label' => 'Category',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'job[rate]',
                        'label' => 'Rate',
                        'rules' => 'required|numeric'
                ),
                array(
                        'field' => 'job[level]',
                        'label' => 'Experience Level',
                        'rules' => 'required'
                )
               
        ),
        'signup' => array(
                array(
                        'field' => 'first_name',
                        'label' => 'First Name',
                        'rules' => 'required|alpha'
                ),
                array(
                        'field' => 'last_name',
                        'label' => 'Last Name',
                        'rules' => 'required|alpha'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email Address',
                        'rules' => 'required|valid_email|is_unique[users.email]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|min_length[5]'
                ),
                array(
                        'field' => 'confirm_password',
                        'label' => 'Confirm Password',
                        'rules' => 'required|matches[password]'
                ),
                array(
                        'field' => 'phone',
                        'label' => 'Phone',
                        'rules' => 'required|regex_match[/^[0-9]{10}$/]'
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'required'
                )
        ),
    
        'login' => array(
                array(
                        'field' => 'email',
                        'label' => 'Email Address',
                        'rules' => 'required'
                    ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required'
                    )
        )
);