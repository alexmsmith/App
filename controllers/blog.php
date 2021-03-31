<?php
require_once('../template/header.php');

include '../models/BlogModel.php';

class Blog {
    private $blogModel;

    function __construct($conn) {
        $this->blogModel = new BlogModel($conn);
    }

    function getBlogs() {
        return $this->blogModel->getBlogs();
    }

    function createBlog($blog) {
        $this->blogModel->createBlog($blog);
        header('Location: ../views/index.php');
    }

    function editBlog($blog) {
        $this->blogModel->editBlog($blog);
        header('Location: ../views/index.php');
    }

    function deleteBlog($blogId) {
        $this->blogModel->deleteBlog($blogId);
        header('Location: ../views/index.php');
    }
}