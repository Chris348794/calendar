<?php
require "header.php";

$id = $_GET['id'];
$query = "select * from Event where id = :id LIMIT 1";
$event = $db->query($query, ['id' => $id])[0];
$repeats = ($event['repeatType'] != null);
$name = $event['name'];

$reType = null;
$reDuration = null;
if($repeats):
    $reType = $event['repeatType'];
    $reDuration = $event['repeatDuration'];
    if($reType == "day" and ($event['repeatDuration'] % 7 == 0)):
        $reType = "week";
        $reDuration = $reDuration / 7;
    endif;
endif;

$date = DateTime::createFromFormat('Y-m-d H:i:s', $event['moment']);
$day   = (int)$date->format('j');
$month = (int)$date->format('n');
$year  = (int)$date->format('Y');

$isDeadline = $event['isDeadline'];

$months = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
];

require "views/edit.php";