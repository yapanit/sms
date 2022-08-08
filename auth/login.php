<?php
include('../config/connect.php');
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "';";
    $statement = $connect->prepare($query);
    $statement->execute();
    $row = $statement->fetch();

    // foreach ($result as $row) {
        if ($row) {
            // If user type is admin
            if ($row['role'] == 'admin') {
                echo ('<script>alert("You are logged in!")</script>');
                $_SESSION['id'] = $row['id'];
                header("location: ../admin/dashboard.php");
            }
            // If user type is student
            elseif ($row['role'] == 'student') {
                echo ('<script>alert("You are logged in!	")</script>');
                $_SESSION['id'] = $row['id'];
                header("location: ../student/dashboard.php");
            }
        } else {
            $message = "Login Failed!";
            header("location: ../index.php?message=" . $message);
        }
    // }
}
