<?php

// get the HTTP method, path and body of the request
$url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$method = $_SERVER['REQUEST_METHOD'];
$parts = explode('&', $_SERVER['QUERY_STRING']);
$request = explode('/', trim($parts[0], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$parts = explode('&', $_SERVER['QUERY_STRING']);
print_r($parts);

//echo $method;
//print_r($_GET);
//print_r($url);

//$entityBody = file_get_contents('php://input');
//print_r($entityBody);

// connect to the mysql database

require_once '../database/connect.php';

$table = "game";

// create SQL based on HTTP method
switch ($method) {
    case 'GET':
        $sql = "select * from `$table`";
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

// die if SQL statement failed
if (!$result) {
    http_response_code(404);
    die(mysqli_error($link));
}

// print results, insert id or affected row count
if ($method == 'GET') {
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
    }

} elseif ($method == 'POST') {
    print_r($input);
    echo mysqli_insert_id($link);
} else {
    echo mysqli_affected_rows($link);
}

// close mysql connection
mysqli_close($link);