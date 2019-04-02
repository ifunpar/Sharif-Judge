<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Submittest_model extends Test_model
{
    var $assignment = array(
      'id' => 1,
      'name' => "Test Assignment",
      'problems' => 5,
      'total_submits' => 0,
      'open' => 1,
      'scoreboard' => 0,
      'javaexceptions' => 0,
      'description' => '', /* todo */
      'start_time' => '2019-02-11 00:00:00',
      'finish_time' => '2019-02-13 00:00:00',
      'extra_time' => 0,
      'late_rule' => '',
      'participants' => '',
      'archived_assignment' => 0
    );
    var $user = array(
      array(
        'id' => 100,
        'username' => "Aku Tester",
        'password' => "Aku Tester",
        'display_name' => "Aku Tester",
        'email' => "AkuTester@gm.cm",
        'role' => "administrator",
        'passchange_key' => "Pololo",
        'selected_assignment' => 0, /* todo */
        'dashboard_widget_positions' => ''
      ),
      array(
        'id' => 101,
        'username' => "Aku Tester Versi 2",
        'password' => "Aku Tester",
        'display_name' => "Aku Tester Versi 2",
        'email' => "AkuTester@gm.cm",
        'role' => "student",
        'passchange_key' => "Pololos",
        'selected_assignment' => 0, /* todo */
        'dashboard_widget_positions' => ''
      ),
    );
    var $submissions = array(
      array(
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
      ),
      array(
        'submit_id' => 2,
        'username' => "Aku Tester",
        'assignment'=> 1,
        'problem' => 1,
        'is_final' => 0,
        'status' => '',
        'time' => "2019-02-12 00:00:00",
        'pre_score' => 100,
        'coefficient' => 25,
        'file_name' => 'Main',
        'main_file_name' => 'Main',
        'file_type' => 'java',
      ),
      array(
        'submit_id' => 3,
        'username' => "Aku Tester Versi 2",
        'assignment'=> 1,
        'problem' => 1,
        'is_final' => 1,
        'status' => '',
        'time' => "2019-02-12 00:00:00",
        'pre_score' => 100,
        'coefficient' => 25,
        'file_name' => 'Main',
        'main_file_name' => 'Main',
        'file_type' => 'java',
      ),
      array(
        'submit_id' => 4,
        'username' => "Aku Tester Versi 2",
        'assignment'=> 1,
        'problem' => 2,
        'is_final' => 1,
        'status' => '',
        'time' => "2019-02-12 00:00:00",
        'pre_score' => 100,
        'coefficient' => 25,
        'file_name' => 'Main',
        'main_file_name' => 'Main',
        'file_type' => 'java',
      ),
      array(
        'submit_id' => 5,
        'username' => "Aku Tester Versi 2",
        'assignment'=> 1,
        'problem' => 2,
        'is_final' => 0,
        'status' => '',
        'time' => "2019-02-12 00:00:00",
        'pre_score' => 100,
        'coefficient' => 25,
        'file_name' => 'Main',
        'main_file_name' => 'Main',
        'file_type' => 'java',
      )
    );
	public function __construct()
	{
        parent::__construct();
        $this->load->model("Submit_model");
	}

	// ------------------------------------------------------------------------
    
    //example content of test
    public function test(){
        $this->checkSubmitFirstTime();
        $this->addSubmissionForCertainUser();
        $this->adminLookAllSubmission();
        $this->countAllSubmissionForAdmin();
        $this->countAllSubmissionForCertainUsers();
        $this->checkFinalSubmissionForCertainUser();
        $this->checkFinalSubmissionForAdmin();
        $this->checkFinalSubmissionForCertainUserFromAdmin();
        $this->checkFinalSubmissionForCertainProblemFromAdmin();
        $this->checkFinalSubmissionForCertainProblemFromAdminWithPageSettingZero();
        $this->checkFinalSubmissionForCertainProblemFromAdminWithPageSettingOne();
        $this->checkGetSubmissionMethodFound();
        $this->checkGetSubmissionMethodNotFound();
        $this->checkAllSubmissionForCertainUser();
        $this->checkAllSubmissionForAdmin();
        $this->checkAllSubmissionForCertainUserFromAdmin();
        $this->checkAllSubmissionForCertainProblemFromAdmin();
        $this->checkAllSubmissionForCertainProblemFromAdminWithPageSettingZero();
        $this->checkAllSubmissionForCertainProblemFromAdminWithPageSettingOne();
        $this->countAllFinalSubmissionForAdminFilterUser();
        $this->countAllFinalSubmissionForCertainUser();
        $this->countAllFinalSubmissionForCertainUserCertainProblem();
        $this->countAllSubmissionAdminForCertainUserCertainProblem();
        $this->checkUploadOnlyMethod();
        $this->checkSetFinalSubmission();
    }

  // ------------------------------------------------------------------------
    private function checkSubmitFirstTime(){
      $test_name = "Check Assignment First Time There is not submit";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('assignments', $this->assignment);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester"));
      $expected_result = 0;
      $notes = "Test: $test_name <br>" .
                "Expected result: There is not submitted<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function clear(){
      $this->db->truncate('users');
      $this->db->truncate('assignments');
      $this->db->truncate('submissions');
    }

    private function addSubmissionForCertainUser(){
      $test_name = "Show submission for certain users";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_all_submissions(1, 0, "Aku Tester"));
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function adminLookAllSubmission(){
      $test_name = "Show submission for Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester "));
      $expected_result = 4;
      $notes = "Test: $test_name <br>" .
                "Expected result: 4 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function countAllSubmissionForAdmin(){
      $test_name = "count all submission for Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = $this->Submit_model->count_all_submissions(1, 1, "Aku Tester ");
      $expected_result = 4;
      $notes = "Test: $test_name <br>" .
                "Expected result: 4 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function countAllSubmissionForCertainUsers(){
      $test_name = "count all submission for Certains Users";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = $this->Submit_model->count_all_submissions(1, 0, "Aku Tester Versi 2");
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkFinalSubmissionForAdmin(){
      $test_name = "Check Final Submission for Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_final_submissions(1, 1, "Aku Tester"));
      $expected_result = 3;
      $notes = "Test: $test_name <br>" .
                "Expected result: 3 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkFinalSubmissionForCertainUser(){
      $test_name = "Check Final Submission for Certain User";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_final_submissions(1, 0, "Aku Tester"));
      $expected_result = 1;
      $notes = "Test: $test_name <br>" .
                "Expected result: should be 1 final submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkFinalSubmissionForCertainUserFromAdmin(){
      $test_name = "Check Final Submission for Certain User";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_final_submissions(1, 1, "Aku Tester Versi 2",NULL,"Aku Tester Versi 2"));
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 final submissions for 2 problem<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkFinalSubmissionForCertainProblemFromAdmin(){
      $test_name = "Check Final Submission for Certain User From Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_final_submissions(1, 1, "Aku Tester Versi 2",NULL,NULL,1));
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkFinalSubmissionForCertainProblemFromAdminWithPageSettingZero(){
      $test_name = "Check Final Submission for Certain User From Admin With Page Setting is Zero";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->where('shj_key', 'results_per_page_final')->update('settings', array('shj_value'=>0));
      $total = count($this->Submit_model->get_final_submissions(1, 1, "Aku Tester Versi 2",0,NULL,1));
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
      $this->db->where('shj_key', 'results_per_page_final')->update('settings', array('shj_value'=>80));
    }

    private function checkFinalSubmissionForCertainProblemFromAdminWithPageSettingOne(){
      $test_name = "Check Final Submission for Certain User From Admin With Page";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_final_submissions(1, 1, "Aku Tester Versi 2",1,NULL,1));
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 final submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkGetSubmissionMethodFound(){
      $test_name = "Check get final Submission method and found";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_submission("Aku Tester", 1, 1,1));
      $expected_result = 12;
      $notes = "Test: $test_name <br>" .
                "Expected result: 12 columns<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkGetSubmissionMethodNotFound(){
      $test_name = "Check get final Submission method and found";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $total = count($this->Submit_model->get_submission("Aku Tester", 1, 1,13));
      $expected_result = 1;
      $notes = "Test: $test_name <br>" .
                "Expected result: Not found<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkAllSubmissionForAdmin(){
      $test_name = "Check All Submission for Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester"));
      $expected_result = 5;
      $notes = "Test: $test_name <br>" .
                "Expected result: 5 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkAllSubmissionForCertainUser(){
      $test_name = "Check All Submission for Certain User";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = count($this->Submit_model->get_all_submissions(1, 0, "Aku Tester"));
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkAllSubmissionForCertainUserFromAdmin(){
      $test_name = "Check All Submission for Certain User From Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester Versi 2",NULL,"Aku Tester Versi 2"));
      $expected_result = 3;
      $notes = "Test: $test_name <br>" .
                "Expected result: 3 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkAllSubmissionForCertainProblemFromAdmin(){
      $test_name = "Check All Submission for Certain Problem From Admin";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester Versi 2",NULL,NULL,1));
      $expected_result = 3;
      $notes = "Test: $test_name <br>" .
                "Expected result: 3 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkAllSubmissionForCertainProblemFromAdminWithPageSettingZero(){
      $test_name = "Check All Submission for Certain User From Admin With Page Setting is Zero";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $this->db->where('shj_key', 'results_per_page_all')->update('settings', array('shj_value'=>0));
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester Versi 2",0,NULL,1));
      $expected_result = 3;
      $notes = "Test: $test_name <br>" .
                "Expected result: 3 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
      $this->db->where('shj_key', 'results_per_page_all')->update('settings', array('shj_value'=>40));
    }

    private function checkAllSubmissionForCertainProblemFromAdminWithPageSettingOne(){
      $test_name = "Check All Submission for Certain User From Admin With Page";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester Versi 2",1,NULL,1));
      $expected_result = 3;
      $notes = "Test: $test_name <br>" .
                "Expected result: 3 submissions <br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    
    private function countAllFinalSubmissionForCertainUser(){
      $test_name = "Count all Final Submission for Certain User";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = $this->Submit_model->count_final_submissions(1, 0, "Aku Tester Versi 2","Aku Tester Versi 2",NULL);
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 final submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function countAllFinalSubmissionForAdminFilterUser(){
      $test_name = "Count all Final Submission for Admin Filter User";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = $this->Submit_model->count_final_submissions(1, 1, "Aku Tester Versi 2","Aku Tester Versi 2",NULL);
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function countAllFinalSubmissionForCertainUserCertainProblem(){
      $test_name = "Count all Final Submission for Certain User Certain Problem";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = $this->Submit_model->count_final_submissions(1, 0, "Aku Tester Versi 2","Aku Tester Versi 2",1);
      $expected_result = 1;
      $notes = "Test: $test_name <br>" .
                "Expected result: 1 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function countAllSubmissionAdminForCertainUserCertainProblem(){
      $test_name = "Count all Submission admin for Certain User Certain Problem";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[0]);
      $this->db->insert('submissions', $this->submissions[1]);
      $this->db->insert('submissions', $this->submissions[2]);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $total = $this->Submit_model->count_all_submissions(1, 1, "Aku Tester Versi 2","Aku Tester Versi 2",2);
      $expected_result = 2;
      $notes = "Test: $test_name <br>" .
                "Expected result: 2 submissions<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($total,$expected_result,$test_name,$notes);
      $this->clear();
    }
    private function checkUploadOnlyMethod(){
      $test_name = "Check upload only method";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->Submit_model->add_upload_only($this->submissions[4]);
      $query = ($this->db->get_where('submissions', array('submit_id' => 5)))->row_array();
      $result = $query['is_final'];
      $expected_result = 1;
      $notes = "Test: $test_name <br>" .
                "Expected result: should be final<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($result,$expected_result,$test_name,$notes);
      $this->clear();
    }

    private function checkSetFinalSubmission(){
      $test_name = "check final submission method";
      $this->db->insert('users',$this->user[0]);
      $this->db->insert('users',$this->user[1]);
      $this->db->insert('assignments', $this->assignment);
      $this->db->insert('submissions', $this->submissions[3]);
      $this->db->insert('submissions', $this->submissions[4]);
      $this->Submit_model->set_final_submission("Aku Tester Versi 2",1,2,5);
      $query = ($this->db->get_where('submissions', array('submit_id' => 5)))->row_array();
      $result = $query['is_final'];
      $expected_result = 1;
      $notes = "Test: $test_name <br>" .
                "Expected result: new data should be final<br>" .
                "Last test date: " . date('H:i:s ~ Y-m-d');
      $this->unit->run($result,$expected_result,$test_name,$notes);
      $this->clear();
    }
}
