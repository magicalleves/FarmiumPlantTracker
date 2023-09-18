<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


session_start();


$userid = $_SESSION['usersid'];

echo $userid;


    // Connect to database
    $conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get email from JavaScript
    $email = $_POST['email'];

    // Generate random temporary password
    $temp_password = bin2hex(random_bytes(4));

    $hashedPwd = password_hash($temp_password, PASSWORD_DEFAULT);

    // Insert temporary passwo$rd into database
    $sql = "UPDATE users SET usersPwd='$hashedPwd' WHERE usersEmail='$email'";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }




    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'no-reply@farmium.co';                     //SMTP username
        $mail->Password   = 'Meow123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('no-reply@farmium.co', 'Farmium');
        $mail->addAddress( $email, 'User');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password reset';
        $mail->Body    = 'Here is your temporary password: <b>' . $temp_password . '</b><br>Please make sure to reset your password in the settings tab once youre logged in!';
        $mail->AltBody = 'Here is your temporary password: <b>' . $temp_password . '</b><br>Please make sure to reset your password in the settings tab once youre logged in!';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    // Close connection
    $conn->close();

