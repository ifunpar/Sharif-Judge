<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Test_model extends CI_Model
{

    protected $test, $expected_result, $test_name;

	public function __construct()
	{
        parent::__construct();
        $this->load->library('unit_test');
	}

	// ------------------------------------------------------------------------
    
    //example content of test
    // $this->test = $this->division(6,3);
    // $this->expected_result = 2;
	// $this->test_name = "Division test function";
	// $this->unit->run($this->test,$this->expected_result,$this->test_name);	
    abstract public function test();

    public function runTest() {
        $this->test();
	}
	
	public function showResult() {
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

	// ------------------------------------------------------------------------
}
