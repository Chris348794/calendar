<?php

require "header.php";

$id = $_GET['id'];

$query = "select * from Event where id = :id LIMIT 1";
$event = $db->query($query, ['id' => $id])[0];

$reType = $event['repeatType'];
$reLength = $event['repeatDuration'];

$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $event['moment']);

$date = $datetime->format('F j, Y');
$month = $datetime->format('F');
$day = $datetime->format('l');

$datestring = $datetime->format('Y-m-d');
$todaystring = $today->format('Y-m-d');
$tomorrowstring = $tomorrow->format('Y-m-d');

$dateMsg = '';
if($datestring == $todaystring) $dateMsg .= "Today ({$date})";
else if($datestring == $tomorrowstring) $dateMsg .= "Tomorrow ({$date})";
else $dateMsg .= "{$date}";

if($reType != NULL) {
    $dateMsg .= ", repeats every ";
    if($reType === 'day' && $reLength % 7 == 0) {
        $reLength = strval($reLength / 7);
        $reType = "week";
    }
    if($reLength != 1) $dateMsg .= strval($reLength) . " ";
    $dateMsg .= strval($reType);
    if($reLength != 1) $dateMsg .= "s";
}

require "views/event.php";