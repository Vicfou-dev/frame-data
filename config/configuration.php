<?php
require_once 'config.inc.php';

if (session_id() == false) {
    session_start();
} 

if(isset($database) == false) {

    $database = new PDO('mysql:host='. SERVERBD .';dbname='. NOMBD, LOGINBD, PASSBD);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

}

if(defined(PATH_REQUEST) == false) {
    $path = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1);

    $search = 'www';
    $offset = strlen($search) + 1;

    $to_erase = substr(__DIR__, strpos(__DIR__, $search) + $offset);
    $to_erase = str_replace('\\', '/', $to_erase);
    $offset = strlen($to_erase) + 1;

    $final_path = substr($path, strpos($path, $to_erase) + $offset);

    define('PATH_REQUEST', $final_path);
}
