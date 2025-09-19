<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= site_url('admin/users') ?>" class="btn btn-primary">Manage Users</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
