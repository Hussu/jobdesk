<?php

Class Dashboard_Model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_trending_hourlies() {
         $id =  user_meta('id'); 
         $this->db->select('users.id as uid, users.first_name, users.profile_image, hourlies.*');
         $this->db->from('hourlies');
         $this->db->join('users', 'users.id = hourlies.user_id');
         $this->db->where('users.id !=', $id);
         $this->db->limit(6);
         $query = $this->db->get();
         $result = $query->result_object();
         return $result;
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

