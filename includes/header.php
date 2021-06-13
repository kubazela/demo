<?php
require 'config/config.php';

if (isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}else{
    header("Location: register.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="Cs">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>KnirBook</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">KnirBook</a>
        </div>
        <nav>
            <a href="#"><?php echo $user['first_name']?></a>
            <a href="#"><i class="fa fa-envelope fa-lg"></i></a>
            <a href="index.php"><i class="fa fa-home fa-lg"></i></a>
            <a href="#"><i class="fa fa-bell-o fa-lg"></i></a>
            <a href="#"><i class="fa fa-users fa-lg"></i></a>
            <a href="#"><i class="fa fa-cog fa-lg"></i></a>
            <a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-lg"></i></a>

        </nav>
    </div>

    <div class="wrapper">