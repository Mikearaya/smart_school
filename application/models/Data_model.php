<?php


class Data_model extends MY_Model {

    function __constructor() {
        parent::__construct();
        $this->load->database();
    }

    public  function filter_data($table, $filter_string = '', $sort_column = '', $sort_order = 'asc', $page_index = '', $page_size = '') {
    
        
        $this->db->order_by($sort_column, $sort_order);

        if($page_index === 0) {
            $start = 0;
        } else {
            $start = $page_index * $page_size;
        }
        $cloned = $this->db;
        $result['total'] = $cloned->count_all_results($table);
        $this->db->limit($page_size , $start);
        $result_set;	

                    $result_set = $this->db->get($table);
            $result['data'] = $result_set->result_array();
            $first_record= isset($result['data'][0]) ? $result['data'][0] : $result['data'];                      
            $result['columns']=array_keys((array)$first_record);
        return $result;

    }
}
?>