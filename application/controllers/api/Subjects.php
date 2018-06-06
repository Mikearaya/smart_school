<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:13 AM
 */

class Subjects extends API
{
    
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('subjects_model');
    }

    function index_get()
    {
        $result= $this->subjects_model->lists();
        $result['columns']=[];
        if($result['total_row']>0)
        {
            $first_record=$result['result'][0];
            unset($first_record->id);
            $result['columns']=array_keys((array)$first_record);
        }
        $this->response($result,API::HTTP_OK);
    }

    
            // Inserting subjects Data

    public function index_post()
    {
        $id = $this->post('id');
            
        $subjectsData = array(
             'title' => $this->post('title'),
             'grade_weightage' => $this->post('grade_weightage'),
             'code' => $this->post('code'),
             'subject_type' => $this->post('subject_type')
            );

        if (!empty($subjectsData['title']) && !empty($subjectsData['grade_weightage']) && !empty($subjectsData['code']) && !empty($subjectsData['subject_type'])) {
            $insert = $this->Subjects_model->insert($subjectsData);
            
            if ($insert) {
                $this->response([
                    'status' => true,
                    'message' => 'Subject has been added successfully.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response("Provide complete Subject information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
            // Updating subjects Data

    // Deleting subjects Data
    public function subject_delete()
    {
        $id = $this->delete('id');
        
        if ($id) {
            $delete = $this->Subjects_model->delete($id);

            if ($delete) {
                $this->response([
                    'status' => true,
                    'message' => 'Subject has been removed successfully.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'No Subject were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }  


}