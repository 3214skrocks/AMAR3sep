<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>

<div class="container">
    <h1>AMR Status View</h1>

    <?php if (!empty($data['data_manuscript']) || !empty($data['data_rarebook']) || !empty($data['data_catalogue']) || !empty($data['data_periodical'])): ?>

    <?php if (!empty($data['data_manuscript'])): ?>
    <h2>Manuscripts</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data_manuscript'] as $item): ?>
            <tr>
                <td><?= $item['title_phonetic']; ?></td>
                <td><?= $item['author_phonetic']; ?></td>
                <td><?= $item['status']; ?></td>
                <td><a href="<?= site_url('/amr/viewpdf/'.$item['file_path']); ?>" class="btn btn-info">View PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <?php if (!empty($data['data_rarebook'])): ?>
    <h2>Rare Books</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data_rarebook'] as $item): ?>
            <tr>
                <td><?= $item['title_phonetic']; ?></td>
                <td><?= $item['author_phonetic']; ?></td>
                <td><?= $item['status']; ?></td>
                <td><a href="<?= site_url('/amr/viewpdf/'.$item['file_path']); ?>" class="btn btn-info">View PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <?php if (!empty($data['data_catalogue'])): ?>
    <h2>Catalogues</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data_catalogue'] as $item): ?>
            <tr>
                <td><?= $item['title_phonetic']; ?></td>
                <td><?= $item['author_phonetic']; ?></td>
                <td><?= $item['status']; ?></td>
                <td><a href="<?= site_url('/amr/viewpdf/'.$item['file_path']); ?>" class="btn btn-info">View PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <?php if (!empty($data['data_periodical'])): ?>
    <h2>Periodicals</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['data_periodical'] as $item): ?>
            <tr>
                <td><?= $item['per_title']; ?></td>
                <td><?= $item['publisher']; ?></td>
                <td><?= $item['status']; ?></td>
                <td><a href="<?= site_url('/amr/viewpdf/'.$item['file_path']); ?>" class="btn btn-info">View PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <?php else: ?>
    <p>No records available for this status.</p>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>