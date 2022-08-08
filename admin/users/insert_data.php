<?php
include '../../config/connect.php';

if (isset($_POST["fname"])) {
    $error = '';
    $success = '';
    $fname = '';
    $lname = '';
    $email = '';
    $phone_number = '';
    $password = '';

    // fname
    if (empty($_POST["fname"])) {
        $error .= '<p>First Name is Required</p>';
    } else {
        $fname = $_POST["fname"];
    }
    // lname
    if (empty($_POST["lname"])) {
        $error .= '<p>Last Name is Required</p>';
    } else {
        $lname = $_POST["lname"];
    }
    // email
    if (empty($_POST["email"])) {
        $error .= '<p>Email is Required</p>';
    } else {
        $email = $_POST["email"];
    }
    // email
    if (empty($_POST["phone_number"])) {
        $error .= '<p>Phone Number is Required</p>';
    } else {
        $phone_number = $_POST["phone_number"];
    }
    // password
    if (empty($_POST["password"])) {
        $error .= '<p>Password is Required</p>';
    } else {
        $password = $_POST["password"];
    }

    if ($error == '') {
        $data = array(
            ':fname'   => $fname,
            ':lname'  => $lname,
            ':email'  => $email,
            ':phone_number' => $phone_number,
            ':password'   => $password,
        );

        $query = "INSERT INTO users (fname, lname, email, phone_number, password) VALUES (:fname, :lname, :email, :phone_number, :password)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $success = 'User Added';
    }
    $output = array(
        'success'  => $success,
        'error'   => $error
    );
    echo json_encode($output);
}
