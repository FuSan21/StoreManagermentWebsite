<?php
include_once '../db_conn.php';
$code = $_GET['id'];

$Name     = $_POST['Name'];
$Email     = $_POST['Email'];
$Password      = $_POST['Password'];

// edit data to database

$sql = "UPDATE Manager SET name = '" . $Name . "', email= '" . $Email . "', password= '" . $Password . "' WHERE manager_id = '" . $code . "'";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    set_time_limit(5);
    header("location: ../list-managers.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
