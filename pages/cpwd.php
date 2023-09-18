<?php

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

    $input = $_POST['input'];

    $id = $_POST['id'];

    $hashedPwd = password_hash($input, PASSWORD_DEFAULT);


    $query = "UPDATE users SET usersPwd='$hashedPwd' WHERE usersId = $id";
    $result = $conn->query($query);
     $conn->close();