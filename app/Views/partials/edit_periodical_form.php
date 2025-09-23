<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Edit Periodical</h1>
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
    <?php endif; ?>

    <form action="<?= site_url('/amr/update_periodical/'.$periodical['id']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="per_title">Title:</label>
            <input type="text" class="form-control" id="per_title" name="per_title" value="<?= $periodical['per_title']; ?>">
        </div>
        <div class="form-group">
            <label for="publisher">Publisher:</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="<?= $periodical['publisher']; ?>">
        </div>
        <div class="form-group">
            <label for="cataloguer">Assign to Cataloguer:</label>
            <select class="form-control" id="cataloguer" name="cataloguer_id">
                <?php foreach ($cataloguers as $cataloguer): ?>
                    <option value="<?= $cataloguer['id'] ?>" <?= ($cataloguer['id'] == $periodical['cataloguer_id']) ? 'selected' : ''; ?>>
                        <?= $cataloguer['Username'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="file">Upload New File (Optional):</label>
            <p>Current File: <a href="<?= site_url('/amr/viewpdf/'.$periodical['file_path']); ?>" target="_blank"><?= $periodical['file_path']; ?></a></p>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?= $this->endSection(); ?>
