<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Manuscript Form</h1>
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

    <form action="<?= site_url(); ?>/amr/submitManuscript" method="post" enctype="multipart/form-data">
        <!-- Add form fields for Manuscript -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title_phonetic">
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author_phonetic">
        </div>
        <div class="form-group">
            <label for="cataloguer">Assign to Cataloguer:</label>
            <select class="form-control" id="cataloguer" name="cataloguer_id">
                <?php foreach ($cataloguers as $cataloguer): ?>
                    <option value="<?= $cataloguer['id'] ?>"><?= $cataloguer['Username'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="file">Upload File:</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection(); ?>