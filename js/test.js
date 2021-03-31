<script>
const modal = document.getElementById('modal');
const editModal = document.getElementById('editModal');

function openModal() {
    modal.style.visibility = 'visible'
}
function closeModal() {
    modal.style.visibility = 'hidden'
}

function openEditModal(project_id, project_title, project_description) {
    editModal.style.visibility = 'visible'
    
    document.getElementById('projectEditId').value = project_id
    document.getElementById('projectEditTitle').value = project_title
    document.getElementById('projectEditDescription').innerHTML = project_description
}
function closeEditModal() {
    editModal.style.visibility = 'hidden'
}
</script>