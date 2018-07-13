<?php


class School_data extends API {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('school_data_model');
    }

    public function filter_GET($table) {
        $table = $this->input->get('source');
        $filter_string = $this->get('filter_string');
        $filter_column = $this->get('filter_column');
        $sort_column = $this->get('sort_column');
        $sort_order = $this->get('sort_order');
        $page_index = $this->input->get('page_index');
        $page_size = $this->input->get('page_size');

        $result = $this->school_data_model->filter_data($table, $filter_column, $filter_string, $sort_column, $sort_order, $page_index, $page_size);
  
            if(count($result)>0) {
                $first_record=$result['data'][0];
                unset($first_record->id);
                $result['columns'] = array_keys((array)$first_record);
            
            $this->response($result, API::HTTP_OK);
        }else {
            $this->response($result, API::HTTP_NO_CONTENT);
        }
    }
}

?>