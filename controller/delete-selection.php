<?php
include_once '../db_conn.php';
$customer_id = $_GET['cid'];
$product_id = $_GET['pid'];
$sql = "DELETE FROM selection WHERE customer_id = '$customer_id' AND product_id = '$product_id'";

if (mysqli_query($conn, $sql)) {
    echo "Driver has been removed";
    set_time_limit(5);
    header("location: ../create-bill-2.php?customerId=" . $customer_id);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
