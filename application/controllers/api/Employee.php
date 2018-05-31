<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:13 AM
 */

class Employee extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('employee_model');
    }

    public function index_get($id = NULL) {
        $result['result'] = $this->employee_model->get_employee($id);
        $result['columns']=[];
        if(count($result)>0)
        {
            $first_record=$result['result'][0];
            unset($first_record->id);
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }

    public function index_post($employeeId = NULL) {
        $result['success'] = FALSE;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullName', 'Employee Name', 'required' );
        $this->form_validation->set_rules('gender', 'Employee gender', 'required');

            if($this->form_validation->run() === FALSE) {
                $this->response($this->validation_errors(), API::HTTP_OK);
            } else {
                $data = array(
                    'id' => $employeeId,
                    'full_name' => $this->input->post('fullName'),
                    'blood_group' => $this->input->post('bloodGroup'),
                    'employment_date' => $this->input->post('employmentDate'),
                    'gender' => $this->input->post('gender')
                );
                $result['success'] = $this->employee_model->save_employee($data);
                $this->response($result, API::HTTP_OK);
        }
    }

    public function index_delete($id) {
            $result['success'] = $this->employee_model->delete_employee($id);
        $this->response($result, API::HTTP_OK);
    }
}
