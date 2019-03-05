<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Leave empty if you pefer just password.
// The password will be authenticated with this orded:
// -- saved password from the database
// -- your prefered authentication method.
$config['shj_authenticate'] = 'radius';
$config['shj_radius']= [
    "server" => "127.0.0.1",
    "secret" => "i-have-no-secret"
];
$config['shj_mail'] = [
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.mailgun.org',
    'smtp_port' => 465,
    'smtp_user' => '',
    'smtp_pass' => '',
    'mailtype'  => 'html',
    'charset'   => 'utf-8'
];