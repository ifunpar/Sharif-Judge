<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php Notifications_model_test
class Notifications_model_test extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library("unit_test");
        $this->load->model("Notifications_model");
    }
    
    private function clear(){
      $this->db->truncate('notifications');
    }
		
		public function index(){
			$test = count($this->Notifications_model->get_all_notifications());
			$expected_result = 0;
			$test_name = "Check All Notifications In First Time";
      $this->unit->run($test,$expected_result,$test_name);
      $this->Notifications_model->add_notification("Notif","Notification 1");
      $test = count($this->Notifications_model->get_all_notifications());
      $expected_result = 1;
      $test_name = "Check All Notifications After Add 1 Notifications";
      $this->clear();
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