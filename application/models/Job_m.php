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
        if ($this->db->insert($tablename, $data_array)) {
            $result = $this->db->insert_id();
        } else {
            $result = false;
        }
        return $result;
    }
    
    public function browse_jobs(){
        $id = user_meta('id');
        $this->db->select("job.*, users.first_name, users.last_name, users.profile_image, users.address, users.id");
        $this->db->from('job');
        $this->db->join('users', 'job.user_id = users.id');
        $this->db->order_by('job.id', 'DESC');
         $this->db->limit(10);
        $result =  $this->db->get();
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
}