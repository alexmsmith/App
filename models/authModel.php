<?php
require_once('../template/header.php');

class AuthModel {
    protected $conn;
    protected $arr;

    function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    function loginAttempt($arr) {
        extract($arr);
		
		$errors = [];

		foreach ($arr as $key => $value) {
			switch ($key) {
				case 'username':
					if (!$value) array_push($errors, 'Username is required');
					break;
				case 'password':
					if (!$value) array_push($errors, 'Password is required');
					break;
			}
		}

		if ($username && $password) {
			$stmt = $this->conn->prepare('SELECT * FROM User WHERE username = :username');
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				if (password_verify($password, $row['password'])) {
					$_SESSION['user_id'] = $row['id'];
					header('Location: index.php');
					return;
				}
				array_push($errors, 'Incorrect username/password');
			} else array_push($errors, 'User does not exist');

			// Close PDO connection instance
			$stml = null;
		}
		
		return $errors;
    }

    function registerFormValidation($arr) {
        extract($arr);

        $errors = [];

        foreach ($arr as $key => $value) {
            switch ($key) {
                case 'email':
                    if (!$value) array_push($errors, 'Email is required');
                    if (!preg_match("/^\S+@\S+$/", $email)) array_push($errors, 'Please enter a valid email');
                    break;
                case 'username':
                    if (!$value) array_push($errors, 'Username is required');
                    break;
                case 'password':
                    if (!$value) array_push($errors, 'Password is required');
                    break;
            }
        }

        if ($password != $confirmPassword) array_push($errors, 'Password does not match confirmation');

        return $errors;
    }

    function registerAttempt($arr) {
        $formUsername = htmlspecialchars($arr['username']);
        $formPassword = htmlspecialchars($arr['password']);
        $formEmail = htmlspecialchars($arr['email']);
        $hashedPassword = password_hash($formPassword, PASSWORD_DEFAULT);

        $usernameStmt = $this->conn->prepare('SELECT * FROM User WHERE username = :username');
        $usernameStmt->bindParam(':username', $formUsername, PDO::PARAM_STR);
        $usernameStmt->execute();
        $usernameResult = $usernameStmt->fetch(PDO::FETCH_ASSOC);

        $emailStmt = $this->conn->prepare('SELECT * FROM User WHERE email = :email');
        $emailStmt->bindParam(':email', $formEmail, PDO::PARAM_STR);
        $emailStmt->execute();
        $emailResult = $emailStmt->fetch(PDO::FETCH_ASSOC);

        if (!$usernameResult && !$emailResult) {
            $stmt = $this->conn->prepare('INSERT INTO User (username, password, email) VALUES (:username, :password, :email)');

            $stmt->bindParam(':username', $formUsername, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $formEmail, PDO::PARAM_STR);
            
            $stmt->execute();

            // Close PDO connection instance
            $stmt = null;

        } else return 'Username/Email Already Exists';
    }
}