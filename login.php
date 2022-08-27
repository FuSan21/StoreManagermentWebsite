<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
		exit();
	} else if (empty($pass)) {
		header("Location: index.php?error=Password is required");
		exit();
	} else {
		if ($_POST['acctype'] == "admin") {
			if ($uname === "admin" && $pass === "adminlogin") {
				$_SESSION['user_name'] = "admin";
				$_SESSION['name'] = "admin";
				$_SESSION['id'] = "admin";
				$_SESSION['account_type'] = "admin";
				header("Location: admin-home.php");
			} else {
				header("Location: index.php?error=Incorect User name or password");
			}
		} else {
			$sql = "SELECT * FROM " . $_POST['acctype'] . " WHERE email='$uname' AND password='$pass'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) === 1) {
				$row = mysqli_fetch_assoc($result);
				print_r($row);
				if ($row['email'] === $uname && $row['password'] === $pass) {
					$_SESSION['user_name'] = $row['email'];
					$_SESSION['name'] = $row['name'];
					if ($_POST['acctype'] == "manager") {
						$_SESSION['id'] = $row['manager_id'];
						$_SESSION['account_type'] = "manager";
						header("Location: manager-home.php");
					} else if ($_POST['acctype'] == "salesman") {
						$_SESSION['id'] = $row['seller_id'];
						$_SESSION['account_type'] = "salesman";
						header("Location: salesman-home.php");
					}
					exit();
				} else {
					header("Location: index.php?error=Incorect User name or password");
					exit();
				}
			} else {
				header("Location: index.php?error=Incorect User name or password");
				exit();
			}
		}
	}
} else {
	if ($_SESSION['account_type'] == "manager") {
		header("Location: manager-home.php");
	} else if ($_SESSION['account_type'] == "salesman") {
		header("Location: salesman-home.php");
	} else if ($_SESSION['account_type'] == "admin") {
		header("Location: admin-home.php");
	}
	exit();
}
