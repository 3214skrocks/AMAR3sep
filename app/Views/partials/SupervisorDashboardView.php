<?= $this->extend('layouts/adminbase'); ?>
<?= $this->section('content'); ?>

<style>
/* Sidebar Styling */
.nav-link {
    font-weight: bold;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover {
    background-color: #0056b3;
    color: white;
}

.bg-dark.text-white {
    background-color: #343a40 !important;
    color: #fff !important;
}

/* Table Styling */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, .05);
}

.btn-close {
    float: right;
    color: #fff;
}
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-2">
            <nav class="nav flex-column bg-primary text-white p-3">
                <a class="nav-link <?= (uri_string() == 'supervisor/dashboard/approved') ? 'bg-dark text-white' : 'text-white'; ?>"
                    href="<?= base_url('supervisor/dashboard/approved'); ?>">Approved Files</a>
                <a class="nav-link <?= (uri_string() == 'supervisor/dashboard/pending') ? 'bg-dark text-white' : 'text-white'; ?>"
                    href="<?= base_url('supervisor/dashboard/pending'); ?>">Pending Files</a>
                <a class="nav-link <?= (uri_string() == 'supervisor/dashboard/rejected') ? 'bg-dark text-white' : 'text-white'; ?>"
                    href="<?= base_url('supervisor/dashboard/rejected'); ?>">Rejected Files</a>
                <a class="nav-link <?= (uri_string() == 'supervisor/dashboard/cataloguer_approved') ? 'bg-dark text-white' : 'text-white'; ?>"
                    href="<?= base_url('supervisor/dashboard/cataloguer_approved'); ?>">Cataloguer Approved</a>
                <a class="nav-link <?= (uri_string() == 'supervisor/dashboard/published') ? 'bg-dark text-white' : 'text-white'; ?>"
                    href="<?= base_url('supervisor/dashboard/published'); ?>">Publish</a>
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
            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>AMAR ID</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $serial = 1;

                        // Define the approve and reject URLs
                        $approve_url = base_url('supervisor/approve');  // Replace with the actual URL for approve
                        $reject_url = base_url('supervisor/reject');    // Replace with the actual URL for reject

                        // Render rows for each type of item
                        if (isset($data_manuscript)) {
                            foreach ($data_manuscript as $item) {
                                renderTableRow($item, 'Manuscript', $approve_url, $reject_url, $serial++);
                            }
                        }

                        if (isset($data_rarebook)) {
                            foreach ($data_rarebook as $item) {
                                renderTableRow($item, 'Rare Book', $approve_url, $reject_url, $serial++);
                            }
                        }

                        if (isset($data_catalogue)) {
                            foreach ($data_catalogue as $item) {
                                renderTableRow($item, 'Catalogue', $approve_url, $reject_url, $serial++);
                            }
                        }

                        if (isset($data_periodical)) {
                            foreach ($data_periodical as $item) {
                                renderTableRow($item, 'Periodical', $approve_url, $reject_url, $serial++);
                            }
                        }

                        if (isset($data_cataloguer_approved)) {
                            foreach ($data_cataloguer_approved as $item) {
                                renderTableRow($item, 'Cataloguer Approved', $approve_url, $reject_url, $serial++);
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<!-- Updated renderTableRow Function -->
<?php
function renderTableRow($single_data, $table_type, $approve_url, $reject_url, $serial) {
    // Check if the item is cataloguer-approved
    $isCataloguerApproved = isset($single_data['cataloguer_approved']) && $single_data['cataloguer_approved'] == true;
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
        <form action="<?= $isCataloguerApproved ? base_url('supervisor/publish') : $approve_url; ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($single_data['id']); ?>">
            <input type="hidden" name="table_type" value="<?= htmlspecialchars($table_type); ?>">
            <input type="text" name="remark" class="form-control" placeholder="Enter remark"
                value="<?= htmlspecialchars($single_data['remark'] ?? ''); ?>" required>
    </td>
    <td>
        <!-- Display "Publish" if cataloguer approved, otherwise "Approve" -->
        <?php if ($isCataloguerApproved): ?>
        <button type="submit" name="action" value="publish" class="btn btn-primary btn-sm me-1">
            Publish
        </button>
        <?php else: ?>
        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm me-1">
            Approve
        </button>
        <?php endif; ?>

        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm me-1">Reject</button>
        <a href="<?= isset($single_data['file_path']) ? base_url('/view/pdf/' . $single_data['file_path']) : '#'; ?>"
            class="btn btn-info btn-sm" target="_blank">View PDF</a>
        </form>
    </td>
</tr>
<?php
}
?>