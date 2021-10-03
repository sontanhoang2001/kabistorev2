<?php
// get CountFile
// open
$CountFile = "index.log";
$CF = fopen($CountFile, "r");
$Views = fread($CF, filesize($CountFile));
fclose($CF);
$Views++;

// write
$CF = fopen($CountFile, "w");
fwrite($CF, $Views);
fclose($CF);
$response = array();
$array_Views = str_split($Views);
$count_arrView = count($array_Views);
$row_array['count_arrView'] = $count_arrView;
$row_array['row_array'] = $array_Views;
array_push($response,$row_array);
echo json_encode($response);



