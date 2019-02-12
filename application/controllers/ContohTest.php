<?php
defined('BASEPATH') or exit('No direct script access allowed');
// php index.php ContohTest
class ContohTest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("unit_test");
		$this->load->model("User_model");
	}


	private function division($a, $b)
	{
		return $a / $b;
	}

	public function index()
	{
		//coba
		$test = $this->division(6, 3);
		$expected_result = 2;
		$test_name = "Division test function";
		$this->unit->run($test, $expected_result, $test_name);
		$results = $this->unit->result();
		foreach ($results as $result) {
			echo "=== " . $result['Test Name'] . " ===\n";
			foreach ($result as $key => $value) {
				echo "$key: $value\n";
				if ($key === 'Result') {
					break;
				}
			}
			echo "\n";
		}

		//User_model method username_to_user_id
		$test = $this->username_to_user_id('admin');
		$expected_result = true;
		$test_name = "Testing username_to_user_id function in User_model.php";
		$this->unit->run($test, $expected_result, $test_name);
		$results = $this->unit->result();
		foreach ($results as $result) {
			echo "=== " . $result['Test Name'] . " ===\n";
			foreach ($result as $key => $value) {
				echo "$key: $value\n";
				if ($key === 'Result') {
					break;
				}
			}
			echo "\n";
		}

	}

	//User_model.php
	private function username_to_user_id($username)
	{
		$query = $this->db->select('id')->get_where('users', array('username'=>$username));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->row()->id;
	}
}