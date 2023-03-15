
<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/Db.php';
include_once '../object/gamers.php';

$database = new Db();
$db = $database->getConnection();

// initialize object
$gamers = new ($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

// set gamers property value
$gamers->nickname = $data->nickname;
$gamers->age = $data->age;
$gamers->level = $data->level;

// create the gamers
if ($gamers->create()) {
    echo '{';
    echo '"message": "gamers was created."';
    echo '}';
}

// if unable to create the gamers, tell the user
else {
    echo '{';
    echo '"message": "Unable to create gamers."';
    echo '}';
}
