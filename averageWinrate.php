<?php
session_start();
include 'connect.php';
$connect = getDBConnection();
$sql = "SELECT AVG(character_winrate) as winrateAvg FROM `characters`";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);
?>