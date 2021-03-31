<?php
require_once('../template/header.php');

include '../models/ProjectModel.php';

class Project {
    private $projectModel;

    function __construct($conn) {
        $this->projectModel = new ProjectModel($conn);
    }

    function getProjects() {
        return $this->projectModel->getProjects();
    }

    function editProject($project) {
        return $this->projectModel->editProject($project);
    }

    function deleteProject($projectId) {
        $this->projectModel->deleteProject($projectId);
    }

    function createProject($project) {
        return $this->projectModel->createProject($project);
    }
}