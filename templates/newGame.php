<?php
/**
 * Created by PhpStorm.
 * User: Yannick
 * Date: 09.05.2016
 * Time: 11:30
 */

require_once '../config.php';

// initialize variables
$template_data = array();

// handle login
if (isset($_REQUEST['add_user'])) {
    Session::create_user($_REQUEST['username'], $_REQUEST['password']);
} else if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    if (!Session::check_credentials($_REQUEST['username'], $_REQUEST['password'])) {
        $template_data['message'] = 'Login failed!';
    }
}


if (isset($_REQUEST['logout'])) {
    Session::logout();
}

if (Session::authenticated()) {
    /** $template_data['albums'] = Album::getAll();
    Template::render('list', $template_data); **/
} else {
    $template_data['title'] = 'Login';
    Template::render('login', $template_data);
}