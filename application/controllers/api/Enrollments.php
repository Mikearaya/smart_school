<?php

class Enrollments extends API {

  public function __construct($config = 'rest') {
    parent::__construct($config);
    $this->load->model('Enrollment_model');
  }
  // \\
  function index_get($id = NULL) {
    $result['result'] = $this->Enrollment_model->get_enrollment($id);
    $result['columns']=[];
    
    if(count($result)>0) {
        $first_record= isset($result['result'][0]) ? $result['result'][0] : $result['result'];                      
        $result['columns']=array_keys((array)$first_record);
    }
    $this->response($result,API::HTTP_OK);
  }
  // \\
  function index_post($id = NULL){
    $this->load->library('form_validation');
    $result['success'] = false;

    $this->form_validation->set_rules('student_id', 'student_id', 'required');
    $this->form_validation->set_rules('date', 'Date', 'required');
    $this->form_validation->set_rules('term', 'Term', 'required');
    $this->form_validation->set_rules('year', 'Year', 'required');
    $this->form_validation->set_rules('course_code', 'Course Code', 'required');

        if($this->form_validation->run() === FALSE ) {
            $this->response($this->validation_errors(), API::HTTP_OK);
        } else {
            $data = array(
                'id' => $id,
                'student_id' => $this->input->post('student_id'),
                'date' => $this->input->post('student_id'),
                'term' =>$this->input->post('term'),
                'year' => $this->input->post('year'),
                'course_code' => $this->input->post('course_code')
            );

            $result['success'] = ($this->Enrollment_model->save_enrollment($data)) ? true : false;
            $this->response($result, API::HTTP_OK);
        }
  }
  // \\
  function index_delete($id) {
    $result['success'] = ($this->Enrollment_model->delete_enrollment($id)) ? true : false;
    $this->response($result, API::HTTP_OK);
  }

}

 ?>
