<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($_SESSION['department']) ? $_SESSION['department'] : 'Admin';  ?> Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"
            href="#"><?= !empty($_SESSION['department']) ? $_SESSION['username'] . " " . $_SESSION['department'] : 'Admin';  ?>
            Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                echo !empty($_SESSION['department']) ? '<li class="nav-item">
                    <a class="nav-link" href="<?= site_url(); ?>/amr/menu">Menu</a>
                </li>' : '';
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url(); ?>/logout">Logout</a>
                </li>`
            </ul>
        </div>
    </nav>

    <main id="main">
        <!-- Page Content Start Here -->
        <?= $this->renderSection("content"); ?>
        <!-- Page Content End Here -->
    </main>
    <hr>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>