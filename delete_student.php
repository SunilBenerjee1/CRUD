<?php
    session_start();
    if($_SESSION['user_role'] == 1){
?>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2 class="text-danger text-center">Delete Student Record</h2>
        <form  style="margin: 20px 0;" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group">
                <label for="enrolment_number">Enrolment Number</label>
                <input type="text" class="form-control" id="enrolment_number" name="enrolment_number" aria-describedby="emailHelp" placeholder="Enter enrolment number" autocomplete="off" required>
            </div>
            <button type="submit" name="delete" class="btn btn-primary">Delete Record</button>
        </form>
    </div>
<?php
    if(isset($_POST['delete'])){
        include 'config.php';
        $enrolment_number = mysqli_real_escape_string($conn, $_POST['enrolment_number']);
        $sql = "SELECT student_id FROM students_details WHERE `enrolment_number`={$enrolment_number}";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $query = "DELETE FROM students_details WHERE `enrolment_number`=$enrolment_number";
            if(mysqli_query($conn, $query)){
                echo '<div class="container"><div class="alert alert-danger" role="alert">
                    Record Deleted Successfully!
                </div></div>';
            }
        }else {
            echo '<div class="container"><div class="alert alert-info" role="alert">
                Please Provide an Valid Enrolment Number!
            </div></div>';
        }
    }
    include 'footer.php';  
    }else {
        header("location: ./home.php");
    }
?>