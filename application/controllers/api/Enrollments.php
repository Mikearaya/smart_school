<?php

class Enrollments extends API {

  public function __construct($config = 'rest') {
    parent::__construct($config);
    $this->load->model('enrollment_model');
  }

  public function index_get($id = NULL) {

    $result['result']  = $this->enrollment_model->get_enrollment($id);

      if(count($result) > 0 ) {
        $first_record = $result['result'][0];
        unset($first_record->id);
        $result['columns'] = array_keys((array) $first_record);

      }
        $this->response($result, API::HTTP_OK);
  }

}


 ?>
