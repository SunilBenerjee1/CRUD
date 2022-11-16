<?php include 'header.php' ?>
<div class="container">
    <h2 class="sub-header text-center text-danger">Students Details</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Enrolment Number</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'config.php';
                    $query = "SELECT students_details.student_id, students_details.enrolment_number, students_details.student_name, students_details.student_course, students_details.student_email, students_details.student_address, course_details.course_title, course_details.course_id FROM students_details INNER JOIN course_details ON students_details.student_course=course_details.course_id";
                    $result = mysqli_query($conn, $query) or die("Query Failed");
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                            <tr>
                                <td><?php echo $row['enrolment_number'];  ?></td>
                                <td><?php echo $row['student_name'];  ?></td>
                                <td><?php echo $row['course_title'];  ?></td>
                                <td><?php echo $row['student_email'];  ?></td>
                                <td><?php echo $row['student_address'];  ?></td>
                            </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>