<!DOCTYPE html>
<html>
<?php
if (isset($_GET['user_name'])) {
	header("location: home.php");
}
?>

<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css?v=0.0.2">
</head>

<body class="indexBody">

	<form action="login.php" method="post">
		<h2>LOGIN</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<label>Account Type:</label><br>
		<input type="radio" name="acctype" id="admin" value="admin" class="acctype">
		<label for="admin">Admin</label><br>
		<input type="radio" name="acctype" id="salesman" value="salesman" class="acctype">
		<label for="salesman">Salesman</label><br>
		<input type="radio" name="acctype" id="manager" value="manager" class="acctype">
		<label for="manager">Manager</label><br><br>

		<label>User Name</label>
		<input type="text" name="uname" placeholder="User Name"><br>

		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>

		<button type="submit">Login</button>
	</form>
</body>

</html>