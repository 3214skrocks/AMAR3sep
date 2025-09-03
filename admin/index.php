<?php
session_start();

// Function to increment visitor count
function incrementVisitorCount() {
    $countFile = 'visitor_count.txt';
    if (!file_exists($countFile)) {
        if (!file_put_contents($countFile, 1000)) {
            echo "Failed to create count file.";
            exit();
        }
    }
    $count = (int)file_get_contents($countFile);
    if ($count === false) {
        echo "Failed to read count file.";
        exit();
    }
    $count++;
    if (!file_put_contents($countFile, $count)) {
        echo "Failed to update count file.";
        exit();
    }
    return $count;
}

// Get visitor count
$visitorCount = incrementVisitorCount();

// MySQL database connection
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "amar";

$error = ''; // Initialize error variable

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if the user is already logged in
    if (isset($_SESSION['username'])) {
        redirectToDashboard($_SESSION['department']);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $department = $_POST['department'];
        $sql = "SELECT * FROM users WHERE Username=? AND Password=? AND Department=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $department);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Store user session variables
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['department'] = $user['Department'];

            // Redirect based on department
            redirectToDashboard($department);
        } else {
            $error = "Invalid username, password, or department";
        }
    }
} catch (Exception $e) {
    echo "Error connecting to MySQL: " . $e->getMessage();
    exit();
} finally {
    $conn->close();
}

// Function to redirect users based on department
function redirectToDashboard($department) {
    switch ($department) {
        case 'Admin':
            header('Location: admin_dashboard.php');
            exit();
        case 'Supervisor':
            header('Location: supervisor.php');
            exit();
        case 'AMR':
            header('Location: upload.php');
            exit();
        case 'Cataloguer':
            header('Location: approve.php');
            exit();
        default:
            header('Location: search.php');
            exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Multiple movable backgrounds */
        body {
            overflow: hidden; /* Prevents scrolling */
            background: url('nmms.jpg') center fixed; /* Initial background image */
            background-size: cover;
            animation: backgroundAnimation 10s infinite linear; /* Adjust the duration and timing function as needed */
            padding-top: 100px; /* Adjust the top padding to center the form */
        }

        @keyframes backgroundAnimation {
            0% {
                background-image: url('nmms.jpg'), url('nmms1.jpg'), url('nmms2.jpg'), url('nmms3.png');
            }
            25% {
                background-image: url('nmms1.jpg'), url('nmms2.jpg'), url('nmms3.png'), url('nmms.jpg');
            }
            50% {
                background-image: url('nmms2.jpg'), url('nmms3.png'), url('nmms.jpg'), url('nmms1.jpg');
            }
            75% {
                background-image: url('nmms3.png'), url('nmms.jpg'), url('nmms1.jpg'), url('nmms2.jpg');
            }
            100% {
                background-image: url('nmms.jpg'), url('nmms1.jpg'), url('nmms2.jpg'), url('nmms3.png');
            }
        }

        /* Other styles */
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
        /* Add any other styles you need */
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error)) { echo "<p class='error-msg'>$error</p>"; } ?>
        <div class="visitor-count">
            <span>Visitor Count:</span>
            <span class="badge badge-primary"><?php echo $visitorCount; ?></span>
        </div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
            <a href="Home.php" class="btn btn-success btn-guest">Guest User</a> <!-- Guest User button -->
        </form>
    </div>

    <!-- JavaScript to handle session and prevent back button issues -->
    <script>
        // Prevent session issues on back button click
        window.onbeforeunload = function() {
            <?php session_destroy(); ?>
        };
    </script>
</body>
</html>
