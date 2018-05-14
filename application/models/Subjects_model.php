<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Subjects_model extends MY_Model
{
    function __construct() {
      $this->load->database();
    }
    function lists()
    {
        $table=[
            'from'=>'subjects',
        ];
        return $this->select($table);
    }

    function get_subject() {

      $result = $this->db->get("courses");
      return $result->result_array();
    }
}
