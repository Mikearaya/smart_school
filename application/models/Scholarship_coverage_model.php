<?php

class Scholarship_coverage_model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function lists()
    {
        $table = [
            'from' => 'scholarship_coverage',
            'select' => ['id', 'scholarship', 'scholarship_type', 'fee_type', 'amount', 'amount_type']
        ];
        return $this->select($table);
    }

    function get_scholarship_coverage($scholarship_coverageId = NULL) {
      $result = NULL;
          if(!is_null($scholarship_coverageId)) {
              $query = $this->db->get_where('scholarship_coverage', array('id' => $scholarship_coverageId));
              $result = $query->result_array();
          } else {
              $query = $this->db->get('scholarship_coverage');
              $result = $query->result_array();
          }       
    return $result;
  }

    public function save_scholarship_coverage($scholarship_coverage){
          if(!is_null($scholarship_coverage['id'])) {
            return $this->$this->update_scholarship_coverage($scholarship_coverage);
        } else {
            $this->db->insert('scholarship_coverage', $scholarship_coverage);
        }
      return ($this->db->affected_rows()) ? true : false;
    }

    public function update_scholarship_coverage($scholarship_coverage){
      $this->db->where('id', $scholarship_coverage['id']);
        return  $this->db->update('scholarship_coverage', $scholarship_coverage);
    }

    public function delete_scholarship_coverage(){
      $this->db->delete('scholarship_coverage', array('id' => $id));
      return ($this->db->affected_rows() > 0) ? true : false;
    }
}
