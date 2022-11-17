<!DOCTYPE html>
<html lang="en">
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
<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && $_SESSION['user_role']){
?>
<body>
    <?php 
        $test = explode("/",$_SERVER['PHP_SELF']);
        if($test[2] == "home.php"){
            $home = "active";
        }else {
            $home = "";
        }
        if($test[2] == "add_student.php"){
            $add = "active";
        }else {
            $add = "";
        }
        if($test[2] == "update_student.php"){
            $update = "active";
        }else {
            $update = "";
        }
        if($test[2] == "delete_student.php"){
            $delete = "active";
        }else {
            $delete = "";
        }
        if($test[2] == "index.php"){
            $hide = "style='display:none;'";
        }else {
            $hide = "";
        }
        if($test[2] == "add_user.php"){
            $add_user = "active";
        }else {
            $add_user = "";
        }
    ?>
    <div class="container" <?php echo $hide; ?>>
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo $home; ?>" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $add; ?>" href="./add_student.php">Add</a>
                </li>
                <?php
                    if($_SESSION['user_role'] == 1){
                        $space = "style='margin: 0 0 0 550px'";
                ?>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo $update; ?>" href="./update_student.php">Update</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $delete; ?>" href="./delete_student.php">Delete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $add_user; ?>" href="./add_user.php">Add User</a>
                        </li>
                <?php
                    }else {
                        $space = "style='margin: 0 0 0 800px'";
                    }
                ?>
                        <li class="nav-item">
                            <p class="nav-link active" <?php echo $space; ?>>Hello <?php echo $_SESSION['user_name']; ?></p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">Logout</a>
                        </li>
            </ul>
        </nav>
    </div>
<?php
    }else {
        header("location: ./index.php");
    }
?>
