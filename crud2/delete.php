<?php
include 'conn.php';
if (isset($_GET['emp_id'])) {
    $id = $_GET['emp_id'];
$sql = "DELETE From emp where emp_id= '$id'";

if($conn->query($sql) == TRUE){
    echo " Deleted";
}else{
    echo "Error";
}
}
$conn->close();

?>