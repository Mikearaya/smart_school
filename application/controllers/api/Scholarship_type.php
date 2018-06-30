<?php

class Scholarship_type extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Scholarship_type_model');
    }


    function index_get($id = NULL) {
        $result['result'] = $this->Scholarship_type_model->get_scholarship_type($id);
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
    
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $this->form_validation->set_rules('amount_type', 'amount_type', 'required');
    
            if($this->form_validation->run() === FALSE ) {
                $this->response($this->validation_errors(), API::HTTP_OK);
            } else {
                $data = array(
                    'id' => $scholarship_typeId,
                    'name' => $this->input->post('name'),
                    'amount' => $this->input->post('amount'),                    
                    'amount_type' => $this->input->post('amount_type'),
                );
    
                $result['success'] = ($this->Scholarship_type_model->save_scholarship_type($data)) ? true : false;
                $this->response($result, API::HTTP_OK);
            }
      }
      // \\
    
        public function index_delete($id) {        
            $result = ($this->Scholarship_type_model->delete_scholarship_type($id)) ? true: false;
           if($result === true) {
                $this->response([
                'status' => true,
                'message' => 'Scholarship Type has been removed successfully.'
            ], API::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'No scholarship were found.'
            ], API::HTTP_NOT_FOUND);
            
        }
    }

}

