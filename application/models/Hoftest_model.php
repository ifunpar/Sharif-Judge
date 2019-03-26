<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class Hoftest_model extends Test_model {

    public function __construct(){
        parent::__construct(); 
        $this->load->library("unit_test");
        $this->load->model('Hof_model');
    }

    private function emptyDB($tableName){
        $this->db->truncate($tableName);   
    }

    private function testget_all_final_submission(){
        $test = $this->Hof_model->get_all_final_submission();
        $expected_result = null;
        $test_name = "Test get_all_final_submission";
        $this->unit->run($test,$expected_result,$test_name); 
    }

    private function testget_all_user_assignments(){
        $test = $this->Hof_model->get_all_user_assignments('naofal');
        $expected_result = null;
        $test_name = "Test get_all_user_assigments";
        $this->unit->run($test,$expected_result,$test_name); 
    }

    public function test(){
        $this->testget_all_final_submission();
        $this->testget_all_user_assignments();
    }
}