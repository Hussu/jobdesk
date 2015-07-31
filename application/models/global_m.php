<?php

class Global_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($tablename, $data_array) {
        if ($this->db->insert($tablename, $data_array)) {
            $result = $this->db->insert_id();
        } else {
            $result = false;
        }
        return $result;
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

    public function delete($tablename, $where_key, $where_val) {
        if (is_array($where_val)) {
            $this->db->where_in($where_key, $where_val);
        } else {
            $this->db->where($where_key, $where_val);
        }

        if ($this->db->delete($tablename)) {
            $result = true;
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

    public function login($email, $password) {
        if (!empty($email) && !empty($password)) {
            $this->db->where('email', $email);
            $this->db->where('password', $password);
        }

        $q = $this->db->get('users');
        
        if ($q->num_rows() > 0) {
            $result = $q->row();
        } else {
            $result = false;
        }
        return $result;
    }
    
    public function fb_register() {
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                $data = $this->facebook->api('/me');
                    if ($result = $this->get('users', 'email', $data['email'])) {
                        $sess_array = array(
                        'id' => $result[0]->id,
                        'username' => $result[0]->first_name . ' ' . $result[0]->last_name,
                        'email' => $result[0]->email,
                        'role' => $result[0]->role
                    );
                    $this->session->set_userdata($sess_array);
                    redirect('user/profile');
                } else {
                    $insertData = array('email' => $data['email'], 'first_name' => $data['first_name'], 'last_name' => $data['last_name']);
                    if ($insertID = $this->insert('users', $insertData)) {
                        $sess_array = array(
                            'id' => $insertID,
                            'username' => $data['first_name'] . ' ' . $data['last_name'],
                            'email' => $data['email'],
                            'role' => '',
                        );
                        $this->session->set_userdata($sess_array);
                    }
                    redirect('user/profile');
                }
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }
    }
    
    public function query($sql, $array = false) {
        $q = $this->db->query($sql);
        $data = ($array) ? $q->result_array() : $q->result_object();
        return (count($data) > 1) ? $data : $data[0];
    }

}
