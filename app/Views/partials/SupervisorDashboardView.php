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
                        $printDocumentRow = function ($doc, $type, $status) use (&$serial) {
                            $title = $type === 'periodical' ? $doc['per_title'] : $doc['title_phonetic'];
                            $author = $type === 'periodical' ? $doc['publisher'] : $doc['author_phonetic'];
                            $type_for_url = str_replace(' ', '', strtolower($type));

                            echo "<tr>
                                <td>" . $serial++ . "</td>
                                <td>" . ucfirst($type) . "</td>
                                <td>{$title}</td>
                                <td>{$author}</td>
                                <td>{$doc['amar_id']}</td>
                                <td>
                                    <form action='" . site_url('supervisor/handleAction') . "' method='post'>
                                        " . csrf_field() . "
                                        <input type='hidden' name='id' value='{$doc['id']}'>
                                        <input type='hidden' name='table_type' value='{$type}'>
                                        <input type='text' name='remark' class='form-control' placeholder='Enter remark' value='" . htmlspecialchars($doc['remark_by_supervisor'] ?? '') . "'>
                                </td>
                                <td>
                                        <button type='submit' name='action' value='approve' class='btn btn-success btn-sm'>Approve</button>
                                        <button type='submit' name='action' value='reject' class='btn btn-danger btn-sm'>Reject</button>
                                        <a href='" . site_url('supervisor/publish/' . $doc['id'] . '/' . $type_for_url) . "' class='btn btn-primary btn-sm'>Publish</a>
                                        <a href='" . site_url('amr/viewpdf/' . $doc['file_path']) . "' class='btn btn-info btn-sm' target='_blank'>View PDF</a>
                                    </form>
                                </td>
                            </tr>";
                        };

                        if (empty($data_manuscript) && empty($data_rarebook) && empty($data_catalogue) && empty($data_periodical)) {
                            echo '<tr><td colspan="7">No documents found.</td></tr>';
                        } else {
                            if (!empty($data_manuscript)) {
                                foreach ($data_manuscript as $doc) $printDocumentRow($doc, 'Manuscript', $doc['status']);
                            }
                            if (!empty($data_rarebook)) {
                                foreach ($data_rarebook as $doc) $printDocumentRow($doc, 'Rare Book', $doc['status']);
                            }
                            if (!empty($data_catalogue)) {
                                foreach ($data_catalogue as $doc) $printDocumentRow($doc, 'Catalogue', $doc['status']);
                            }
                            if (!empty($data_periodical)) {
                                foreach ($data_periodical as $doc) $printDocumentRow($doc, 'Periodical', $doc['status']);
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>