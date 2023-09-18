<?php

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';



if (isset($_POST["signup"])) {

    $email = $_POST["email"];
    $name = $_POST["name"];
    $pwd = $_POST["pwd"];

    date_default_timezone_set("Asia/Baku");
	$time = date('Y-m-d H:i:s');

    require_once 'dbh.php';
    require_once 'functions.php';

    
    $select = mysqli_query($conn, "SELECT * FROM users WHERE usersEmail = '".$_POST['email']."'");
    if (mysqli_num_rows($select)) {
        header("location: ../index.php?error=thisemailistaken");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../index.php?error=invalidemail");
        exit();
    }
    
    if (uidExists($conn, $email) !== false) {
        header("location: ../index.php?error=emailtakened");
        exit();
    }
    


    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'eva@farmium.co';                     //SMTP username
    $mail->Password   = '12345678';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('eva@farmium.co', 'Eva Gadz');
    $mail->addAddress('eva.gadzhieva@gmail.com', 'Eva Gadzhieva');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New User';
    $mail->Body    = $_POST['name'].' just signed up!';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




    createUser($conn, $name, $email, $pwd);
}
/*
else {
    header("location: ../index.php");
    exit();
}*/
