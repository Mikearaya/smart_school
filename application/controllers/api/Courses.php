<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:13 AM
 */

class Courses extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('courses_model');
    }

    function index_get()
    {
        $result['result'] = $this->courses_model->get_course();
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
