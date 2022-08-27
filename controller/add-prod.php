<?php
include_once '../db_conn.php';

$price     = $_POST['price'];
$name     = $_POST['name'];
$image      = $_POST['image'];
$brand      = $_POST['brand'];
$category      = $_POST['category'];
$manage      = $_POST['manage'];


$sql = "INSERT INTO  Product (price,name,image,brand,category,manage) VALUES ('$price', '$name', '$image', '$brand', '$category','$manage')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    set_time_limit(5);
    header("location: ../list-product.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
