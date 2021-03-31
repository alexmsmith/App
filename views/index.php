<?php
require_once('../template/header.php');
    
if (!$_SESSION['user_id']) header('Location: login.php');

$user = new User($conn);
$userBlogs = $user->getUserBlogs();

$blog = new Blog($conn);
$Blogs = $blog->getBlogs();

if (isset($_POST['createBlog'])) $blog->createBlog($_POST);

if (isset($_POST['delete'])) $blog->deleteBlog($_POST['blogId']);

?>

<form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">
    <input type="text" name="blogTitle">
    <textarea name="blogDescription"></textarea>
    <input type="submit" name="createBlog" value="Create">
</form>

<h1>My Blogs</h1>
<?php foreach ($userBlogs as $blog) { ?>
    <div class="blogContainer">
        <div class="blogTitle">
            <h1><?= $blog['blog_title'] ?></h1>
        </div>
        <div class="blogDescription">
            <p><?= $blog['blog_description'] ?></p>
        </div>
        <div>
            <form method="POST" action="editBlog.php">
                <input type="hidden" name="blogId" value="<?= $blog['id'] ?>">
                <input type="hidden" name="blogTitle" value="<?= $blog['blog_title'] ?>">
                <input type="hidden" name="blogDescription" value="<?= $blog['blog_description'] ?>">
				<input type="submit" value="Edit" name="edit">
			</form>

            <form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">
                <input type="hidden" name="blogId" value="<?= $blog['blog_id'] ?>">
				<input type="submit" value="Delete" name="delete">
			</form>
        </div>
    </div>
<?php } ?>

<h1>Other Blogs</h1>
<?php foreach ($Blogs as $blog) { ?>
    <div class="blogContainer">
        <div class="blogTitle">
            <h1><?= $blog['blog_title'] ?></h1>
        </div>
        <div class="blogDescription">
            <?= $blog['blog_description'] ?>
        </div>
    </div>
<?php } ?>