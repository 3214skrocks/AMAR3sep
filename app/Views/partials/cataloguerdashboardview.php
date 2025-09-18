<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-2">
            <nav class="nav flex-column bg-light p-3">
                <a class="nav-link" href="<?= base_url('supervisor/dashboard/approved'); ?>">Approved Files</a>
                <a class="nav-link" href="<?= base_url('supervisor/dashboard/pending'); ?>">Pending Files</a>
                <a class="nav-link" href="<?= base_url('supervisor/dashboard/rejected'); ?>">Rejected Files</a>
                <a class="nav-link active"
                    href="<?= base_url('supervisor/dashboard/cataloguer_approved'); ?>">Cataloguer Approved</a>
                <a class="nav-link" href="<?= base_url('supervisor/dashboard/published'); ?>">Publish</a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-10">
            <!-- Flash Messages -->
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

            <!-- Dynamic Table Content -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Table Name</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Amar ID</th>
                            <th>Remark</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $serial = 1; ?>

                        <!-- Function to Render Rows -->
                        <?php
                        // Render Manuscripts
                        foreach ($data_manuscript as $single_data):
                            ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Manuscript</td>
                            <td><?= htmlspecialchars($single_data['title_phonetic']); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['author_phonetic'] ?? 'N/A'); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['amar_id']); ?></td>
                            <td><?= htmlspecialchars($single_data['remark'] ?? ''); ?></td>
                            <td>
                                <a href="<?= base_url('supervisor/publish/' . $single_data['id'] . '/manuscript'); ?>"
                                    class="btn btn-success btn-sm">Publish</a>
                                <a href="<?= base_url('supervisor/rejectManuscript/' . $single_data['id']); ?>"
                                    class="btn btn-danger btn-sm">Reject</a>
                                <a href="<?= isset($single_data['file_path']) ? base_url('/view/pdf/' . $single_data['file_path']) : '#'; ?>"
                                    class="btn btn-info btn-sm" target="_blank">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Render Rare Books -->
                        <?php foreach ($data_rarebook as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Rare Book</td>
                            <td><?= htmlspecialchars($single_data['title_phonetic']); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['author_phonetic'] ?? 'N/A'); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['amar_id']); ?></td>
                            <td><?= htmlspecialchars($single_data['remark'] ?? ''); ?></td>
                            <td>
                                <a href="<?= base_url('supervisor/publish/' . $single_data['id'] . '/rarebook'); ?>"
                                    class="btn btn-success btn-sm">Publish</a>
                                <a href="<?= base_url('supervisor/rejectRareBook/' . $single_data['id']); ?>"
                                    class="btn btn-danger btn-sm">Reject</a>
                                <a href="<?= isset($single_data['file_path']) ? base_url('/view/pdf/' . $single_data['file_path']) : '#'; ?>"
                                    class="btn btn-info btn-sm" target="_blank">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Render Catalogues -->
                        <?php foreach ($data_catalogue as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Catalogue</td>
                            <td><?= htmlspecialchars($single_data['title_phonetic']); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['author_phonetic'] ?? 'N/A'); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['amar_id']); ?></td>
                            <td><?= htmlspecialchars($single_data['remark'] ?? ''); ?></td>
                            <td>
                                <a href="<?= base_url('supervisor/publish/' . $single_data['id'] . '/catalogue'); ?>"
                                    class="btn btn-success btn-sm">Publish</a>
                                <a href="<?= base_url('supervisor/rejectCatalogue/' . $single_data['id']); ?>"
                                    class="btn btn-danger btn-sm">Reject</a>
                                <a href="<?= isset($single_data['file_path']) ? base_url('/view/pdf/' . $single_data['file_path']) : '#'; ?>"
                                    class="btn btn-info btn-sm" target="_blank">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Render Periodicals -->
                        <?php foreach ($data_periodical as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Periodical</td>
                            <td><?= htmlspecialchars($single_data['per_title']); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['publisher']) ?? 'N/A'; ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['amar_id']); ?></td>
                            <td><?= htmlspecialchars($single_data['remark'] ?? ''); ?></td>
                            <td>
                                <a href="<?= base_url('supervisor/publish/' . $single_data['id'] . '/periodical'); ?>"
                                    class="btn btn-success btn-sm">Publish</a>
                                <a href="<?= base_url('supervisor/rejectPeriodical/' . $single_data['id']); ?>"
                                    class="btn btn-danger btn-sm">Reject</a>
                                <a href="<?= isset($single_data['file_path']) ? base_url('/view/pdf/' . $single_data['file_path']) : '#'; ?>"
                                    class="btn btn-info btn-sm" target="_blank">View PDF</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>