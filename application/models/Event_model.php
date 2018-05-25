<?php

class Event_model extends MY_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_events($id = NULL) {
    $result = $this->db->get('events');
    return $result->result_array();
  }
}

?>
