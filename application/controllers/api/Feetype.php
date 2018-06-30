<?php
/**
 * Created by PhpStorm.
 * User: raju
 * Date: 1/9/18
 * Time: 8:13 AM
 */

class Feetype extends API
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Fee_type_model');
    }

  // \\
  function index_get($id = null)
  {
      $result['result'] = $this->Fee_type_model->get_feeType($id);
      $result['columns'] = [];

      if (count($result) > 0) {
          $first_record = isset($result['result'][0]) ? $result['result'][0] : $result['result'];
          $result['columns'] = array_keys((array)$first_record);
      }
      $this->response($result, API::HTTP_OK);
  }
// \\
  function index_post($id = null)
  {
      $this->load->library('form_validation');
      $result['success'] = false;

      $this->form_validation->set_rules('fee', 'Fee', 'required');
      $this->form_validation->set_rules('term', 'Term', 'required');
      $this->form_validation->set_rules('duration', 'Duration', 'required');
      $this->form_validation->set_rules('min_duration', 'Minimun Duration', 'required');

      if ($this->form_validation->run() === false) {
          $this->response($this->validation_errors(), API::HTTP_OK);
      } else {
          $data = array(
              'id' => $id,
              'fee' => $this->input->post('fee'),
              'term' => $this->input->post('term'),
              'duration' => $this->input->post('duration'),
              'min_duration' => $this->input->post('min_duration')
          );

          $result['success'] = ($this->Fee_type_model->save_feeType($data)) ? true : false;
          $this->response($result, API::HTTP_OK);
      }
  }
// \\
  function index_delete($id)
  {
      $result['success'] = ($this->Fee_type_model->delete_feeType($id)) ? true : false;
      $this->response($result, API::HTTP_OK);
  }

}
