<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Courses_model extends MY_Model {

    function __construct() {
      parent::__construct();
      $this->load->database();

    }

    //return one or many course records based on wether course id parameter is set
    function get_course($courseId = NULL) {
        $result = NULL;
            //if course id is not null get course
            if(!is_null($courseId)) {
                $query = $this->db->get_where('courses', array('id' => $courseId));
                $result = $query->row_array();
            } else {
                //else get all courses
                $query = $this->db->get('courses');
                $result = $query->result_array();
            }
            
      return $result;
    }
    //handels the insertion and update of course data into the database
    function save_course($course) {
        // if course id is not null update course
            if(!is_null($course['id'])) {
                return $this->$this->update_course($course);
            } else {
                $this->db->insert('courses', $course);
            }
        return ($this->db->affected_rows()) ? true : false;

    }

    function update_course($course) {
                $this->db->where('id', $course['id']);
        return  $this->db->update('courses', $course);
    }

    function delete_course($id) {
            $this->db->delete('courses', array('id', $id));
        return ($this->db->affected_rows()) ? true : false;
    }
    

}
