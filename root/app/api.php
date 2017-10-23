<?php

// get the HTTP method, path and body of the request
$url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$method = $_SERVER['REQUEST_METHOD'];

//get the first element before / after api.php?
$request = explode('/', $_SERVER['QUERY_STRING']);
//split elements with / to get requestType (send / get)
$parts = explode('&', trim($request[1], '/'));
$input = json_decode(file_get_contents('php://input'), true);

//all or send
$requestType = $request[0];
//print_r($requestType);
//print_r($parts);

//echo $method;
//print_r($_GET);
//print_r($url);

//$entityBody = file_get_contents('php://input');
//print_r($entityBody);

// connect to the mysql database

require_once '../database/connect.php';

$table = "game";
//$table = "tower_defense_statistic";

// create SQL based on HTTP method
switch ($method) {
    case 'GET':
        if ($requestType == "all") {
            $sql = "select * from `$table`";
        }else if ($requestType == "send"){
            $param0 = explode("=", $parts[0]);
            $param1 = explode("=", $parts[1]);
            $param2 = explode("=", $parts[2]);
            $param3 = explode("=", $parts[3]);
//            $set = $
            $sql = "INSERT INTO `$table` (`$param0[0]`,`$param1[0]`,`$param2[0]`,`$param3[0]`) VALUES ($param0[1],$param1[1],$param2[1],$param3[1])";
//            print_r($sql);
        }
        else{
            http_response_code(404);
            die(mysqli_error($link));
        }
        break;
    case 'PUT':
//        $sql = "update `$table` set $set where id=$key"; break;
    case 'POST':
//        $sql = "insert into `$table` set $set"; break;
    case 'DELETE':
//        $sql = "delete `$table` where id=$key"; break;
    case 'UPDATE':

    default:
        http_response_code(404);
        die(mysqli_error($link));
}

// excecute SQL statement
$result = mysqli_query($link, $sql);

// die if SQL statement failed and send reason
if (!$result) {
    http_response_code(404);
    echo '{"status": "failure",
           "reason":"' . mysqli_error($link) .'"
    }';
    die();
}

// print results, insert id or affected row count
$myArray = array();
if ($method == 'GET') {
    if($requestType == "all"){
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }else {
        echo '{"status": "success"}';
    }
} elseif ($method == 'POST') {
    print_r($input);
    echo mysqli_insert_id($link);
} else {
    echo mysqli_affected_rows($link);
}

// close mysql connection
mysqli_close($link);