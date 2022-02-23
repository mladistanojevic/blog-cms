<!-- Sidebar -->
<div class="bg-white" id="sidebar-wrapper">
    <div class="list-group list-group-flush my-3">
        <a href="<?= URLROOT ?>/admin/dashboard" class="list-group-item list-group-item-action bg-transparent second-text my-2"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="<?= URLROOT ?>/admin/profile/<?= $_SESSION['user_id']; ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold my-2"><i class="fas fa-id-card me-2"></i>Profile</a>
        <a href="<?= URLROOT ?>/admin/blogs" class="list-group-item list-group-item-action bg-transparent second-text fw-bold my-2"><i class="fab fa-blogger-b me-2"></i>List of all Blogs</a>
        <a href="<?= URLROOT ?>/admin/users" class="list-group-item list-group-item-action bg-transparent second-text fw-bold my-2"><i class="fas fa-users me-2"></i>List of all Users</a>
        <a href="<?= URLROOT ?>/admin/comments" class="list-group-item list-group-item-action bg-transparent second-text fw-bold my-2"><i class="fas fa-comments me-2"></i>List of all Comments</a>
        <a href="<?= URLROOT ?>/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold my-2"><i class="fas fa-power-off me-2"></i>Logout</a>
    </div>
</div>
<!-- /#sidebar-wrapper -->