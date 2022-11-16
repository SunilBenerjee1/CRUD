<?php
    session_start();
    if($_SESSION['user_role'] == 1){
        include 'header.php'; ?>
        <div class="container">
            <h2 class="text-danger text-center">Add User</h2>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="user_name">User Name:</label>
                        <input type="text" class="form-control" id="user_name" placeholder="Enter user name" name="user_name" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email:</label>
                        <input type="email" class="form-control" id="user_email" placeholder="Enter user email" name="user_email" required>
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password:</label>
                        <input type="password" class="form-control" id="user_password" placeholder="Enter user password" name="user_password">
                    </div>
                    <div class="form-group">
                        <label for="user_role">User Role:</label>
                        <select class="form-control" name="user_role" id="user_role">
                            <option selected disabled>Select</option>
                            <option value="1">Admin</option>
                            <option value="2">Normal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save" style="padding: 12px 36px; margin-bottom: 20px;">Add User</button>
            </form>
        </div>
    <?php
        if(isset($_POST['save'])){
            include 'config.php';
            $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
            $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
            $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
            $encrypted_password = sha1($user_password);
            $user_role = mysqli_real_escape_string($conn, $_POST['user_role']);
            $query = "INSERT INTO login_details (`user_name`, `user_email`, `user_password`, `user_role`) VALUES ('{$user_name}', '{$user_email}', '{$encrypted_password}', {$user_role})";
            if(mysqli_query($conn, $query)){
                echo '<div class="container"><div class="alert alert-success" role="alert">
                    Add user Successfully
                </div></div>';
            }else {
                echo '<div class="container"><div class="alert alert-danger" role="alert">
                    Something Happens Wrong!
                </div></div>';
            }
        }
        include 'footer.php' ;
    }else {
        header("location: ./home.php");
    }
?>