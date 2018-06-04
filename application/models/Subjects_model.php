<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Subjects_model extends MY_Model
{
    function __construct() {
      $this->load->database();
    }
    function lists()
    {
        $table=[
            'from'=>'subjects',
        ];
        return $this->select($table);
    }

    function get_subject($id = NULL) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
            $result = $this->db->get('subjects');
            return $result->row_array();
        } else {
            $result = $this->db->get("subjects");
            return $result->result_array();
        }
      
    }

    function save_subjects( $input, $id = NULL ) {
            $data = $this->initialize_data_model($input);
            $last_id = NULL;
            $this->db->trans_begin();
                try {
            if($id) {
                $this->update_subjects($data, $id);
                $last_id = $id;
            } else {
                $this->db->insert('subjects', $data);
                $last_id = $this->db->insert_id();
            }
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            $this->db->trans_complete();

        return ($this->db->trans_status() === FALSE) ? false : $last_id;
    }

    function update_subjects($input, $id) {
        $data = $this->initialize_data_model($input);
        $this->db->where('id', $id);
        $this->db->update('subjects', $data);
    }

    private function initialize_data_model($input_data) {
        return array(
            "title" => $input_data['title'],
            "subject_type" => $input_data['subject_type'],
            "grade_weightage" => $input_data['grade_weightage']
        );
    }

}

