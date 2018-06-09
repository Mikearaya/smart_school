<?php


class Events extends API {


  public function __construct($config = 'rest') {
    parent::__construct($config);
    $this->load->model('event_model');
  }

  function index_get($id = NULL) {

    $result['result'] = $this->event_model->get_events($id);
    $result['columns']=[];
    
    if(count($result)>0) {
        $first_record= isset($result['result'][0]) ? $result['result'][0] : $result['result'];                      
        $result['columns']=array_keys((array)$first_record);
    }
    $this->response($result,API::HTTP_OK);
}

function index_post($id = NULL) {
    $this->load->library('form_validation');
    $result['success'] = false;

    $this->form_validation->set_rules("event_name", "event Name", "required");
    $this->form_validation->set_rules("description", "description", "required");
    

        if($this->form_validation->run() === FALSE ) {
            $this->response($this->validation_errors(), API::HTTP_OK);
        } else {
            $data = array(
                'id' => $id, 
                'event_name' => $this->input->post('event_name'),
                'description' => $this->input->post('description'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
            
            );

            $result['success'] = ($this->event_model->save_events($data)) ? true : false;
            $this->response($result, API::HTTP_OK);
        }
}

function index_delete($id) {
    $result['success'] = ($this->event_model->delete_events($id)) ? true : false;
    $this->response($result, API::HTTP_OK);
}

}
/*
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
}*/
 ?>
