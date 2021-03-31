<?php
require_once('../template/header.php');

if (!$_SESSION['user_id']) header('Location: login.php');

$projectObj = new Project($conn);

$projects = $projectObj->getProjects();

$errorMsg = '';
$errorMsgEdit = '';

if (isset($_POST['createProject'])) {
    $errorMsg = $projectObj->createProject($_POST);
    if ($errorMsg == '') header('Location: project.php');
}

if (isset($_POST['editProject'])) {
    $errorMsgEdit = $projectObj->editProject($_POST);
    if (count($errorMsgEdit) == 0) header('Location: project.php');
}

if (isset($_POST['delete'])) {
    $projectObj->deleteProject($_POST['projectId']);
    header('Location: project.php');
}
?>

<button id="toggleBtn" onclick="openModal()">New Project</button>
<div id="modal" class="modal-container">
    <button onclick="closeModal()">X</button>
    <h3>Create A Project</h3>
    <form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">
        <?php
            if (!empty($errorMsg)) { ?>
                <div class="errorMessages">
                    <ul>
                        <?php foreach ($errorMsg as $error) { ?>
                            <li><?= $error ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        <input type="text" class="modal-title" name="projectTitle" placeholder="Project Title">
        <textarea class="modal-description" name="projectDescription" placeholder="Project Description"></textarea>
        <input type="submit" class="modal-btn" value="Create" name="createProject">
    </form>
</div>

<h1>Project Board</h1>
<div id="editModal" class="modal-container">
    <button onclick="closeEditModal()">X</button>
    <h3>Edit A Project</h3>
    <form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">
        <?php
            if (!empty($errorMsgEdit)) { ?>
                <div class="errorMessages">
                    <ul>
                        <?php foreach ($errorMsgEdit as $error) { ?>
                            <li><?= $error ?></li>
                        <?php } ?>
                    </ul>
                </div>
        <?php } ?>
        <input type="hidden" id="projectEditId" name="projectId" value="<?= $project['id'] ?>">
        <input type="text" class="modal-title" id="projectEditTitle" name="projectTitle">
        <textarea class="modal-description" id="projectEditDescription" name="projectDescription"></textarea>
        <input type="submit" class="modal-btn" value="Edit" name="editProject">
    </form>
</div>

<?php foreach ($projects as $project) { ?>
    <div class="container">
        <div class="projectTitle">
            <h1><?= $project['project_title'] ?></h1>
        </div>
        <div class="projectDescription">
            <p><?= $project['project_description'] ?></p>
        </div>
        
        <button id="toggleEditBtn" onclick="openEditModal('<?= $project['id']; ?>', '<?= $project['project_title']; ?>', '<?= $project['project_description']; ?>')">Edit</button>

        <form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">
            <input type="hidden" name="projectId" value="<?= $project['id'] ?>">
			<input type="submit" value="Delete" name="delete">
		</form>
    </div>
<?php } ?>

<script>
    const modal = document.getElementById('modal');
    const editModal = document.getElementById('editModal');

    const editErrors = <?php echo json_encode($errorMsgEdit); ?>;
    if (editErrors.length > 0) openEditModal();

    const errors = <?php echo json_encode($errorMsg); ?>;
    if (errors.length > 0) openModal();
    
    function openModal() {
        modal.style.visibility = 'visible';
    }
    function closeModal() {
        modal.style.visibility = 'hidden';
    }

    function openEditModal(project_id, project_title, project_description) {
        editModal.style.visibility = 'visible';
        
        document.getElementById('projectEditId').value = project_id;
        document.getElementById('projectEditTitle').value = project_title;
        document.getElementById('projectEditDescription').innerHTML = project_description;
    }
    function closeEditModal() {
        editModal.style.visibility = 'hidden';
    }
</script>
