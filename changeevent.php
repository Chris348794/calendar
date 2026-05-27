<?php

require "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    echo "Name: " . $name;

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $moment = DateTime::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d H:i:s');
    echo "Moment: " . $moment;

    $repeats = $_GET['repeats'];
    if ($repeats == "true") {
        echo "CHECKING REPEAT DURATION";
        $repeatDuration = $_POST['repeatDuration'];
        $repeatType = $_POST['repeatType'];
        if($repeatType == "week") {
            $repeatType = "day";
            $repeatDuration = $repeatDuration * 7;
        }
    }
    else {
        echo "DOESN'T REPEAT";
        $repeatDuration = 0;
        $repeatType = NULL;
    }
    echo " repeats: " . $repeats;
    echo " repeatDuration: " . $repeatDuration;
    echo " repeatType: " . $repeatType;

    $isDeadline = (int)($_POST['isDeadline'] == "d");
    echo $_POST['isDeadline'];

    echo " isdeadline: " . $isDeadline;

    $db->query("INSERT INTO Event (name, moment, repeatType, repeatDuration, isDeadline, completed)
                VALUES (:name, :moment, :repeatType, :repeatDuration, :isDeadline, :completed)",
    [
        'name' => $name,
        'moment' => $moment,
        'repeatType' => $repeatType,
        'repeatDuration' => $repeatDuration,
        'isDeadline' => $isDeadline,
        'completed' => 0
    ]);
}

header("Location: /");
exit();