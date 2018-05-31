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
            $this->db->select();
            $this->db->from('students');
            $this->db->where('students.id',$id);
            $this->db->join('address', 'students.id = address.studentId', 'left');
            $result = $this->db->get();
            return $result->row_array();
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
            if($student['address'] == 'true') {
                $this->set_address($action, $student['address'], $last_id);                        
            }
            $this->db->trans_complete();
         return ($this->db->trans_status() === FALSE) ? false : $this->get_students($last_id);

    }

    public function update_student($data, $id) {
            $this->db->where('id', $id);
       return $this->db->update('students', $data);        
    }

    private function set_address($action, $address, $id) {
        
        $studentAddress = array( 
            'region' => $address['region'],
            'wereda' => $address['wereda'],
            'kebele' => $address['kebele'],
            'house_no' => $address['houseNo'],
            'mobile' => $address['mobile'],
            'phone' => $address['phone'],
            'post_code' => $address['postCode'],
            'type' => $address['type'],
            'status' => $address['status'],
         
        );
        if($action == 'update') {
            $this->db->where('studentId', $id);
            $this->db->update('address', $studentAddress);
        } else {
            $studentAddress['studentId'] = $id;
            $this->db->insert('address', $studentAddress);
        }
    }

    public function delete_student($id) {
            $this->db->delete('students', array('id' => $id));
        return ($this->db->affected_rows() > 0) ? true : false;
    }


}
