<?php
include "header.html";
require "connection.php";


$mail = $password = '';
$err_mail = $err_password = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = $_POST['mail'];
    $password = $_POST['pasword'];

    
    if (empty($mail)) {
        $err_mail = "Email is required.";
    }
    if (empty($password)) {
        $err_password = "Password is required.";
    }

    if (empty($err_mail) && empty($err_password)) {
       
        $stmt = $database_conn->prepare("SELECT * FROM tdata WHERE E_mail = ?");
        $stmt->bind_param("s", $mail);
        
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && mysqli_num_rows($result) > 0) {
            $hello = mysqli_fetch_assoc($result);

        
            if ($hello['E_mail'] == $mail && $hello['Pasword'] == $password) {
                session_start();
                $_SESSION['name'] = $hello['First_name'];

                $database_conn->close();
                header("location: home.php");
                exit();
            } else {
                echo "Incorrect Password";
            }
        } else {
            echo "Wrong Email";
        }

        $database_conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: monospace;
            background-color:#D0DDD0 !important;
        }

        .b {
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background-color: white;
            max-width: 400px;
            margin-top: 80px;
            margin-bottom: 11%;
        }

        h2 {
            color: #6a1b9a;
            font-weight: 700;
            font-size: 2.5rem;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #6a1b9a;
            border-color: #6a1b9a;
            font-size: 1.1rem;
            padding: 12px 20px;
            width: 100%;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #9c27b0;
            border-color: #9c27b0;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .text-center {
            font-size: 1rem;
        }

        .text-center a {
            color: #6a1b9a;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            color: #9c27b0;
        }
    </style>
</head>

<body>

    <div class="container b  w-25">
        <h2 class="text-center mt-4 mb-4">Login</h2>
    
            
        <form action="" method="POST">

            <div class="mb-3">
                <label for="mail" class="form-label">Email:</label>
                <input type="email" class="form-control" id="mail" name="mail" placeholder="Enter your email" value="<?php echo htmlspecialchars($mail); ?>">
                <div class="error"><?php echo isset($err_mail) ? $err_mail : ''; ?></div>
            </div>

            <div class="mb-3">
                <label for="pasword" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pasword" name="pasword" placeholder="Enter your password">
                <div class="error"><?php echo isset($err_password) ? $err_password : ''; ?></div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="text-center mt-3">
                Don't have an account? <a href="Sign-Up.php">Sign Up</a>
            </div>
        </form>
           
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php
include "footer.html"
?>