<?php

require("database.php");

date_default_timezone_set('Canada/Mountain');

$today = new DateTime('today');
$tomorrow = clone $today;
$tomorrow->modify("+1 days");

$cutoffmonths = 12;



$thisWeek = [$today, $tomorrow];
$offset = 1;
while($offset < 6) {
    $new = clone $thisWeek[$offset];
    $new->modify("+1 days");
    $thisWeek[] = $new;
    $offset++;
}

$nextYears = [(int)$today->format('Y')];
$offset2 = 0;
while($offset2 < 19) {
    $nextYears[] = $nextYears[$offset2] + 1;
    $offset2++;
}


try {
    $db->construct($config);
} catch (Exception $e) { "ERROR: database connection failed"; };

$inTimeframe = function ($eventDate, $timeframe) {
    foreach($timeframe as $date):
        if($eventDate->format('Y-m-d') === $date->format('Y-m-d')) {
            return true;
    }
    endforeach;

    return false;
};

$repeatsToday = function (&$eventDate, $timeframe, $repeatDuration, $repeatType) {
    foreach($timeframe as $date):
        $dateString = $date->format('Y-m-d');
        while($eventDate < $date) {
             $eventDate->modify("+{$repeatDuration} {$repeatType}s")->format('Y-m-d');
        }
        if ($eventDate->format('Y-m-d') == $dateString) return true;
    endforeach;

    return false;
};

$filterEvent = function ($db, $event, $dates, $deadline, $updating) use ($inTimeframe, $repeatsToday){

    $eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $event['moment']);

    if (!($event['isDeadline'] ^ $deadline)) {

        $match = $inTimeframe($eventDate, $dates);

        if(!$match && $event['repeatType'] != NULL) {

            $repeatDuration = $event['repeatDuration'];
            $repeatType = $event['repeatType'];

            $match = $repeatsToday($eventDate, $dates, $repeatDuration, $repeatType);
            
            if($updating) {
                $id = $event['id'];
                $newMoment = $eventDate->format("Y-m-d H:i:s");
                $query = "update Event set moment = :moment where id = {$id}";
                $db->query($query, ['moment' => $newMoment]);
            }
        }
        return ($match);
    }
    else return false;
};

$garbageCollect = function ($db, $events, $today, $cutoffmonths) {
    $cutoff = clone $today;
    $cutoff->modify("-{$cutoffmonths} months");
    $cutoff = $cutoff->format('Y-m-d');
    foreach($events as $event):
        $eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $event['moment']);
        if ($eventDate->format('Y-m-d') < $cutoff) {
            $db->query("DELETE FROM Event where id = :id", ['id' => $event['id']]);
        }
    endforeach;
};

$preserveIncomplete = function ($db, $events, $today){
    foreach ($events as $event):
        $eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $event['moment']);
        if ((!$event['completed']) and ($eventDate->format('Y-m-d') < $today->format('Y-m-d'))) {
            $id = $event['id'];
            $newMoment = $eventDate->format("Y-m-d H:i:s");
            $query = "update Event set moment = :moment where id = {$id}";
            $db->query($query, ['moment' => $today->format("Y-m-d H:i:s")]);
        }
    endforeach;
};

$events = $db->query("select * from Event");