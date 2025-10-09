<?php
require_once "../../connection/dbcon.php";
header('Content-Type: application/json');

try {
$sql = "SELECT 
                c.company_name, 
                c.contact_person,
                c.contact_mobile,
                c.address, 
                a.email, 
                c.industry, 
                a.b_status AS status
            FROM employer_company_info AS c
            INNER JOIN employer_account AS a 
                ON c.employer_id = a.employer_id";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("SQL error: " . $conn->error);
    }

    $pending = [];
    $verified = [];
    $revoked = [];

     while ($row = $result->fetch_assoc()) {
        switch (strtolower($row['status'])) {
            case 'pending':
                $pending[] = $row;
                break;

            case 'verify':
            case 'verified':
                $verified[] = $row;
                break;

            case 'revoke':
            case 'revoked':
                $revoked[] = $row;
                break;
        }
    }

    echo json_encode([
        "success" => true,
        "pending" => $pending,
        "verified" => $verified,
        "revoked" => $revoked
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

