<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
	}
    public function log(){
        $this->load->model('users');
        
        $post = $this->input->post();
        if(isset($post['remember'])){
            $log_result = $this->users->login($post['username'],$post['password'],$post['remember']);
        }else{
            $log_result = $this->users->login($post['username'],$post['password'],false);
        }
        if($log_result['msg'] == "wrong_user_name" || $log_result['msg'] == "wrong_psw"){
            $msg = array() ;
            $msg['error'] = 1;
            $this->load->view('header');
            $this->load->view('login',$msg);
            $this->load->view('footer');
        }elseif($log_result['msg'] == "banned_user"){
            $msg = array() ;
            $msg['error'] = 2;
            $this->load->view('header');
            $this->load->view('login',$msg);
            $this->load->view('footer');
        }elseif($log_result['msg'] == "login_admin"){
            $this->load->helper('cookie');
            set_cookie('log','1','604800');
            set_cookie('id',$log_result['id'],'604800');
            set_cookie('name',$post['username'],'604800');
            set_cookie('admin','1','604800');
            redirect('');
        }elseif($log_result['msg'] == "login_rem"){
            $this->load->helper('cookie');
            set_cookie('log','1','604800');
            set_cookie('id',$log_result['id'],'604800');
            set_cookie('name',$post['username'],'604800');
            redirect('');
        }elseif($log_result['msg'] == "login_no_rem"){
            $newdata = array(
                'username'  => $post['username'],
                'id' => $log_result['id'],
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            redirect('');        
        }      
    }
    public function rec(){        
        $this->load->view('header');
        $this->load->view('rec_form');
        $this->load->view('footer');       
    }
    public function rec_send(){
        $this->load->model('users');
        
        if($this->input->post() != NULL){
            
            $post = $this->input->post();
            
            $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.googlemail.com',
              'smtp_port' => 465,
              'smtp_user' => 'meh0blog@gmail.com', // change it to yours
              'smtp_pass' => 'jesuisunegirafe', // change it to yours
              'mailtype' => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE
            );
            $data['auth_token'] = $this->users->auth_token($post['email']);
            $message = $this->load->view('recovery_email',$data,true);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('meh0blog@gmail.com'); // change it to yours
            $this->email->to($post['email']);// change it to yours
            $this->email->subject('Meh Blog - Password recovery');
            $this->email->message($message);
            if($this->email->send()){
                redirect('');
            }else{
                show_error($this->email->print_debugger());
            }
        }        
    }
    
    public function rec_new_form(){
        if($this->input->get() != NULL){
            $token = $this->input->get('at');
            $this->load->model('users');
            $result =$this->users->get_id_by_token($token); 
            if(!empty($result)){
                            
                $this->load->view('header');
                $this->load->view('rec_new_form',$result[0]);
                $this->load->view('footer');
            }
        }else{
            redirect('');
        }
    }
        
    public function logout_sess(){
        $this->session->sess_destroy();
        redirect('');
    }
    public function logout_cook(){
        $this->load->helper('cookie');
        delete_cookie("log");
        delete_cookie("id");
        delete_cookie("name");
        delete_cookie("admin");
        redirect('');
    }
    public function admin(){
        if($this->input->post() != NULL){
            $mdp = $this->input->post('mdp');
            if(hash('sha512',$mdp,false) !=  '45e4de5ccda45faa8b1aa8955b0f852e8ffe550af52087ccfc288017722b17a487ef73a6a7a7303a2134620e22d6cef0de3abe7b7a0175eed0d179b32974c15f'){
                redirect('');
            }else{
                $this->load->model('users');
                $this->load->model('posts');
                $this->load->model('comments');
                
                $data['users'] = $this->users->get_all_users();
                $data['posts'] = $this->posts->get_all_posts();
                $data['comments'] = $this->comments->get_all_comments();
                
                $this->load->view('header');
                $this->load->view('moderation',$data);
                $this->load->view('footer');
            }
        }
    }
}