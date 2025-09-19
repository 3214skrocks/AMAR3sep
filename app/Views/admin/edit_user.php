<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Edit User</h1>
    <form action="<?= site_url('admin/users/update/' . $user['id']) ?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= $user['Username'] ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password (leave blank to keep current password)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <select name="department" id="department" class="form-control" required>
                <option value="amr" <?= $user['Department'] == 'amr' ? 'selected' : '' ?>>AMR</option>
                <option value="cataloguer" <?= $user['Department'] == 'cataloguer' ? 'selected' : '' ?>>Cataloguer</option>
                <option value="supervisor" <?= $user['Department'] == 'supervisor' ? 'selected' : '' ?>>Supervisor</option>
                <option value="registrar" <?= $user['Department'] == 'registrar' ? 'selected' : '' ?>>Registrar</option>
                <option value="admin" <?= $user['Department'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="amr" <?= $user['role'] == 'amr' ? 'selected' : '' ?>>AMR</option>
                <option value="cataloguer" <?= $user['role'] == 'cataloguer' ? 'selected' : '' ?>>Cataloguer</option>
                <option value="supervisor" <?= $user['role'] == 'supervisor' ? 'selected' : '' ?>>Supervisor</option>
                <option value="registrar" <?= $user['role'] == 'registrar' ? 'selected' : '' ?>>Registrar</option>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
<?= $this->endSection(); ?>
