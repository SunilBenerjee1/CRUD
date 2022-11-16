<?php
    session_start();
    if($_SESSION['user_role'] == 1){
?>
    <?php include 'header.php'; ?>
    <div class="container">
        <form  style="margin: 20px 0;" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group">
                <label for="enrolment_number">Enrolment Number</label>
                <input type="text" class="form-control" id="enrolment_number" name="enrolment_number" aria-describedby="emailHelp" placeholder="Enter enrolment number" autocomplete="off" required>
            </div>
            <button type="submit" name="fetch" class="btn btn-primary">Show Details</button>
        </form>
    </div>
<?php 
    if(isset($_POST['fetch'])){
        include 'config.php';
        $enrolnment = mysqli_real_escape_string($conn, $_POST['enrolment_number']);
        $query = "SELECT students_details.student_id, students_details.enrolment_number, students_details.student_name, students_details.student_course, students_details.student_email, students_details.student_address, course_details.course_title, course_details.course_id FROM students_details INNER JOIN course_details ON students_details.student_course=course_details.course_id WHERE `enrolment_number`=$enrolnment";
        $result = mysqli_query($conn, $query) or die("Query Failed");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
?>
                <div class="container">
                    <h2 class="text-danger text-center">Update Student Record</h2>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="enrolment_number">Enrolment Number:</label>
                            <input type="text" class="form-control" id="enrolment_number" placeholder="Enter enlonment number" name="enrolnment_number" disabled value="<?php echo $row['enrolment_number']; ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="student_name">Name:</label>
                            <input type="text" class="form-control" id="student_name" placeholder="Enter student name" name="student_name" value="<?php echo $row['student_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="student_course">Select Course:</label>
                            <select class="form-control" name="student_course" id="student_course">
                                <option value="<?php echo $row['course_id']; ?>" selected disabled><?php echo $row['course_title']; ?></option>
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
                            <input type="email" class="form-control" id="email" placeholder="Enter student email" name="student_email" value="<?php echo $row['student_email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="student_address">Address:</label>
                            <input type="text" class="form-control" id="student_addresss" placeholder="Enter student address" name="student_address" value="<?php echo $row['student_address']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="save" style="padding: 12px 36px; margin-bottom: 20px;">Save</button>
                    </form>
                </div>
<?php                
            }
        }else {
            echo '<div class="container"><div class="alert alert-danger" role="alert">
                No Record Found!
            </div></div>';
        }
    }
    if(isset($_POST['save'])){
        include 'config.php';
        $student_id = $_POST['student_id'];
        $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
        $student_course = mysqli_real_escape_string($conn, $_POST['student_course']);
        $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
        $student_address = mysqli_real_escape_string($conn, $_POST['student_address']);
        $query = "UPDATE students_details SET `student_name`='{$student_name}', `student_course`={$student_course}, `student_email`='{$student_email}', `student_address`='{$student_address}' WHERE `student_id`={$student_id}";
        if(mysqli_query($conn, $query)){
            echo '<div class="container"><div class="alert alert-success" role="alert">
                Student Record Updated!
            </div></div>';
        }else {
            echo '<div class="container"><div class="alert alert-danger" role="alert">
                Student Record Not Updated!
            </div></div>';
        }
    }
    include 'footer.php'; 
    }else {
        header("location: ./home.php");
    }
?>