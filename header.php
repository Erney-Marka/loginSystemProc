<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        <a class="nav-link" href="discover.php">About Us</a>
                        <a class="nav-link" href="blog.php">Find Blogs</a>
                        <?php 
                        if (isset($_SESSION['useruid'])) {
                            echo '<a class="nav-link" href="profile.php">Profile Page</a>';
                            echo '<a class="nav-link" href="includes/logout.inc.php">Log Out</a>';
                        } else {
                            echo '<a class="nav-link" href="signup.php">Sign Up</a>';
                            echo '<a class="nav-link" href="login.php">Log In</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>