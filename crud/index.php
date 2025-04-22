<?php
 include 'conn.php';


 if(isset($_POST['submit'])){
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $email = trim($_POST['email']);

    $phno = $_POST['phone'];
    $gender = $_POST['gender'];
    $jon = $_POST['joi'];
    $address = $_POST['addr'];
    $desig = $_POST['desig'];
    if (empty($fname) || empty($lname) || empty($email)) {
      die("First Name, Last Name, and Email are required fields.");
     }

    $insert = "INSERT INTO `emp`( `emp_fname`, `emp_lname`, `emp_email`, `emp_pno`, `emp_gender`, `emp_jdate`, `emp_add`, `emp_desi`) VALUES ( '$fname','$lname','$email','$phno','$gender','$jon','$address','$desig')";

    if($conn->query($insert) == TRUE){
      echo "New record created successfully";
      header("Location: index.php?success=1");
      exit;
    }else{
      echo "Error" . $conn->connect_error;
    }
 }

 
 
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="index.js"></script>
  </head>
  <body>
    <div class="container mt-5">
      <h2 class="mb-4">Employee Registration Form</h2>
   <?php  
    $edit_mode= false;
      $emp_data = [];
      
      if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['emp_id'])){
        $edit_mode = true;
        $emp_id = mysqli_real_escape_string($conn , $_POST['emp_id']);
      
        $result = $conn->query("SELECT * FROM emp Where emp_id = '$emp_id'");
        if($result && $result->num_rows > 0){
          $emp_data =$result->fetch_assoc();
        }
      }
      ?>
  <form method="POST" action="" >
  <?php if ($edit_mode): ?>
  <input type="hidden" name="emp_id" value="<?= $emp_id ?>">
<?php endif; ?>
    <div class="row mb-3">
      <div class="col">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" placeholder="Enter first name" name="fname" value="<?= $emp_data['emp_fname'] ?? ''?>">
      </div>
      <div class="col">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" placeholder="Enter last name" name="lname" value="<?= $emp_data['emp_lname'] ?? '' ?>">
      </div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $emp_data['emp_email'] ?? '' ?>">
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="phone" value="<?= $emp_data['emp_pno'] ?? '' ?>"> 
    </div>

    <div class="mb-3">
      <label class="form-label d-block">Gender</label>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="male"  value="male" 
        <?= (isset($emp_data['emp_gender']) && $emp_data['emp_gender'] == 'male') ? 'checked' : '' ?>>
        <label class="form-check-label" for="male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="female" value="female" 
        <?= (isset($emp_data['emp_gender']) && $emp_data['emp_gender'] == 'female') ? 'checked' : '' ?>>
        <label class="form-check-label" for="female">Female</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="other" value="other" 
        <?= (isset($emp_data['emp_gender']) && $emp_data['emp_gender'] == 'other') ? 'checked' : '' ?>>
        <label class="form-check-label" for="other">Other</label>
      </div>
    </div>

    <div class="mb-3">
      <label for="joiningDate" class="form-label">Joining Date</label>
      <input type="date" class="form-control" id="joiningDate" name="joi" value="<?= $emp_data['emp_jdate'] ?? '' ?>">
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <textarea class="form-control" id="address" rows="3" placeholder="Enter address" name="addr"><?= $emp_data['emp_add'] ?? '' ?></textarea>

    </div>

    <div class="mb-3">
      <label for="designation" class="form-label">Designation</label>
      <select class="form-select" id="designation" name="desig" >
        <option value="">Select designation</option>
        <option value="QA" <?= (isset($emp_data['emp_desi']) && $emp_data['emp_desi'] == 'QA') ? 'selected' : '' ?>>QA</option>
        <option value="Devloper" <?= (isset($emp_data['emp_desi']) && $emp_data['emp_desi'] == 'Devloper') ? 'selected' : '' ?>>Developer</option>
        <option  value="Designer"<?= (isset($emp_data['emp_desi']) && $emp_data['emp_desi'] == 'Designer') ? 'selected' : '' ?>>Designer</option>
        <option  value="Manager"<?= (isset($emp_data['emp_desi']) && $emp_data['emp_desi'] == 'Manager') ? 'selected' : '' ?>>Manager</option>
        <option value="TeamLead" <?= (isset($emp_data['emp_desi']) && $emp_data['emp_desi'] == 'TeamLead') ? 'selected' : '' ?>>TeamLead</option>
      </select>
    </div>
    
    <button type="submit" class="btn btn-primary" name="<?= $edit_mode ? 'update' : 'submit' ?>">  <?= $edit_mode ? 'Update' : 'Submit' ?></button>
  </form>
<?php    if (isset($_POST['submit'])) {
    // INSERT new employee
}   elseif (isset($_POST['update'])) {
    $emp_id = mysqli_real_escape_string($conn, $_GET['emp_id']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phno = $_POST['phone'];
    $gender = $_POST['gender'];
    $jon = $_POST['joi'];
    $address = $_POST['addr'];
    $desig = $_POST['desig'];

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

    if ($conn->query($update) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
