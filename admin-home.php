<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
  include_once 'db_conn.php';
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
          <a href="admin-home.php" class="active">
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
          <a href="list-salesmans.php">
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
                    <h5 style="font-family: 'Kanit', sans-serif;"> Hello <?php echo $_SESSION['name']; ?> </h5>

                  </b>
                </div>
              </div>

            </div>

          </span>
        </div>

      </nav>

      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Number of Managers<br>
                <div style="text-align:center">(<?php
                                                $sql = "SELECT * FROM manager";
                                                $result = $conn->query($sql);
                                                echo $result->num_rows;
                                                ?>)</div>
              </div>

            </div>

          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Number of Salesman<br>
                <div style="text-align:center">(<?php
                                                $sql = "SELECT * FROM salesman";
                                                $result = $conn->query($sql);
                                                echo $result->num_rows;
                                                ?>)</div>
              </div>

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