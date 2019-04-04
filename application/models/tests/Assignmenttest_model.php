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
    // $this->addDummyAssignment();
    // //
    // $this->testing_method_add_assignment();
    // //
    // $this->testing_method_all_assignments();
    // //
    // $this->testing_method_new_assignment_id();
    // //
    // $this->clear();
    $this->initial_test();

    //add new assignment (id 1)
    $this->testing_method_add_assignment();

    //add 2 dummy assignment (id 2 and 3)
    $this->addDummyAssignment();

    //find all assignments
    $this->testing_method_all_assignments();

    //delete the first dummy (id 2)
    $this->assignment_model->delete_assignment(2);

    //test new_assignment_id, expect id 2
    $this->testing_method_new_assignment_id();

    //test edit assignment 3
    $this->test_edit_assignment();

    //the rest tbd
    $this->clear();
  }

  private function clear()
  {
    $this->db->truncate('shj_assignments');
    $this->db->truncate('shj_problems');
  }

  private function testing_method_add_assignment()
  {
    // - Assignment_model method passchange_is_valid
    // $test = $this->Assignment_model->add_assignment(1,TRUE);
    // $expected_result = true;
    // $test_name = "Testing add_assignment function in Assignment_model.php || input : valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    // $this->unit->run($test, $expected_result, $test_name);
    $_POST['id'] = 1;
    $_POST['assignment_name'] = "Test first new assignment";
    $_POST['number_of_problems'] = 2;
    $_POST['total_submits'] = 0;
    $_POST['open'] = 1;
    $_POST['scoreboard'] = 1;
    $_POST['javaexceptions'] = 0;
    $_POST['description'] = 'This is the description of the add assignment test'; /* todo */
    $_POST['start_time'] = date('Y-m-d H:i:s', strtotime('04/1/2019 00:00:00'));
    $_POST['finish_time'] = date('Y-m-d H:i:s', strtotime('04/1/2019 12:00:00'));
    $_POST['extra_time'] = 0;
    $_POST['late_rule'] = "/* 
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
                            $coefficient = 0;";
    $_POST['participants'] = 'ALL';
    $_POST['archived_assignment'] = 0;

    $_POST['name'] = array('Problem1', 'Problem2');
    $_POST['score'] = array(100, 100);
    $_POST['c_time_limit'] = array(500, 500);
    $_POST['python_time_limit'] = array(1500, 1500);
    $_POST['java_time_limit'] = array(2000, 2000);
    $_POST['memory_limit'] = array(50000, 50000);
    $_POST['languages'] = array('C,C++,Python 2,Python 3,Java', 'C,C++,Python 2,Python 3,Java');
    $_POST['diff_cmd'] = array('diff', 'diff');
    $_POST['diff_arg'] = array('-bB', '-bB');
    $_POST['is_upload_only'] = array(1, 1);
    
    
    $this->Assignment_model->add_assignment(1, FALSE);
    $test = $this->db->order_by('id')->get('assignments')->result_array();
    $test = sizeof($test);
    $expected_result = 1;
    $test_name = "Test add_assignment function in Assignment_model.php";
    $this->unit->run($test, $expected_result, $test_name);
  }

  // ------------------------------------------------------------------------

  private function test_edit_assignment() {
    $expected_result = "Assignment name 3 has changed";
    $_POST['assignment_name'] = $expected_result;
    $_POST['is_upload_only'] = null;
    $_POST['languages'] = array('C,C++,python2,python3,Java,pdf', '');
    $this->Assignment_model->add_assignment(3, true);
    $test = $this->db->where('id', 3)->get('assignments')->result_array();
    $test = $test[0]['name'];
    $test_name = "Test edit assignment in add_assignment function in Assignment_model.php";
    $this->unit->run($test, $expected_result, $test_name);
  }

  private function test_delete_assignment(){
    $this->assignment_model->delete_assignment(2);
    $test = $this->db->order_by('id')->get('assignments')->result_array();
    $test = sizeof($test);
    $expected_result = 2;
    $test_name = "Test delete_assignment function in Assignment_model.php";
    $this->unit->run($test, $expected_result, $test_name);
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
    $test_name = "Testing all_assignments function in Assignment_model.php || input : - \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name);
  }

  private function initial_test(){
    $test = $this->Assignment_model->new_assignment_id();
    $expected_result =1;
    $test_name = "Initial test, should get id 1 and prove empty database || input : - \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name);
  }

  private function testing_method_new_assignment_id(){
    $shellString = "cd {$this->settings_model->get_setting('assignments_root')}; mkdir 'assignment_4'";
    shell_exec($shellString);
    $test = $this->Assignment_model->new_assignment_id();
    $expected_result = 5;
    $test_name = "Testing new_assignment_id function in Assignment_model.php || input : - \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name);
    shell_exec("cd {$this->settings_model->get_setting('assignments_root')}; rm -r 'assignment_4'");
  }

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
