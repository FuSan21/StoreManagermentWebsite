<?php
include_once '../db_conn.php';
$customer_id = $_GET['id'];
$sql = "DELETE FROM customer WHERE customer_id = '$customer_id'";

if (mysqli_query($conn, $sql)) {
    echo "Driver has been removed";
    set_time_limit(5);
    header("location: ../list-customers.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
