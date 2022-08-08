<?php
session_start();
include '../config/connect.php';

if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header('../index.php');
    exit();
}

$query = "SELECT * FROM users WHERE id='" . $_SESSION['id'] . "'";
$statement = $connect->prepare($query);
$statement->execute();
$row = $statement->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Cavite State University</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav pl-2 pt-4 mr-auto sidenav" id="navAccordion">
                <!--  -->
                <span class="border-bottom text-white pt-2">General</span>
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php"> <i class="fa fa-feed"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="announcements/announcements.php"><i class="fa fa-newspaper-o"></i> Announcements</a>
                </li>
                <!--  -->
                <span class="border-bottom text-white pt-2">Scholarship</span>
                <li class="nav-item">
                    <a class="nav-link" href="applications/applications.php"><i class="fa fa-certificate"></i> Scholarship Applications</a>
                </li>
                <!--  -->
                <span class="border-bottom text-white pt-2">Academic</span>
                <li class="nav-item">
                    <a class="nav-link" href="colleges/colleges.php"><i class="fa fa-graduation-cap"></i> Colleges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courses/courses.php"><i class="fa fa-book"></i> Courses</a>
                </li>
                <!--  -->
                <span class="border-bottom text-white pt-2">Users</span>
                <li class="nav-item">
                    <a class="nav-link" href="students/students.php"><i class="fa fa-users"></i> Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users/users.php"><i class="fa fa-user-circle"></i> Administrator Accounts</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse" data-target="#collapseSubItems2" aria-controls="collapseSubItems2" aria-expanded="false">Item 2</a>
                    <ul class="nav-second-level collapse" id="collapseSubItems2" data-parent="#navAccordion">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-text">Item 2.1</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-text">Item 2.2</span>
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
            <form class="form-inline ml-auto mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <main class="content-wrapper">
        <div class="container">
            <h1>Main Content</h1>
        </div>
    </main>

    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <script src="js/sidebar.js"></script>

</body>

</html>