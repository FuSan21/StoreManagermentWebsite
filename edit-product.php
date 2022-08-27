<?php
session_start();
include_once 'db_conn.php';
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
  if (isset($_GET['id'])) {
    $sql = "SELECT * FROM product WHERE product_id='" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    }
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
            <a href="list-product.php" class="active">
              <i class='bx bx-box'></i>
              <span class="links_name">List product</span>
            </a>
          </li>
          <li>
            <a href="list-order.php">
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


        <div class="home-content home-content-edit">
          <h4 style="text-align:center">Edit product </h4>
          <div class="overview-boxes">
            <div class="box">
              <div class="right-side">
                <form action="./controller/add-prod.php" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="price" name="price" value="<?php echo $row['price']; ?>">
                  </div>
                  <div class=" form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name" name="name" value="<?php echo $row['name']; ?>">
                  </div>
                  <div class=" form-group">
                    <label for="exampleInputPassword1">image url</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="image" name="image" value="<?php echo $row['image']; ?>">
                  </div>
                  <div class=" form-group">
                    <label for="exampleInputPassword1">brand</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="brand" name="brand" value="<?php echo $row['brand']; ?>">
                  </div>
                  <div class=" form-group">
                    <label for="exampleInputPassword1">category</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="category" name="category" value="<?php echo $row['category']; ?>">
                  </div>
                  <input type="hidden" value="<?php echo $row['manage']; ?>" name="manage">
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
  }
} else {
  header("Location: index.php");
  exit();
}
?>