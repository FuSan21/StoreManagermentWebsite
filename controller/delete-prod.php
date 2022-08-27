<?php
include_once '../db_conn.php';
$product_id = $_GET['id'];
$sql = "DELETE FROM product WHERE product_id = '$product_id'";

if (mysqli_query($conn, $sql)) {
    echo "Driver has been removed";
    set_time_limit(5);
    header("location: ../list-product.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
