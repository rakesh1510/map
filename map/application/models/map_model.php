<?php

if (!defined('BASEPATH'))
    exist('No Access');

class Map_model extends CI_model {

    public function check_user($user, $pass) {
        $query = $this->db->query("SELECT log_pass FROM map_tbl where log_pass='$pass'");
        $row = $query->row();
        if ($row->log_pass == $pass) {
            return 1;
        } else {
            return "wrong password";
        }
    }

    public function get_Country() {
        $this->db->select('DISTINCT(country_name)')->from("country_states");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_state($country_name) {
        $this->db->select('DISTINCT(state_name)');
        $this->db->from('country_states');
        $this->db->where('country_name', $country_name);
        $this->db->get();
        echo json_encode($result);
    }

    public function get_city($state_name) {
//        echo "sdsd";exit;
        $this->db->select('DISTINCT(city_name)');
        $this->db->from('states_cities');
        $this->db->where('state', $state_name);
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>