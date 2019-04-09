<?php
/**
 * Created by PhpStorm.
 * User: Mitsuaki
 * Date: 2019-02-19
 * Time: 14:41
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Queuetest_model extends Test_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("unit_test");
        $this->load->model("Queue_model");
        $this->load->model("Assignment_model");
    }

    private function emptyDB($tableName){
        $this->db->truncate($tableName);

    }

    public function test()
    {
        // TODO: Implement test() method.
        $this->testNotEmptyQueue();
        $this->testInQueue();
        $this->testEmptyQueue();
        $this->testAddQueue();
        $this->testGetTop();
        $this->testRemove();
        $this->testRejudgeSingle();
        $this->testRejudge();
        $this->testSaveJudge();
    }

    public function testNotEmptyQueue(){
        $test_name = "Test isi dari queue";
        $test = count($this->Queue_model->get_queue());
        $expected_result = 0;
        $notes = "Test: count queue <br>" .
            "Expected result: $expected_result<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name, $notes);
    }

    public function testInQueue(){
        $test_name = "test search queue";
        $test = $this->Queue_model->in_queue(test,1,1);
        $expected_result = false;
        $res = "false";
        $notes = "Test: In Queue <br>" .
            "Expected result: $res<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name, $notes);
    }

    public function testEmptyQueue(){
        $test_name = "empty the queue";
        $test = $this->Queue_model->empty_queue();
        $query = $this->db->get_where('queue', array('id'=>1));
        $expected_result = ($query != 0);
        $res = "Row must be 0";
        $notes = "Test: Empty Queue <br>" .
            "Expected result: $res<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name, $notes);
    }

    public function testAddQueue(){
        $test_name = "add to queue";
        $dummyArray = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java',
        );
        $addQueue = $this->Queue_model->add_to_queue($dummyArray);
        $test = $this->Queue_model->in_queue("Aku Tester", 1,1);
        $expected_result = true;
        $notes = "Test: add queue <br>" .
            "Expected result: $expected_result<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name,$notes);

        $this->emptyDB('scoreboard');
        $this->emptyDB('assignments');
        $this->emptyDB('queue');
        $this->emptyDB('submissions');
    }

    public function testGetTop(){
        $test_name1 = "Test get 1st item if null";
        $test1 = $this->Queue_model->get_first_item();
        $expected_result1 = NULL;
        $res = "null";
        $notes = "Test: get top when queue empty <br>" .
            "Expected result: $res<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test1,$expected_result1,$test_name1, $notes);

        $test_name = "test get 1st item";
        $dummyArray = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java',
        );
        $addQueue = $this->Queue_model->add_to_queue($dummyArray);
        $preTest = $this->Queue_model->get_first_item();
        $this->load->helper('array');
        $test = (int)element('id', $preTest);
        $expected_result = 1;
        $notes = "Test: get top queue (search by ID)<br>" .
            "Expected result: $expected_result<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name, $notes);

        $this->emptyDB('scoreboard');
        $this->emptyDB('assignments');
        $this->emptyDB('queue');
        $this->emptyDB('submissions');
    }

    public function testRemove(){
        $test_name = "Test remove an item";

        $dummyArray = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java',
        );
        $addQueue = $this->Queue_model->add_to_queue($dummyArray);
        $run = $this->Queue_model->remove_item("Aku Tester", 1, 1, 1);
        $test = $this->Queue_model->in_queue("Aku Tester",1,1);
        $expected_result = null;
        $res = "null";
        $notes = "Test: remove queue (the data we insert become null)<br>" .
            "Expected result: $res<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name,$notes);

        $this->emptyDB('scoreboard');
        $this->emptyDB('assignments');
        $this->emptyDB('queue');
        $this->emptyDB('submissions');
    }

    public function testRejudgeSingle(){
        $test_name = "Test Rejudge Single";
        $dummyArray1 = array(
            'assignment'=> 1,
            'id' => 1,
            'name' => "asdf.exe",
            'score'=> 100,
            'is_upload_only' => 1,
            'c_time_limit' => 2000,
            'python_time_limit' => 2000,
            'java_time_limit' => 2000,
            'memory_limit' => 128,
            'allowed_languages' => 'java',
            'diff_cmd' => 'diff',
            'diff_arg' => '-bB'
        );
        $dummyAssignment =
            array(
                'name' => 'Test rejudge single',
                'problems' => 1,
                'total_submits' => 0,
                'open' => 0,
                'scoreboard' => 0,
                'javaexceptions' => 0,
                'description' => '',
                'start_time' => '2019-02-14 00:00:00',
                'finish_time' => '2019-03-01 00:00:00',
                'extra_time' => 0,
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0');
        $dummyArray = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java'
        );
        $this->db->insert('problems', $dummyArray1);
        $this->db->insert('assignment', $dummyAssignment);
        $this->db->insert('submissions',$dummyArray);
        $test = $this->Queue_model->rejudge_single($dummyArray);
        $expected_result = 0;
        $this->unit->run($test,$expected_result,$test_name);
        $this->emptyDB('problems');
        $this->emptyDB('assignment');
        $this->emptyDB('submissions');

        $dummyArray2 = array(
            'assignment'=> 1,
            'id' => 1,
            'name' => "asdf.exe",
            'score'=> 100,
            'is_upload_only' => 0,
            'c_time_limit' => 2000,
            'python_time_limit' => 2000,
            'java_time_limit' => 2000,
            'memory_limit' => 128,
            'allowed_languages' => 'java',
            'diff_cmd' => 'diff',
            'diff_arg' => '-bB'
        );
        $dummyAssignment2 =
            array(
                'name' => 'Test rejudge single',
                'problems' => 1,
                'total_submits' => 0,
                'open' => 0,
                'scoreboard' => 0,
                'javaexceptions' => 0,
                'description' => '',
                'start_time' => '2019-02-14 00:00:00',
                'finish_time' => '2019-03-01 00:00:00',
                'extra_time' => 0,
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0');
        $dummyArrays = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java'
        );
        $this->db->insert('problems', $dummyArray2);
        $this->db->insert('assignment', $dummyAssignment2);
        $this->db->insert('submissions',$dummyArrays);
        $test1 = $this->Queue_model->rejudge_single($dummyArrays);
        $expected_result1 = 0;
        $this->unit->run($test1,$expected_result1,$test_name);

        $this->emptyDB('scoreboard');
        $this->emptyDB('assignments');
        $this->emptyDB('queue');
        $this->emptyDB('problems');
        $this->emptyDB('submissions');
    }

    public function testRejudge(){
        $test_name = "Test Rejudge Single";
        $dummyArray1 = array(
            'assignment'=> 1,
            'id' => 1,
            'name' => "asdf.exe",
            'score'=> 100,
            'is_upload_only' => 1,
            'c_time_limit' => 2000,
            'python_time_limit' => 2000,
            'java_time_limit' => 2000,
            'memory_limit' => 128,
            'allowed_languages' => 'java',
            'diff_cmd' => 'diff',
            'diff_arg' => '-bB'
        );
        $dummyAssignment =
            array(
                'name' => 'Test rejudge single',
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0');
        $dummyArray = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java'
        );
        $this->db->insert('submissions',$dummyArray);
        $this->db->insert('problems', $dummyArray1);
        $this->db->insert('assignment', $dummyAssignment);
        $test = $this->Queue_model->rejudge(1,1);
        $expected_result = 0;
        $notes = "Test: rrejudge<br>" .
            "Expected result: none<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name, $notes);
        $this->emptyDB('problems');

        $dummyArray2 = array(
            'assignment'=> 1,
            'id' => 1,
            'name' => "asdf.exe",
            'score'=> 100,
            'is_upload_only' => 0,
            'c_time_limit' => 2000,
            'python_time_limit' => 2000,
            'java_time_limit' => 2000,
            'memory_limit' => 128,
            'allowed_languages' => 'java',
            'diff_cmd' => 'diff',
            'diff_arg' => '-bB'
        );
        $this->db->insert('problems', $dummyArray2);
        $test1 = $this->Queue_model->rejudge(1,1);
        $expected_result1 = 0;
        $notes = "Test: rrejudge<br>" .
            "Expected result: none<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');

        $this->unit->run($test1,$expected_result1,$test_name,$notes);

        $this->emptyDB('scoreboard');
        $this->emptyDB('assignments');
        $this->emptyDB('queue');
        $this->emptyDB('problems');
        $this->emptyDB('submissions');
    }

    public function testSaveJudge(){
        $dummyArray1 = array(
            'assignment'=> 1,
            'id' => 1,
            'name' => "asdf.exe",
            'score'=> 100,
            'is_upload_only' => 1,
            'c_time_limit' => 2000,
            'python_time_limit' => 2000,
            'java_time_limit' => 2000,
            'memory_limit' => 128,
            'allowed_languages' => 'java',
            'diff_cmd' => 'diff',
            'diff_arg' => '-bB'
        );
        $dummyAssignment =
            array(
                'name' => 'Test rejudge single',
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0');
        $dummyArray = array(
            'submit_id' => 1,
            'username' => "Aku Tester",
            'assignment'=> 1,
            'problem' => 1,
            'is_final' => 1,
            'status' => '',
            'time' => "2019-02-13 00:00:00",
            'pre_score' => 100,
            'coefficient' => 25,
            'file_name' => 'Main',
            'main_file_name' => 'Main',
            'file_type' => 'java'
        );
        $this->db->insert('submissions',$dummyArray);
        $this->db->insert('problems', $dummyArray1);
        $this->db->insert('assignment', $dummyAssignment);

        $test_name = "Test save to db";
        $test = $this->Queue_model->save_judge_result_in_db(1,"judge");
        $expected_result = 0;
        $notes = "Test: save to dbe<br>" .
            "Expected result: db should exist<br>" .
            "Last test date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test,$expected_result,$test_name, $notes);

        $this->emptyDB('scoreboard');
        $this->emptyDB('assignments');
        $this->emptyDB('queue');
        $this->emptyDB('problems');
        $this->emptyDB('submissions');
    }
}