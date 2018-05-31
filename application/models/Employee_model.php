<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Employee_model extends MY_Model
{

    function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function get_employee($id = NULL) {

          if(!is_null($id)) {
              $this->db->where('id', $id);
              $result = $this->db->get('employees');
            return $result->row_array();
          }
      
        $result = $this->db->get('employees');
      return $result->result_array();
    }

    public function save_employee($employee) {
        $result = FALSE;
          try{
          if(!is_null($employee['id'])) {
            $this->db->where('id', $employee['id']);
            $result =  $this->db->update('employees', $employee );
          } else {
            $this->db->insert('employees', $employee);
            $result = ($this->db->affected_rows() > 0 ) ? true : false;
          }
        } catch(Exception $e) {
          $result = FALSE;
        }

      return $result; 
    }
    public function update_employee($employee) {
          $success = FALSE;
          
          if(!is_null($employee['id'])) {
            try {
              $this->db->where('id', $employee['id']);
              $success = $this->update('employees', $employee );
            } catch(Exception $e) {
              echo $e->getMessage();
            }
          }

      return $success;

    }
    public function delete_employee($id) {
        $this->db->delete('employees', array('id' => $id));
      return ($this->db->affected_rows() > 0 ) ? true : false;
    }

}
