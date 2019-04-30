<?php
use SebastianBergmann\CodeCoverage\CodeCoverage;
include('BaseTest.php');
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php RunTest
class RunTest extends CI_Controller {
	const ENABLE_COVERAGE = TRUE; // Requires xdebug
	public $classes = [
		//notificationtest model has to be run first in the list
		'notificationtest_model',
		'Assignmenttest_model',
		'usertest_model',
		'settingtest_model',
		'Scoreboardtest_model',
		'logtest_model',
		'Submittest_model',
		'Queuetest_model',
		'Hoftest_model'
	];
	private $test, $expected_result, $test_name;
	private $coverage;

	public function __construct()
	{
		parent::__construct();
        $this->load->library('unit_test');
				if (self::ENABLE_COVERAGE) {
					$this->coverage = new CodeCoverage;
					$this->coverage->filter()->addDirectoryToWhitelist('application/models');
					$this->coverage->filter()->removeDirectoryFromWhitelist('application/controllers/tests');
					$this->coverage->start('Sharif Unit Testing');
				}	
		foreach ($this->classes as $className) {
			$this->load->model('../controllers/tests/' . $className);
			$this->$className->runTest();
		}
	}
	
	public function index(){
		$this->showResult();
		
	}

	public function showResult() {
		$results = $this->unit->result();
		if (self::ENABLE_COVERAGE) {
			$this->coverage->stop();        
			$writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
			$writer->process($this->coverage, 'reports-dev/code-coverage');
		}
		//generate test report
		file_put_contents('reports-dev/test_report.html', $this->unit->report());
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