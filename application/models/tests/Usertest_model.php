<?php

/**
 * SharIF Judge online judge
 * @file User_model.php
 * @author Mohammad Javad Naderi <mjnaderi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertest_model extends Test_model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Notifications_model");
    $this->load->model("User_model");
  }

    // ------------------------------------------------------------------------

  public function test()
  {
        // 1 - 10
    $this->testing_method_add_user();
    // 11 - 12
    $this->testing_method_add_users();
    // 13 - 15
    $this->testing_method_have_user();
    // 16 - 17
    $this->testing_method_username_to_user_id();
    // 18 - 20
    $this->testing_method_user_id_to_username();
    // 21 - 23
    $this->testing_method_have_email();
    // 24 - 27
    $this->testing_method_validate_user();
    // // 28
    $this->testing_method_get_names();
    // // 29 - 30 
    $this->testing_method_get_user();
    // // 31
    $this->testing_method_get_all_users();
    // // 32 - 33 
    $this->testing_method_delete_submissions();
    // 34 - 35
    $this->testing_method_update_profile();

    $this->testing_method_send_password_reset_mail();

    $this->testing_method_update_login_time();

    $this->testing_method_delete_user();
    //
    $this->testing_method_passchange_is_valid();
    //
    
    //
    $this->testing_method_reset_password();
    //
    
    //
   
    //
    $this->testing_method_selected_assignment();

    $this->clear();
  }

  private function clear()
  {
    $this->db->truncate('users');
  }

  private function testing_method_add_user()
  {
    //1 - User_model method add_user
    $test = $this->User_model->add_user('admin', 'admin@judge.com', 'Admin', 'admin123', 'admin');
    $expected_result = true;
    $test_name = "Testing add_user function in User_model.php ";
    $notes = "input : valid user \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);
    

    //2 - User_model method add_user
    $test = $this->User_model->add_user('a', 'usertest@test.com', 'usertest', '12345', 'admin');
    $expected_result = 'Username or password length error.';
    $test_name = "Testing add_user function in User_model.php ";
    $notes = "input : username length < 3 \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //3 - User_model method add_user
    $test = $this->User_model->add_user('abcdefghijklmnopqrstu', 'usertest@test.com', 'usertest', '12345', 'admin');
    $expected_result = 'Username or password length error.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : username length > 20 \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //4 - User_model method add_user
    $test = $this->User_model->add_user('abcde', 'usertest@test.com', 'usertest', '01', 'admin');
    $expected_result = 'Username or password length error.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : password length < 6 \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //5 - User_model method add_user
    for ($i = 0; $i < 201; $i++) {
      $pass += '1';
    }
    $test = $this->User_model->add_user('abcde', 'usertest@test.com', 'usertest', $pass, 'admin');
    $expected_result = 'Username or password length error.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : password length > 200 \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //6 - User_model method add_user
    $test = $this->User_model->add_user('admin', 'usertest@test.com', 'usertest', '123456', 'admin');
    $expected_result = 'User with this username exists.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : username already exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //7 - User_model method add_user
    $test = $this->User_model->add_user('usertest', 'admin@judge.com', 'usertest', '123456', 'admin');
    $expected_result = 'User with this email exists.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : email already exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //8 - User_model method add_user
    $test = $this->User_model->add_user('USERTEST', 'usertest@test.com', 'usertest', '123456', 'admin');
    $expected_result = 'Username must be lowercase.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : username not lowercase \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //9 - User_model method add_user
    $test = $this->User_model->add_user('usertest', 'usertest@test.com', 'usertest', '123456', 'nothing');
    $expected_result = 'Users role is not valid.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input : role not valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name,$notes);

    //10 - User_model method add_user
    $test = $this->User_model->add_user('!@#$%^&*./,<>', 'usertest@test.com', 'usertest', '12345', 'admin');
    $expected_result = 'Username may only contain alpha-numeric characters.';
    $test_name = "Testing add_user function in User_model.php";
    $notes = "input not alphanumeric \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_add_users()
  {
    //11 - User_model method add_users
    $temp1 = array();
    $temp2 = array();
    array_push($temp2, array('asdf', '', '', '', '', 'Wrong Format'));
    $test = $this->User_model->add_users('asdf', false, 0);
    $expected_result = array($temp1, $temp2);
    $test_name = "Testing add_users function in User_model.php";
    $notes = "input : Line Wrong Format \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //12 - User_model method add_users
    $temp1 = array();
    $temp2 = array();
    array_push($temp1, array('usertest1', 'usertest1@test.com', 'usertest1', '123456', 'student'));
    array_push($temp2, array('usertest2', 'usertest2@test.com', 'usertest2', '123456', 'nothing', 'Users role is not valid.'));
    $test = $this->User_model->add_users("usertest1,usertest1@test.com,usertest1,123456,student \nusertest2,usertest2@test.com,usertest2,123456,nothing", true, 0);
    $expected_result = array($temp1, $temp2);
    $test_name = "Testing add_users function in User_model.php";
    $notes = "input : 1 valid user and 1 not valid user \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    $temp1 = array();
    $temp2 = array();
    $test = $this->User_model->add_users('', false, 0);
    $expected_result = array($temp1, $temp2);
    $test_name = "Testing add_users function in User_model.php";
    $notes = "input : empty \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_have_user()
  {
    //13 - User_model method have_user
    $test = $this->User_model->have_user('admin');
    $expected_result = true;
    $test_name = "Testing have_user function in User_model.php";
    $notes = "input : admin \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //14 - User_model method have_user
    $test = $this->User_model->have_user('admins');
    $expected_result = false;
    $test_name = "Testing have_user function in User_model.php";
    $notes = "input : admins \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //15 - User_model method have_user
    $test = $this->User_model->have_user('admins');
    $expected_result = false;
    $test_name = "Testing have_user function in User_model.php";
    $notes = "input : ADMIN \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    $test = $this->User_model->have_user(false);
    $expected_result = false;
    $test_name = "Testing have_user function in User_model.php";
    $notes = "input : null \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);


  }

  private function testing_method_username_to_user_id()
  {
    //16 - User_model method username_to_user_id
    $test = $this->User_model->username_to_user_id('admin');
    $expected_result = true;
    $test_name = "Testing username_to_user_id function in User_model.php";
    $notes = "input : username exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
    
    //17 - User_model method username_to_user_id
    $test = $this->User_model->username_to_user_id('');
    $expected_result = false;
    $test_name = "Testing username_to_user_id function in User_model.php";
    $notes = "input : username not exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_user_id_to_username()
  {
    //18 - User_model method user_id_to_username
    $test = $this->User_model->user_id_to_username('a');
    $expected_result = false;
    $test_name = "Testing user_id_to_username function in User_model.php";
    $notes = "input : not numeric \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //19 - User_model method user_id_to_username
    $test = $this->User_model->user_id_to_username(1);
    $expected_result = true;
    $test_name = "Testing user_id_to_username function in User_model.php";
    $notes = "input : numeric and exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //20 - User_model method user_id_to_username
    $test = $this->User_model->user_id_to_username(0);
    $expected_result = false;
    $test_name = "Testing user_id_to_username function in User_model.php";
    $notes = "input : numeric and not exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_have_email()
  {
     //21 - User_model method have_email
    $test = $this->User_model->have_email('admin@judge.com', false);
    $expected_result = true;
    $test_name = "Testing have_email function in User_model.php";
    $notes = "input : email exists and username false \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
 
     //22 - User_model method have_email
    $test = $this->User_model->have_email('', false);
    $expected_result = false;
    $test_name = "Testing have_email function in User_model.php";
    $notes = "input : email not exists and username false \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
 
     //23 - User_model method have_email
    $test = $this->User_model->have_email('admin@judge.com', true);
    $expected_result = false;
    $test_name = "Testing have_email function in User_model.php";
    $notes = "input : email exists and username not false \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_validate_user()
  {
    //24 - User_model method validate_user
    $test = $this->User_model->validate_user('nothing', 'admin123');
    $expected_result = false;
    $test_name = "Testing validate_user function in User_model.php";
    $notes = "input : username not exists \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //25 - User_model method validate_user
    $test = $this->User_model->validate_user('ADMIN', 'admin123');
    $expected_result = false;
    $test_name = "Testing validate_user function in User_model.php";
    $notes = "input : username not valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //26 - User_model method validate_user
    $test = $this->User_model->validate_user('admin', 'nothing');
    $expected_result = false;
    $test_name = "Testing validate_user function in User_model.php";
    $notes = "input : not valid password \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //27 - User_model method validate_user
    $test = $this->User_model->validate_user('admin', 'admin123');
    $expected_result = true;
    $test_name = "Testing validate_user function in User_model.php";
    $notes = "input : valid username and password \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_get_names()
  {
    //28 - User_model method get_names
    $temp = array();
    $temp['admin'] = 'Admin';
    $temp['usertest1'] = 'usertest1';
    $test = $this->User_model->get_names();
    $expected_result = $temp;
    $test_name = "Testing get_names function in User_model.php";
    $notes = "input : valid names \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

  }

  private function testing_method_get_user()
  {
    //29 - User_model method get_user
    $test = $this->User_model->get_user(0);
    $expected_result = false;
    $test_name = "Testing get_user function in User_model.php";
    $notes = "input : not valid id \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //30 - User_model method get_user
    $test = $this->User_model->get_user(1);
    $expected_result = true;
    $test_name = "Testing get_user function in User_model.php";
    $notes = "input : valid id \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_get_all_users()
  {
    //31 - User_model method get_all_users
    $temp = $this->db->order_by('role', 'asc')->order_by('id')->get('users')->result_array();
    $test = $this->User_model->get_all_users();
    $expected_result = $temp;
    $test_name = "Testing get_all_users function in User_model.php";
    $notes = "input : - \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_delete_submissions()
  {
    //32 - User_model method delete_submissions
    $test = $this->User_model->delete_submissions(0);
    $expected_result = false;
    $test_name = "Testing delete_submissions function in User_model.php";
    $notes = "input : not valid id \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //33 - User_model method delete_submissions
    $test = $this->User_model->delete_submissions(1);
    $expected_result = true;
    $test_name = "Testing delete_submissions function in User_model.php";
    $ntes = "input : valid id \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

  }

  private function testing_method_delete_user()
  {
    //34 - User_model method delete_user
    $test = $this->User_model->delete_user(-1);
    $expected_result = false;
    $test_name = "Testing reset_password function in User_model.php";
    $notes = "input : not valid userId \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    //35 - User_model method delete_user
    $test = $this->User_model->delete_user(2);
    $expected_result = true;
    $test_name = "Testing reset_password function in User_model.php";
    $notes = "input : valid userId \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_update_profile()
  {
    // - User_model method update_profile
    $test = $this->User_model->update_profile(0);
    $expected_result = false;
    $test_name = "Testing update_profile function in User_model.php";
    $notes = "input : not valid userId \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    // - User_model method update_profile
    $test = $this->User_model->update_profile(1);
    $expected_result = null;
    $test_name = "Testing update_profile function in User_model.php";
    $notes = "input : valid userId \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_passchange_is_valid()
  {
    // - User_model method passchange_is_valid
    $test = $this->User_model->passchange_is_valid(-1);
    $expected_result = 'Invalid password reset link.';
    $test_name = "Testing passchange_is_valid function in User_model.php";
    $notes = "input : not valid passChangeKey \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    // - User_model method passchange_is_valid
    $test = $this->User_model->passchange_is_valid(0);
    $expected_result = true;
    $test_name = "Testing passchange_is_valid function in User_model.php";
    $notes = "input : valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    // - User_model method passchange_is_valid
    $test = $this->User_model->passchange_is_valid(false);
    $expected_result = 'The link is expired.';
    $test_name = "Testing passchange_is_valid function in User_model.php";
    $notes = "input : valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }


  private function testing_method_selected_assignment()
  {
    // //34 - User_model method selected_assignment
    // $temp2 = 'nothing';
    // $temp = $this->db->select('selected_assignment')->get_where('users', array('username'=>$temp2));
    // $test = $this->User_model->selected_assignment($temp2);
    // $expected_result = $temp;
    // $test_name = "Testing validate_user function in User_model.php || input : not valid username \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    // $this->unit->run($test, $expected_result, $test_name, $notes);

    // //35 - User_model method selected_assignment
    // $temp2 = 'admin';
    // $temp = $this->db->select('selected_assignment')->get_where('users', array('username'=>$temp2));
    // $test = $this->User_model->selected_assignment($temp2);
    // $expected_result = $temp;
    // $test_name = "Testing validate_user function in User_model.php || input : valid username \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    // $this->unit->run($test, $expected_result, $test_name, $notes);

    $test = $this->User_model->selected_assignment('admin');
    $expected_result = 0;
    $test_name = "Testing selected_asssignment function in User_model.php";
    $notes = "input : null \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

  }

  private function testing_method_send_password_reset_mail()
  {
    // - User_model method send_password_reset_mail
    $test = $this->User_model->send_password_reset_mail('asdfasdf');
    $expected_result = null;
    $test_name = "Testing send_password_reset_mail function in User_model.php";
    $notes = "input : not valid email \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    // - User_model method send_password_reset_mail
    $test = $this->User_model->send_password_reset_mail('usertest1@test.com');
    $expected_result = null;
    $test_name = "Testing send_password_reset_mail function in User_model.php";
    $notes = "input : not valid email \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  private function testing_method_reset_password()
  {
    // - User_model method passchange_is_valid
    $test = $this->User_model->reset_password(-1, 'newPass');
    $expected_result = false;
    $test_name = "Testing reset_password function in User_model.php";
    $notes = "input : not valid passChangeKey \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);

    // - User_model method passchange_is_valid
    $test = $this->User_model->reset_password(0, 'newPass');
    $expected_result = true;
    $test_name = "Testing reset_password function in User_model.php";
    $notes = "input : valid passChangeKey \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }

  

  private function testing_method_update_login_time()
  {
    $test = $this->User_model->update_login_time('admin');
    $expected_result = null;
    $test_name = "Testing update_login_time function in User_model.php";
    $notes = "input : valid \nTime ~ Date: " . date('H:i:s ~ Y-m-d');
    $this->unit->run($test, $expected_result, $test_name, $notes);
  }
  // ------------------------------------------------------------------------
}
