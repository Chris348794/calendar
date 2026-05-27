<?php

require "header.php";

$garbageCollect($db, $events, $today, $cutoffmonths);
$preserveIncomplete($db, $events, $today);

$eventsToday = array_filter($events, fn($event) => $filterEvent($db, $event, [$today], false, true));
$deadlinesToday = array_filter($events, fn($event) => $filterEvent($db, $event, [$today], true, true));

$eventsTomorrow = array_filter($events, fn($event) => $filterEvent($db, $event, [$tomorrow], false, false));
$deadlinesThisWeek = array_filter($events, fn($event) => $filterEvent($db, $event, $thisWeek, true, false));

$others = array_filter($events, fn($event) => !$filterEvent($db, $event, [$today], false, true));
$others = array_filter($others, fn($event) => !$filterEvent($db, $event, [$tomorrow], false, false));
$others = array_filter($others, fn($event) => !$filterEvent($db, $event, $thisWeek, true, false));

$columns = [[$deadlinesThisWeek, "Deadlines This Week"],
[$eventsToday, "Events Today"], 
            [$eventsTomorrow, "Events Tomorrow"],
            [$others, "Others"]
];

require "views/index.php";