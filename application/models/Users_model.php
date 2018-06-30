<?php

class Users_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_users($id = null)
    {
        $result = null;
        if (!is_null($id)) {
            $query = $this->db->get_where('users', array('id' => $id));
            $result = $query->row_array();
        } else {
            $query = $this->db->get('users');
            $result = $query->result_array();
        }

        return $result;
    }

    public function register_user($user)
    {
        if (!is_null($user['id'])) {
            return $this->$this->update_user($user);
        } else {
            $this->db->insert('users', $user);
        }
        return ($this->db->affected_rows()) ? true : false;
    }

    public function Authentication()
    {
        $user_name = $this->input->post('user_name');
        $password = Utils::hash('sha1', $this->input->post('password'));

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_name', $user_name);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $data = $this->db->get();

        if ($data->num_rows() == 1) {
            $row = $data->row();
            if ($row->is_active != 1) {
            $this->response(API::HTTP_FORBIDDEN);
            } else {
                $session_data = array(
                    'user_id' => $row->user_id,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'user_name' => $row->user_name,
                    'email' => $row->email
                );
                $this->session->set_userdata('logged_in', $session_data);
            }
        } else {
            $this->response(API::HTTP_UNAUTHORIZED);
        }

       // return $data;

    }
}
