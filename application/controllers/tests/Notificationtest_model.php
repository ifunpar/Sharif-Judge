<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
include('Test_model.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificationtest_model extends Test_model
{

  public function __construct()
  {
        parent::__construct();
        $this->load->model("Notifications_model");
  }

    public function test(){
        $this->checkNotificationFirstTime();
        $this->checkAddNotification();
        $this->checkUpdateNotifications();
        $this->checkDeletedNotification();
        $this->check10LatestNotification();
        $this->checkLatestAda();
        $this->checkLatestGaAda();
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

    private function check10LatestNotification(){
      $shj_notificationDummy = array(
          array(
              'title' => 'Notif 1',
              'text' => 'ASD Ditiadakan',
              'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 2',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 3',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 4',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 5',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 6',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 7',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 8',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 9',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 10',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 11',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-05 04:16:23'
          ),
          array(
            'title' => 'Notif 12',
            'text' => 'ASD Ditiadakan Tapi Boong',
            'time' => '2019-02-05 04:16:23'
          ),
        );
        $length = count($shj_notificationDummy);
        for($i = 0 ; $i < $length ;$i++){
          $this->db->insert('notifications',$shj_notificationDummy[$i]);
        }
        $test_name = "Check Top 10 Notifications When There's have more than 10";
        $notifications = $this->Notifications_model->get_latest_notifications();
        $expected_result = 10 ;
        $valueTest = count($notifications);
        $this->unit->run($valueTest,$expected_result,$test_name);
        $this->clear();
    }

  // ------------------------------------------------------------------------
  private function checkLatestAda(){
    $shj_notificationDummy = array(
        array(
            'title' => 'Notif 1',
            'text' => 'ASD Ditiadakan',
            'time' => '2019-02-28 04:16:23'
        ),
      );
      $length = count($shj_notificationDummy);
      for($i = 0 ; $i < $length ;$i++){
        $this->db->insert('notifications',$shj_notificationDummy[$i]);
      }
      $test_name = "Check Theres Latest Notification Must Return True";
      $notifications = $this->Notifications_model->have_new_notification('2019-02-27');
      $this->unit->run($notifications,TRUE,$test_name);
      $this->clear();
  }
  // ------------------------------------------------------------------------
  private function checkLatestGaAda(){
      $test_name = "Check Theres Latest Notification Must Return False";
      $notifications = $this->Notifications_model->have_new_notification('2019-02-23 04:16:23');
      $this->unit->run($notifications,FALSE,$test_name);
      $this->clear();
  }

}
