<?php


  class Enrollment_model extends MY_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    function get_enrollment($enrollmentId = NULL) {
      $result = NULL;
          if(!is_null($enrollmentId)) {
              $query = $this->db->get_where('enrollment', array('id' => $enrollmentId));
              $result = $query->row_array();
          } else {
              $query = $this->db->get('enrollment');
              $result = $query->result_array();
          }       
    return $result;
  }

    public function save_enrollment($enrollment){
          if(!is_null($enrollment['id'])) {
            return $this->$this->update_enrollment($enrollment);
        } else {
            $this->db->insert('enrollment', $enrollment);
        }
      return ($this->db->affected_rows()) ? true : false;
    }

    public function update_enrollment($enrollment){
      $this->db->where('id', $enrollment['id']);
        return  $this->db->update('enrollment', $enrollment);
    }

    public function delete_enrollment(){
      $this->db->delete('enrollment', array('id' => $id));
      return ($this->db->affected_rows() > 0) ? true : false;
    }
    
  }
?>
