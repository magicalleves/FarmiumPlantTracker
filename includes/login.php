<?php 

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");


if (isset($_POST["login"])) {

$email = $_POST["email"];
$pwd = $_POST["pwd"];

$current_time = time();

require_once 'dbh.php';
require_once 'functions.php';


if (emptyInputLogin($email, $pwd) !== false) {
    header("location: ../index.php?error=emptyinput");
    exit();
}



$quer = "UPDATE users SET last_login = '$current_time' WHERE usersEmail = '$email'";
$resu = $conn->query($quer);

loginUser($conn, $email, $pwd);
}