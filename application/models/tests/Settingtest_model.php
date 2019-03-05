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
        $this->load->model("Settings_model");
	}

    // ------------------------------------------------------------------------
    
    public function test(){
        $prevSetting = $this->settings_model->get_all_settings();

        $this->individualSettingTest();
        $this->setAllSettingTest();

        $this->settings_model->set_settings($prevSetting);
    }

    public function individualSettingTest() {
        $set = $this->settings_model->set_setting("timezone", "Asia/Tokyo");
        $test = $this->settings_model->get_setting("timezone");
        $expected_result = "Asia/Tokyo";
        $testString = $test;
        $expected_resultString = $expected_result;
        if($testString == NULL){
            $testString = 'NULL';
        }
        if($expected_resultString == NULL){
            $expected_resultString = 'NULL';
        }
        $notes = "Test: $testString <br>" .
                "Expected result: $expected_resultString<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
        $test_name = "Change Time Zone (Setting) || individual set setting test function";

        $this->unit->run($test,$expected_result,$test_name,$notes);
    }

    public function setAllSettingTest() {
        $expected_result = array(
            'timezone' => 'Asia/Jakarta',
            'mail_from' => 'test_email@email.com',
            'mail_from_name' => 'One lonely test mail account'
        );
        $this->settings_model->set_settings($expected_result);
        $test = $this->settings_model->get_all_settings();
        $test = array(
            'timezone' => $test['timezone'],
            'mail_from' => $test['mail_from'],
            'mail_from_name' => $test['mail_from_name']
        );
        $testString = $test;
        $expected_resultString = $expected_result;
        if($testString == NULL){
            $testString = 'NULL';
        }
        if($expected_resultString == NULL){
            $expected_resultString = 'NULL';
        }
        $notes = "Test: $testString <br>" .
                "Expected result: $expected_resultString<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
        $test_name = "Change Setting || set all setting test function";

        $this->unit->run($test,$expected_result,$test_name,$notes);
    }

	// ------------------------------------------------------------------------
}
