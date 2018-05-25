<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/8/18
 * Time: 11:56 AM
 */


class Students extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('students_model');
    }

    function index_get($id = NULL)
    {
        $result['result'] = $this->students_model->get_students();
        if(count($result)>0)
        {
            $first_record=$result['result'][0];
            unset($first_record->id);
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    
    }

    function index_post() {

        $this->load->library("form_validation");
  
        $this->form_validation->set_rules("full_name", "Full Name", "required");
        $this->form_validation->set_rules("gender", "Gender", "required");
            $result['success'] = false;
          if($this->form_validation->run() === FALSE) {
                $this->response($result, API::HTTP_OK);
          } else {
              $data = array(
                'full_name' => $this->input->post('full_name'),
                'gender' => $this->input->post('gender'),
                'blood_group' => $this->input->post('blood_group'),
                'birthdate' => $this->input->post('birthdate')
                
            );
            $result['success'] = ($this->students_model->save_student($data)) ? true : false;
            $this->response($result, API::HTTP_OK);
          }

        

    }

    function index_put($id) {
        $this->input->raw_input_stream;
            $data = array(
                'full_name' => $this->input->input_stream('full_name'),
                'gender' => $this->input->input_stream('gender'),
                'birthdate' => $this->input->input_stream('birthdate'),
                'blood_group' => $this->input->input_stream('blood_group')
            );
           $result['success'] = $this->students_model->update_student($id, $data) ? true : false;
           $this->response($result, API::HTTP_OK);

    }

    
    function index_delete($id) {
        $result['sucess'] = ($this->students_model->delete_student($id)) ? true: false;
        $this->response($result, API::HTTP_OK);
    }


}
