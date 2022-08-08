<?php
include '../../config/connect.php';

if (isset($_POST["id"])) {
    // change table name
    $query = "DELETE FROM announcements WHERE id = '" . $_POST["id"] . "'";
    $statement = $connect->prepare($query);
    $statement->execute();  
}
