<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
    <!DOCTYPE html>
    <html>
    <?php
    include_once './partials/head.php';
    ?>

    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i></i>
                <a href="manager-home.php" class="logo_name">Store Management</a>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="manager-home.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>

                    </a>
                </li>
                <li>
                    <a href="list-product.php">
                        <i class='bx bx-box'></i>
                        <span class="links_name">List product</span>
                    </a>
                </li>
                <li>
                    <a href="list-order.php" class="active">
                        <i class='bx bx-box'></i>
                        <span class="links_name">List order</span>
                    </a>
                </li>
                <li class="log_out">
                    <a href="logout.php">
                        <i class='bx bx-log-out'></i>
                        <span class="links_name">Log out</span>
                    </a>
                </li>
            </ul>
        </div>


        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class='bx bx-menu sidebarBtn'></i>
                    <span class="dashboard">Dashboard</span>
                    <span class="dashboard">
                        <div class="container">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col-6">

                                </div>
                                <div class="col">
                                    <b>
                                        <h5 style="font-family: 'Kanit', sans-serif;"> { Hello, <?php echo $_SESSION['name']; ?> }</h5>

                                    </b>
                                </div>
                            </div>

                        </div>

                    </span>
                </div>

            </nav>

            <div class="home-content">
                <div class="overview-boxes">

                    <div class="cardMod">
                        <h4>List of Orders </h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bill ID</th>
                                    <th scope="col">Seller ID</th>
                                    <th scope="col">Customer_id</th>
                                    <th scope="col">Date & Time</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once 'db_conn.php';
                                $sql = "SELECT * FROM bill";
                                $i = 1;
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>$i</th>";
                                        echo "<td>" . $row["bill_id"] . "</td>";
                                        echo "<td>" . $row["seller_id"] . "</td>";
                                        echo "<td>" . $row["customer_id"] . "</td>";
                                        echo "<td>" . $row["date_time"] . "</td>";
                                        echo "<td>";
                                        $sql2 = "SELECT product_id FROM bill_products WHERE bill_id='" . $row["bill_id"] . "'";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                $sql3 = "SELECT `name` AS `productname` FROM product WHERE product_id='" . $row2["product_id"] . "'";
                                                $result3 = $conn->query($sql3);
                                                $row3 = $result3->fetch_assoc();
                                                echo $row3["productname"] . "<br>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        $sql2 = "SELECT product_id FROM bill_products WHERE bill_id='" . $row["bill_id"] . "'";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                $sql3 = "SELECT `price` AS `productprice` FROM product WHERE product_id='" . $row2["product_id"] . "'";
                                                $result3 = $conn->query($sql3);
                                                $row3 = $result3->fetch_assoc();
                                                echo $row3["productprice"] . "<br>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        $sql4 = "SELECT product_id FROM bill_products WHERE bill_id='" . $row["bill_id"] . "'";
                                        $result4 = $conn->query($sql4);
                                        if ($result4->num_rows > 0) {
                                            while ($row4 = $result4->fetch_assoc()) {
                                                $sql5 = "SELECT quantity FROM bill_products WHERE bill_id='" . $row["bill_id"] . "' AND product_id='" . $row4["product_id"] . "'";
                                                $result5 = $conn->query($sql5);
                                                $row5 = $result5->fetch_assoc();
                                                echo $row5["quantity"] . "<br>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                let sidebar = document.querySelector(".sidebar");
                let sidebarBtn = document.querySelector(".sidebarBtn");
                sidebarBtn.onclick = function() {
                    sidebar.classList.toggle("active");
                    if (sidebar.classList.contains("active")) {
                        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                    } else
                        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
                }
            </script>




    </body>

    </html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>