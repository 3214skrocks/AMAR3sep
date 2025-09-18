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
                <a class="nav-link text-white" href="<?= base_url('cataloguer/dashboard'); ?>">Assigned Documents</a>
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
                            <th>Author/Publisher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $serial = 1;
                        $printDocumentRow = function ($doc, $type) use (&$serial) {
                            $title = $type === 'periodical' ? $doc['per_title'] : $doc['title_phonetic'];
                            $author = $type === 'periodical' ? $doc['publisher'] : $doc['author_phonetic'];
                            echo "<tr>
                                <td>" . $serial++ . "</td>
                                <td>" . ucfirst($type) . "</td>
                                <td>{$title}</td>
                                <td>{$author}</td>
                                <td>
                                    <a href='" . site_url('cataloguer/approve/' . $doc['id'] . '/' . $type) . "' class='btn btn-success'>Approve</a>
                                    <a href='" . site_url('cataloguer/reject/' . $doc['id'] . '/' . $type) . "' class='btn btn-danger'>Reject</a>
                                    <a href='" . site_url('amr/viewpdf/' . $doc['file_path']) . "' class='btn btn-info' target='_blank'>View PDF</a>
                                </td>
                            </tr>";
                        };

                        if (empty($manuscripts) && empty($rare_books) && empty($catalogues) && empty($periodicals)) {
                            echo '<tr><td colspan="5">No assigned documents found.</td></tr>';
                        } else {
                            if (!empty($manuscripts)) {
                                foreach ($manuscripts as $doc) $printDocumentRow($doc, 'manuscript');
                            }
                            if (!empty($rare_books)) {
                                foreach ($rare_books as $doc) $printDocumentRow($doc, 'rarebook');
                            }
                            if (!empty($catalogues)) {
                                foreach ($catalogues as $doc) $printDocumentRow($doc, 'catalogue');
                            }
                            if (!empty($periodicals)) {
                                foreach ($periodicals as $doc) $printDocumentRow($doc, 'periodical');
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