<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/Db.php';
include_once '../object/gamers.php';

// instantiate database and gamers object
$database = new Db();
$db = $database->getConnection();

// initialize object
$gamers = new gamers($db);

// query gamers
$stmt = $gamers->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // gamers array
    $gamers_arr = array();
    $gamers_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $gamers_item = array(
            "id" => $row['id'],
            "nickname" => $row['nickname'],
            "age" => $row['age'],
            "level" => $row['level']
        );
        array_push($gamers_arr["records"], $gamers_item);
    }
    echo json_encode($gamers_arr);
} else {
    echo json_encode(
            array("message" => "No gamers found.")
    );
}
