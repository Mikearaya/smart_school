<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:13 AM
 */

class Courses extends API {
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('courses_model');
    }

    
    //return one or multiple courses
    function index_get($id = NULL) {

        $result['result'] = $this->courses_model->get_course($id);
        $result['columns']=[];
        
        if(count($result)>0) {
            $first_record= isset($result['result'][0]) ? $result['result'][0] : $result['result'];                      
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }

    function index_post($id = NULL) {
        $this->load->library('form_validation');
        $result['success'] = false;

        $this->form_validation->set_rules('course_name', 'Course Name', 'required');
        $this->form_validation->set_rules('fee_term', 'Course Fee', 'required|is_numeric');
        $this->form_validation->set_rules('section', 'Section', 'required');
        $this->form_validation->set_rules('grade', 'Grade', 'required');

            if($this->form_validation->run() === FALSE ) {
                $this->response($this->validation_errors(), API::HTTP_OK);
            } else {
                $data = array(
                    'id' => $id,
                    'name' => $this->input->post('course_name'),
                    'fees_term' => $this->input->post('fee_term'),
                    'section' =>$this->input->post('section'),
                    'grade' => $this->input->post('grade')
                );

                $result['success'] = ($this->courses_model->save_course($data)) ? true : false;
                $this->response($result, API::HTTP_OK);
            }
    }

    function index_delete($id) {
        $result['success'] = ($this->courses_model->delete_course($id)) ? true : false;
        $this->response($result, API::HTTP_OK);
    }

}
