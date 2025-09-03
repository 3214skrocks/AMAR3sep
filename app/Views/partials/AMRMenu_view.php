<?= $this->extend("layouts/adminbase"); ?>
<?= $this->section("content"); ?>
<div class="container amr-menu">
    <h1 class="menu-title">AMR Menu</h1>
    <ul class="list-group">
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/manuscript">Manuscript</a></li>
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/rareBooks">Rare Books</a></li>
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/catalogues">Catalogues</a></li>
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/periodicals">Periodicals</a></li>
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/statuswisedata/1">Approved / Published</a></li>
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/statuswisedata/2">Rejected</a></li>
        <li class="list-group-item"><a href="<?= site_url(); ?>/amr/statuswisedata/3">Rejected by Cataloguer</a></li>
    </ul>
</div>
<?= $this->endSection(); ?>

<!-- Updated and more attractive CSS -->
<style>
/* General container for AMR Menu */
.amr-menu {
    max-width: 700px;
    margin: 30px auto;
    padding: 30px;
    background-color: #f4f6f9;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Menu title with modern font and color */
.menu-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    color: #007bff;
    margin-bottom: 30px;
    letter-spacing: 1px;
}

/* Styling for the list group */
.list-group-item {
    background-color: #28a745;
    color: white;
    border: none;
    margin: 8px 0;
    padding: 12px;
    font-size: 1.2rem;
    border-radius: 10px;
    transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
}

/* Styling for the links inside the list group items */
.list-group-item a {
    color: white;
    text-decoration: none;
    font-weight: 600;
    display: block;
    padding: 10px 15px;
}

/* Hover effect for list group items */
.list-group-item:hover {
    transform: translateY(-5px);
    background-color: #218838;
    box-shadow: 0 10px 25px rgba(0, 128, 0, 0.2);
}

/* Hover effect for the links */
.list-group-item a:hover {
    color: #f8f9fa;
}

/* Mobile responsiveness */
@media (max-width: 576px) {
    .amr-menu {
        padding: 20px;
    }

    .menu-title {
        font-size: 2rem;
    }

    .list-group-item {
        font-size: 1.1rem;
        padding: 10px;
    }
}
</style>