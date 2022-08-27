<?php
include_once '../db_conn.php';

$Name = $_POST['Name'];
$Address = $_POST['Address'];
$Phone1 = $_POST['Phone1'];
$Phone2 = $_POST['Phone2'];
$sellerId = $_POST['sellerId'];

$query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'storemanagementdb' AND TABLE_NAME = 'customer'";
$result = mysqli_query($conn, $query)->fetch_row();
$curr_index = $result[0];


$sql = "INSERT INTO  customer (customer_id,name,address, seller_id) VALUES ($curr_index, '$Name', '$Address', $sellerId)";
$sql2 = "INSERT INTO customer_phonenumbers (customer_id, phone_numbers) VALUES ($curr_index, $Phone1)";
$sql3 = "INSERT INTO customer_phonenumbers (customer_id, phone_numbers) VALUES ($curr_index, $Phone2)";


if (mysqli_query($conn, $sql)) {
    if (isset($Phone1)) {
        mysqli_query($conn, $sql2);
    }
    if (isset($Phone2)) {
        mysqli_query($conn, $sql3);
    }
    echo "New record created successfully";
    set_time_limit(5);
    header("location: ../list-customers.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
