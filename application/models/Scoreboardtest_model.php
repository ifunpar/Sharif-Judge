<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class Scoreboardtest_model extends Test_model {
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
        'coefficient'=>'100',
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
        'pre_score'=>0,
        'coefficient'=>'100',
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
            $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0'),
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
              $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0'));
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
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[0]);
          $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[1]);
          $this->Scoreboard_model->update_scoreboards();
          
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
          $expected_result2 = 'Scoreboard not found';
          $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
          $test_name2 = "Test Update All Scoreboard (Scoreboard tidak enabled)";
          $this->unit->run($scoreboard,$expected_result2,$test_name2);

          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
          $test_name2 = "Test Update All Scoreboard(Scoreboard enabled)";
          $this->unit->run($scoreboard,$expected_result2,$test_name2);

          $this->db->insert('submissions',$this->shj_submissionsdummy[0]);
          $this->Scoreboard_model->update_scoreboard(1);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
          $expected_result2 = 'Scoreboard not found';
          $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
          $test_name2 = "Test Update All Scoreboard (Scoreboard tidak enabled & Ada submission)";
          $this->unit->run($scoreboard,$expected_result2,$test_name2);
 
          $this->db->insert('shj_submissions',$this->shj_submissionsdummy[1]);
          $this->Scoreboard_model->update_scoreboard(2);
          $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
          $expected_result2 = $tabble->row()->scoreboard;
          $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
          $test_name2 = "Test Update All Scoreboard(Scoreboard enabled & Ada Submission)";
          $this->unit->run($scoreboard,$expected_result2,$test_name2);

          $this->emptyDB('submissions');
          $this->emptyDB('scoreboard');
          $this->emptyDB('assignments');
          
        }

        private function testGetScoreboard(){
            $test = $this->Scoreboard_model->get_scoreboard(1);
			      $expected_result = 'Scoreboard not found';
			      $test_name = "Test Get Scoreboard Data Kosong";
            $this->unit->run($test,$expected_result,$test_name); 
        }

        private function testUpdateScoreboard(){
         $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[0]);
         $this->Scoreboard_model->update_scoreboard(1);
         $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
         $expected_result2 = 'Scoreboard not found';
         $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
         $test_name2 = "Test Update Scoreboard (Scoreboard tidak enabled)";
         $this->unit->run($scoreboard,$expected_result2,$test_name2);

         $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[1]);
         $this->Scoreboard_model->update_scoreboard(2);
         $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
         $expected_result2 = $tabble->row()->scoreboard;
         $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
         $test_name2 = "Test Update Scoreboard(Scoreboard enabled)";
         $this->unit->run($scoreboard,$expected_result2,$test_name2);

         $this->db->insert('submissions',$this->shj_submissionsdummy[0]);
         $this->Scoreboard_model->update_scoreboard(1);
         $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>1));
         $expected_result2 = 'Scoreboard not found';
         $scoreboard=$this->Scoreboard_model->get_scoreboard(1);
         $test_name2 = "Test Update Scoreboard (Scoreboard tidak enabled & Ada submission)";
         $this->unit->run($scoreboard,$expected_result2,$test_name2);

         $this->db->insert('shj_submissions',$this->shj_submissionsdummy[1]);
         $this->Scoreboard_model->update_scoreboard(2);
         $tabble = $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>2));
         $expected_result2 = $tabble->row()->scoreboard;
         $scoreboard=$this->Scoreboard_model->get_scoreboard(2);
         $test_name2 = "Test Update Scoreboard(Scoreboard enabled & Ada Submission)";
         $this->unit->run($scoreboard,$expected_result2,$test_name2);

         $this->emptyDB('submissions');
         $this->emptyDB('scoreboard');
         $this->emptyDB('assignments');
        }

		public function test(){

            $this->testGetScoreboard();
            $this->testUpdateScoreboard();
            $this->testUpdateAllScoreboard();
    }   
}
    