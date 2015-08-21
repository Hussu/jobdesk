<?php

Class Job_m extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function query($sql, $array = false) {
        $q = $this->db->query($sql);
        $data = ($array) ? $q->result_array() : $q->result_object();
        if(!empty($data)):
            return (count($data) > 1) ? $data : $data[0];
        else:
            return FALSE;
        endif;
    }
    
    public function insert($tablename, $data_array) {
        //echo $tablename;
       // print_r($data_array);
        if ($this->db->insert($tablename, $data_array)) {
             $result = $this->db->insert_id();
        } else {
            $result = false;
        }
        return $result;
    }
    
    public function browse_jobs(){
        $id = user_meta('id');
        $this->db->select("job.*, users.first_name, users.last_name, users.profile_image, users.address, users.id as user_id");
        $this->db->from('job');
//        $this->db->join('proposals', 'proposals.job_id = job.id');
        $this->db->join('users', 'job.user_id = users.id');
        $this->db->order_by('job.id', 'DESC');
         $this->db->limit(10);
        $result =  $this->db->get();
//        echo $this->db->last_query(); die;
        if(!empty($result)):
            $data = $result->result_object();
            return $data;
        else:
            return false;
        endif;
            
    }
    
    public function sorting($job_type, $level, $category, $offset = 0){
      if(!empty($job_type)):
             $this->db->where('type', $job_type);
         endif;
         
         if(!empty($level)):
             $this->db->where_in('level', $level);
         endif;
         
          if(!empty($category)):
             $this->db->where_in('cat_id', $category);
         endif;
         $this->db->select("job.*, users.first_name, users.last_name, users.profile_image, users.address, users.id");
         $this->db->from('job');
         $this->db->join('users', 'job.user_id = users.id');
         $this->db->order_by('job.id', 'DESC');
         $this->db->limit(10, $offset);
         $query = $this->db->get();
         $result = $query->result_object();
         
         if(!empty($result)){
             return  $result;
             
         }else{
             return false;
         }   
    }
    
     public function search_job($title){
         $this->db->like('title', $title);
         $this->db->select("job.*, users.first_name, users.last_name, users.profile_image, users.address, users.id");
         $this->db->from('job');
         $this->db->join('users', 'job.user_id = users.id');
         $this->db->order_by('job.id', 'DESC');
         $query = $this->db->get();
         $result = $query->result_object();
         
         if(!empty($result)){
             return  $result;
             
         }else{
             return false;
         }   
    }
    
    public function get_posted_job(){
        $this->db->where('user_id', user_meta('id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('job');
        $result = $query->result_object();
         if(!empty($result)){
             return  $result;
             
         }else{
             return false;
         } 
    }
    
    public function get_worked_job(){
        $this->db->where('assign_to', user_meta('id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('job');
        $result = $query->result_object();
         if(!empty($result)){
             return  $result;
             
         }else{
             return false;
         } 
    }
    
     public function get_proposals($slug){
         $this->db->select("proposals.*, users.first_name, users.last_name, users.profile_image, users.address, users.id as user_id");
         $this->db->from('proposals');
         $this->db->where('job_slug', $slug);
         $this->db->join('users', 'proposals.user_id = users.id');
         $this->db->order_by('proposals.id', 'DESC');
         $query = $this->db->get();
         $result = $query->result_object();
         
         if(!empty($result)){
             return  $result;
             
         }else{
             return false;
         }   
    }
    
     public function update($tablename, $data_array, $where_key, $where_val) {
        if (is_array($where_val)) {
            $this->db->where_in($where_key, $where_val);
        } else {
            $this->db->where($where_key, $where_val);
        }

        if ($id = $this->db->update($tablename, $data_array)) {
            $result = $id;
        } else {
            $result = false;
        }
        return $result;
    }
    
      public function get($tablename, $where_key = '', $where_val = '', $array = false) {
        if (!empty($where_key) && !empty($where_val)) {
            $this->db->where($where_key, $where_val);
        }

        $q = $this->db->get($tablename);

        if ($q->num_rows() > 0) {
            if($array == true) {
              $result = $q->row_array();
            }else {
              $result = $q->result_object();
            }
        } else {
            $result = false;
        }
        return $result;
    }
    
    public function get_workstreams($job_id){
        $this->db->select('users.profile_image,  workstreams.*');
        $this->db->from('workstreams');
        $this->db->join('users', 'users.id = workstreams.sender');
        $this->db->where('workstreams.job_id', $job_id);
        $query = $this->db->get();
        $result = $query->result_object();
        return $result;
    }
    
   
}