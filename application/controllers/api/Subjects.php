<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:13 AM
 */

class Subjects extends API
{
    
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('subjects_model');
    }

    function index_get($id = NULL)
    {
        $result["result"]= $this->subjects_model->get_subject($id);
        if(count($result)>0) {
            $first_record= (isset($result['result'][0])) ? $result['result'][0] : $result['result'];

            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }


    function index_post($id = NULL) {
        $result['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title[]', 'Subject Name', 'callback_subject_validator');
        $this->form_validation->set_rules('subject_type[]', 'Subject Type', 'callback_subject_validator');
        $this->form_validation->set_rules('grade_weightage[]', 'Subject CrHr.', 'callback_subject_validator');
      //  $this->form_validation->set_rules('subject[code]', 'Subject code', 'callback_subject_validator|required');
        
        if ($this->form_validation->run() === FALSE ) {
            $this->response($this->validation_errors(), API::HTTP_OK);
        } else {

            $success = $this->subjects_model->save_subjects($this->input->post(), $id);
            if($success) {
                $result['success'] = true;
                $result['subjectId'] = $success;              
            }
            $this->response($result, API::HTTP_OK);
        }


    }
    public function subject_validator($subject) {
        if(!$subject) {
            $this->form_validation->set_message('subject_validator', '%s field is required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
