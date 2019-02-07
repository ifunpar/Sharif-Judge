<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class BaseTest extends CI_Controller {
        public function __construct()
        {
            parent::__construct(); 
			$this->load->library("unit_test");
			// $this->load->model("settings_model"); load model
        }
		
		
		private function division($a,$b){
			return $a/$b;
		}
		
		public function index(){
			// $test = $this->settings_model->get_all_settings(); call model method
			$test = $this->division(6,3);
			$expected_result = 2;
			$test_name = "Division test function";
			echo $test;
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