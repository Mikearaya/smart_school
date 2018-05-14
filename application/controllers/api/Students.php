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

    function index_get()
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


}
