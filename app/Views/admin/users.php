<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Manage Users</h1>
    <a href="<?= site_url('admin/users/add') ?>" class="btn btn-primary mb-3">Add User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Department</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['Username'] ?></td>
                <td><?= $user['Department'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a href="<?= site_url('admin/users/edit/' . $user['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="<?= site_url('admin/users/delete/' . $user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
