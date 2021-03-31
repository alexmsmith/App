<?php
    require_once('../template/header.php');

    if (isset($_POST['logout'])) {
        $auth = new Auth($conn);
        $auth->logout();
    }