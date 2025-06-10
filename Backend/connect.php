<?php
$host = "localhost:3307";
$user = "root";
$password = "Akash@12345";
$db = "job_finding";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
