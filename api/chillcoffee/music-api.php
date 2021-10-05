<?php
header("Content-Type:application/json");
include '../lib/session.php';
Session::init();
include '../lib/database.php';
include '../helpers/format.php';
include '../helpers/helpers.php';
include '../classes/musiccoffee.php';

$db = new Database();
$fm = new Format();
$music = new musiccoffee();

$db = new Database();
$fm = new Format();
$music = new musiccoffee();

// get music on db
$get_all_music = $music->getMusic();

$response = array();

if ($get_all_music) {
    while ($result = $get_all_music->fetch_assoc()) {
        $row_array['trackName'] = $result['trackName'];
        $row_array['albumArtwork'] =  $result['albumArtwork'];
        $row_array['trackUrl'] =   $result['trackUrl'];
        array_push($response,$row_array);
    }
    echo json_encode($response);
} else {
    echo "0 results";
}