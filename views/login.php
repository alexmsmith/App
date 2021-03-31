<?php
	require_once('../template/header.php');

	// If user is logged in, re-direct to the index page
	if (isset($_SESSION['user_id'])) header('Location: index.php');
	
	if (isset($_POST['login'])) {
		$auth = new Auth($conn);
		$errorMsg = $auth->login($_POST);
	}
?>

<div class="contaianer">
	<h1>Login</h1>
	<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<?php
			if (!empty($errorMsg)) { ?>
				<div class="errorMessages">
					<ul>
						<?php foreach ($errorMsg as $error) { ?>
							<li><?= $error ?></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		<p><input type="text" name="username" placeholder="Username" /></p>
		<p><input type="password" name="password" placeholder="Password" /></p>
		<p><input type="submit" value="Login" name="login" /></p>
		<p><input type="reset" value="Clear" /></p>
	</form>
</div>