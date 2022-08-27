<?php
session_start();
include_once '../db_conn.php';

$customerId     = $_GET['customerId'];
$sellerId     = $_SESSION['id'];
$quantity = $_GET;
unset($quantity['customerId']);
$datetime = date('Y-m-d H:i:s');

$query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'storemanagementdb' AND TABLE_NAME = 'bill'";
$result = mysqli_query($conn, $query)->fetch_row();
$curr_index = $result[0];

$sql = "INSERT INTO  bill (bill_id,customer_id, seller_id, date_time) VALUES ('$curr_index', '$customerId', '$sellerId', '$datetime')";
if (mysqli_query($conn, $sql)) {
    foreach ($quantity as $key => $val) {

        $sql3 = "SELECT price FROM `product` WHERE product_id='" . $key . "'";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
            $row3 = $result3->fetch_assoc();
            $price =  $row3["price"];
        }
        $sql2 = "INSERT INTO  bill_products (bill_id, product_id, item_code, price, quantity) VALUES ('$curr_index', '$key', 'asdf', '$price', '$val')";
        mysqli_query($conn, $sql2);
    }
    echo "New record created successfully";

    $sql4 = "DELETE FROM Selection WHERE customer_id='" . $customerId . "';";
    mysqli_query($conn, $sql4);
    set_time_limit(5);
    header("location: ../create-bill.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
