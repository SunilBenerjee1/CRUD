<?php include 'header.php'; ?>
<div class="container">
  <h2 class="text-danger text-center">Add Student Record</h2>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="enrolment_number">Enrolment Number:</label>
            <input type="text" class="form-control" id="enrolment_number" placeholder="Enter enlonment number" name="enrolnment_number" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="student_name">Name:</label>
            <input type="text" class="form-control" id="student_name" placeholder="Enter student name" name="student_name" required>
        </div>
        <div class="form-group">
            <label for="student_course">Select Course:</label>
            <select class="form-control" name="student_course" id="student_course">
                <option value="0" selected disabled>Select</option>
                <option value="1">BA</option>
                <option value="2">BCOM</option>
                <option value="3">BSC</option>
                <option value="4">BCA</option>
                <option value="5">BAG</option>
                <option value="6">BBA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="student_email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter student email" name="student_email">
        </div>
        <div class="form-group">
            <label for="student_address">Address:</label>
            <input type="text" class="form-control" id="student_addresss" placeholder="Enter student address" name="student_address">
        </div>
        <button type="submit" class="btn btn-primary" name="save" style="padding: 12px 36px; margin-bottom: 20px;">Add Student</button>
  </form>
</div>
<?php 
    if(isset($_POST['save'])){
        include 'config.php';
        $enrolment_number = mysqli_real_escape_string($conn, $_POST['enrolnment_number']);
        $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
        $student_course = mysqli_real_escape_string($conn, $_POST['student_course']);
        $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
        $student_address = mysqli_real_escape_string($conn, $_POST['student_address']);
        $query = "INSERT INTO students_details(`enrolment_number`, `student_name`, `student_course`, `student_email`, `student_address`) VALUES ({$enrolment_number}, '{$student_name}', {$student_course}, '{$student_email}', '{$student_address}')";
        if(mysqli_query($conn, $query)){
            echo '<div class="container"><div class="alert alert-success" role="alert">
                Student Record Inserted!
            </div></div>';
        }else {
            echo '<div class="container"><div class="alert alert-danger" role="alert">
                Student Record Not Inserted!
            </div></div>';
        }
    }
    include 'footer.php'; 
?>
