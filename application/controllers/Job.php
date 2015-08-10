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
             $_POST['slug'] = str_replace(' ', '-', $_POST['job']['title'].'-'.rand(1, 1000));
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
                                    <div class="col-md-10"><a href="" class="job_title">'.$value->title.'</a></div>
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
                                    <div class="col-md-4"><p class="browse-a"><a href="#" class="bnt btn-lg btn-primary btn-proposal "> SEND PROPOSAL </a></p></div>
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
                                    <div class="col-md-10"><a href="" class="job_title">'.$value->title.'</a></div>
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
                                    <div class="col-md-4"><p class="browse-a"><a href="#" class="bnt btn-lg btn-primary btn-proposal "> SEND PROPOSAL </a></p></div>
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
             if($this->Job_m->insert('proposals', $_POST)){
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
            $job = $this->Job_m->query('select * from job where slug = "'.$slug.'"');
            $this->jobdesk->view('job/detail', compact('job'));
        endif;
    }
    
    public function proposal() {
        
    }
}