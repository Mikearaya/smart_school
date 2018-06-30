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
    function get_feeType($fee_typeId = null)
    {
        $result = null;
        if (!is_null($fee_typeId)) {
            $query = $this->db->get_where('fee_type', array('id' => $fee_typeId));
            $result = $query->row_array();
        } else {
            $query = $this->db->get('fee_type');
            $result = $query->result_array();
        }
        return $result;
    }

    public function save_feeType($fee_type)
    {
        if (!is_null($fee_type['id'])) {
            return $this->$this->update_feeType($fee_type);
        } else {
            $this->db->insert('fee_type', $fee_type);
        }
        return ($this->db->affected_rows()) ? true : false;
    }

    public function update_feeType($fee_type)
    {
        $this->db->where('id', $fee_type['id']);
        return $this->db->update('fee_type', $fee_type);
    }

    public function delete_feeType()
    {
        $this->db->delete('fee_type', array('id' => $id));
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
