<?= $this->extend("layouts/base"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <h1>Catalogue</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Title</th>
                <th>Author/Publisher</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $printDocumentRow = function ($doc, $type) {
                $title = $type === 'periodical' ? $doc['per_title'] : $doc['title_phonetic'];
                $author = $type === 'periodical' ? $doc['publisher'] : $doc['author_phonetic'];
                echo "<tr>
                    <td>{$doc['id']}</td>
                    <td>" . ucfirst($type) . "</td>
                    <td>{$title}</td>
                    <td>{$author}</td>
                </tr>";
            };

            if (empty($manuscripts) && empty($rare_books) && empty($catalogues) && empty($periodicals)) {
                echo '<tr><td colspan="4">No published documents found.</td></tr>';
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
<?= $this->endSection(); ?>
