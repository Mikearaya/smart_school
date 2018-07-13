<?php
header('Access-Control-Allow-Origin: *');
class Data extends API {

    function __construct($config = 'rent') {
        parent::__construct($config);
        $this->load->model('data_model');
    }

    public function filter_get() {
        $table_name = $this->input->get('table_name');
        $filter_string = $this->input->get('filter_string');
        $sort_column = $this->input->get('sort_column');
        $sort_order = $this->input->get('sort_order');
        $page_index = $this->input->get('page_number');
        $page_size = $this->input->get('page_size');

        $result = $this->data_model->filter_data($table_name, $filter_string, $sort_column, $sort_order, $page_index, $page_size);
        $this->response($result, API::HTTP_OK);
    }
}

?>