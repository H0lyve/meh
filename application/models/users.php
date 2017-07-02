<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

	public function login($user,$psw,$rem = "off"){
        $query = $this->db->get_where('users', array('user_name' => $user));
        $result = $query->result_array();
        if(empty($result)){
            return 'wrong_user_name';
        }else{
            if($result[0]['user_psw'] != $psw ){
                return 'wrong_psw';
            }else{
                if($result[0]['user_admin']){
                    $data['msg'] = 'login_admin';
                    $data['id'] = $result[0]['user_id'];
                    return $data ;
                }elseif($result[0]['user_status'] == 0){            
                    return 'banned_user';
                }else{
                    if($rem == 'on'){
                        $data['msg'] = 'login_rem';
                        $data['id'] = $result[0]['user_id'];
                        return $data ;
                    }else{
                        $data['msg'] = 'login_no_rem';
                        $data['id'] = $result[0]['user_id'];
                        return $data ;
                    }
                }
            }
        }
    }
    
    public function create($name,$psw,$email){
        $data = array(
           'user_name' => $name ,
           'user_psw' => $psw ,
           'user_date' => date("Y-m-d")
        );

        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function get_all_users(){
        $query = $this->db->get('users');
        return $query->result_array();
    }
    
    public function switch_status($id,$status){
        $data = array(
               'user_status' => $status
            );
        $this->db->where('user_id', $id);
        $this->db->update('users', $data); 
    }
    
    public function auth_token($email){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < 24; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        
        $data = array(
               'user_psw_rec' => $string
            );

        $this->db->where('user_email', $email);
        $this->db->update('users', $data);
        
        return $string;
    }
    public function get_id_by_token($token){
        $this->db->select('user_id,user_name');
        $this->db->where('user_psw_rec', $token);
        $query = $this->db->get('users');
        return $query->result_array();
    }
    public function new_psw($id,$psw){
        $data = array(
           'user_psw' => $psw ,
           'user_psw_rec' => ''
        );
        $this->db->where('user_id',$id);
        $this->db->update('users',$data);
    }
}