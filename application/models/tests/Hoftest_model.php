<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class Hoftest_model extends Test_model {
    var $shj_submissionsdummy = array(
        array(
            'submit_id' => '2',
            'username'=>'naofal',
            'assignment'=>'1',
            'problem'=>'1',
            'is_final'=>'1',
            'time'=>'2018-02-14 09:04:03',
            'status'=>'SCORE',
            'pre_score'=>100,
            'coefficient'=>'100',
            'file_name'=>'Fibonaccio-1',
            'main_file_name'=>'Fibonaccio',
            'file_type'=>'java')
        );
        var $shj_assignmentsdummy = array(
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
                  $coefficient = 0;','participants' => 'ALL','moss_update' => 'Never','archived_assignment' => '0'));
    public function __construct(){
        parent::__construct();
        $this->load->model('Hof_model');
    }
    private function emptyDB($tableName){
        $this->db->truncate($tableName);   
    }
    private function testget_all_final_submission(){
        $test = $this->Hof_model->get_all_final_submission();
        $expected_result = null;
        $test_name = "Test get_all_final_submission submision kosong";
        $notes = "input : null \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test, $expected_result, $test_name,$notes);
        
        $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[0]);
        $this->db->insert('shj_submissions',$this->shj_submissionsdummy[0]);
        $this->db->query("INSERT INTO `shj_users` (`id`, `username`, `password`, `display_name`, `email`, `role`, `passchange_key`, `passchange_time`, `first_login_time`, `last_login_time`, `selected_assignment`, `dashboard_widget_positions`) VALUES ('1', 'naofal', '080898', 'Admin', 'naofal@mail.com', 'admin', '', NULL, NULL, NULL, '0', '');");
        $test = $this->Hof_model->get_all_final_submission();
        $expected_result = array(array('username'=>'naofal','totalscore'=>'1','display_name'=>'Admin'));;
        $test_name = "Test get_all_final_submission submission tidak kosong";
        $notes = "input : valid assigment,submission, and user \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test, $expected_result, $test_name,$notes);

        $this->emptyDB('users');
        $this->emptyDB('submissions');
        $this->emptyDB('assignments');
    }
    private function testget_all_user_assignments(){
        $test = $this->Hof_model->get_all_user_assignments('naofal');
        $expected_result = null;
        $test_name = "Test get_all_user_assigments assigment kosong";
        $notes = "input : unvalid user \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test, $expected_result, $test_name,$notes);
        
        $this->db->insert('shj_assignments',$this->shj_assignmentsdummy[0]);
        $this->db->insert('shj_submissions',$this->shj_submissionsdummy[0]);
        $this->db->query("INSERT INTO `shj_problems` (`assignment`, `id`, `name`, `score`, `is_upload_only`, `c_time_limit`, `python_time_limit`, `java_time_limit`, `memory_limit`, `allowed_languages`, `diff_cmd`, `diff_arg`) VALUES ('1', '1', 'Problem 1', '0', '0', '500', '1500', '2000', '50000', 'java', 'diff', '-bB');");
        $this->db->query("INSERT INTO `shj_users` (`id`, `username`, `password`, `display_name`, `email`, `role`, `passchange_key`, `passchange_time`, `first_login_time`, `last_login_time`, `selected_assignment`, `dashboard_widget_positions`) VALUES ('1', 'naofal', '080898', 'Admin', 'naofal@mail.com', 'admin', '', NULL, NULL, NULL, '0', '');");
        $test = $this->Hof_model->get_all_user_assignments('naofal');
        $expected_result = array(array('assignment'=>'Test','problem'=>'Problem 1','score'=>'1','scoreboard'=>'1'));
        $test_name = "Test get_all_user_assigments assigment tidak kosong";
        $notes = "input : valid assigment,submission,problems, and user \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
        $this->unit->run($test, $expected_result, $test_name,$notes);
        $this->emptyDB('users');
        $this->emptyDB('submissions');
        $this->emptyDB('assignments');
        $this->emptyDB('problems');
    }
    public function test()
    {
        //echo("db driver: " . $this->db->dbdriver);
        if ($this->db->dbdriver != "postgre") {
            $this->testget_all_final_submission();
            $this->testget_all_user_assignments();
        }
    }
}