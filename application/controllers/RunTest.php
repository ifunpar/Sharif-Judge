<?php
include('BaseTest.php');
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php RunTest
class RunTest extends CI_Controller {

	public $classes = [
		'initialtest_model',
		'notificationtest_model',
		'usertest_model',
		'settingtest_model',
		'Scoreboardtest_model',
		'logtest_model',
		'Submittest_model',
		'Queuetest_Model'
	];
	private $test, $expected_result, $test_name;

	public function __construct()
	{
		parent::__construct();

		foreach ($this->classes as $className) {
			$this->load->model($className);
			$this->$className->runTest();
		}
		$this->initialtest_model->showResult();
	}
	
	public function index(){}
}