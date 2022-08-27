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
                        <h4>Bill Products For Customer Id: <?php echo $_GET['customerId']; ?></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form id='quantity' method='GET'>
                                    <input type="hidden" name="customerId" form='quantity' value='<?php echo $_GET['customerId'] ?>'>
                                </form>
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
                                        <input type='number' form='quantity' name='" . $row3["product_id"] . "' min='1' max='99' onChange='submit();' value='";
                                        if ($_GET[($row3["product_id"])]) {
                                            echo $_GET[($row3["product_id"])];
                                        } else {
                                            echo "0";
                                        }
                                        echo "'></td>";
                                        echo "<td>";
                                        if (isset($_GET[($row3["product_id"])])) {
                                            echo (int)$row3["price"] * (int)$_GET[($row3["product_id"])];
                                        } else {
                                            echo "0";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                }

                                ?>


                            </tbody>
                        </table>
                        <a href="./controller/add-bill.php?<?php $query = $_SERVER['QUERY_STRING'];
                                                            echo $query; ?>" class="addDriver" style="width: 200px;"> + Register Bill </a>

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