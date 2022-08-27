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
        <a href="admin-home.php" class="logo_name">Store Management</a>
      </div>
      <ul class="nav-links">
        <li>
          <a href="admin-home.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>

          </a>
        </li>
        <li>
          <a href="list-managers.php">
            <i class='bx bx-box'></i>
            <span class="links_name">List Managers</span>
          </a>
        </li>
        </li>
        <li>
          <a href="list-salesmans.php" class="active">
            <i class='bx bx-box'></i>
            <span class="links_name">List Salesmans</span>
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
            <h4>List of Salesmans </h4>
            <a href="add-salesman.php" class="addDriver"> + Create </a>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Seller ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Products Sold (quantity)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include_once 'db_conn.php';
                $sql = "SELECT * FROM salesman";
                $i = 1;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>$i</th>";
                    echo "<td>" . $row["seller_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    if ($result->num_rows > 0) {
                      $sql2 = "SELECT SUM(quantity) AS total_quantity FROM bill,bill_products WHERE bill.bill_id=bill_products.bill_id AND bill.seller_id='" . $row["seller_id"] . "'";
                      $result2 = $conn->query($sql2);
                      $row2 = $result2->fetch_assoc();
                    }
                    echo "<td>";
                    echo $row2['total_quantity'] ? $row2['total_quantity'] : 0;
                    echo "</td>";
                    echo "<td>
      <div class='dropdown'>
      <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button>
      <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
          <a class='dropdown-item' href='edit-salesman.php?id=" . $row["seller_id"] . "'>Edit</a>
          <a class='dropdown-item' href='./controller/delete-seller.php?id=" . $row["seller_id"] . "'>Delete</a>
      </div>
  </div>
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