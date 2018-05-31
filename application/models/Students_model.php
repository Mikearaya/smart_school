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

    //selects one or multiple student records based on wether the id parameter is set
    public function get_students($id = NULL) {
       
        if(!is_null($id)) {            
            //if id is not null get the specific student
            $result = $this->db->get_where('students', array('id' => $id));
            return $result->row_array();
        } else {
            //else get all student records
            $result = $this->db->get("students");
        }
      return $result->result_array();
    }

    // Handels both update or insert request based on the wether id parameter is set
    public function save_student($student) {
        //if id is not null then its update request
        if(!is_null($student['id'])) {
            $this->db->where('id', $student['id']);
            $this->db->update('students', $student);
        } else {
            //if id null then insert new record            
            $this->db->insert('students', $student);
        }
        return ($this->db->affected_rows() > 0) ? true : false; 

    }

    public function update_student($id, $data) {
            $this->db->where('id', $id);
       return $this->db->update('students', $data);        
    }

    public function delete_student($id) {
        $this->db->where_in('id', $id);
        $this->db->delete('students');
        return ($this->db->affected_rows() > 0) ? true : false;
    }


}
