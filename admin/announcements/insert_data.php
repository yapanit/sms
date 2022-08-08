<?php
include '../../config/connect.php';

if (isset($_POST["title"])) {//need post
    $error = '';
    $success = '';

    // add or change
    $title = '';
    $description = '';
    // $mname = $_POST['mname'];

    // title
    if (empty($_POST["title"])) {
        $error .= '<p>Title is Required</p>';
    } else {
        $title = $_POST["title"];
    }
    // description
    if (empty($_POST["description"])) {
        $error .= '<p>Description is Required</p>';
    } else {
        $description = $_POST["description"];
    }
    // date now
    $date_now = date("Y-m-d h:i:sa");

    if ($error == '') {
        $data = array(
            // add or change
            ':title' => $title,
            ':description' => $description,
            ':date_now' => $date_now,
        );

        // add or change
        $query = "INSERT INTO announcements (title, description, created_at, updated_at) VALUES (:title, :description, :date_now, :date_now)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $success = 'Announcement Created';
    }
    $output = array(
        'success'  => $success,
        'error'   => $error
    );
    echo json_encode($output);
}
