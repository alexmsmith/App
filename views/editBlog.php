<?php
require_once('../template/header.php');

if (!$_SESSION['user_id']) header('Location: login.php');

$blog = new Blog($conn);
$blogId = null;

if (isset($_POST['submit'])) {
    $blogId = $_POST['blogId'];
    $blog->editBlog($_POST);
}

if (isset($_POST['edit'])) {
    $blogId = $_POST['blogId'];
    $blogTitle = $_POST['blogTitle'];
    $blogDescription = $_POST['blogDescription'];
?>

<form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">
    <input type="hidden" name="blogId" value="<?= $blogId?>">
    <input type="text" name="blogTitle" value="<?= $blogTitle ?>">
    <textarea name="blogDescription"><?= $blogDescription ?></textarea>
    <input type="submit" value="Submit" name="submit">
</form>

<?php 
    }
    if ($blogId == null) header('Location: index.php');
?>