<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificationtest_model extends Test_model
{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Notifications_model");
	}

	// ------------------------------------------------------------------------
    public function test(){
        $this->checkNotificationFirstTime();
        $this->checkAddNotification();
        $this->checkUpdateNotifications();
        $this->checkDeletedNotification();
    }

    private function clear(){
        $this->db->truncate('notifications');
    }
    
    private function checkNotificationFirstTime(){
        $test_name = "Check All Notifications In First Time";
        $test = count($this->Notifications_model->get_all_notifications());
        $expected_result = 0;
        $this->unit->run($test,$expected_result,$test_name);
    }
    
    private function checkAddNotification(){
        $test_name = "Check All Notifications After Add 1 Notifications";
        $this->Notifications_model->add_notification("Notif","Notification 1");
        $test = count($this->Notifications_model->get_all_notifications());
        $expected_result = 1;
        $this->unit->run($test,$expected_result,$test_name);
        $this->clear();
    }

    private function checkUpdateNotifications(){
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
        $this->clear();
    }

    private function checkDeletedNotification(){
        $test_name = "Check Delete Notifications";
        $this->Notifications_model->add_notification("Notif","Notification 1");
        $this->Notifications_model->delete_notification(1);
        $notif = $this->Notifications_model->get_notification(1);
        $this->unit->run($notif,FALSE,$test_name);
    }

	// ------------------------------------------------------------------------
}
