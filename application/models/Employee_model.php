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

    function get_employee($id = NULL) {
      $result = $this->db->get('employees');
      return $result->result_array();
    }
}
