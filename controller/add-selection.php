<?php
include_once '../db_conn.php';

$customer_id = $_GET['cid'];
$product_id = $_GET['pid'];


$sql = "INSERT INTO  selection (`product_id`,`customer_id`) VALUES ('$product_id', '$customer_id')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    set_time_limit(5);
    header("location: ../create-bill-2.php?customerId=" . $customer_id);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
