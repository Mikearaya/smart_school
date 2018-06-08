<?php

class Scholarship_model extends MY_Model
{

    function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function get_scholarship($id = NULL) {

          if(!is_null($id)) {
              $this->db->where('id', $id);
              $result = $this->db->get('scholarships');
            return $result->row_array();
          }
      
        $result = $this->db->get('scholarships');
      return $result->result_array();
    }

    public function save_scholarship($scholarship) {
        $result = FALSE;
          try{
          if(!is_null($scholarship['id'])) {
            $this->db->where('id', $scholarship['id']);
            $result =  $this->db->update('scholarships', $scholarship );
          } else {
            $this->db->insert('scholarships', $scholarship);
            $result = ($this->db->affected_rows() > 0 ) ? true : false;
          }
        } catch(Exception $e) {
          $result = FALSE;
        }

      return $result; 
    }
    public function update_scholarship($scholarship) {
          $success = FALSE;
          
          if(!is_null($scholarship['id'])) {
            try {
              $this->db->where('id', $scholarship['id']);
              $success = $this->update('scholarships', $scholarship );
            } catch(Exception $e) {
              echo $e->getMessage();
            }
          }

      return $success;

    }
    public function delete_scholarship($id) {
        $this->db->delete('scholarships', array('id' => $id));
      return ($this->db->affected_rows() > 0 ) ? true : false;
    }

}
