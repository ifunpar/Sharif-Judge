<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Logtest_model extends Test_model
{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Notifications_model");
        $this->load->model("Logs_model");
	}

    // ------------------------------------------------------------------------
    
    public function test(){
        $this->testInitialDBStatus();
        // $this->initPastLogin();
        $this->loginUser();
        $this->clear();
    }

    private function clear(){
        $this->db->truncate('logins');
    }

    private function testInitialDBStatus() {
        $test = $this->Logs_model->get_all_logs();
		$expected_result = NULL;
        $test_name = "Initial test | Database should be empty.";
		$this->unit->run($test, $expected_result, $test_name);
    }
    
    // private function initPastLogin() {
    //     $data = array(
    //         'username' => 'testuser',
    //         'ip_address' => '127.0.0.1'
    //     );
    //     $this->db->insert('logins', $data);
    // }

    private function loginUser() {
        $this->Logs_model->insert_to_logs('testuser', '127.0.0.1');

        $temp = $this->Logs_model->get_all_logs()[0];
        $test = array(
            'username' => $temp['username'],
            'ip_address' => $temp['ip_address']
        );
        $expected_result = array(
            'username' => 'testuser',
            'ip_address' => '127.0.0.1'
        );
        $test_name = "Login test | Login log should be updated by this last login";
        $this->unit->run($test, $expected_result, $test_name);
    }

	// ------------------------------------------------------------------------
}
