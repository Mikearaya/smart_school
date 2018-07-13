<?php

class Scholarship_coverage extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Scholarship_coverage_model');
    }

    function index_get($id = NULL) {
        $result['result'] = $this->Scholarship_coverage_model->get_scholarship_coverage($id);
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
    
        $this->form_validation->set_rules('scholarship', 'scholarship', 'required');
       // $this->form_validation->set_rules('scholarship_type', 'scholarship type', 'required');
       // $this->form_validation->set_rules('fee_type', 'fee type', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $this->form_validation->set_rules('amount_type', 'amount type', 'required');
    
            if($this->form_validation->run() === FALSE ) {
                $this->response($this->validation_errors(), API::HTTP_OK);
            } else {
                $data = array(
                    'id' => $id,
                    'scholarship' => $this->input->post('scholarship'),
                    'scholarship_type' => $this->input->post('scholarship_type'),
                    'fee_type' => $this->input->post('fee_type'),
                    'amount' =>$this->input->post('amount'),
                    'amount_type' => $this->input->post('amount_type'),
                );
    
                $result['success'] = ($this->Scholarship_coverage_model->save_scholarship_coverage($data)) ? true : false;
                $this->response($result, API::HTTP_OK);
            }
      }
      // \\


    public function index_delete($id)
    {
        $result = ($this->Scholarship_coverage_model->delete_scholarship_coverage($id)) ? true : false;
        if ($result === true) {
            $this->response([
                'status' => true,
                'message' => 'Scholarship has been removed successfully.'
            ], API::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No scholarship were found.'
            ], API::HTTP_NOT_FOUND);

        }


    }
}
