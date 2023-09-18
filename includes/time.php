<?php
session_start();
$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userid = $_SESSION['userid'];
$date = date("Y-m-d");

$query = "UPDATE userPlants SET lastWatered='$date' WHERE UsersId=$userid";

if (!mysqli_query($conn, $query)) {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

header('Location: ../pages/menu');
exit;


?>