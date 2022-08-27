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
                <a href="salesman-home.php" class="logo_name">Store Management</a>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="salesman-home.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>

                    </a>
                </li>
                <li>
                    <a href="list-customers.php">
                        <i class='bx bx-box'></i>
                        <span class="links_name">List Customers</span>
                    </a>
                </li>
                </li>
                <li>
                    <a href="create-bill.php" class="active">
                        <i class='bx bx-box'></i>
                        <span class="links_name">Bill</span>
                    </a>
                </li>
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
                        <h4>Selected Products For Customer Id: <?php echo $_GET['customerId']; ?></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once 'db_conn.php';
                                $sql = "SELECT * FROM selection WHERE customer_id='" . $_GET['customerId'] . "'";
                                $i = 1;
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $sql3 = "SELECT * FROM product WHERE product_id='" . $row["product_id"] . "'";
                                        $result3 = $conn->query($sql3);
                                        $row3 = $result3->fetch_assoc();
                                        echo "<tr>";
                                        echo "<th scope='row'>$i</th>";
                                        echo "<td>" . $row3["product_id"] . "</td>";
                                        echo "<td>" . $row3["name"] . "</td>";
                                        echo "<td><img src='" . $row3["image"] . "' alt='product-image' width='50' height='50'></td>";
                                        echo "<td>" . $row3["brand"] . "</td>";
                                        echo "<td>" . $row3["category"] . "</td>";
                                        echo "<td>" . $row3["price"] . "</td>";
                                        echo "<td>
      <button onclick='location.href=\"./controller/delete-selection.php?cid=" . $_GET['customerId'] . "&pid=" . $row3["product_id"] . "\"' class='btn btn-secondary' type='button' id='dropdownMenuButton'>Remove from Selection</button>
      </td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                        <a href="create-bill3.php?customerId=<?php echo $_GET['customerId']; ?>" class="addDriver"> + Create Bill </a>
                    </div>
                </div>
            </div>
            <div class="home-content">
                <div class="overview-boxes">

                    <div class="cardMod">
                        <h4>Select Products For Customer Id: <?php echo $_GET['customerId']; ?></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql2 = "SELECT * FROM product";
                                $i = 1;
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>$i</th>";
                                        echo "<td>" . $row2["product_id"] . "</td>";
                                        echo "<td>" . $row2["name"] . "</td>";
                                        echo "<td><img src='" . $row2["image"] . "' width='50' height='50'></td>";
                                        echo "<td>" . $row2["brand"] . "</td>";
                                        echo "<td>" . $row2["category"] . "</td>";
                                        echo "<td>
      <button onclick='location.href=\"./controller/add-selection.php?cid=" . $_GET['customerId'] . "&pid=" . $row2["product_id"] . "\"' class='btn btn-secondary' type='button' id='dropdownMenuButton'>Add to Selection</button>
      </td>";
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