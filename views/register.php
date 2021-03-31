<?php
	require_once('../template/header.php');

	// If user is logged in, re-direct to the index page
	if (isset($_SESSION['user_id'])) header('Location: index.php');
	
	// Registration Post
	if (isset($_POST['register'])) {
		$auth = new Auth($conn);
		$errorMsgs = $auth->register($_POST);
		if (!$errorMsgs) {
			header('Location: login.php');
		}
	}
?>

<div class="container">
	<h1>Register</h1>
	<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<?php
			if (!empty($errorMsgs)) { ?>
				<div class="errorMessages">
					<ul>
						<?php foreach ($errorMsgs as $error) { ?>
							<li><?= $error?></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		<p><input type="email" name="email" placeholder="Email" /></p>
		<p><input type="text" name="username" placeholder="Username" /></p>
		<p><input type="password" name="password" placeholder="Password" /></p>
		<p><input type="password" name="confirmPassword" placeholder="Confirm Password" /></p>
		<p><input type="submit" value="Register" name="register" /></p>
		<p><input type="reset" value="Clear" /></p>
	</form>
</div>