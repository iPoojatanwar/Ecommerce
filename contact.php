<?php
require "connection.php";
include "./HEADER/header.html";

$fname = $mail = $subject = $tarea = "";
$err_fname = $err_mail = $err_subject = $err_tarea = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = trim($_POST['fname']);
    $mail = trim($_POST['mail']);
    $subject = trim($_POST['subject']);
    $tarea = trim($_POST['tarea']);

    
    if (empty($fname)) {
        $err_fname = "Enter your full name.";
    }

    
    if (empty($mail)) {
        $err_mail = "Enter your email ";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $err_mail = "Invalid email format.";
    }

    
    if (empty($subject)) {
        $err_subject = "Enter the subject.";
    }


    if (empty($tarea)) {
        $err_tarea = "Enter your message.";
    }


    if (empty($err_fname) && empty($err_mail) && empty($err_subject) && empty($err_tarea)) {
        
        $stmt = $database_conn->prepare("INSERT INTO feedback (name, mail, subject, textarea) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $mail, $subject, $tarea);

        if ($stmt->execute()) {
            $fname = $mail = $subject = $tarea = ""; 

        } else {
            echo "Error: " . $stmt->error;
        }

           
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>

    form {
        box-shadow: 1px 1px 12px slategray;
        padding: 62px 42px;
        border-radius: 12px;
        color: black;
    }
    .fa-pen, .fa-message, .fa, .fa-envelope {
        color: #3674B5;
        padding: 2px;
        font-size: 15px;
    }
    .btn {
        background-color: #3674B5 !important;
    }
    .err {
        color: red;
    }
</style>
<body>
    <div class="container">
    <div class="container py-5 m-12 ">
        <form action="" method="POST">
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="fname" class="form-label"><i class="fa-solid fa-user fa"></i>Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your full name" value="<?php echo htmlspecialchars($fname); ?>">
                        <div class="err"><?php echo $err_fname; ?></div>
                    </div>
                    <div class="col mb-3">
                        <label for="mail" class="form-label"><i class="fa-solid fa-envelope"></i>Email address</label>
                        <input type="email" class="form-control" name="mail" id="mail" placeholder="Email" value="<?php echo htmlspecialchars($mail); ?>">
                        <div class="err"><?php echo $err_mail; ?></div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label"><i class="fa-solid fa-pen"></i>Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?php echo htmlspecialchars($subject); ?>">
                <div class="err"><?php echo $err_subject; ?></div>
            </div>

            <div class="mb-3">
                <label for="tarea" class="form-label"><i class="fa-solid fa-message"></i>Message</label>
                <textarea class="form-control" name="tarea" id="tarea" rows="12" placeholder="Write your message..."><?php echo htmlspecialchars($tarea); ?></textarea>
                <div class="err"><?php echo $err_tarea; ?></div>
            </div>

            <center><button type="submit" class="btn" >Submit</button></center>
        </form>
    </div>
    <?php if (empty($err_fname) && empty($err_mail) && empty($err_subject) && empty($err_tarea)): ?>
        <span class="bg-black fs-2 p-4 mx-4 text-light border">Thank you for your feedback😊😊</span>
        <?php else: ?>
    <span class="bg-black fs-2 p-4 mx-4 text-light border">Please complete  the form😔</span>
<?php endif; ?>
    </div>
</body>
</html>

<?php
include "./FOOTER/footer.html";
?>
