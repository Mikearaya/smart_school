<?php

class Scholarship extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Scholarship_model');
    }

    public function index_get($id = NULL) {
        $result['result'] = $this->Scholarship_model->get_scholarship($id);
        $result['columns']=[];
        if(count($result)>0)
        {
            $first_record=isset($result['result'][0]) ? $result['result'][0] : $result['result'];
            unset($first_record->id);
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }

    public function index_post($scholarshipId = NULL) {
        $result['success'] = FALSE;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('scholarship type', 'application code', 'required' );
            if($this->form_validation->run() === FALSE) {
                $this->response($this->validation_errors(), API::HTTP_OK);
            } else {
                $data = array(
                    'id' => $employeeId,
                    'scholarship_type' => $this->input->post('scholarship_type'),
                    'application_code' => $this->input->post('application code'),
                    'date' => $this->input->post('dates'),
                );
                $result['success'] = $this->Scholarship_model->save_scholarship($data);
                $this->response($result, API::HTTP_OK);
        }
    }

    public function index_delete($id) {
            $result['success'] = $this->Scholarship_model->delete_scholarship($id);
        $this->response($result, API::HTTP_OK);
    }
}
