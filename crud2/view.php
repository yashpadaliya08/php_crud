<?php
include 'conn.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Employee List</h2>
        <div id="employeeTable">
    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            fetchEmployees();

            function fetchEmployees(){
                $.ajax({
                    url: "fetch.php",
                    method:"GET",
                    success: function(data){
                        $('#employeeTable').html(data);
                    }
                });
            }
        });

        $(document).ready(function() {
    $(document).on('click' , '.edit-btn' , function(e){
      e.preventDefault();
      const empId = $(this).data('id');

      console.log('Edit clicked, empId:', empId); // ✅ for debugging


      $.ajax({
        url: 'get_employee.php',
        method: 'POST',
        data: { emp_id: empId },
        contentType: 'application/x-www-form-urlencoded', 
        success:function(response) {
        console.log(response);
          if(response.error){
            alert(response.error);
          }else{
               $('#firstName').val(response.emp_fname);
                $('#lastName').val(response.emp_lname);
                $('#email').val(response.emp_email);
                $('#phone').val(response.emp_pno);
                $('#joiningDate').val(response.emp_jdate);
                $('#address').val(response.emp_add);
                $('#designation').val(response.emp_desi);
                $('input[name="gender"][value="' + response.emp_gender + '"]').prop('checked', true);

                // Add or update hidden emp_id field
                if ($('#emp_id').length === 0) {
                $('#empform').append(`<input type="hidden" name="emp_id" id="emp_id" value="${response.emp_id}">`);
                } else {
                $('#emp_id').val(response.emp_id);
                }

                // Change button text to "Update"
                $('button[type="submit"]').text('Update');

                

            
          }
        }
      });
      });
    });

        </script>
        <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-primary mt-3 " onclick="window.location.href='index.php'">Add Employee</button>
    </div>
</body>
</html>