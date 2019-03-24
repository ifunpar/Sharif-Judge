<?php

/**
 * SharIF Judge online judge
 * @file Assignmenttest_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Assignmenttest_model extends Test_model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Assignment_model");
  }

    // ------------------------------------------------------------------------

  public function test()
  {
    $this->addDummyAssignment();
    //
    $this->testing_method_add_assignment();
    //
    $this->testing_method_all_assignments();
    //
    $this->testing_method_new_assignment_id();
    //
    $this->clear();
  }

  private function clear()
  {
    $this->db->truncate('shj_assignments');
  }

  private function testing_method_add_assignment()
  {
    // - User_model method passchange_is_valid
    // $test = $this->Assignment_model->add_assignment(1,TRUE);
    // $expected_result = true;
    // $test_name = "Testing add_assignment function in User_model.php || input : valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    // $this->unit->run($test, $expected_result, $test_name);
  }

  private function testing_method_all_assignments(){
    $result = $this->db->order_by('id')->get('assignments')->result_array();
		$assignments = array();
		foreach ($result as $item)
		{
			$assignments[$item['id']] = $item;
		}
    $test = $this->Assignment_model->all_assignments();
    $expected_result = $assignments;
    $test_name = "Testing all_assignments function in User_model.php || input : - \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name);
  }

  private function testing_method_new_assignment_id(){
    $test = $this->Assignment_model->new_assignment_id();
    $expected_result =3;
    $test_name = "Testing new_assignment_id function in User_model.php || input : - \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name);
  }

  // ------------------------------------------------------------------------

  private function addDummyAssignment()
  {
    $shj_assignmentsdummy = array(
      array(
        'name' => 'Test No Scoreboard',
        'problems' => '1',
        'total_submits' => '0',
        'open' => '0',
        'scoreboard' => '0',
        'javaexceptions' => '0',
        'description' => '',
        'start_time' => '2019-02-14 00:00:00',
        'finish_time' => '2019-03-01 00:00:00',
        'extra_time' => '0',
        'late_rule' => '/* 
          * Put coefficient (from 100) in variable $coefficient.
          * You can use variables $extra_time and $delay.
          * $extra_time is the total extra time given to users
          * (in seconds) and $delay is number of seconds passed
          * from finish time (can be negative).
          *  In this example, $extra_time is 172800 (2 days):
          */
          if ($delay<=0)
            // no delay
            $coefficient = 100;
          
          elseif ($delay<=3600)
            // delay less than 1 hour
            $coefficient = ceil(100-((30*$delay)/3600));
          
          elseif ($delay<=86400)
            // delay more than 1 hour and less than 1 day
            $coefficient = 70;
          
          elseif (($delay-86400)<=3600)
            // delay less than 1 hour in second day
            $coefficient = ceil(70-((20*($delay-86400))/3600));
          
          elseif (($delay-86400)<=86400)
            // delay more than 1 hour in second day
            $coefficient = 50;
          
          elseif ($delay > $extra_time)
            // too late
            $coefficient = 0;', 
            'participants' => 'ALL',
            'moss_update' => 'Never',
            'archived_assignment' => '0'
      ),
      array(
        'name' => 'Test',
        'problems' => '1',
        'total_submits' => '0',
        'open' => '0',
        'scoreboard' => '1',
        'javaexceptions' => '0',
        'description' => '',
        'start_time' => '2019-02-14 00:00:00',
        'finish_time' => '2019-03-01 00:00:00',
        'extra_time' => '0',
        'late_rule' => '/* 
          * Put coefficient (from 100) in variable $coefficient.
          * You can use variables $extra_time and $delay.
          * $extra_time is the total extra time given to users
          * (in seconds) and $delay is number of seconds passed
          * from finish time (can be negative).
          *  In this example, $extra_time is 172800 (2 days):
          */
          
          if ($delay<=0)
            // no delay
            $coefficient = 100;
          
          elseif ($delay<=3600)
            // delay less than 1 hour
            $coefficient = ceil(100-((30*$delay)/3600));
          
          elseif ($delay<=86400)
            // delay more than 1 hour and less than 1 day
            $coefficient = 70;
          
          elseif (($delay-86400)<=3600)
            // delay less than 1 hour in second day
            $coefficient = ceil(70-((20*($delay-86400))/3600));
          
          elseif (($delay-86400)<=86400)
            // delay more than 1 hour in second day
            $coefficient = 50;
          
          elseif ($delay > $extra_time)
            // too late
            $coefficient = 0;', 'participants' => 'ALL', 'moss_update' => 'Never', 'archived_assignment' => '0'
      ),
      array(
        'name' => 'Test2',
        'problems' => '1',
        'total_submits' => '0',
        'open' => '0',
        'scoreboard' => '1',
        'javaexceptions' => '0',
        'description' => '',
        'start_time' => '2019-02-14 00:00:00',
        'finish_time' => '2019-03-01 00:00:00',
        'extra_time' => '0',
        'late_rule' => '/* 
            * Put coefficient (from 100) in variable $coefficient.
            * You can use variables $extra_time and $delay.
            * $extra_time is the total extra time given to users
            * (in seconds) and $delay is number of seconds passed
            * from finish time (can be negative).
            *  In this example, $extra_time is 172800 (2 days):
            */
            
            if ($delay<=0)
              // no delay
              $coefficient = 100;
            
            elseif ($delay<=3600)
              // delay less than 1 hour
              $coefficient = ceil(100-((30*$delay)/3600));
            
            elseif ($delay<=86400)
              // delay more than 1 hour and less than 1 day
              $coefficient = 70;
            
            elseif (($delay-86400)<=3600)
              // delay less than 1 hour in second day
              $coefficient = ceil(70-((20*($delay-86400))/3600));
            
            elseif (($delay-86400)<=86400)
              // delay more than 1 hour in second day
              $coefficient = 50;
            
            elseif ($delay > $extra_time)
              // too late
              $coefficient = 0;', 'participants' => 'ALL', 'moss_update' => 'Never', 'archived_assignment' => '0'
      )
    );
    $this->db->insert('assignments', $shj_assignmentsdummy[0]);
    $this->db->insert('shj_assignments', $shj_assignmentsdummy[1]);
  }

}
