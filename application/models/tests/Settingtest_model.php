<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settingtest_model extends Test_model
{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Notifications_model");
        $this->load->model("User_model");
	}

    // ------------------------------------------------------------------------
    
    public function test(){
        $this->printSetting();

        $set = $this->set_setting("timezone", "Asia/Tokyo");
        $test = $this->get_setting("timezone");
        $expected_result = "Asia/Tokyo";
        $test_name = "Change Time Zone test function";

        $this->unit->run($test,$expected_result,$test_name);
    }

    public function printSetting(){
        $testAll = $this->get_all_settings();
        echo "Current Setting";
        // print_r($testAll);
        echo "\n";
    }
    
    public function set_setting($key, $value)
    {
        $this->db->where('shj_key', $key)->update('settings', array('shj_value'=>$value));
    }

    public function get_setting($key)
    {
        return $this->db->select('shj_value')->get_where('settings', array('shj_key'=>$key))->row()->shj_value;
    }

    public function get_all_settings()
    {
        $result = $this->db->get('settings')->result_array();
        $settings = array();
        foreach($result as $item)
        {
            $settings[$item['shj_key']] = $item['shj_value'];
        }
        return $settings;
    }

	// ------------------------------------------------------------------------
}
