<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/8/18
 * Time: 11:56 AM
 */


class Students extends API  {


        function __construct($config = 'rest') {
            parent::__construct($config);
            $this->load->model('students_model');
        }

    public function index_get($id = NULL) {
        
        $result['result'] = $this->students_model->get_students($id);

        if(count($result)>0)  {                                            
                $result['columns'] = ['id', 'full_name', 'gender', 'id_no', 'blood_group', 'birthdate'];
            }
        $this->response($result,API::HTTP_OK);
    
    }
    // Handels both update or insert request based on the wether id parameter is set 
    public function index_post($id = NULL) {

        $this->load->library("form_validation");
        $result['success'] = false;

        $this->form_validation->set_rules("full_name", "Full Name", "required");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("wereda", "Wereda", "required");
        $this->form_validation->set_rules("region", "Region", "required");
        $this->form_validation->set_rules("city", "City", "required");
        $this->form_validation->set_rules("sub_city", "Sub-city", "required");
        $this->form_validation->set_rules("mobile", "Mobile", "required");
        $this->form_validation->set_rules("house_no", "House Number", "required");
        
          if($this->form_validation->run() == false) {              
                $this->response($this->validation_errors(), API::HTTP_OK);
          } else {                
            $result['success'] = ($this->students_model->save_student($this->input->post(), $id)) ? true : false;
            $this->response($result, API::HTTP_OK);
          }      

    }

      public function index_delete($id = NULL) {
            if(is_null($id)) {
                $id = $this->input->input_stream('id');
            }
        $result['sucess'] = ($this->students_model->delete_student($id)) ? true: false;
        $this->response($result, API::HTTP_OK);
    }
    
    


}
