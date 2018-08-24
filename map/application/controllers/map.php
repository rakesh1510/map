<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

    public function index() {
        $this->load->view('login');
    }

    public function login_check() {

        $ans = $this->input->post();
        $this->form_validation->set_rules('login_username', 'EmailId', 'trim|required');
        $this->form_validation->set_rules('login_password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $this->load->model('map_model');
            $ans_check = $this->map_model->check_user($ans['login_username'], $ans['login_password']);
//            echo $ans_check;exit;
            if ($ans_check == 1) {
                $this->load->view('world_view');
//                redirect(base_url() . 'index.php/map/world_view');
            }
        }
    }

    public function get_Country() {
        error_reporting(0);
        $this->load->model('map_model');
        $ctry = $this->map_model->get_Country();
        return $ctry;
    }

    public function get_state() {
        $cntname = $this->input->post('country_id');
        $state_name = $this->input->post('state_name');
//        print_r($state_name);exit;
        $this->db->select('DISTINCT(state_name)');
        $this->db->from('country_states');
        $this->db->where('country_name', $cntname);
        $query = $this->db->get();
        $arrStates = $query->result_array();
        echo "<select id = 'states' name='states' onchange='selectRegion(this.options[this.selectedIndex].value)'>";
        echo '<option value="selectstate">Select your states</option>';
        foreach ($arrStates as $key => $statesval) {
            echo '<option value="' . $statesval["state_name"] . '">' . $statesval["state_name"] . '</option>';
        }
        echo "</select>";
    }

    public function get_city() {
        $citname = $this->input->post('city_id');
        $this->load->model('map_model');
        $city_name_list = $this->map_model->get_city($citname);
        echo "<select id = 'city' name='city' >";
        echo '<option>Select your city</option>';
        foreach ($city_name_list as $key => $statesval) {
            echo '<option value="' . $statesval["city_name"] . '">' . $statesval["city_name"] . '</option>';
        }
        echo "</select>";
    }

    public function show_map() {
        $map_detail = $this->input->post();
//        print_r($map_detail);exit;
        $this->form_validation->set_rules('country', 'Country', 'required|callback_country_check');
        $this->form_validation->set_rules('states', 'State', 'required|callback_state_check');
        $this->form_validation->set_rules('city', 'City', 'required|callback_city_check');
//        print_r($map_detail);exit;
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('world_view', $map_detail);
        } else {
//            $this->load->library('googlemaps');
//            $config['center'] = '37.4419, -122.1419';
//            $config['zoom'] = 'auto';
//            $this->googlemaps->initialize($config);
//            $marker = array();
//            $marker['position'] = $map_detail['city'];
//            $this->googlemaps->add_marker($marker);
//            $circle['radius'] = '100';
//            $this->googlemaps->add_circle($circle);
//            $data['map'] = $this->googlemaps->create_map();


            $this->load->library('googlemaps');
            /* below code is for STREET */
//            $config['center'] = $map_detail['city'];
//            $config['center'] = '23.033863,72.585022';
//            $config['map_type'] = 'STREET';
//            $config['streetViewPovHeading'] = 90;
//            $marker['position'] = $map_detail['city'];

//            $this->googlemaps->initialize($config);
//            $data['map'] = $this->googlemaps->create_map();
//
//
//            $this->load->library('googlemaps');
            /* below code is for DRAR polygon,circle everything */
//            $config['center'] = $map_detail['city'];
//            $config['zoom'] = '13';
//            $config['drawing'] = true;
//            $config['drawingDefaultMode'] = 'circle';
//            $config['drawingModes'] = array('circle', 'rectangle', 'polygon');
//            $this->googlemaps->initialize($config);
//            $data['map'] = $this->googlemaps->create_map();


//            $this->load->library('googlemaps');
////            $config['center'] = '37.4419, -122.1419';
//
//            $config['center'] = $map_detail['city'];
//            $config['zoom'] = 'auto';
//            $config['places'] = TRUE;
//            $config['placesLocation'] = $map_detail['city'];
//            $config['placesRadius'] = 200;
//             Add Marker At Clicked Position
//            $config['center'] = '37.4419, -122.1419';
            $config['center'] = $map_detail['city'];
            $config['zoom'] = 'auto';
            $config['onclick'] = 'createMarker_map({ map: map, position:event.latLng });';
            $this->googlemaps->initialize($config);
            $data['map'] = $this->googlemaps->create_map();
//echo $this->google_maps->output();exit;
//            $this->load->view('view_file', $data);
            $this->load->view('world_data', $data);
//                redirect(base_url() . 'index.php/map/world_view');
        }
    }

    public function country_check() {
        if ($this->input->post('country') === 'selectcountry') {
            $this->form_validation->set_message('country_check', 'Please choose your country.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function state_check() {

        if ($this->input->post('states') === 'selectstate') {
            $this->form_validation->set_message('state_check', 'Please choose your State.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function city_check() {

        if ($this->input->post('city') === 'selectcity') {
            $this->form_validation->set_message('city_check', 'Please choose your City.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function map_test() {
        $this->load->view('map_test');
    }

}
