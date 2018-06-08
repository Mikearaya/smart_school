<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Subjects_model extends MY_Model   {
        
    function __construct() {
        $this->load->database();
    }
    
    function get_subject($id = NULL) {
        $result = NULL;
        if (!is_null($id)) {
            $this->db->where('id', $id);
        } 
            $result = $this->db->get("subjects");            
        return $result->result_array();
    }

    function save_subjects( $input, $id = NULL ) {

            $data = $this->initialize_data_model($input, $id);
            $last_id = NULL;
            
            $this->db->trans_begin();

            try {
                    if($id) {          
                        $this->update_subjects($data, $id);
                        $last_id = $id;
                    } else {
                        $this->db->insert_batch('subjects', $data);
                    }
                $this->db->trans_complete();
            
            } catch(Exception $e) {
                $this->db->trans_rollback();
                    echo $e->getMessage();
            }
        
        return ($this->db->trans_status() === FALSE) ? FALSE : true;
    }

    function update_subjects($input, $id) {
        $this->db->update_batch('subjects', $input, 'id');
    }

    private function initialize_data_model($input_data, $id = NULL) {

            $data;
            $total = count($input_data['title']);
            for ($i = 0; $i < $total; $i++) {
                $data[$i]['id']  = $id;
                $data[$i]['title'] = $input_data['title'][$i];
                $data[$i]['subject_type'] = $input_data['subject_type'][$i];
                $data[$i]['grade_weightage'] = $input_data['grade_weightage'][$i];
                //$data[$i]['code'] = $input_data['code'][$i];

            }
        
        return $data;
    }


}

