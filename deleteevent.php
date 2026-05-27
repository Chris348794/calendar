<?php

require "header.php";

$id = $_GET['id'];
$db->query("DELETE FROM Event where id = :id", ['id' => $id]);

header("Location: /");
exit();