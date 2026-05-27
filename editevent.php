<?php

require "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $moment = DateTime::createFromFormat('Y-m-d', "$year-$month-$day")->format('Y-m-d H:i:s');
    $description = $_POST['description'];

    $id = $_GET['id'];
    $repeats = $_GET['repeats'];
    if ($repeats == "true") {
        $repeatDuration = $_POST['repeatDuration'];
        $repeatType = $_POST['repeatType'];
        if($repeatType == "week") {
            $repeatType = "day";
            $repeatDuration = $repeatDuration * 7;
        }
    }
    else {
        $repeatDuration = 0;
        $repeatType = NULL;
    }

    $isDeadline = (int)($_POST['isDeadline'] == "d");

    $db->query("UPDATE Event 
            SET name = :name, 
                moment = :moment, 
                repeatType = :repeatType, 
                repeatDuration = :repeatDuration, 
                isDeadline = :isDeadline, 
                completed = :completed, 
                description = :description 
            WHERE id = :id",
    [
        'id' => $id,
        'name' => $name,
        'moment' => $moment,
        'repeatType' => $repeatType,
        'repeatDuration' => $repeatDuration,
        'isDeadline' => $isDeadline,
        'completed' => 0,
        'description' => $description
    ]);
}

header("Location: /");
exit();