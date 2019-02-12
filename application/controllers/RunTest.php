<?php
include('BaseTest.php');
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class RunTest extends CI_Controller {

	public $array = [
		'exampletest_model'
	];
	private $test, $expected_result, $test_name;

	public function __construct()
	{
		parent::__construct();

		foreach ($this->array as $className) {
			echo $className;
			echo $array;
			$this->load->model($className);
			$this->$className->runTest();
		}
	}
	
	public function runTest(){
		$this->test = $this->division(6,3);
		$this->expected_result = 3;
		$this->test_name = "Division test function";
	}
	
	private function division($a,$b){
		return $a/$b;
	}
	
	public function index(){}
}