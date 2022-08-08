<?php
session_start();
include '../../config/connect.php';

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
    <link rel="stylesheet" href="../css/style.css">

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
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php"> <i class="fa fa-feed"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../announcements/announcements.php"><i class="fa fa-newspaper-o"></i> Announcements</a>
                </li>
                <!--  -->
                <span class="border-bottom text-white pt-2">Scholarship</span>
                <li class="nav-item">
                    <a class="nav-link" href="../applications/applications.php"><i class="fa fa-certificate"></i> Scholarship Applications</a>
                </li>
                <!--  -->
                <span class="border-bottom text-white pt-2">Academic</span>
                <li class="nav-item">
                    <a class="nav-link" href="../colleges/colleges.php"><i class="fa fa-graduation-cap"></i> Colleges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../courses/courses.php"><i class="fa fa-book"></i> Courses</a>
                </li>
                <!--  -->
                <span class="border-bottom text-white pt-2">Users</span>
                <li class="nav-item">
                    <a class="nav-link" href="../students/students.php"><i class="fa fa-users"></i> Students</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="users.php"><i class="fa fa-user-circle"></i> Administrator Accounts</a>
                </li>
            </ul>
            <form class="form-inline ml-auto mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <main class="content-wrapper">
        <!-- Page content-->
        <div class="container my-4">
            <div class="panel panel-default">
                <div class="panel-heading my-1">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="panel-title">Users</h3>
                        </div>
                        <div class="col-md-6" align="right">
                            <button type="button" name="add_data" id="add_data" class="btn btn-success btn-xs">Add</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <span id="form_response"></span>
                        <table id="user_data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Phone Number</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- partial -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js" charset="utf8" type="text/javascript"></script>
    <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/sidebar.js"></script>
    <script type="text/javascript" language="javascript" src="users.js"> </script>

</body>

</html>