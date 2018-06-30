<?php

class Users extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Users_model');
    }

    public function index_get($id = NULL) {
        $result['result'] = $this->Users_model->get_users($id);
        $result['columns']=[];
        if(count($result)>0)
        {
            $first_record=$result['result'][0];
            unset($first_record->id);
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }

    public function index_post($id = NULL) {
        $result['success'] = FALSE;
        $this->load->library('form_validation');
        		// set validation rules
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        $this->form_validation->set_rules('user_name', 'User name', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.user_name]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        

            if($this->form_validation->run() === FALSE) {
                $this->response($this->validation_errors(), API::HTTP_OK);
            } else {
                $data = array(
                    'id' => $id,
                    'first_name' => $this->input->post('first_name'),                    
                    'last_name' => $this->input->post('last_name'),
                    'user_name' => $this->input->post('user_name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password')                   
                );
                $result['success'] = $this->Users_model->register_user($data);
                $this->response($result, API::HTTP_OK);
        }
    }

    public function login() {

        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->se_rules('password', 'password', 'required');

            if($this->form_validation->run() === FALSE) {
                $this->response($result, API::HTTP_OK);
            } else {
                $data = array(
                    'user_name' => $this->input->post('user_name'),
                    'password' => $this->input->post('password')                   
                ); 
                $this->User_model->authentication();
                // set session user data
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_name', $user->user_name);
                $this->session->set_userdata('logged_in', true);
                $this->session('is_confirmed', (bool)$user->is_confirmed);
            }
            
    }
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}
