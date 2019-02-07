<?php
/**
 * Created by PhpStorm.
 * User: Mitsuaki
 * Date: 2019-02-07
 * Time: 12:54
 */

class SettingTest extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("unit_test");
    }

    public function set_setting($key, $value)
    {
        $this->db->where('shj_key', $key)->update('settings', array('shj_value'=>$value));
    }

    public function get_setting($key)
    {
        return $this->db->select('shj_value')->get_where('settings', array('shj_key'=>$key))->row()->shj_value;
    }

    public function index(){
        $set = $this->set_setting("timezone", "Asia/Tokyo");
        $test = $this->get_setting("timezone");
        $expected_result = "Asia/Tokyo";
        $test_name = "Change Time Zone test function";
        $this->unit->run($test,$expected_result,$test_name);
        $results = $this->unit->result();
        foreach ($results as $result) {
            echo "=== " . $result['Test Name'] . " ===\n";
            foreach ($result as $key => $value) {
                echo "$key: $value\n";
                if($key ==='Result'){
                    break;
                }
            }
            echo "\n";
        }
    }
}