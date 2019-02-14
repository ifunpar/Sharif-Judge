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
  
  public function showResult() {
    $results = $this->unit->result();
    $statistics = [
            'Pass' => 0,
            'Fail' => 0
        ];
    foreach ($results as $result) {
      echo "=== " . $result['Test Name'] . " ===\n";
      foreach ($result as $key => $value) {
        echo "$key: $value\n";
        if($key ==='Result'){
          if ($result['Result'] === 'Passed') {
            $statistics['Pass']++;
          } else {
            $statistics['Fail']++;
          }
          break;
        }
      }
      echo "\n";
    }
    echo "==========\n";
    foreach ($statistics as $key => $value) {
        echo "$value test(s) $key\n";
    }
    if ($statistics['Fail'] > 0) {
        exit(1);
    }        
  }
}
