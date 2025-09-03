<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            overflow: hidden; /* Prevents scrolling */
            background: url('<?=base_url(); ?>/admin/nmms.jpg') center fixed; /* Initial background image */
            background-size: cover;
            animation: backgroundAnimation 10s infinite linear; /* Adjust the duration and timing function as needed */
            padding-top: 100px; /* Adjust the top padding to center the form */
        }

        @keyframes backgroundAnimation {
            0% {
                background-image: url('<?=base_url(); ?>/admin/nmms.jpg'), url('<?=base_url(); ?>/admin/nmms1.jpg'), url('<?=base_url(); ?>/admin/nmms2.jpg'), url('<?=base_url(); ?>/admin/nmms3.png');
            }
            25% {
                background-image: url('<?=base_url(); ?>/admin/nmms1.jpg'), url('<?=base_url(); ?>/admin/nmms2.jpg'), url('<?=base_url(); ?>/admin/nmms3.png'), url('<?=base_url(); ?>/admin/nmms.jpg');
            }
            50% {
                background-image: url('<?=base_url(); ?>/admin/nmms2.jpg'), url('<?=base_url(); ?>/admin/nmms3.png'), url('<?=base_url(); ?>/admin/nmms.jpg'), url('<?=base_url(); ?>/admin/nmms1.jpg');
            }
            75% {
                background-image: url('<?=base_url(); ?>/admin/nmms3.png'), url('<?=base_url(); ?>/admin/nmms.jpg'), url('<?=base_url(); ?>/admin/nmms1.jpg'), url('<?=base_url(); ?>/admin/nmms2.jpg');
            }
            100% {
                background-image: url('<?=base_url(); ?>/admin/nmms.jpg'), url('<?=base_url(); ?>/admin/nmms1.jpg'), url('<?=base_url(); ?>/admin/nmms2.jpg'), url('<?=base_url(); ?>/admin/nmms3.png');
            }
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background for better readability */
        }
        .form-group {
            margin-bottom: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-login {
            width: 100%;
        }
        .btn-guest {
            width: 100%;
            margin-top: 10px;
        }
        .error-msg {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= site_url('/admin/authenticate') ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control" id="department" name="department" required>
                    <option value="Admin">Admin</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="AMR">AMR</option>
                    <option value="Registrar">Registrar</option>
                    <option value="Cataloguer">Cataloguer</option>
                    <!-- Add more options for other departments as needed -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-login">Login</button>
            <a href="<?= site_url("/home"); ?>" class="btn btn-success btn-guest">Guest User</a> <!-- Guest User button -->
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
