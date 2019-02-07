<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// php index.php ContohTest
class Scoreboard_model_test extends CI_Controller {
        public function __construct()
        {
            parent::__construct(); 
			$this->load->library("unit_test");
        }
		
		
		public function get_scoreboard($assignment_id)
		{
			$query =  $this->db->select('scoreboard')->get_where('scoreboard', array('assignment'=>$assignment_id));
			if ($query->num_rows() != 1)
				return 'Scoreboard not found';
			else
				return $query->row()->scoreboard;
		}

		public function index(){
            /**
             * Test get scoreboard apabila data masih kosong
             */
            $test = $this->get_scoreboard(1);
			$expected_result = 'Scoreboard not found';
			$test_name = "Get Scoreboard Data Kosong Test";
			$this->unit->run($test,$expected_result,$test_name);   
            $data_dummy=array(
                'assignment' => 1,
                'scoreboard' => '80'
            );
            
            $this->db->insert('shj_scoreboard',$data_dummy);
            $test2 = $this->get_scoreboard(1);
			$expected_result2 = '80';
			$test_name2 = "Get Scoreboard Data Tidak Kosong Test";
            $this->unit->run($test2,$expected_result2,$test_name2);
            
            /**
             * Test get scoreboard apabila data tidak kosong
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
            $this->db->empty_table('shj_scoreboard');
    }   
}
    