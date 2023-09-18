<?php

session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

if (!isset($_SESSION["userid"])) {
    echo "<script> alert('Please log in first!')
    window.location.replace('../index'); </script>";
} 


$sql = "SELECT plant_named, plant_type, lastWatered FROM userPlants WHERE UsersId = $userid";
  $result = mysqli_query($conn, $sql);

  // Check if there are any results
  if (mysqli_num_rows($result) > 0) {

    // Loop through the results and display the plant name and date of last watered
    while($row = mysqli_fetch_assoc($result)) {
      $plantType = $row['plant_type'];
      $lastW = $row['lastWatered'];
      $plantName = $row['plant_named'];
    }

  }

  header("Location: save2.php");


?>