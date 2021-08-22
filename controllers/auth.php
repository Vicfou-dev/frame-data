<?php
require_once "../tools/database.php";

function get_user($data) {

    $column = is_int($data) ? 'id' : 'username';

    $sql   = "SELECT * FROM user WHERE $column=:data LIMIT 1";
    $param = array(":data" => $data);
    
    $data = sql_binding($sql, $param);
    $user = $data->fetchOne();

    return $user;
}

function is_authenticate() {
    if ( isset($_SESSION['user']) == false || isset($_SESSION['username'])  == false || isset($_SESSION['password'])  == false) {
        return false;
    }

    $user = get_user($_SESSION['username']);
    
    if(empty($user) == true) {
        return false;
    }

    $password = $user['password'];
    if(password_verify($_SESSION['password'], $password) == false) {
        return false;
    }

    return true;
}

function authenticate($username, $password) {

    $user = get_user($username);
    
    $user['password'] = $password;

    $_SESSION['user'] = $user;
}