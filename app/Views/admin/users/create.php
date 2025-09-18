<?= $this->extend("layouts/adminbase"); ?>

<?= $this->section("content"); ?>
<div class="container">
    <h2>Add New User</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/admin/users/store" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <select class="form-control" id="department" name="department" required>
                <option value="">Select Department</option>
                <option value="Admin">Admin</option>
                <option value="AMR">AMR</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Cataloguer">Cataloguer</option>
                <option value="Registrar">Registrar</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
        <a href="/admin/users" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?= $this->endSection(); ?>
