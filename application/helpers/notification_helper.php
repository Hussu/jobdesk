<?php

function get_notification(){
     $id = is_logged_in();
     $ci = &get_instance();
     $ci->db->where('user_id', $id);
     $query = $ci->db->get('notifications');
     $result = $query->result_object();
     if(!empty($result)){
         $liHtml = '';
         foreach ($result as $key => $value) {
            $liHtml .= '<li><a href="'.$value->url.'">'.$value->msg.'</a></li>';
         }
         return $liHtml;
     }else{
         return $liHtml = '<li><a href="javascript:void(0)">No Notification</a></li>';;
     }
}

function get_message(){
     $id = is_logged_in();
     $ci = &get_instance();
     $ci->load->helper('text');
     $query = $ci->db->query('SELECT * FROM (SELECT * FROM `workstreams` ORDER BY time DESC) AS t where receiver ="'.$id.'" GROUP BY job_id');
     $result = $query->result_object();
     if(!empty($result)){
         $total = '';
         $liHtml = '';
         foreach ($result as $key => $value) {
            $job_data = job_data('id', $value->job_id, ['slug', 'user_id']);
            $rel = $job_data->user_id == $id ? 'buyer' : 'seller'; 
            $first_name = get_user_data($value->sender, 'first_name');
            if($value->is_read == 0): $class = 'active'; $total++; else:  $class = ''; endif;
            $liHtml .= '<li class='.$class.'><a href="'.  base_url("job/view/".$job_data->slug.'?rel='.$rel).'">'.character_limiter($first_name.' : '.$value->message, 55).'</a></li><hr style="margin-top:5px; margin-bottom:5px">';
         }
         return array('html' => $liHtml, 'total' => $total);
     }else{
         return $liHtml = '<li><a href="javascript:void(0)">No Message</a></li>';;
     }
}