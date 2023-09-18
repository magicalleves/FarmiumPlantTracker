<?php

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

    $input = $_POST['input'];

    $id = $_POST['id'];

    $query = "UPDATE users SET usersName='$input' WHERE usersId = $id";
    $result = $conn->query($query);
     $conn->close();