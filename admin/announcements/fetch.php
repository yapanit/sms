<?php
include('../../config/connect.php');

// Reading value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

// Search  need to edit
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " AND (title LIKE :title OR 
           description LIKE :description OR
           created_at LIKE :created_at OR 
           updated_at LIKE :updated_at ) ";

    // need
    $searchArray = array(
        'title' => "%$searchValue%",
        'description' => "%$searchValue%",
        'created_at' => "%$searchValue%",
        'updated_at' => "%$searchValue%"
    );
}

// Total number of records without filtering
$stmt = $connect->prepare("SELECT COUNT(*) AS allcount FROM announcements "); //change table name
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

// Total number of records with filtering
$stmt = $connect->prepare("SELECT COUNT(*) AS allcount FROM announcements WHERE 1 " . $searchQuery); //change table name
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

// Fetch records
$stmt = $connect->prepare("SELECT * FROM announcements WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

// Bind values
foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
    $data[] = array(
        // change depends on column
        "title" => $row['title'],
        "description" => $row['description'],
        "created_at" => $row['created_at'],
        "updated_at" => $row['updated_at'],
        "edit" => '<button type="button" name="update" id="' . $row["id"] . '" class="btn btn-warning btn-sm update">Update</button>',
        "delete" => '<button type="button" name="delete" id="' . $row["id"] . '" class="btn btn-danger btn-sm delete">Delete</button>',
    );
}

// Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
