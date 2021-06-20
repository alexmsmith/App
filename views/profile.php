<?php
require_once('../template/header.php');

$profileObj = new Profile($conn);

if (isset($_POST['submit'])) {
    $profileObj->updateProfile($_POST);
}

$profileUsername = $_GET['username'];

$profile = $profileObj->getProfile($profileUsername);

if (isset($_SESSION['user_id'])) { ?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'].'?username='.$_SESSION['user_name']); ?>" method="POST" class="profile-form">
        <input type="text" name="profile_bio" placeholder="Bio" value="<?= $profile['profile_bio'] ?>" /><br /><br />
        <input type="text" name="profile_workexperience" placeholder="Work Experience" value="<?= $profile['profile_workexperience'] ?>" /><br /><br />
        <input type="submit" name="submit" value="Submit" />
    </form>
<?php } else { ?>
    <h1><?= $profile['profile_bio'] ?></h1>
    <h1><?= $profile['profile_workexperience'] ?></h1>
<?php } ?>