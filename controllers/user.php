<?php
require_once('../template/header.php');

include '../models/UserModel.php';

class User {
	private $userModel;

	function __construct($conn) {
		$this->userModel = new UserModel($conn);
	}

	function getUserName() {
		return $this->userModel->username();
	}

	function getEmailAddress() {
		return $this->userModel->emailAddress();
	}

	function getUserBlogs() {
		return $this->userModel->userBlogs();
	}
}