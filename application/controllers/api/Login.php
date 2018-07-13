<?php
class Login extends API {

    public function __construct($config = 'rest') {    
        parent::__construct($config);
        $this->load->model('login_model');
    }

function index_post(){
        $result;
    
        $username=$this->input->post('user_name',true);
        $password=$this->input->post('password',true);
        $users=$this->login_model->select_users($username,$password);
        
        if(!$users){
            $result['success']= false;

    
        } else {
            $this->session->set_userdata('id',$users['id']);
            $this->session->set_userdata('user_name',$users['user_name']);
            
            $result['success']= true;
            
            $result['user_name'] = $this->session->userdata('user_name');
            
        }
        
        $this->response($result, API::HTTP_OK);
    }

    function index_get() {
        $this->session->sess_destroy();
    }
}
?>