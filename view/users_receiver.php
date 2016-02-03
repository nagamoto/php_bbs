<?php
require_once __DIR__ . '/../class/user.php';
$action = $_SERVER['REQUEST_METHOD'];
if(filter_input( INPUT_POST, 'sign_in' )){
    $action = 'sign_in';
}
if(filter_input( INPUT_POST, 'sign_out' )){
    $action = 'sign_out';
}
$user = new User();
$name = filter_input(INPUT_POST, "user_name" );
$pass = filter_input(INPUT_POST, "user_pass");

switch ($action){
    case 'POST'://new user
        $user->isAuthenticate($name, $pass);
        session_start();
        session_regenerate_id(TRUE);
        $_SESSION["user_name"] = $name;
        $_COOKIE["user_name"] = $name;
        header("Location: /bbs/");
        exit;
    case 'sign_in':
        If ($user->signIn($name, $pass) == "true"){
            session_start();
            session_regenerate_id(TRUE);
            $_SESSION["user_name"] = $name;
            $_COOKIE["user_name"] = $name;
        }
        print $_SESSION["user_name"];
//        header("Location: /bbs/");
        exit;
    case 'sign_out':
        print "debug signout";
        $_SESSION = array();
        $_COOKIE["user_name"] = null;
        $_COOKIE["PHPSESSID"] = null;
        session_destroy();
        header("Location: /bbs/");
        exit;
}
