<?php
session_start();
include 'connect.php';
$connect = getDBConnection();
$sql = "SELECT AVG(character_winrate + character_play) as resultAvg FROM `characters`";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);
?>