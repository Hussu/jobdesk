<?php

Class Job extends CI_Controller{
    private $fixed_type = 'FIXED PRICE';
    private $hourly = 'PER HOUR';
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'date'));
        $this->load->model('Job_m');
        validate_login();
    }
    
    public function index($job){
    }
    
    public function post(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class=error>', '</p>');
        if($this->form_validation->run('postjob') == false){
        }else{
             $_POST['job']['user_id'] = user_meta('id');
              $_POST['job']['slug'] = str_replace(' ', '-', $_POST['job']['title'].'-'.rand(1, 1000)); 
            if($this->Job_m->insert('job', $_POST['job'])){
                $this->session->set_flashdata('job_success_page', 'Congratulations Job Posted Successfully');
                redirect('job/post');
            }
        }
        $category = $this->Job_m->query('select * from category');
        $cat = array();
        $cat['0'] = 'Select';
        foreach($category as $key=> $value):
            $cat[$value->id] = $value->name;
        endforeach;
        $this->jobdesk->view('job/post', compact('cat'));
    }
    
    public function get_subcategory(){
        $cat = $this->input->post('category');
        $sub_category = $this->Job_m->query('select id, name from sub_category where cat_id = "'.$cat.'"');
        $html = '';
        if(!empty($sub_category)):
                $html .= "<option value=0>Subcategory</option>";
            foreach ($sub_category as $key => $value) {
                $html .= "<option value=".$value->id.">".$value->name."</option>";
            }
        endif;
        echo $html;
    }
    
    public function browse(){
        date_default_timezone_set('Asia/Kolkata');
        $jobs = $this->Job_m->browse_jobs();
        $categories = $this->Job_m->query('select * from category ORDER BY name asc');
        $this->jobdesk->view('job/browse', compact('jobs', 'categories'));
    }
    
    public function sorting(){
        $job_type = $this->input->post('job_type');
        $experience_level = $this->input->post('level');
        $category = $this->input->post('cat_id');
        $level =  !empty($experience_level)? explode(',', $experience_level) : '';
        if($page = $this->input->post('page')):
            $offset = ($page-1) * 10;
            else:
             $offset = 0;
        endif;
        $result = $this->Job_m->sorting($job_type, $level, $category, $offset);
         if(!empty($result)){
             $html = '';
             foreach ($result as $key => $value) {
                 $addressArray = explode(",", $value->address);
                 $type =  $value->type == 'fixed_type'  ? 'FIXED PRICE' : 'PER HOUR';
                 if($value->level == 1){ $level =  "$";} elseif($value->level == 2){ $level = '$$'; }else{ $level = "$$$"; }
                 $image_path = !empty($value->profile_image) ? assets_path("uploads/profile/".$value->profile_image) : assets_path("images/default_profile.jpg");
                 $html .= 
                            '<div class="col-md-12 single_job">   
                                <div class="col-md-12">
                                    <div class="col-md-10"><a href="detail/'.$value->slug.'" class="job_title">'.$value->title.'</a></div>
                                    <div class="col-md-2 ">
                                        <span class="">'.$type.'</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="">
                                        <span class=" job_exp" >'.$level.'</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class=" job_price" >$'.$value->rate.'</span>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 20px  ">
                                    <div class="col-md-3">
                                        <div class="col-md-3">
                                            <img src="'.$image_path .'" class="browse_job_user_img">
                                        </div>
                                        <div class="col-md-9">
                                            <p style="margin-bottom:0; margin-left: 10px">'.$value->first_name.'</p>
                                            <p style="margin-left: 10px"><strong>'.end($addressArray).'</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3"><p class="browse-p">Posted '. timespan(human_to_unix($value->created_at), time(), 1) . " ago".'</p></div>
                                    <div class="col-md-2"><p class="browse-p">Proposals 2</p></div>
                                    <div class="col-md-4"><p class="browse-a"><a href="detail/'.$value->slug.'" class="bnt btn-lg btn-primary btn-proposal "> SEND PROPOSAL </a></p></div>
                                </div>
                            </div>';
                 
                $total_jobs = count($result);
             }
         }else{
             $total_jobs = 0;
             $html = "<h1>no job found</h1>";
         }
         
             $result_array = array('html' => $html, 'total_jobs' => $total_jobs);
             echo json_encode($result_array); 
        
    }
    
    public function search_job(){
        $title = $this->input->post('title');
         if(!empty($title)){}
         $result = $this->Job_m->search_job($title);
         if(!empty($result)){
             $html = '';
             foreach ($result as $key => $value) {
                 $addressArray = explode(",", $value->address);
                 $type =  $value->type == 'fixed_type'  ? 'FIXED PRICE' : 'PER HOUR';
                 if($value->level == 1){ $level =  "$";} elseif($value->level == 2){ $level = '$$'; }else{ $level = "$$$"; }
                 $image_path = !empty($value->profile_image) ? assets_path("uploads/profile/".$value->profile_image) : assets_path("images/default_profile.jpg");
                 $html .= 
                            '<div class="col-md-12 single_job">   
                                <div class="col-md-12">
                                    <div class="col-md-10"><a href="detail/'.$value->slug.'" class="job_title">'.$value->title.'</a></div>
                                    <div class="col-md-2 ">
                                        <span class="">'.$type.'</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="">
                                        <span class=" job_exp" >'.$level.'</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class=" job_price" >$'.$value->rate.'</span>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 20px  ">
                                    <div class="col-md-3">
                                        <div class="col-md-3">
                                            <img src="'.$image_path .'" class="browse_job_user_img">
                                        </div>
                                        <div class="col-md-9">
                                            <p style="margin-bottom:0; margin-left: 10px">'.$value->first_name.'</p>
                                            <p style="margin-left: 10px"><strong>'.end($addressArray).'</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3"><p class="browse-p">Posted '. timespan(human_to_unix($value->created_at), time(), 1) . " ago".'</p></div>
                                    <div class="col-md-2"><p class="browse-p">Proposals 2</p></div>
                                    <div class="col-md-4"><p class="browse-a"><a href="detail/'.$value->slug.'" class="bnt btn-lg btn-primary btn-proposal "> SEND PROPOSAL </a></p></div>
                                </div>
                            </div>';
                 
                $total_jobs = count($result);
             }
         }else{
             $total_jobs = 0;
             $html = "<h1>no job found</h1>";
         }
         
             $result_array = array('html' => $html, 'total_jobs' => $total_jobs);
             echo json_encode($result_array); 
    }
    
    public function detail($slug = '') {
        if($this->input->post('detail')){
            $_POST['user_id'] = user_meta('id');
            if(!$this->Job_m->query('select * from proposals where job_id = "'.$this->input->post('job_id').'" and user_id = "'.$_POST['user_id'].'"')){
                $creater_id = $this->input->post('creater_id');
                unset($_POST['creater_id']);
             if($this->Job_m->insert('proposals', $_POST)){
                $this->Job_m->insert('notifications', array('type' => 1, 'url' => base_url('job/view/'.$this->input->post('job_slug').'?rel=buyer'), 'msg' => 'you have a new proposal', 'user_id' => $creater_id));
                $this->session->set_flashdata('class', 'success');
                $this->session->set_flashdata('proposal_success', 'Proposal has been submitted Successfully');
               redirect('job/detail/'.$this->input->post('job_slug'));
             }
            }else{
                $this->session->set_flashdata('class', 'danger');
                $this->session->set_flashdata('proposal_success', 'You have already subimmited proposal for this job');
               redirect('job/detail/'.$this->input->post('job_slug'));
            }
        }
        if(!empty($slug)):
            $job = $this->Job_m->query('select * from job where slug = "'.$slug.'" limit 1');
            $this->jobdesk->view('job/detail', compact('job'));
        endif;
    }
    
    public function proposal() {
        
    }
    
    
    public function activity(){
       $rel = $this->input->get('rel');
       $user_data = user_meta();
       if($rel == 'buyer'):
           $posted_jobs =  $this->Job_m->get_posted_job();
       else:
           $posted_jobs =  $this->Job_m->get('job', 'assign_to', $user_data->id);
       endif;
       $this->jobdesk->view('job/posted_jobs', compact('posted_jobs', 'user_data', 'rel'));
    }
    
     /* ****** view posted ******* */
    public function view($slug = ''){
        $this->load->helper('text');
        if(!empty($_POST['user_id'])){
            $user_id = $_POST['user_id'];
            $this->Job_m->insert('notifications', array('type' => 1, 'url' => base_url('job/view/'.$this->input->post('job_slug').'?rel=seller'), 'msg' => 'Your proposal has been accepted', 'user_id' => $user_id));
            $job_id = $_POST['job_id'];
            $this->Job_m->update('job', array('status' => 'ongoing', 'assign_to' => $user_id), 'id', $job_id);
        }
        if(!empty($slug)):
            $job = $this->Job_m->query('select * from job where slug = "'.$slug.'"');
            if(!empty($job)){
                $id = user_meta('id');
                if($job->assign_to == $id){ $rel = 'seller';}elseif($job->user_id == $id){$rel = 'buyer';}
                $workstream = $this->Job_m->get_workstreams($job->id);
                $this->Job_m->update('workstreams', ['is_read' => 1], 'job_id', $job->id );
                $proposals = $this->Job_m->get_proposals($slug);
                $this->jobdesk->view('job/view', compact('job', 'proposals', 'rel', 'workstream'));
            }
        endif;
        
    }
    
    public function workstream(){
        if($this->input->post('sender') && $this->input->post('receiver')):
            $this->Job_m->insert('workstreams', $_POST);
        endif;
        
        if($this->input->post('receiver_id') && $this->input->post('job_id')):
            $job_id = $this->input->post('job_id');
            $reciever = $this->input->post('receiver_id');    
            $workstream = $this->Job_m->query('select id, message from workstreams where job_id = "'.$job_id.'" and receiver = "'.$reciever.'" And is_read = 0 limit 1 ');
            if(!empty($workstream)):
                $this->Job_m->update('workstreams', ['is_read' => 1], 'id', $workstream->id);
               die($workstream->message);
            endif;
        endif;
    }
    
}