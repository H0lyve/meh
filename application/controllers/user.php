<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function switch_status(){
        $this->load->model('users');
        if($this->input->get() != NULL){
            $this->users->switch_status($this->input->get('id'),$this->input->get('status'));
        }
        echo json_encode($this->input->get('status'));
    }
    public function reg(){
        $this->load->model('users');        
        if($this->input->post() != null){
            $post = $this->input->post();
            $id = $this->users->create($post['username'],$post['reg-password'],$post['email']);
            $newdata = array(
                'username'  => $post['username'],
                'id' => $id,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            redirect('');
        }else{
            $this->load->view('header');
            $this->load->view('home');
            $this->load->view('footer');
        }
        
    }
    public function new_psw(){
        if($this->input->post() != NULL){
            $post = $this->input->post();
            $this->load->model('users');
            $this->users->new_psw($post['id'],$post['rec-password']);
        }
        redirect('');
    }
}