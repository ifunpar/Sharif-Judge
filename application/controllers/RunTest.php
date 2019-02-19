<?php
include('BaseTest.php');
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php RunTest
class RunTest extends CI_Controller {

	public $classes = [
		'notificationtest_model',
		'usertest_model',
		'settingtest_model',
		'Scoreboardtest_model',
		'logtest_model',
		'Submittest_model',
		'Queuetest_model',
		'Hoftest_model'
	];
	private $test, $expected_result, $test_name;

	public function __construct()
	{
		parent::__construct();
        $this->load->library('unit_test');

		foreach ($this->classes as $className) {
			$this->load->model('tests/' . $className);
			$this->$className->runTest();
		}
	}
	
	public function index(){
		$this->showResult();
	}

	public function showResult() {
		$results = $this->unit->result();
		$statistics = [
				'Pass' => 0,
				'Fail' => 0
			];
		foreach ($results as $result) {
			echo "=== " . $result['Test Name'] . " ===\n";
			foreach ($result as $key => $value) {
			echo "$key: $value\n";
			if($key ==='Result'){
				if ($result['Result'] === 'Passed') {
				$statistics['Pass']++;
				} else {
				$statistics['Fail']++;
				}
				break;
			}
			}
			echo "\n";
		}
		echo "==========\n";
		foreach ($statistics as $key => $value) {
			echo "$value test(s) $key\n";
		}
		if ($statistics['Fail'] > 0) {
			exit(1);
		}        
	}
}