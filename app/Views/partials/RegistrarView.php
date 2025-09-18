<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Table Name</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Amar ID</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $serial = 1; ?>

                        <!-- Manuscript Block -->
                        <?php if (!empty($data_manuscript)): ?>
                        <?php foreach ($data_manuscript as $manuscript_single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Manuscript</td>
                            <td><?= $manuscript_single_data['Title']; ?></td>
                            <td><?= isset($manuscript_single_data['Author']) ? $manuscript_single_data['Author'] : 'N/A'; ?>
                            </td>
                            <td><?= $manuscript_single_data['amar_id']; ?></td>
                            <td>
                                <a href="<?= site_url('registrar/view_pdf/'.$manuscript_single_data['id'].'/manuscript1_m'); ?>"
                                    class="btn btn-info btn-sm">View PDF</a>
                                <a href="<?= site_url('registrar/download/'.$manuscript_single_data['id'].'/manuscript1_m'); ?>"
                                    class="btn btn-primary btn-sm">Download</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Rarebook Block -->
                        <?php if (!empty($data_rarebook)): ?>
                        <?php foreach ($data_rarebook as $rarebooks_single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Rarebook</td>
                            <td><?= $rarebooks_single_data['Title']; ?></td>
                            <td><?= isset($rarebooks_single_data['Author']) ? $rarebooks_single_data['Author'] : 'N/A'; ?>
                            </td>
                            <td><?= $rarebooks_single_data['amar_id']; ?></td>
                            <td>
                                <a href="<?= site_url('registrar/view_pdf/'.$rarebooks_single_data['id'].'/rare_books1'); ?>"
                                    class="btn btn-info btn-sm">View PDF</a>
                                <a href="<?= site_url('registrar/download/'.$rarebooks_single_data['id'].'/rare_books1'); ?>"
                                    class="btn btn-primary btn-sm">Download</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Catalogue Block -->
                        <?php if (!empty($data_catalogue)): ?>
                        <?php foreach ($data_catalogue as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Catalogue</td>
                            <td><?= $single_data['Title']; ?></td>
                            <td><?= isset($single_data['Author']) ? $single_data['Author'] : 'N/A'; ?></td>
                            <td><?= $single_data['amar_id']; ?></td>
                            <td>
                                <a href="<?= site_url('registrar/view_pdf/'.$single_data['id'].'/catalogue1'); ?>"
                                    class="btn btn-info btn-sm">View PDF</a>
                                <a href="<?= site_url('registrar/download/'.$single_data['id'].'/catalogue1'); ?>"
                                    class="btn btn-primary btn-sm">Download</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Periodical Block -->
                        <?php if (!empty($data_periodical)): ?>
                        <?php foreach ($data_periodical as $single_data): ?>
                        <tr>
                            <td><?= $serial++; ?></td>
                            <td>Periodical</td>
                            <td><?= $single_data['Title']; ?></td>
                            <td><?= isset($single_data['Author']) ? $single_data['Author'] : 'N/A'; ?></td>
                            <td><?= $single_data['amar_id']; ?></td>
                            <td>
                                <a href="<?= site_url('registrar/view_pdf/'.$single_data['id'].'/periodical1'); ?>"
                                    class="btn btn-info btn-sm">View PDF</a>
                                <a href="<?= site_url('registrar/download/'.$single_data['id'].'/periodical1'); ?>"
                                    class="btn btn-primary btn-sm">Download</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>