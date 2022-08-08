<?php
session_start();
include('config/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Home</title>
</head>

<body>
    <!-- Form -->
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <form action="auth/login.php" method="post" name="loginform" onsubmit="return validateForm()">
                        <div class="form-outline mb-4">
                            <?php if (isset($_GET['message'])) {
                                echo "<h6>" . $_GET['message'] . "</h6>";
                            } ?>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" id="email" name="email" placeholder="Email" class="form-control form-control-lg" />

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function validateForm() {
            var x = document.forms["loginform"]["email"].value;
            var y = document.forms["loginform"]["password"].value;
            if (x == "" || y == "") {
                window.alert("Username and Password is required!");
                return false;
            }
        }
    </script>
</body>