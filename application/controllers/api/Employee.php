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

    function index_get()
    {
        $result['result'] = $this->employee_model->get_employee();
        $result['columns']=[];
        if(count($result)>0)
        {
            $first_record=$result['result'][0];
            unset($first_record->id);
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }

}
