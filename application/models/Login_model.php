<?php
class Login_model extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
//login function for user
     function select_users($username,$password){
        $where=array(
            'user_name'=>$username,
            'password'=>$password
        );
        $this->db->select('*')->from('users')->where($where);
        $query=$this->db->get();
        return $query->first_row('array');
    }
}
?>