<?php


  class Enrollment_model extends MY_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function get_enrollment($id = NULL) {
      $result = $this->db->get('enrollment');
      return $result->result_array();
    }
  }

?>
