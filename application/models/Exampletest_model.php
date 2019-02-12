<?php
/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
include('Test_model.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Exampletest_model extends Test_model
{

	public function __construct()
	{
        parent::__construct();
	}

	// ------------------------------------------------------------------------
    
    //example content of test
    public function test(){
        $this->test = $this->division(6,3);
        $this->expected_result = 2;
        $this->test_name = "Division test function";
    }

    private function division($a,$b){
		return $a/$b;
	}

	// ------------------------------------------------------------------------
}
