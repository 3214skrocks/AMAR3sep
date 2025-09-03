Share


You said:
<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>

<div class="container my-4">
    <!-- Success or error message popup -->
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <!-- Table Section -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title">Cataloguer Dashboard</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Amar ID</th>
                            <th>Remark by Supervisor</th>
                            <th>Remark by Cataloguer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $serial = 1; ?>

                        <!-- Manuscripts -->
                        <?php foreach ($data_manuscript as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Manuscript</td>
                            <td><?= $single_data['title_phonetic']; ?></td>
                            <td><?= isset($single_data['author_phonetic']) ? $single_data['author_phonetic'] : 'N/A'; ?>
                            </td>
                            <td><?= $single_data['amar_id']; ?></td>
                            <td><?= isset($single_data['remark_by_supervisor']) ? $single_data['remark_by_supervisor'] : 'N/A'; ?>
                            </td>
                            <td>
                                <form
                                    action="<?= site_url('cataloguer/save_remark/' . $single_data['id'] . '/manuscript'); ?>"
                                    method="post" class="remark-form">
                                    <input type="text" name="remark_by_cataloguer"
                                        class="form-control form-control-sm remark-input"
                                        value="<?= isset($single_data['remark_by_cataloguer']) ? $single_data['remark_by_cataloguer'] : ''; ?>"
                                        placeholder="Enter remark">
                                </form>
                            </td>
                            <td class="d-flex justify-content-start">
                                <a href="<?= site_url('cataloguer/approve/'.$single_data['id'].'/manuscript'); ?>"
                                    class="btn btn-success btn-sm me-2">Approve</a>
                                <a href="<?= site_url('cataloguer/reject/'.$single_data['id'].'/manuscript'); ?>"
                                    class="btn btn-danger btn-sm me-2">Reject</a>
                                <a href="<?= site_url('cataloguer/view_pdf/'.$single_data['id'].'/manuscript'); ?>"
                                    class="btn btn-info btn-sm me-2">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Rare Books -->
                        <?php foreach ($data_rarebook as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Rare Book</td>
                            <td><?= $single_data['title_phonetic']; ?></td>
                            <td><?= isset($single_data['author_phonetic']) ? $single_data['author_phonetic'] : 'N/A'; ?>
                            </td>
                            <td><?= $single_data['amar_id']; ?></td>
                            <td><?= isset($single_data['remark_by_supervisor']) ? $single_data['remark_by_supervisor'] : 'N/A'; ?>
                            </td>
                            <td>
                                <form
                                    action="<?= site_url('cataloguer/save_remark/' . $single_data['id'] . '/rarebook'); ?>"
                                    method="post" class="remark-form">
                                    <input type="text" name="remark_by_cataloguer"
                                        class="form-control form-control-sm remark-input"
                                        value="<?= isset($single_data['remark_by_cataloguer']) ? $single_data['remark_by_cataloguer'] : ''; ?>"
                                        placeholder="Enter remark">
                                </form>
                            </td>
                            <td class="d-flex justify-content-start">
                                <a href="<?= site_url('cataloguer/approve/'.$single_data['id'].'/rarebook'); ?>"
                                    class="btn btn-success btn-sm me-2">Approve</a>
                                <a href="<?= site_url('cataloguer/reject/'.$single_data['id'].'/rarebook'); ?>"
                                    class="btn btn-danger btn-sm me-2">Reject</a>
                                <a href="<?= site_url('cataloguer/view_pdf/'.$single_data['id'].'/rarebook'); ?>"
                                    class="btn btn-info btn-sm me-2">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Catalogues -->
                        <?php foreach ($data_catalogue as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Catalogue</td>
                            <td><?= $single_data['title_phonetic']; ?></td>
                            <td><?= isset($single_data['author_phonetic']) ? $single_data['author_phonetic'] : 'N/A'; ?>
                            </td>
                            <td><?= $single_data['amar_id']; ?></td>
                            <td><?= isset($single_data['remark_by_supervisor']) ? $single_data['remark_by_supervisor'] : 'N/A'; ?>
                            </td>
                            <td>
                                <form
                                    action="<?= site_url('cataloguer/save_remark/' . $single_data['id'] . '/catalogue'); ?>"
                                    method="post" class="remark-form">
                                    <input type="text" name="remark_by_cataloguer"
                                        class="form-control form-control-sm remark-input"
                                        value="<?= isset($single_data['remark_by_cataloguer']) ? $single_data['remark_by_cataloguer'] : ''; ?>"
                                        placeholder="Enter remark">
                                </form>
                            </td>
                            <td class="d-flex justify-content-start">
                                <a href="<?= site_url('cataloguer/approve/'.$single_data['id'].'/catalogue'); ?>"
                                    class="btn btn-success btn-sm me-2">Approve</a>
                                <a href="<?= site_url('cataloguer/reject/'.$single_data['id'].'/catalogue'); ?>"
                                    class="btn btn-danger btn-sm me-2">Reject</a>
                                <a href="<?= site_url('cataloguer/view_pdf/'.$single_data['id'].'/catalogue'); ?>"
                                    class="btn btn-info btn-sm me-2">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Periodicals -->
                        <?php foreach ($data_periodical as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Periodical</td>
                            <td><?= $single_data['per_title']; ?></td>
                            <td><?= isset($single_data['publisher']) ? $single_data['publisher'] : 'N/A'; ?></td>
                            <td><?= $single_data['amar_id']; ?></td>
                            <td><?= isset($single_data['remark_by_supervisor']) ? $single_data['remark_by_supervisor'] : 'N/A'; ?>
                            </td>
                            <td>
                                <form
                                    action="<?= site_url('cataloguer/save_remark/' . $single_data['id'] . '/periodical'); ?>"
                                    method="post" class="remark-form">
                                    <input type="text" name="remark_by_cataloguer"
                                        class="form-control form-control-sm remark-input"
                                        value="<?= isset($single_data['remark_by_cataloguer']) ? $single_data['remark_by_cataloguer'] : ''; ?>"
                                        placeholder="Enter remark">
                                </form>
                            </td>
                            <td class="d-flex justify-content-start">
                                <a href="<?= site_url('cataloguer/approve/'.$single_data['id'].'/periodical'); ?>"
                                    class="btn btn-success btn-sm me-2">Approve</a>
                                <a href="<?= site_url('cataloguer/reject/'.$single_data['id'].'/periodical'); ?>"
                                    class="btn btn-danger btn-sm me-2">Reject</a>
                                <a href="<?= site_url('cataloguer/view_pdf/'.$single_data['id'].'/periodical'); ?>"
                                    class="btn btn-info btn-sm me-2">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const remarkInputs = document.querySelectorAll('.remark-input');

    remarkInputs.forEach(input => {
        input.addEventListener('change', function() {
            const form = this.closest('.remark-form');
            form.submit();
        });
    });
});
</script>

<?= $this->endSection(); ?>