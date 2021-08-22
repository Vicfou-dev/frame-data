<?php

require_once '../config/configuration.php';
require_once '../config/headers.php';


$method = strtolower($_SERVER['REQUEST_METHOD']);

switch($method) {
    case 'post' : 
    case 'get' :
    case 'update' : 
    case 'delete' :  
        require_once "../routes/$method.php";

        if(isset($result) == false || $result == null) {
            exit("Error in file $method.php forget to set 'result' variable for action : " . PATH_REQUEST);
        }

        break;
    case 'options' : 
        header("HTTP/1.0 200 Authorized");
        break;
    default :
        header("HTTP/1.0 403 Not Authorized");
        break;
}

exit($result);