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
		<nav class="navBar">
			<ul class="navLeft">
			<?php if (isset($_SESSION['user_id'])) { ?>
				<li><a href="index.php">Index</a></li>
				<li><a href="profile.php?username=<?php echo $_SESSION['user_name'] ?>">My Profile</a></li>
			<?php 
				} else { ?>
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				<?php } ?>
			</ul>
			<?php if (isset($_SESSION['user_id'])) { ?>
				<ul class="navRight">
					<li><a href="projects.php">Projects</a></li>
					<li>
						<form method="POST" action="logout.php">
							<input type="submit" value="Logout" name="logout">
						</form>
					</li>
				</ul>
			<?php } ?>
		</nav>