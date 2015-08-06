<?php

Class Profile extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('job');
        $this->load->helper('form');
            validate_login();
    }
    
    public function index() {
        $this->load->helper('form');
        $data['portfolio_data'] = $this->global_m->get('portfolio', 'user_id', user_meta('id'));
        $data['hourlies_data'] = $this->global_m->get('hourlies', 'user_id', user_meta('id'));
        $data['user_data'] = user_meta();
        $this->jobdesk->view('profile/index', $data);
        
    }
    public function update(){
       
        if($_FILES){
                $config['upload_path'] = './assets/uploads/profile/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
                if(!$this->upload->do_upload('profile_image')){
                    print_r($this->upload->display_errors());  
                }else{
                    $data = $this->upload->data();
                    echo './assets/uploads/profile/'.$data['file_name'];  
                    $this->global_m->update('users', array('profile_image' => $data['file_name']), 'id', user_meta('id'));
                }
        }else{
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '<br>');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('per_hour_rate', 'Per Hour Rate', 'required|numeric');
            $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
             if ($this->form_validation->run() == FALSE){
                echo json_encode(array('error' => validation_errors()));
             }else{
                $this->global_m->update('users', $_POST, 'id', user_meta('id'));
                echo json_encode(array('success' => 1));
             } 
        }
    }
    
    public function portfolio() {
        if($_FILES){
            $config['upload_path'] = './assets/uploads/portfolio/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2024';
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('image')){
                echo json_encode(array('error' => $this->upload->display_errors()));
            }else{
                $data = $this->upload->data();
                $this->global_m->insert('portfolio', array('user_id' => user_meta('id'), 'image'=>$data['file_name'], 'description' => $_POST['description']));
                echo json_encode(array('img' => './assets/uploads/portfolio/'.$data['file_name'], 'des' => $_POST['description']));
            }
        }else{
            $data = $this->global_m->get('portfolio', 'user_id', user_meta('id'));
            $html = '';
            if(!empty($data)){
                foreach ($data as $key => $value) {
                    $html .= '<a rel="prettyPhoto" href="'. assets_path('uploads/portfolio') . '/' . $value->image.'" class="preview">
                                 <img alt="'.$value->description.'" src="'.assets_path('uploads/portfolio') . '/' . $value->image. '" width="230" style="padding-bottom: 5px">
                             </a>';
                }
            }else{
              
            }
            echo $html;
        }
    }
    
    public function hourlies(){
        if($_FILES):
            $config['upload_path'] = './assets/uploads/hourlies/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2024';
            $this->load->library('upload', $config);
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '<br>');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('price', 'Price', 'numeric|required');
            if (!$this->upload->do_upload('media')  || $this->form_validation->run() == false ):
                echo json_encode(array('error' => $this->upload->display_errors().validation_errors()));
            else:
                $data = $this->upload->data();
                $this->global_m->insert('hourlies', array('user_id' => user_meta('id'), 'media' => $data['file_name'], 'description' => $_POST['description'], 'price' => $_POST['price']));
                echo json_encode(array('img' => './assets/uploads/hourlies/' . $data['file_name'], 'des' => $_POST['description']));
            endif;
        endif;
       
    }
    
    public function cover_image() {
        
          if($_FILES){
                $config['upload_path'] = './assets/uploads/cover/';
		$config['allowed_types'] = 'gif|jpg|png';
//		$config['max_size']	= '1024';
//		$config['max_width']  = '1024';
//		$config['max_height']  = '768';
		$this->load->library('upload', $config);
                if(!$this->upload->do_upload('cover_image')){
                    print_r($this->upload->display_errors());  
                }else{
                    $data = $this->upload->data();
                    echo './assets/uploads/cover/'.$data['file_name'];  
                    $this->global_m->update('users', array('cover_image' => $data['file_name']), 'id', user_meta('id'));
                }
          }
    }
}