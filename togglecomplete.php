<?php

require "header.php";

$id = $_GET['id'];
$completed = $db->query("select completed from Event where id = :id", ['id' => $id])[0]['completed'];
$completed = (int)!$completed;
$db->query("update Event set completed = {$completed} where id = :id", ['id' => $id]);
header("Location: /");
exit();