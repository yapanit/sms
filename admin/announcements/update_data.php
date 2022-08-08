<?php
include '../../config/connect.php';

if (isset($_POST["title"])) {
    $error = '';
    $success = '';
    $title = '';
    $description = '';

    // title
    if (empty($_POST["title"])) {
        $error .= '<p>First Name is Required</p>';
    } else {
        $title = $_POST["title"];
    }
    // description
    if (empty($_POST["description"])) {
        $error .= '<p>Last Name is Required</p>';
    } else {
        $description = $_POST["description"];
    }
    // date now
    $date_now = date("Y-m-d h:i:sa");

    if ($error == '') {
        $data = array(
            ':title' => $title,
            ':description' => $description,
            ':date_now' => $date_now,
            ':id' => $_POST['id'],
        );


        $query = " UPDATE announcements SET 
            title = :title, 
            description = :description,
            updated_at = :date_now 
            WHERE id = :id";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $success = 'Post Updated';
    }
    $output = array(
        'success'  => $success,
        'error'   => $error
    );
    echo json_encode($output);
}
