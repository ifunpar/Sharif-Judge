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
      //get all notif
      $test_name = "Check All Notifications In First Time";
			$test = count($this->Notifications_model->get_all_notifications());
			$expected_result = 0;
      $this->unit->run($test,$expected_result,$test_name);
      //add notif
      $test_name = "Check All Notifications After Add 1 Notifications";
      $this->Notifications_model->add_notification("Notif","Notification 1");
      $test = count($this->Notifications_model->get_all_notifications());
      $expected_result = 1;
      $this->clear();
      $this->unit->run($test,$expected_result,$test_name);
      //update notif,get notif
      $test_name = "Check Update Notification method";
      $this->Notifications_model->add_notification("Notif","Notification 1");
      $this->Notifications_model->update_notification(1,"Notif Edited","Notification 1.1");
      $notif = $this->Notifications_model->get_notification(1);
      $key = array("title","text");
      $expected_value = array("Notif Edited","Notification 1.1");
      for($i = 0 ;$i < 2 ; $i++){
        $afterValue = $notif[$key[$i]];
        $this->unit->run($afterValue,$expected_value[$i],$test_name." $key[$i]");
        echo "\n";
      }
      //delete notif
      $test_name = "Check Delete Notifications";
      $this->Notifications_model->add_notification("Notif","Notification 1");
      $this->Notifications_model->delete_notification(1);
      $notif = $this->Notifications_model->get_notification(1);
      $this->unit->run($notif,FALSE,$test_name);

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
      $this->clear();
	}
}		