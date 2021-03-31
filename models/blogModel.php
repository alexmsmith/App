<?php
require_once('../template/header.php');

class BlogModel {
    protected $conn;

    function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    function getBlogs() {
        $blogs = [];

        $stmt = $this->conn->prepare('SELECT blog_title, blog_description FROM Blog WHERE NOT user_id = :userId');
        $stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($blogs, $row);
        }

        $stmt = null;

        return $blogs;
    }

    function createBlog($blog) {
        $stmt = $this->conn->prepare('INSERT INTO Blog (user_id, blog_title, blog_description) VALUES (:userId, :blogTitle, :blogDescription)');

        $stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':blogTitle', htmlspecialchars($blog['blogTitle']), PDO::PARAM_STR);
        $stmt->bindParam(':blogDescription', htmlspecialchars($blog['blogDescription']), PDO::PARAM_STR);

        $stmt->execute();

        // Close PDO connection instance
        $stmt = null;
    }

    function editBlog($blog) {
        $stmt = $this->conn->prepare('UPDATE Blog SET blog_title = :blogTitle, blog_description = :blogDescription WHERE id = :blogId');
        $stmt->bindParam(':blogTitle', htmlspecialchars($blog['blogTitle']), PDO::PARAM_STR);
        $stmt->bindParam(':blogDescription', htmlspecialchars($blog['blogDescription']), PDO::PARAM_STR);
        $stmt->bindParam(':blogId', $blog['blogId'], PDO::PARAM_INT);

        $stmt->execute();

        // Close PDO connection instance
        $stmt = null;
    }
    
    function deleteBlog($blogId) {
        $stmt = $this->conn->prepare('DELETE FROM Blog WHERE id = :blogId');
        $stmt->bindParam(':blogId', $blogId, PDO::PARAM_INT);

        $stmt->execute();

        // Close PDO connection instance
        $stmt = null;
    }
}