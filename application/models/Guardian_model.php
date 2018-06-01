<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Guardian_model extends MY_Model {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
        }

    //selects one or multiple guardian records based on wether the id parameter is set
    public function get_guardian($id = NULL) {
    //if id is not null get the specific guardian               
        if(!is_null($id)) {            
            $result = $this->db->get_where('guardian', array('student_code' =>$id));
            $reuslt1['guardian'] = [];
            $result1[] = $result->row_array();
            return $result1;
        } else { //else get all guardian records//if id is not null get the specific guardian                        
            $result = $this->db->get("guardian");
        }
        
      return $result->result_array();

    }

    // Handels both update or insert request based on the wether id parameter is set
    public function save_guardian($guardian, $id = NULL) {
        //if id is not null then its update request
          $data = array(
                    'id' => $id, 
                    'student_code' => $guardian['studentId'],
                    'full_name' => $guardian['full_name'],
                    'gender' => $guardian['gender'],
                    'date_of_birth' => isset($guardian['birthdate']) ? $guardian['birthdate'] : NULL,
                    'relation' => $guardian['relation'],
                    'wereda' => $guardian['wereda  '],
                    'city' => $guardian['city'],
                    'sub_city' => $guardian['sub_city'],                                     
                    'house_no' => $guardian['house_no'],
                    'phone' => $guardian['phone']                    
                );
        $action = NULL;
        $last_id = NULL;
        $this->db->trans_start();
            if(!is_null($id)) {
                $last_id = $id;
                $action = 'update';
                 $this->update_guardian($data, $last_id);
            } else {//if id null then insert new record            
                $action = 'insert';                
                $this->db->insert('guardian', $data);                
                $last_id = $this->db->insert_id();                                             
            }            
            $this->db->trans_complete();
         return ($this->db->trans_status() === FALSE) ? false : $this->get_guardian($last_id);


    }

    public function update_guardian($data, $id) {
            $this->db->where('id', $id);
       return $this->db->update('guardian', $data);        
    }

 
    public function delete_guardian($id) {
        $this->db->where_in('id', $id);
        $this->db->delete('guardian');
        return ($this->db->affected_rows() > 0) ? true : false;
    }


}
