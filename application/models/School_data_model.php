<?php


class School_data_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function filter_data($table, $filter_column = '', $filter_string = '', $sort_column, $sort_order = 'ASC', $page_index = 0, $page_size = 1000) {
        $result;
            $this->db->select();
            $this->db->from($table);
            
            if (trim($filter_column)) {
                $this->db->like($filter_column, $filter_string);
            }
            if (trim($sort_column)) {
                $this->db->sort($sort_column, $sort_order);
            }

                $start = $page_index * $page_size;
                $cloned_db = clone $this->db;
                $result['total'] = $this->db->count_all();
            $this->db->limit($page_size, $start);
                $query = $this->db->get();
                $result['data'] = $query->result_array();

            return $result;

    }
}
?>