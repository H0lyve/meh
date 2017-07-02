<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Model {

	public function get_comments($id){
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where('post_id', $id);
        $this->db->where('com_status', 1);
        $this->db->join('users', 'comments.user_id = users.user_id');
        $query = $this->db->get();
        return $query->result_array();
	}
    public function add($id,$content,$post_id){
        $data = array(
           'com_content' => $content ,
           'user_id' => $id ,
           'post_id' => $post_id,
           'com_date' => date("Y-m-d")
        );

        $this->db->insert('comments', $data);
    }
    
    public function get_all_comments(){
        $query = $this->db->get('comments');
        return $query->result_array();
    }
    public function switch_status($id,$status){
        $data = array(
               'com_status' => $status
            );
        $this->db->where('com_id', $id);
        $this->db->update('comments', $data); 
    }    
}