<?php
/**
 * Created by PhpStorm.
 * User: Mitsuaki
 * Date: 2019-02-07
 * Time: 12:54
 */

class SettingTest extends CI_Controller
{

    private $isExist;

    public function __construct()
    {
        parent::__construct();
        $this->load->library("unit_test");
    }

//    public function check_db(){
//        if ($this->db->table_exists('shj_scoreboard') )
//        {
//            $this->isExist=true;
//        }
//        else
//        {
//            $this->isExist=false;
//        }
//    }

//    public function createDB(){
//            // create table 'settings'
//            $fields = array(
//                'shj_key'        => array('type' => 'VARCHAR', 'constraint' => 50),
//                'shj_value'      => array('type' => 'TEXT'),
//            );
//            $this->dbforge->add_field($fields);
//            $this->dbforge->add_key('shj_key');
//            if ( ! $this->dbforge->create_table('settings', TRUE))
//                show_error("Error creating database table ".$this->db->dbprefix('settings'));
//
//
//            // insert default settings to table 'settings'
//            $result = $this->db->insert_batch('settings', array(
//                array('shj_key' => 'timezone',               'shj_value' => 'Asia/Jakarta'),
//                array('shj_key' => 'tester_path',            'shj_value' => dirname(__FILE__, 3) . "/restricted/tester"),
//                array('shj_key' => 'assignments_root',       'shj_value' => dirname(__FILE__, 3) . "/restricted/assignments"),
//                array('shj_key' => 'file_size_limit',        'shj_value' => '50'),
//                array('shj_key' => 'output_size_limit',      'shj_value' => '1024'),
//                array('shj_key' => 'queue_is_working',       'shj_value' => '0'),
//                array('shj_key' => 'default_late_rule',      'shj_value' => "/* \n * Put coefficient (from 100) in variable \$coefficient.\n * You can use variables \$extra_time and \$delay.\n * \$extra_time is the total extra time given to users\n * (in seconds) and \$delay is number of seconds passed\n * from finish time (can be negative).\n *  In this example, \$extra_time is 172800 (2 days):\n */\n\nif (\$delay<=0)\n  // no delay\n  \$coefficient = 100;\n\nelseif (\$delay<=3600)\n  // delay less than 1 hour\n  \$coefficient = ceil(100-((30*\$delay)/3600));\n\nelseif (\$delay<=86400)\n  // delay more than 1 hour and less than 1 day\n  \$coefficient = 70;\n\nelseif ((\$delay-86400)<=3600)\n  // delay less than 1 hour in second day\n  \$coefficient = ceil(70-((20*(\$delay-86400))/3600));\n\nelseif ((\$delay-86400)<=86400)\n  // delay more than 1 hour in second day\n  \$coefficient = 50;\n\nelseif (\$delay > \$extra_time)\n  // too late\n  \$coefficient = 0;"),
//                array('shj_key' => 'enable_easysandbox',     'shj_value' => '1'),
//                array('shj_key' => 'enable_c_shield',        'shj_value' => '1'),
//                array('shj_key' => 'enable_cpp_shield',      'shj_value' => '1'),
//                array('shj_key' => 'enable_py2_shield',      'shj_value' => '1'),
//                array('shj_key' => 'enable_py3_shield',      'shj_value' => '1'),
//                array('shj_key' => 'enable_java_policy',     'shj_value' => '1'),
//                array('shj_key' => 'enable_log',             'shj_value' => '1'),
//                array('shj_key' => 'submit_penalty',         'shj_value' => '300'),
//                array('shj_key' => 'enable_registration',    'shj_value' => '0'),
//                array('shj_key' => 'registration_code',      'shj_value' => '0'),
//                array('shj_key' => 'mail_from',              'shj_value' => 'no-reply+shj@labftis.net'),
//                array('shj_key' => 'mail_from_name',         'shj_value' => 'Judge from FTIS Administrator'),
//                array('shj_key' => 'reset_password_mail',    'shj_value' => "<p>\nSomeone requested a password reset for your SharIF Judge account at {SITE_URL}.\n</p>\n<p>\nTo change your password, visit this link:\n</p>\n<p>\n<a href=\"{RESET_LINK}\">Reset Password</a>\n</p>\n<p>\nThe link is valid for {VALID_TIME}. If you don't want to change your password, just ignore this email.\n</p>"),
//                array('shj_key' => 'add_user_mail',          'shj_value' => "<p>\nHello! You are registered in SharIF Judge at {SITE_URL} as {ROLE}.\n</p>\n<p>\nYour username: {USERNAME}\n</p>\n<p>\nYour password: {PASSWORD}\n</p>\n<p>\nYou can log in at <a href=\"{LOGIN_URL}\">{LOGIN_URL}</a>\n</p>"),
//                array('shj_key' => 'moss_userid',            'shj_value' => ''),
//                array('shj_key' => 'results_per_page_all',   'shj_value' => '40'),
//                array('shj_key' => 'results_per_page_final', 'shj_value' => '80'),
//                array('shj_key' => 'week_start',             'shj_value' => '0'),
//                array('shj_key' => 'lock_student_display_name',      'shj_value' => '0'),
//            ));
//            if ( ! $result)
//                show_error("Error adding data to table ".$this->db->dbprefix('settings'));
//    }

    public function set_setting($key, $value)
    {
        $this->db->where('shj_key', $key)->update('settings', array('shj_value'=>$value));
    }

    public function get_setting($key)
    {
        return $this->db->select('shj_value')->get_where('settings', array('shj_key'=>$key))->row()->shj_value;
    }

    public function get_all_settings()
    {
        $result = $this->db->get('settings')->result_array();
        $settings = array();
        foreach($result as $item)
        {
            $settings[$item['shj_key']] = $item['shj_value'];
        }
        return $settings;
    }

    public function index(){
        //$exist = $this->check_db();
        $set = $this->set_setting("timezone", "Asia/Tokyo");
        $test = $this->get_setting("timezone");
        $testAll = $this->get_all_settings();
        $expected_result = "Asia/Tokyo";
        $test_name = "Change Time Zone test function";

        echo "Current Setting";
        print_r($testAll);
        echo "\n";

        $this->unit->run($test,$expected_result,$test_name);
        $results = $this->unit->result();
        foreach ($results as $result) {
            echo "=== " . $result['Test Name'] . " ===\n";
            foreach ($result as $key => $value) {
                echo "$key: $value\n";
                if($key ==='Result'){
                    break;
                }
            }
            echo "\n";
        }
    }
}