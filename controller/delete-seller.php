<?php
include_once '../db_conn.php';
$seller_id = $_GET['id'];
$sql = "DELETE FROM salesman WHERE seller_id = '$seller_id'";

if (mysqli_query($conn, $sql)) {
    echo "Driver has been removed";
    set_time_limit(5);
    header("location: ../list-salesmans.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
