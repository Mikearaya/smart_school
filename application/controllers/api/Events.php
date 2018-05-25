<?php


class Events extends API {


  public function __construct($config = 'rest') {
    parent::__construct($config);
    $this->load->model('event_model');
  }

  public function index_get($id = NULL) {
    $result['result'] = $this->event_model->get_events($id);
      $result['columns']=[];
    if(count($result['result']) > 0 ) {
    $first_element = $result['result'][0];
    unset($first_element->id);
    $result['columns'] = array_keys((array) $first_element);

  }

    $this->response($result, API::HTTP_OK);

  }
}
 ?>
