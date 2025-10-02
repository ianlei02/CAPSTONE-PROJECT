<?php
require "../../connection/dbcon.php";

$applicant_id = intval($_GET['applicant_id']);

if ($applicant_id > 0) {
    $applicant = $conn->query("SELECT * FROM applicant_account WHERE applicant_id = $applicant_id")->fetch_assoc();
    if ($applicant) {
        echo "<p><strong>Name:</strong> " . htmlspecialchars($applicant['f_name'] . ' ' . $applicant['l_name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($applicant['email']) . "</p>";
        echo "<p><strong>Phone:</strong> " . htmlspecialchars($applicant['contact_no']) . "</p>";
        // Add more fields here
    } else {
        echo "<p>Applicant not found.</p>";
    }
}
?>


    
       
      

        