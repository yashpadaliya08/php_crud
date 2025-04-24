<?php
include 'conn.php';

$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$email = trim($_POST['email']);
$phno = $_POST['phone'];
$gender = $_POST['gender'];
$jon = $_POST['joi'];
$address = $_POST['addr'];
$desig = $_POST['desig'];

if (!empty($_POST['emp_id'])) {
    // UPDATE logic
    $emp_id = $_POST['emp_id'];
    $update = "UPDATE emp SET 
      emp_fname = '$fname',
      emp_lname = '$lname',
      emp_email = '$email',
      emp_pno = '$phno',
      emp_gender = '$gender',
      emp_jdate = '$jon',
      emp_add = '$address',
      emp_desi = '$desig'
      WHERE emp_id = '$emp_id'";

    if ($conn->query($update)) {
        echo "updated";
    } else {
        echo "error";
    }

} else {
    // INSERT logic
    $insert = "INSERT INTO emp (emp_fname, emp_lname, emp_email, emp_pno, emp_gender, emp_jdate, emp_add, emp_desi)
               VALUES ('$fname','$lname','$email','$phno','$gender','$jon','$address','$desig')";

    if ($conn->query($insert)) {
        echo "inserted";
    } else {
        echo "error";
    }
}
?>
