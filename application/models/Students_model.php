<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Students_model extends MY_Model {
    function __construct() {
      parent::__construct();
      $this->load->database();
    }

    function get_students($id = NULL) {
        if(!is_null($id)) {
        }
      $result = $this->db->get("students");

      return $result->result_array();
    }

    function save_student($new_student) {
        $this->db->insert('students', $new_student);
        return ($this->db->affected_rows() > 0) ? true : false; 

    }

    function update_student($id, $data) {
        $this->db->where('id', $id);
       return $this->db->update('students', $data);
        
    }

    function delete_student($id) {
         $this->db->delete('students', array('id' => $id));
        return ($this->db->affected_rows() > 0) ? true : false;
    }


}
