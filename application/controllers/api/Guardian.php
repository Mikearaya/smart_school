<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/8/18
 * Time: 11:56 AM
 */


class Guardian extends API  {


        function __construct($config = 'rest') {
            parent::__construct($config);
            $this->load->model('guardian_model');
        }

    public function index_get($id = NULL) {        
        $this->get_guardian($id);
    }    
    function get_guardian($id = NULL) {
        $result['result'] = $this->guardian_model->get_guardian($id);

        if(count($result)>0)  {                            
            isset($result['result'][0]) ? $first_record=$result['result'][0] : $first_record=$result['result'] ;            
            $result['columns']=array_keys((array)$first_record);
        }
        
        $this->response($result,API::HTTP_OK);    
    }
    // Handels both update or insert request based on the wether id parameter is set 
    public function index_post($id = NULL) {
            $this->save_guardian($id); 
    }
    public function save_guardian($id = NULL) {

        $this->load->library("form_validation");
        $result['success'] = false;

        $this->form_validation->set_rules("full_name", "Full Name", "required");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("relation", "Relation", "required");
        $this->form_validation->set_rules("city", "City", "required");
        $this->form_validation->set_rules("sub_city", "Sub-City", "required");
        $this->form_validation->set_rules("wereda", "Wereda", "required");
        $this->form_validation->set_rules("phone", "Phone Number", "required");
        $this->form_validation->set_rules("house_no", "House Number", "required");

          if($this->form_validation->run() == false) {
              
                $this->response($this->validation_errors(), API::HTTP_OK);
          } else {              
            $result['success'] = ($this->guardian_model->save_guardian($this->input->post(), $id)) ? true : false;
            $this->response($result, API::HTTP_OK);
          }      

    }

    public function index_delete($id = NULL) {
            if(is_null($id)) {
                $id = $this->input->input_stream('id');
            }
        $result['sucess'] = ($this->guardian_model->delete_guardian($id)) ? true: false;
        $this->response($result, API::HTTP_OK);
    }
    
    


}
