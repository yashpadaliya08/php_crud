<?php
 include 'conn.php';

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FIRST jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
    <div class="container mt-5">
      <h2 class="mb-4">Employee Registration Form</h2>

      <?php 

$edit_mode = false;
$emp_data = [];

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];
    $result = $conn->query("SELECT * FROM emp WHERE emp_id = '$emp_id'");

    if ($result && $result->num_rows > 0) {
        $emp_data = $result->fetch_assoc();
        $edit_mode = true;
    }
}

      ?>
  <form method="POST" action="" id="empform" >
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
        <input class="form-check-input" type="radio" name="gender" id="radio"  value="male" 
        <?= (isset($emp_data['emp_gender']) && $emp_data['emp_gender'] == 'male') ? 'checked' : '' ?>>
        <label class="form-check-label" for="male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="radio" value="female" 
        <?= (isset($emp_data['emp_gender']) && $emp_data['emp_gender'] == 'female') ? 'checked' : '' ?>>
        <label class="form-check-label" for="female">Female</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="radio" value="other" 
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
    <div class="d-flex justify-content-center gap-2 ">
      <button type="submit" class="btn btn-primary" name="<?= $edit_mode ? 'update' : 'submit' ?>">  <?= $edit_mode ? 'Update' : 'Submit' ?></button>
    </div>
  </form>
  <div class="d-flex justify-content-center gap-2 mt-3 ">
  <button class="btn btn-primary " onclick="window.location.href='/crud2/view.php'">View Employee</button></div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  
    $(document).ready(function(){
        $('#empform').on('submit',function(e){
          e.preventDefault();
          console.log('Form submit clicked');
  
          let fname = $('#firstName').val().trim();
          let lname = $('#lastName').val().trim();
          let email = $('#email').val().trim();
          let phone = $('#phone').val().trim();
  
          if(fname === '' || lname === ''){
            alert('Please fill all the fields');
            return;
          }else if(email === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert("Please enter a valid email address");
            return;
          }else if(!/^\d{10}$/.test(phone)){
            alert("Please enter a valid phone number");
            return;
          }else{
            alert("Form submitted successfully!");
          }

          $.ajax({
      url: 'insert_or_update.php',
      method: 'POST',
      data: $('#empform').serialize(),
      success: function(response) {
        if (response.includes('inserted')) {
          alert("Employee added successfully!");
          $('#empform')[0].reset();
        } else if (response.includes('updated')) {
          alert("Employee updated successfully!");
        } else {
          alert("Something went wrong!");
        }
      }
    });


   
    });
        });
    </script>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
