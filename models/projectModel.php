<?php
require_once('../template/header.php');

class ProjectModel {
    protected $conn;

    function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    function getProjects() {
        $projects = [];

        $stmt = $this->conn->prepare('SELECT id, project_title, project_description FROM Project');
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($projects, $row);
        }

        $stmt = null;

        return $projects;
    }

    function editProject($project) {

        extract($project);

        $projectTitle = htmlspecialchars($project['projectTitle']);
        $projectDescription = htmlspecialchars($project['projectDescription']);

        $errors = [];

        foreach ($project as $key => $value) {
            switch ($key) {
                case 'projectTitle':
                    if (!$value) array_push($errors, 'Project Title is required');
                    break;
                case 'projectDescription':
                    if (!$value) array_push($errors, 'Project Description is required');
                    break;
            }
        }

        if (empty($errors)) {
            $stmt = $this->conn->prepare('UPDATE Project SET project_title = :projectTitle, project_description = :projectDescription WHERE id = :projectId');
            $stmt->bindParam(':projectTitle', $projectTitle, PDO::PARAM_STR);
            $stmt->bindParam(':projectDescription', $projectDescription, PDO::PARAM_STR);
            $stmt->bindParam(':projectId', $project['projectId'], PDO::PARAM_INT);

            $stmt->execute();

            // Close PDO connection instance
            $stmt = null;
        }

        return $errors;
    }

    function deleteProject($projectId) {
        $stmt = $this->conn->prepare('DELETE FROM Project WHERE id = :projectId');
        $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);

        $stmt->execute();

        // Close PDO connection instance
        $stmt = null;
    }

    function createProject($project) {
        extract($project);

        $errors = [];

        foreach ($project as $key => $value) {
            switch ($key) {
                case 'projectTitle':
                    if (!$value) array_push($errors, 'Project Title is required');
                    break;
                case 'projectDescription':
                    if (!$value) array_push($errors, 'Project Description is required');
                    break;
            }
        }

        if (empty($errors)) {
            $projectTitle = htmlspecialchars($project['projectTitle']);
            $projectDescription = htmlspecialchars($project['projectDescription']);

            $stmt = $this->conn->prepare('INSERT INTO Project (user_id, project_title, project_description) VALUES (:userId, :projectTitle, :projectDescription)');

            $stmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':projectTitle', $projectTitle, PDO::PARAM_STR);
            $stmt->bindParam(':projectDescription', $projectDescription, PDO::PARAM_STR);

            $stmt->execute();

            // Close PDO connection instance
            $stmt = null;
            return;
        }

        return $errors;
    }
}