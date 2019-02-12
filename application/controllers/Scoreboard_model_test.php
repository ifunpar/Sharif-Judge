<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class Scoreboard_model_test extends CI_Controller {
        public function __construct()
        {
            parent::__construct(); 
            $this->load->library("unit_test");
            $this->load->model('Scoreboard_model');
        }

        private function emptyDB($tableName){
            $this->db->truncate($tableName);
        }

        private function testGetScoreboard(){
            $test = $this->Scoreboard_model->get_scoreboard(1);
			$expected_result = 'Scoreboard not found';
			$test_name = "Get Scoreboard Data Kosong Test";
            $this->unit->run($test,$expected_result,$test_name); 
        }

        private function testUpdateScoreboard(){
            $shj_assignments = array('name' => 'Test','problems' => '1','total_submits' => '0','open' => '0','scoreboard' => '0','javaexceptions' => '0','description' => '','start_time' => '2019-02-28 00:00:00','finish_time' => '2019-03-01 00:00:00','extra_time' => '0','late_rule' => '/* 
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
     
         $this->db->insert('shj_assignments',$shj_assignments);
         $test2 =$this->Scoreboard_model->update_scoreboard(2);
         $tabble = $this->db->select('scoreboard')->get_where('shj_scoreboard',array('assignment'));
         $expected_result2 = $tabble;
         $test_name2 = "Get Scoreboard Data Tidak Kosong Test";
         $this->unit->run($test2,$expected_result2,$test_name2);
         $this->emptyDB('shj_scoreboard');
        }

		public function index(){
            /**
             * Test get scoreboard apabila data masih kosong
             */
            $this->testGetScoreboard();
            /**
             * Test get scoreboard apabila data tidak kosong 
             * & update scoreboard apabila scoreboard masih kosong
             */
            $results2 = $this->unit->result();   
	        foreach ($results2 as $result2) {
			echo "=== " . $result2['Test Name'] . " ===\n";
            foreach ($result2 as $key2 => $value2) {
				echo "$key2: $value2\n";
				if($key2 ==='Result'){
					break;
				}
            }
            echo "\n";
            }
    }   
}
    