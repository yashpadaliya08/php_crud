<?php
include 'conn.php';

$sql ="SELECT * FROM emp";
$result = $conn->query($sql);

$output = '';
if($result->num_rows > 0){
    $output .= '<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Gender</th>
                            <th>Joining Date</th>
                            <th>Address</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

    while($row = $result->fetch_assoc()){
        $output .= '<tr>
                    <td>'.$row['emp_id'].'</td>
                    <td>'.$row['emp_fname'].'</td>
                    <td>'.$row['emp_lname'].'</td>
                    <td>'.$row['emp_email'].'</td>
                    <td>'.$row['emp_pno'].'</td>
                    <td>'.$row['emp_gender'].'</td>
                    <td>'.$row['emp_jdate'].'</td>
                    <td>'.$row['emp_add'].'</td>
                    <td>'.$row['emp_desi'].'</td>
                    <td>
                       <a href="index.php?emp_id='.$row['emp_id'].'">Edit</a>  /
                        <a href="/crud2/delete.php?emp_id='.$row['emp_id'].'">Delete</a> 
                        </td>
                </tr>';

    }
    $output .= '</tbody></table>';
}else{
    $output .= '<p class="text-center">No Records</p>';
}
echo $output;
$conn->close();

?>