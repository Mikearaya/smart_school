<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Students_model extends MY_Model
{
    function __construct() {
      parent::__construct();
      $this->load->database();
    }
    function lists()
    {
        $table=[
            'from'=>'students',
            'select'=>['id','full_name','id_no','birthdate','gender','blood_group']
        ];
        return $this->select($table);
    }

    function get_students() {
      $result = $this->db->get("students");

      return $result->result_array();

    }
}
