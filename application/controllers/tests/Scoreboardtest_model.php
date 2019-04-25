<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class Scoreboardtest_model extends Test_model {
  var $shj_problemsdummy = array(
    array(
      'assigment'=>'3',
      'id'=>'1',
      'name'=>'Problem 1',
      'score'=>'0',
      'is_upload_only'=>'0',
      'c_time_limit	'=>'500',
      'python_time_limit'=>'1500',
      'java_time_limit'=>'2000',
      'memory_limit'=>'50000',
      'allowed_languages'=>'java',
      'diff_cmd'=>'diff',
      'diff_arg'=>'-bB'
    ),
    array(
      'assigment'=>'3',
      'id'=>'2',
      'name'=>'Problem 2',
      'score'=>'50',
      'is_upload_only'=>'0',
      'c_time_limit	'=>'500',
      'python_time_limit'=>'1500',
      'java_time_limit'=>'2000',
      'memory_limit'=>'50000',
      'allowed_languages'=>'java',
      'diff_cmd'=>'diff',
      'diff_arg'=>'-bB'
    )
  );
  var $shj_submissionsdummy = array(
    array(
        'submit_id' => '1',
        'username'=>'naofal',
        'assignment'=>'1',
        'problem'=>'1',
        'is_final'=>'1',
        'time'=>'2018-02-14 09:04:03',
        'status'=>'SCORE',
        'pre_score'=>90,
        'coefficient'=>'error',
        'file_name'=>'Fibonacci-1',
        'main_file_name'=>'Fibonacci',
        'file_type'=>'java'),
    array(
        'submit_id' => '2',
        'username'=>'naofal',
        'assignment'=>'2',
        'problem'=>'1',
        'is_final'=>'1',
        'time'=>'2018-02-14 09:04:03',
        'status'=>'SCORE',
        'pre_score'=>100,
        'coefficient'=>'100',
        'file_name'=>'Fibonaccio-1',
        'main_file_name'=>'Fibonaccio',
        'file_type'=>'java'),
    array(
      'submit_id' => '3',
      'username'=>'naofal',
      'assignment'=>'3',
      'problem'=>'2',
      'is_final'=>'1',
      'time'=>'2018-02-14 09:04:03',
      'status'=>'SCORE',
      'pre_score'=>0,
      'coefficient'=>'error',
      'file_name'=>'Fibonacci-1',
      'main_file_name'=>'Fibonacci',
      'file_type'=>'java')
    );
  var $shj_assignmentsdummy = array(
      array(
        'name' => 'Test No Scoreboard',
        'problems' => '1',
        'total_submits' => '0',
        'open' => '0',
        'scoreboard' => '0',
        'javaexceptions' => '0',
        'description' => '',
        'start_time' => '2019-02-14 00:00:00',
        'finish_time' => '2019-04-01 00:00:00',
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0'),
      array(
        'name' => 'Test',
        'problems' => '1',
        'total_submits' => '0',
        'open' => '0',
        'scoreboard' => '1',
        'javaexceptions' => '0',
        'description' => '',
        'start_time' => '2019-02-14 00:00:00',
        'finish_time' => '2019-04-01 00:00:00',
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0'),
            array(
              'name' => 'Test 3',
              'problems' => '2',
              'total_submits' => '0',
              'open' => '0',
              'scoreboard' => '1',
              'javaexceptions' => '0',
              'description' => '',
              'start_time' => '2019-02-14 00:00:00',
              'finish_time' => '2019-04-01 00:00:00',
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
                  $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0')
          );
        public function __construct()
        {
            parent::__construct(); 
            $this->load->library("unit_test");
            $this->load->model('Scoreboard_model');
        }
        private function emptyDB($tableName){
            $this->db->truncate($tableName);
            
        }
        private function testUpdateAllScoreboard(){
          //insert dummy assigment 1
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[0]);
          //insert dummy assigment 2
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[1]);
          //insert dummy assigment 3
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[2]);
          $this->Scoreboard_model->update_scoreboards();
          
          //6.Scoreboard_model method update_scoreboards
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
          $expected_result2 = 'Scoreboard not found';
          $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
          $test_name2 = "Test Update All Scoreboard (Scoreboard tidak enabled)";
          $notes = "input : valid assigment \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //7.Scoreboard_model method update_scoreboards
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
          $test_name2 = "Test Update All Scoreboard(Scoreboard enabled)";
          $notes = "input : valid assigment \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //8.Scoreboard_model method update_scoreboards
          $this->db->insert('submissions',$this->shj_submissionsdummy[0]);
          $this->Scoreboard_model->update_scoreboard(1);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
          $expected_result2 = 'Scoreboard not found';
          $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
          $test_name2 = "Test Update All Scoreboard (Scoreboard tidak enabled & Ada submission)";
          $notes = "input : valid submission & valid submission \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //9.Scoreboard_model method update_scoreboards
          $this->db->insert('shj_submissions',$this->shj_submissionsdummy[1]);
          $this->Scoreboard_model->update_scoreboard(2);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
          $test_name2 = "Test Update All Scoreboard(Scoreboard enabled & Ada Submission)";
          $notes = "input : valid submission & valid submission \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //10.Scoreboard_model method update_scoreboards
          $this->db->insert('shj_submissions',$this->shj_submissionsdummy[2]);
          $this->db->query("INSERT INTO `shj_problems` (`assignment`, `id`, `name`, `score`, `is_upload_only`, `c_time_limit`, `python_time_limit`, `java_time_limit`, `memory_limit`, `allowed_languages`, `diff_cmd`, `diff_arg`) VALUES ('3', '1', 'Problem 1', '0', '0', '500', '1500', '2000', '50000', 'java', 'diff', '-bB');");
          $this->db->query("INSERT INTO `shj_problems` (`assignment`, `id`, `name`, `score`, `is_upload_only`, `c_time_limit`, `python_time_limit`, `java_time_limit`, `memory_limit`, `allowed_languages`, `diff_cmd`, `diff_arg`) VALUES ('3', '2', 'Problem 2', '50', '0', '500', '1500', '2000', '50000', 'java', 'diff', '-bB');");
          $scoreboard=$this->Scoreboard_model->update_scoreboard(3);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>3));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(3);
          $test_name2 = "Test Update All Scoreboard(Scoreboard enabled & Problems lebih dari 1)";
          $notes = "input : valid submission & valid submission \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          $this->emptyDB('submissions');
          $this->emptyDB('scoreboard');
          $this->emptyDB('assignments');
          $this->emptyDB('problems');
          
        }
        private function testGetScoreboard(){
          //1. Scoreboard_model method get_scoreboard
          $test = $this->Scoreboard_model->get_scoreboard(1);
          $expected_result = 'Scoreboard not found';
          $test_name = "Test Get Scoreboard Data Kosong";
          $notes = "input : unvalid assigment \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($test,$expected_result,$test_name,$notes); 
        }
        private function testUpdateScoreboard(){
          //2. Scoreboard_model method update_scoreboard
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[0]);
          $this->Scoreboard_model->update_scoreboard(1);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
          $expected_result2 = 'Scoreboard not found';
          $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
          $test_name2 = "Test Update Scoreboard (Scoreboard tidak enabled)";
          $notes = "input : assigmentdummy[0] \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //3. Scoreboard_model method update_scoreboard
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[1]);
          $this->Scoreboard_model->update_scoreboard(2);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
          $test_name2 = "Test Update Scoreboard(Scoreboard enabled)";
          $notes = "input : valid scoreboard \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //4. Scoreboard_model method update_scoreboard
          $this->db->insert('submissions',$this->shj_submissionsdummy[0]);
          $this->Scoreboard_model->update_scoreboard(1);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
          $expected_result2 = 'Scoreboard not found';
          $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
          $test_name2 = "Test Update Scoreboard (Scoreboard tidak enabled & Ada submission)";
          $notes = "input : valid submission & valid submission \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          //5. Scoreboard_model method update_scoreboard
          $this->db->insert('shj_submissions',$this->shj_submissionsdummy[1]);
          $this->Scoreboard_model->update_scoreboard(2);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
          $test_name2 = "Test Update Scoreboard(Scoreboard enabled & Ada Submission)";
          $notes = "input : valid submission & valid submission \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
          $this->unit->run($scoreboard,$expected_result2,$test_name2,$notes);
          
          //Truncate table submissions
          $this->emptyDB('submissions');
          //Truncate table scoreboard
          $this->emptyDB('scoreboard');
          //Truncate table assignments
          $this->emptyDB('assignments');
        }
		public function test(){
            $this->testGetScoreboard();
           $this->testUpdateScoreboard();
            $this->testUpdateAllScoreboard();
    }   
}
