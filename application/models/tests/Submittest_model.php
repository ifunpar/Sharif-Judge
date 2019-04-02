<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Submittest_model extends Test_model
{

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
    }

  // ------------------------------------------------------------------------
    private function checkSubmitFirstTime(){
      $test_name = "Check Assignment First Time There is not submit";
      $assignment = array(
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
      $user = array(
        'id' => 100,
        'username' => "Aku Tester",
        'password' => "Aku Tester",
        'display_name' => "Aku Tester",
        'email' => "AkuTester@gm.cm",
        'role' => "administrator",
        'passchange_key' => "Pololo",
        'selected_assignment' => 0, /* todo */
        'dashboard_widget_positions' => ''
      );
      $this->db->insert('users',$user);
      $this->db->insert('assignments', $assignment);
      $total = count($this->Submit_model->get_all_submissions(1, 0, "Aku Tester"));
      $expected_result = 0;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }

    private function clear(){
      $this->db->truncate('users');
      $this->db->truncate('assignments');
      $this->db->truncate('submissions');
    }

    private function addSubmissionForCertainUser(){
      $test_name = "Show submission for certain users";
      $assignment = array(
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
      $user = array(
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
      $submissions = array(
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
          'submit_id' => 1,
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
          'submit_id' => 1,
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
        )
      );
      $this->db->insert('users',$user[0]);
      $this->db->insert('users',$user[1]);
      $this->db->insert('assignments', $assignment);
      $this->db->insert('submissions', $submissions[0]);
      $this->db->insert('submissions', $submissions[1]);
      $this->db->insert('submissions', $submissions[2]);
      $total = count($this->Submit_model->get_all_submissions(1, 0, "Aku Tester "));
      $expected_result = 2;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }
    private function adminLookAllSubmission(){
      $test_name = "Show submission for Admin";
      $assignment = array(
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
      $user = array(
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
      $submissions = array(
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
          'submit_id' => 1,
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
          'submit_id' => 1,
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
        )
      );
      $this->db->insert('users',$user[0]);
      $this->db->insert('users',$user[1]);
      $this->db->insert('assignments', $assignment);
      $this->db->insert('submissions', $submissions[0]);
      $this->db->insert('submissions', $submissions[1]);
      $this->db->insert('submissions', $submissions[2]);
      $total = count($this->Submit_model->get_all_submissions(1, 1, "Aku Tester "));
      $expected_result = 3;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }

    private function countAllSubmissionForAdmin(){
      $test_name = "count all submission for Admin";
      $assignment = array(
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
      $user = array(
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
      $submissions = array(
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
          'submit_id' => 1,
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
          'submit_id' => 1,
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
        )
      );
      $this->db->insert('users',$user[0]);
      $this->db->insert('users',$user[1]);
      $this->db->insert('assignments', $assignment);
      $this->db->insert('submissions', $submissions[0]);
      $this->db->insert('submissions', $submissions[1]);
      $this->db->insert('submissions', $submissions[2]);
      $total = $this->Submit_model->count_all_submissions(1, 1, "Aku Tester ");
      $expected_result = 3;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }

    private function countAllSubmissionForCertainUsers(){
      $test_name = "count all submission for Certains Users";
      $assignment = array(
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
      $user = array(
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
      $submissions = array(
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
          'submit_id' => 1,
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
          'submit_id' => 1,
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
        )
      );
      $this->db->insert('users',$user[0]);
      $this->db->insert('users',$user[1]);
      $this->db->insert('assignments', $assignment);
      $this->db->insert('submissions', $submissions[0]);
      $this->db->insert('submissions', $submissions[1]);
      $this->db->insert('submissions', $submissions[2]);
      $total = $this->Submit_model->count_all_submissions(1, 0, "Aku Tester Versi 2");
      $expected_result = 1;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }

    private function checkFinalSubmissionForAdmin(){
      $test_name = "Check Final Submission for Admin";
      $assignment = array(
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
      $user = array(
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
      $submissions = array(
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
        )
      );
      $this->db->insert('users',$user[0]);
      $this->db->insert('users',$user[1]);
      $this->db->insert('assignments', $assignment);
      $this->db->insert('submissions', $submissions[0]);
      $this->db->insert('submissions', $submissions[1]);
      $this->db->insert('submissions', $submissions[2]);
      $total = count($this->Submit_model->get_final_submissions(1, 1, "Aku Tester"));
      $expected_result = 2;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }

    private function checkFinalSubmissionForCertainUser(){
      $test_name = "Check Final Submission for Certain User";
      $assignment = array(
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
      $user = array(
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
      $submissions = array(
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
          'submit_id' => 1,
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
          'submit_id' => 1,
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
        )
      );
      $this->db->insert('users',$user[0]);
      $this->db->insert('users',$user[1]);
      $this->db->insert('assignments', $assignment);
      $this->db->insert('submissions', $submissions[0]);
      $this->db->insert('submissions', $submissions[1]);
      $this->db->insert('submissions', $submissions[2]);
      $total = count($this->Submit_model->get_final_submissions(1, 0, "Aku Tester"));
      $expected_result = 1;
      $this->unit->run($total,$expected_result,$test_name);
      $this->clear();
    }
}
