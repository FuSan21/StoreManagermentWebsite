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
          <a href="list-managers.php" class="active">
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
                    <h5 style="font-family: 'Kanit', sans-serif;"> { Hello, <?php echo $_SESSION['name']; ?> }</h5>

                  </b>
                </div>
              </div>

            </div>

          </span>
        </div>

      </nav>


      <div class="home-content home-content-edit">
        <h4 style="text-align:center">Create Manager </h4>
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <form action="./controller/add-man.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" name="Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">E-mail</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="Password">
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
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