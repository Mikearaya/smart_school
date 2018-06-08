<?php

class Event_model extends MY_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* public function get_events($id = NULL) {
    $result = $this->db->get('events');
    return $result->result_array();
  }
}
*/
public function get_events($eventsID = NULL) {
    $result = NULL;
        if(!is_null($eventsID)) {            
            //if id is not null get the specific events
            $query = $this->db->get_where('events', array('id' => $eventsID));
            $result = $query->row_array();
        } else {
            //else get all events records
            $query = $this->db->get('events');
            $result = $query->result_array();
        }
      return $result;
    }

    // Handels both update or insert request based on the wether id parameter is set
    public function save_events($events) {
        //if id is not null then its update request
        if(!is_null($events['id'])) {
            return $this->update_events($events);
        } else {
            //if id null then insert new record            
            $this->db->insert('events', $events);
        }
        return ($this->db->affected_rows()) ? true : false; 

    }

    public function update_events($events) {
         
            $this->db->where('id', $events['id']);
       return $this->db->update('events', $events);        
    }

    public function delete_events($id) {
            $this->db->delete('events', array('id' => $id));
        return ($this->db->affected_rows()) ? true : false;
    }
}
?>
