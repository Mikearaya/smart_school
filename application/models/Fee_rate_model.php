<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Fee_rate_model extends MY_Model
{

  function __construct() {
    parent::__construct();
    $this->load->database();
  }

    function get_rate_model($id = NULL) {
      $result = $this->db->get('fee_rate');
      return $result->result_array();
    }
}
