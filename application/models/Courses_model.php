<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:18 AM
 */

class Courses_model extends MY_Model
{

    function __construct() {
      parent::__construct();
      $this->load->database();

    }
    function lists()
    {
        $table=[
            'from'=>'courses',
            'select'=>['courses.id','name','section','grade','count(course_code) as subjects'],
            'join'=>[
                'course_content'=>['courses.id = course_code']
            ],
            'group_by'=>'course_code'
        ];
        return $this->select($table);
    }

    function get_course($id = NULL) {
      $result = $this->db->get('courses');
      return $result->result_array();
    }
}
