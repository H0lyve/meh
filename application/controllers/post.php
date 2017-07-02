<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){        
        $id = $this->input->get();
        
        $this->load->model('posts');
        $post = $this->posts->get_post($id['post_id']);
        
        $this->load->model('comments');
        $comments = $this->comments->get_comments($id['post_id']);
        
        $this->load->view('header');
        $this->load->view('post',$post[0]);
        foreach($comments as $key=>$comment){
            $this->load->view('comment',$comment);
        }
        if($this->check_login() != false){
            $data['user_id'] = $this->check_login();
            $this->load->view('comment_form',$data);
        }
        $this->load->view('footer');
	}
    public function check_login(){        
        $this->load->helper('cookie');
        if($this->session->userdata('username') != false){
            return $this->session->userdata('id');
        }elseif($this->input->cookie('log', TRUE) == '1' ){
            return $this->input->cookie('id', TRUE);
        }else{
            return false;
        }        
    }
    public function switch_status(){
        $this->load->model('posts');
        if($this->input->get() != NULL){
            $this->posts->switch_status($this->input->get('id'),$this->input->get('status'));
        }
        echo json_encode($this->input->get('status'));
    }
    public function add_form(){
        $this->load->view('header');
        $this->load->view('add_post_form');
        $this->load->view('footer');        
    }
    public function add(){
        if($this->input->post() != NULL ){
            $post = $this->input->post();
            $this->load->model('posts');
            $this->posts->add($post['title'],$post['content'],$post['id']);
        }
    }
}