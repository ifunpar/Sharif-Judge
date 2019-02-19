<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Test_model extends CI_Model
{

    protected $test, $expected_result, $test_name;

  public function __construct()
  {
        parent::__construct();
        $this->load->library('unit_test');
  }

    abstract public function test();

    public function runTest() {
        $this->test();
  }
}
