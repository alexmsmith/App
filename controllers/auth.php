<?php
require_once('../template/header.php');

include '../models/AuthModel.php';

    class Auth {

		private $authModel;

		function __construct($conn) {
			$this->authModel = new AuthModel($conn);
		}

		function login($arr) {
			return $this->authModel->loginAttempt($arr);
		}

		function register($arr) {
			$registerFormValidation = $this->authModel->registerFormValidation($arr);
			$registerAttempt = $this->authModel->registerAttempt($arr);

			if ($registerAttempt != null) array_push($registerFormValidation, $registerAttempt);

			return $registerFormValidation;
		}

		function logout() {
			session_destroy();
        	header('Location: login.php');
		}
    }