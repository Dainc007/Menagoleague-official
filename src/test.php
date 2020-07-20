<?php

require_once"connect.php";

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE teams SET money=money-pensjazespolu";
$result = $conn->query($sql);

$sql2 = "UPDATE teams SET pensje=pensje+pensjazespolu";
$result2 = $conn->query($sql2);

$conn->close();
?>

