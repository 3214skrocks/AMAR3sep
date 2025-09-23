<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Cataloguer Dashboard</h1>
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

    <h2>Pending Documents</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Title</th>
                <th>AMR</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $documents = array_merge(
                array_map(function($m) { $m['type'] = 'Manuscript'; return $m; }, $data_manuscript),
                array_map(function($r) { $r['type'] = 'Rare Book'; return $r; }, $data_rarebook),
                array_map(function($c) { $c['type'] = 'Catalogue'; return $c; }, $data_catalogue),
                array_map(function($p) { $p['type'] = 'Periodical'; return $p; }, $data_periodical)
            );

            $userModel = new \App\Models\UserModel();
            ?>

            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><?= $doc['type']; ?></td>
                    <td><?= isset($doc['title_phonetic']) ? $doc['title_phonetic'] : $doc['per_title']; ?></td>
                    <td><?= $userModel->find($doc['amr_id'])['Username']; ?></td>
                    <td>
                        <form action="<?= site_url('cataloguer/approve/'.$doc['id'].'/'.$doc['type']); ?>" method="post" class="d-inline">
                            <input type="text" name="remark" class="form-control" placeholder="Enter remark">
                    </td>
                    <td>
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="<?= site_url('cataloguer/reject/'.$doc['id'].'/'.$doc['type']); ?>" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                        <a href="<?= site_url('cataloguer/view_pdf/'.$doc['id'].'/'.$doc['type']); ?>" class="btn btn-info btn-sm">View PDF</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
