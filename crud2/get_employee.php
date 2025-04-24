<?php
// Show PHP errors for debugging (optional in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Let browser know we're sending JSON
header('Content-Type: application/json');

// Include database connection
include 'conn.php';

// Validate emp_id
if (isset($_POST['emp_id']) && !empty($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];

    // Get employee from DB
    $result = $conn->query("SELECT * FROM emp WHERE emp_id = '$emp_id'");

    if ($result && $result->num_rows > 0) {
        // Send back JSON of the employee record
        echo json_encode($result->fetch_assoc());
    } else {
        // Employee not found
        echo json_encode(['error' => 'No employee found']);
    }
} else {
    // emp_id not sent in POST
    echo json_encode(['error' => 'Missing emp_id']);
}
?>
