<?php
include 'connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$skills = strtolower($_POST['skills']);
$qualification = strtolower($_POST['qualification']);
$experience = $_POST['experience'];

// Upload resume
$resume_name = $_FILES['resume']['name'];
$resume_tmp = $_FILES['resume']['tmp_name'];
$resume_path = "uploads/" . $resume_name;
move_uploaded_file($resume_tmp, $resume_path);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO employees (name, email, mobile, skills, qualification, experience, resume)
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $mobile, $skills, $qualification, $experience, $resume_path);
$stmt->execute();
$stmt->close();

// Call matching logic
include 'match_logic.php';
?>
