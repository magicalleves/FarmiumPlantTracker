<?php

session_start(); 

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

if ($mysqli->connect_error) {
  die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Get the percentage from the POST data
$today = date("Y-m-d");
$healthcheck = $_POST['percentage'];


$sql = "UPDATE userPlants SET last_healthcheck = '$today', healthcheck = '$healthcheck' WHERE UsersId = '$userid'";
  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();

?>