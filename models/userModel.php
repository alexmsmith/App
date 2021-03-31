<?php
require_once('../template/header.php');

class UserModel {
    private $conn;

    function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    function userBlogs() {
        $userBlogs = [];

		$stmt = $this->conn->prepare('SELECT id, blog_title, blog_description FROM Blog WHERE user_id = :userId');
		$stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->execute();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($userBlogs, $row);
		}

		// Close PDO connection instance
		$stmt = null;

		return $userBlogs;
    }

    function username() {
        $stmt = $this->conn->prepare('SELECT username FROM User WHERE id = :userId');
		$stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Close PDO connection instance
		$stmt = null;

		return $row['username'];
    }

    function emailAddress() {
        $stmt = $this->conn->prepare('SELECT email FROM User WHERE id = :userId');
		$stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Close PDO connection instance
		$stmt = null;
			
		return $row['email'];
    }
}