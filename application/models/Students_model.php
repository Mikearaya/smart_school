<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Students_model extends MY_Model {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
        }

    //selects one or multiple student records based on wether the id parameter is set
    public function get_students($id = NULL) {
       
        if(!is_null($id)) {            
    //if id is not null get the specific student

            $results = $this->db->get_where('students', array('id', $id));
            $result['result'] = $results->row_array();
      
            return $result;
        } else {
            //else get all student records
            $result = $this->db->get("students");
        }
      return $result->result_array();
    }

    // Handels both update or insert request based on the wether id parameter is set
    public function save_student($student, $id = NULL) {
        //if id is not null then its update request
        $data = array(
            'full_name' => $student['full_name'],
            'gender' => $student['gender'],
            'blood_group' => $student['blood_group'],
            'birthdate' => $student['birthdate'],            
            'region' => $student['region'],  
            'sub_city' => $student['sub_city'], 
            'city' => $student['city'],  
            'wereda' => $student['wereda'],  
            'house_no' => $student['house_no'],  
            'post_code' => $student['post_code'],  
            'phone' => $student['phone'],  
            'mobile' => $student['mobile'],  
        );
                
        
        $action = NULL;
        $last_id = NULL;
            if(!is_null($id)) {
                $last_id = $id;
                $action = 'update';
                 $this->update_student($data, $last_id);
            } else {//if id null then insert new record            
               $action = 'insert';
                $this->db->trans_start();
                $this->db->insert('students', $data);                
                $last_id = $this->db->insert_id();                                             
            }
            $this->db->trans_complete();
         return ($this->db->trans_status() === FALSE) ? false : $this->get_students($last_id);


    }

    public function update_student($data, $id) {
            $this->db->where('id', $id);
       return $this->db->update('students', $data);        
    }

   
   

    public function delete_student($id) {
        $this->db->where_in('id', $id);
        $this->db->delete('students');
        return ($this->db->affected_rows() > 0) ? true : false;
    }


}
