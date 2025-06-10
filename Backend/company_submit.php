<?php
include 'connect.php';

$company = $_POST['company_name'];
$title = $_POST['job_title'];
$skills = strtolower($_POST['required_skills']);
$qualification = strtolower($_POST['required_qualification']);
$experience = $_POST['experience_required'];
$location = $_POST['location'];
$apply_link = $_POST['apply_link'];

// Upload job description
$desc_name = $_FILES['job_description']['name'];
$desc_tmp = $_FILES['job_description']['tmp_name'];
$desc_path = $desc_name ? "uploads/" . $desc_name : "";
if ($desc_name) {
    move_uploaded_file($desc_tmp, $desc_path);
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO companies (company_name, job_title, required_skills, required_qualification, experience_required, location, job_description, apply_link)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $company, $title, $skills, $qualification, $experience, $location, $desc_path, $apply_link);
$stmt->execute();
$stmt->close();

echo "Job posted successfully!";
?>
