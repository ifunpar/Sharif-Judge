<?php
/**
 * Created by PhpStorm.
 * User: Mitsuaki
 * Date: 2019-02-19
 * Time: 14:41
 */

class Queuetest_Model extends Test_model
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
        $expected_result = 1;
        $this->unit->run($test,$expected_result,$test_name);
    }

}