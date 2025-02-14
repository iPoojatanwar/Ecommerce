<?php
require "connection.php";
include "./HEADER/header.html";

$first_name = $last_name = $mail = $phone_number = $password = $confirm_password = "";
$err_first_name = $err_last_name = $err_mail = $err_phone_number = $err_pasword = $err_confirm_pasword = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $mail = $_POST['mail'];
    $phone_number = $_POST['phone-number'];
    $pasword = $_POST['pasword'];
    $confirm_pasword = $_POST['confirm-pasword'];

    if (empty($first_name)) {
        $err_first_name = "First name is empty";
    }

    if (empty($last_name)) {
        $err_last_name = "Last name is required";
    } 

    if (empty($mail)) {
        $err_mail = "Email is required";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $mail)) {
        $err_mail = "Invalid email format";
    }

    if (empty($phone_number)) {
        $err_phone_number = "Phone number is required";
    } 

    if (empty($pasword)) {
        $err_pasword = "Password is required";
    } elseif (strlen($password) < 6) {
        $err_pasword = "Password must be at least 6 characters";
    }

    if (empty($confirm_pasword)) {
        $err_confirm_password = "Confirm password is required";
    } elseif ($pasword !== $confirm_pasword) {
        $err_confirm_password = "Passwords do not match";
    }

    if (empty($err_first_name) && empty($err_last_name) && empty($err_mail) && empty($err_phone_number)  && empty($err_confirm_pasword)) {
        $insert_data = "INSERT INTO tdata (
            First_name,
            Last_name,
            E_mail,
            Phone_no,
            Pasword
        ) VALUES (
            '$first_name',
            '$last_name',
            '$mail',
            '$phone_number',
            '$confirm_pasword'
        )";

        $result = mysqli_query($database_conn, $insert_data);
        echo $result ? "Registration successful!" : "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
           
            font-family: monospace;
            font-size: 18px;
            background-color:#D0DDD0 !important;
        
        }

        .c {
            background:white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
            max-width: 600px;
            width: 100%;
        }

        h2 {
            color:purple;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 2rem;
            text-align: center;
            font-weight: bold;
        }

        .form-label {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            background-color:rgba(224, 224, 224, 0.14);
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #9c27b0;
            box-shadow: 0 0 5px rgba(156, 39, 176, 0.5);
        }

        .btn-primary {
            background-color: #9c27b0;
            border-color: #9c27b0;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6a1b9a;
            border-color: #6a1b9a;
        }

        .error {
            color: #f44336;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .success-message {
            color: #4caf50;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 1rem;
            color:black;
        }

        .footer a {
            color: purple;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .form-control, .btn-primary {
            transition: all 0.3s ease;
        }

        .form-control:focus, .btn-primary:hover {
            transform: scale(1.05);
        }

    </style>
</head>
<body>

<div class="container c w-50  my-4">
    <h2>Registration Form</h2>
    <form action="" method="POST" >
        <div class="md-4 mb-3">
            <label for="first-name" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first-name" name="first-name" value="">
            <div class="error"><?php echo $err_first_name; ?></div>
        </div>

        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last-name" name="last-name" value="">
            <div class="error"><?php echo $err_last_name; ?></div>
        </div>

        <div class="mb-3">
            <label for="mail" class="form-label">Email:</label>
            <input type="email" class="form-control" id="mail" name="mail" value="">
            <div class="error"><?php echo $err_mail; ?></div>
        </div>

        <div class="mb-3">
            <label for="phone-number" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" id="phone-number" name="phone-number" value="">
            <div class="error"><?php echo $err_phone_number; ?></div>
        </div>

        <div class="mb-3">
            <label for="pasword" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pasword" name="pasword" value="">
            <div class="error"><?php echo $err_pasword; ?></div>
        </div>

        <div class="mb-3">
            <label for="confirm-pasword" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm-pasword" name="confirm-pasword" value="">
            <div class="error"><?php echo $err_confirm_pasword; ?></div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        <?php
        if (isset($result) && $result) {
            echo '<div class="success-message text-center mt-3">Registration successful!</div>';
        }
        ?>
    </form>

    <div class="footer text-center">
        Already have an account? <a href="sign-in.php">Log in</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include "./FOOTER/footer.html"
?>