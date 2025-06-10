<?php
// Get the latest employee
$emp_res = $conn->query("SELECT * FROM employees ORDER BY id DESC LIMIT 1");
$employee = $emp_res->fetch_assoc();

// Get all companies
$companies = $conn->query("SELECT * FROM companies");

$best_match = null;
$max_score = 0;

while ($company = $companies->fetch_assoc()) {
    $skill_match = 0;
    $qual_match = 0;

    $emp_skills = explode(",", $employee['skills']);
    $job_skills = explode(",", $company['required_skills']);

    $match_count = count(array_intersect(array_map('trim', $emp_skills), array_map('trim', $job_skills)));
    $total_required = count($job_skills);
    if ($total_required > 0) {
        $skill_match = ($match_count / $total_required) * 100;
    }

    $qual_match = strtolower(trim($employee['qualification'])) == strtolower(trim($company['required_qualification'])) ? 100 : 0;

    $score = ($skill_match * 0.7) + ($qual_match * 0.3); // Weighted match

    if ($score > $max_score && $score >= 70) {
        $max_score = $score;
        $best_match = $company;
    }
}

// Display result
if ($best_match) {
    echo "<h3>Matching Job Found at: " . htmlspecialchars($best_match['company_name']) . "</h3>";
    echo "<p>Job Title: " . htmlspecialchars($best_match['job_title']) . "</p>";
    echo "<a href='" . htmlspecialchars($best_match['apply_link']) . "' target='_blank'><button>Apply Now</button></a>";
} else {
    echo "<p>No matching job found.</p>";
}
?>
