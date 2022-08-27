<?php
include_once '../db_conn.php';
$manager_id = $_GET['id'];
$sql = "DELETE FROM manager WHERE manager_id = '$manager_id'";

if (mysqli_query($conn, $sql)) {
    echo "Driver has been removed";
    set_time_limit(5);
    header("location: ../list-managers.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
