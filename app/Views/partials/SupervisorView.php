<!-- app/Views/partials/SupervisorCataloguerApprovedView.php -->

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
                        /**
                         * Renders a table row for a given data item.
                         *
                         * @param array $single_data The data for the current row.
                         * @param string $table_type The type of the table (Manuscript, Rare Book, etc.).
                         * @param string $approve_url The URL to approve the item.
                         * @param string $reject_url The URL to reject the item.
                         */   
                        function renderTableRow($single_data, $table_type, $approve_url, $reject_url, $serial) {
                            ?>
                        <tr>
                            <td><?= $serial; ?></td>
                            <td><?= htmlspecialchars($table_type); ?></td>
                            <td><?= ($table_type == 'Periodical' ? htmlspecialchars($single_data['per_title']): htmlspecialchars($single_data['title_phonetic'])); ?>
                            </td>
                            <td><?= ($table_type == 'Periodical' ? htmlspecialchars($single_data['publisher']) ?? 'N/A': htmlspecialchars($single_data['author_phonetic'] ?? 'N/A')); ?>
                            </td>
                            <td><?= htmlspecialchars($single_data['amar_id']); ?></td>
                            <td>
                                <form action="" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($single_data['id']); ?>">
                                    <input type="hidden" name="table_type"
                                        value="<?= htmlspecialchars($table_type); ?>">
                                    <input type="text" name="remark" class="form-control" placeholder="Enter remark"
                                        value="<?= htmlspecialchars($single_data['remark'] ?? ''); ?>" required>
                            </td>
                            <td>
                                <button type="submit" name="action" value="approve"
                                    class="btn btn-success btn-sm me-1">Approve</button>
                                <button type="submit" name="action" value="reject"
                                    class="btn btn-danger btn-sm me-1">Reject</button>
                                <a href="<?= isset($single_data['file_path']) ? base_url('/view/pdf/' . $single_data['file_path']) : '#'; ?>"
                                    class="btn btn-info btn-sm" target="_blank">View PDF</a>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }

                        // Render Manuscripts
                        foreach ($data_manuscript as $single_data):
                            renderTableRow(
                                $single_data,
                                'Manuscript',
                                base_url('supervisor/approveManuscript/' . $single_data['id']),
                                base_url('supervisor/rejectManuscript/' . $single_data['id']),
                                $serial++
                            );
                        endforeach;

                        // Render Rare Books
                        foreach ($data_rarebook as $single_data):
                            renderTableRow(
                                $single_data,
                                'Rare Book',
                                base_url('supervisor/approveRareBook/' . $single_data['id']),
                                base_url('supervisor/rejectRareBook/' . $single_data['id']),
                                $serial++
                            );
                        endforeach;

                        // Render Catalogues
                        foreach ($data_catalogue as $single_data):
                            renderTableRow(
                                $single_data,
                                'Catalogue',
                                base_url('supervisor/approveCatalogue/' . $single_data['id']),
                                base_url('supervisor/rejectCatalogue/' . $single_data['id']),
                                $serial++
                            );
                        endforeach;

                        // Render Periodicals
                        foreach ($data_periodical as $single_data):
                            renderTableRow(
                                $single_data,
                                'Periodical',
                                base_url('supervisor/approvePeriodical/' . $single_data['id']),
                                base_url('supervisor/rejectPeriodical/' . $single_data['id']),
                                $serial++
                            );
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>