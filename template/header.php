<?php
	session_start();
	define('__ROOT__', dirname(dirname(__FILE__)));
	require_once(__ROOT__.'\..\App\config\dbConfig.php');

	spl_autoload_register(function ($class_name) {
		include '../controllers/' . $class_name . '.php';
	});
?>

<!DOCTYPE html>
<html>
	<head>
		<title>App</title>
		<link rel="stylesheet" href="../css/base.css">
	</head>
	<body>
		<nav>
			<ul>
			<?php if (isset($_SESSION['user_id'])) { ?>
				<li style="display: inline-block; color: white"><a href="index.php">Index</a></li>
				<li style="display: inline-block; color: white"><a href="stats.php">Covid Stats</a></li>
				<li style="display: inline-block; color: white">
					<form method="POST" action="logout.php">
						<input type="submit" value="Logout" name="logout">
					</form>
				</li>
			<?php 
				} else { ?>
					<li style="display: inline-block; color: white"><a href="login.php">Login</a></li>
					<li style="display: inline-block; color: white"><a href="register.php">Register</a></li>
				<?php } ?>
			</ul>
		</nav>