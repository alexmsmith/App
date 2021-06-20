<?php
require_once('../template/header.php');

include '../models/ProfileModel.php';

class Profile {
    private $profileModel;

    function __construct($conn) {
        $this->profileModel = new ProfileModel($conn);
    }

    function getProfile($profileUsername) {
        return $this->profileModel->getProfile($profileUsername);
    }

    function updateProfile($profile) {
        return $this->profileModel->updateProfile($profile);
    }
}