<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Add User</h1>
    <form action="<?= site_url('admin/users/store') ?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <select name="department" id="department" class="form-control" required>
                <option value="amr">AMR</option>
                <option value="cataloguer">Cataloguer</option>
                <option value="supervisor">Supervisor</option>
                <option value="registrar">Registrar</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="amr">AMR</option>
                <option value="cataloguer">Cataloguer</option>
                <option value="supervisor">Supervisor</option>
                <option value="registrar">Registrar</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
<?= $this->endSection(); ?>
