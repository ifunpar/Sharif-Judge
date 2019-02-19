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
        $this->load->model("Queue_model");
    }

    public function test()
    {
        // TODO: Implement test() method.
        $this->testNotEmptyQueue();

    }

    public function testNotEmptyQueue(){
        $test_name = "Test isi dari queue";
        $test = count($this->Queue_model->get_queue());
        $expected_result = 0;
        $this->unit->run($test,$expected_result,$test_name);
    }

}