<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Fee_type_model extends MY_Model
{

    public function __construct() {
      parent::__construct();
      $this->load->database();
    }
    function lists()
    {
        $table=[
            'from'=>'fee_type',
        ];
        return $this->select($table);
    }
    function get_fee_type() {
      $result = $this->db->get('fee_type');
      return $result->result_array();
    }
}
