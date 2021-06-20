<?php
require_once('../template/header.php');

class ProfileModel {
    protected $conn;

    function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    function getProfile($profileUsername) {
        // Fetch the user's id based on the username
        $stmt = $this->conn->prepare('SELECT id FROM user WHERE username = :username');
        $stmt->bindParam(':username', $profileUsername, PDO::PARAM_STR);
        $stmt->execute();
        $profileId = $stmt->fetchColumn();

        // Close PDO connection instance
        $stmt = null;

        // Fetch the user's profile based on their id
        $stmt = $this->conn->prepare('SELECT * FROM profile WHERE user_id = :profileId');
        $stmt->bindParam(':profileId', $profileId, PDO::PARAM_INT);
        $stmt->execute();
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close PDO connection instance
        $stmt = null;

        return $profile;
    }

    function updateProfile($profile) {
        // Update user's profile with new details
        $stmt = $this->conn->prepare('UPDATE profile SET profile_bio = :profileBio, profile_workexperience = :profileWorkexperience WHERE user_id = :userId');
        $stmt->bindParam(':profileBio', $profile['profile_bio'], PDO::PARAM_STR);
        $stmt->bindParam(':profileWorkexperience', $profile['profile_workexperience'], PDO::PARAM_STR);
        $stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        
        // Close PDO connection instance
        $stmt = null;
    }
}