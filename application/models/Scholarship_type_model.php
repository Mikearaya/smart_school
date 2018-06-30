<?php


class Scholarship_type_model extends MY_Model
{
    function __construct() {
      parent::__construct();
      $this->load->database();
    }
    function lists()
    {
        $table=[
            'from'=>'scholarship_type',
            'select'=>['id','name','amount','amount_type']
        ];
        return $this->select($table);
    }

    function get_scholarship_type($scholarship_typeId = NULL) {
      $result = NULL;
          if(!is_null($scholarship_typeId)) {
              $query = $this->db->get_where('scholarship_type', array('id' => $scholarship_typeId));
              $result = $query->result_array();
          } else {
              $query = $this->db->get('scholarship_type');
              $result = $query->result_array();
          }       
    return $result;
  }

    public function save_scholarship_type($scholarship_type){
          if(!is_null($scholarship_type['id'])) {
            return $this->$this->update_scholarship_type($scholarship_type);
        } else {
            $this->db->insert('scholarship_type', $scholarship_type);
        }
      return ($this->db->affected_rows()) ? true : false;
    }

    public function update_scholarship_type($scholarship_type){
      $this->db->where('id', $scholarship_type['id']);
        return  $this->db->update('scholarship_type', $scholarship_type);
    }

    public function delete_scholarship_type($id) {
        $this->db->delete('scholarship_type', array('id' => $id));
    return ($this->db->affected_rows() > 0) ? true : false;
}
}
