<?php

include 'conn.php';
// if(isset($_POST['submit'])){
//     if(isset($_POST['submit'])){
//         $fname = $_POST['fname'];
//         $lname = $_POST['lname'];
//         $email = $_POST['email'];
//         $phno = $_POST['phone'];
//         $gender = $_POST['gender'];
//         $jon = $_POST['joi'];
//         $address = $_POST['addr'];
//         $desig = $_POST['desig'];
    
//     }
// } ?>




     
    



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
</head>
<body>
<table class="table" >

  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone No</th>
      <th scope="col">Gender</th>
      <th scope="col">Joining Date</th>
      <th scope="col">Address</th>
      <th scope="col">Designation</th>
      <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
<?php
    $sql = "SELECT * FROM emp"; 
            $result = $conn->query($sql);
            if($result->num_rows > 0){
            while($row= $result->fetch_array()){
            ?>
    <tr>
      <td scope="row"><?php echo $row['emp_id']; ?></td>
      <td ><?php echo $row['emp_fname']; ?></td>
      <td ><?php echo $row['emp_lname']; ?></td>
      <td ><?php echo $row['emp_email']; ?></td>
      <td ><?php echo $row['emp_pno']; ?></td>
      <td ><?php echo $row['emp_gender']; ?></td>
      <td ><?php echo $row['emp_jdate']; ?></td>
      <td ><?php echo $row['emp_add']; ?></td>
      <td ><?php echo $row['emp_desi']; ?></td>
      <td>
          <a href="/crud/index.php?emp_id=<?= $row['emp_id'] ?>">Edit</a> /
      <a href="/crud/delete.php?emp_id=<?= $row['emp_id'] ?>">Delete</a>
    </td>
      
    </tr>
 
    <?php
}
}else{
echo "<center><p> No Records</p></center>";
} $conn->close();

?>
  </tbody>
</table>
</body>
</html>