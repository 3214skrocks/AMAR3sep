<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>

<div class="container-fluid">
    <h1>Workflow Dashboard</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Title</th>
                <th>Status</th>
                <th>AMR</th>
                <th>Cataloguer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $documents = array_merge(
                array_map(function($m) { $m['type'] = 'Manuscript'; $m['model'] = 'Manuscript'; return $m; }, $manuscripts),
                array_map(function($r) { $r['type'] = 'Rare Book'; $r['model'] = 'Rare Book'; return $r; }, $rarebooks),
                array_map(function($c) { $c['type'] = 'Catalogue'; $c['model'] = 'Catalogue'; return $c; }, $catalogues),
                array_map(function($p) { $p['type'] = 'Periodical'; $p['model'] = 'Periodical'; return $p; }, $periodicals)
            );

            $userModel = new \App\Models\UserModel();
            $cataloguers = $userModel->getCataloguers();
            ?>

            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><?= $doc['type']; ?></td>
                    <td><?= isset($doc['title_phonetic']) ? $doc['title_phonetic'] : $doc['per_title']; ?></td>
                    <td><?= $doc['status']; ?></td>
                    <td><?= $userModel->find($doc['amr_id'])['Username']; ?></td>
                    <td><?= $userModel->find($doc['cataloguer_id'])['Username']; ?></td>
                    <td>
                        <!-- Re-assign Form -->
                        <form action="<?= site_url('/admin/reassign_document'); ?>" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $doc['id']; ?>">
                            <input type="hidden" name="model" value="<?= $doc['model']; ?>">
                            <select name="cataloguer_id" class="form-control" style="width: 150px; display: inline;">
                                <?php foreach ($cataloguers as $cataloguer): ?>
                                    <option value="<?= $cataloguer['id']; ?>" <?= ($doc['cataloguer_id'] == $cataloguer['id']) ? 'selected' : ''; ?>>
                                        <?= $cataloguer['Username']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-sm btn-info">Re-assign</button>
                        </form>

                        <!-- Approve Form -->
                        <form action="<?= site_url('/admin/approve_document'); ?>" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $doc['id']; ?>">
                            <input type="hidden" name="model" value="<?= $doc['model']; ?>">
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>

                        <!-- Reject Form -->
                        <form action="<?= site_url('/admin/reject_document'); ?>" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $doc['id']; ?>">
                            <input type="hidden" name="model" value="<?= $doc['model']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>
