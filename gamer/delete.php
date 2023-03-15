<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/Db.php';
include_once '../object/gamers.php';

$database = new Db();
$db = $database->getConnection();

// initialize object
$gamers = new gamers($db);

// set ID property of gamers to be deleted
$gamers->id = filter_input(INPUT_GET, 'id');

// delete the gamers
if ($gamers->delete()) {
    echo '{';
    echo '"message": "gamers was deleted."';
    echo '}';
}

// if unable to delete the gamers
else {
    echo '{';
    echo '"message": "Unable to delete gamers."';
    echo '}';
}
