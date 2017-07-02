<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Model {

	public function get_last_ten_posts(){
        $this->db->select('post_id,post_date,post_title');
        $query = $this->db->get('posts', 10);
        return $query->result();
    }
    
    public function get_post($id){
        $query = $this->db->get_where('posts', array('post_id' => $id));        
        return $query->result_array();
    }
    
    public function get_all_ok_posts(){
        $query = $this->db->get_where('posts', array('post_status' => 1));
        return $query->result_array();
    }
    public function get_all_posts(){
        $query = $this->db->get('posts');
        return $query->result_array();
    }
    
    public function switch_status($id,$status){
        $data = array(
               'post_status' => $status
            );
        $this->db->where('post_id', $id);
        $this->db->update('posts', $data); 
    }
    public function add($title,$content,$id){
        $data = array(
           'post_title' => $title ,
           'post_content' => $content ,
           'user_id' => $id ,
           'post_date' => date("Y-m-d")
        );

        $this->db->insert('posts', $data);
        $insert_id = $this->db->insert_id();
        redirect('');
    }
}