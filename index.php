<?php
    session_start();
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
        header("location: ./home.php");
    }else {
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
    <div class="container">
        <h2 class="text-white bg-primary text-center" style="padding: 10px;">CRUD Login System</h2>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="user_email">Email:</label>
                <input type="email" class="form-control" id="user_email" placeholder="Enter email address" name="user_email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="user_password">Password:</label>
                <input type="password" class="form-control" id="user_password" placeholder="Enter password" name="user_password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login" style="padding: 12px 36px; margin-bottom: 20px;">Login</button>
        </form>
    </div>
<?php
    if(isset($_POST['login'])){
        include 'config.php';
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $encrypted_password = sha1($user_password);
        $query = "SELECT login_details.user_id, login_details.user_name, login_details.user_role FROM login_details WHERE `user_email`='{$user_email}' AND `user_password`='{$encrypted_password}'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $response = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $response['user_id'];
            $_SESSION['user_name'] = $response['user_name'];
            $_SESSION['user_role'] = $response['user_role'];
            header("location: ./home.php");
        }else {
            echo '<div class="container"><div class="alert alert-danger" role="alert">
                Please Check, Your Username or Password are Mismatched!
            </div></div>';
        }
    }
        include 'footer.php';      
    }
?>