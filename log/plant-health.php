<?php
session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

if (!isset($_SESSION["userid"])) {
  echo "<script> alert('Please log in first!')
  window.location.replace('../index'); </script>";
} 

if (isset($_POST['deletePlant'])) {
    $deletePlant = $_POST['deletePlant'];

    switch($deletePlant) {
        case 'deletePlant';
        deletePlant();
        break;
    default:
        break;
    }
}

function deletePlant() {
    $conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");
    $userid = $_SESSION['userid'];
    $sql = "DELETE FROM userPlants WHERE usersId = $userid";

    mysqli_query($conn, $sql);  
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



  // Close the database connection
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Farmium</title>
        <style>
            html, body {
                overflow-y: visible;
            }
            .plant {
                position: relative;
            }

            #plant-score-percentage {
              color: #3D4D43; font-size: 27px; font-weight: 600; margin-top: 1vh;
            }
        
            .dele {
                color: red;
                cursor: pointer;
                text-decoration: underline;
                font-size: 14px;
                font-weight: 100;
                position: absolute;
                right: 60px;
                bottom: 20%;
            }

            .ko-progress-circle {
            margin: 20px auto;
            width: 120px;
            height: 120px;
            background-color: #d9d9d9;
            border-radius: 50%;
          }
          .ko-progress-circle .ko-progress-circle__slice, .ko-progress-circle .ko-progress-circle__fill {
            width: 120px;
            height: 120px;
            position: absolute;
            -webkit-backface-visibility: hidden;
            transition: transform 1s;
            border-radius: 50%;
          }
          .ko-progress-circle .ko-progress-circle__slice {
            clip: rect(0px, 120px, 120px, 60px);
          }
          .ko-progress-circle .ko-progress-circle__slice .ko-progress-circle__fill {
            clip: rect(0px, 60px, 120px, 0px);
            background-color: #3D4D43;
          }
          .ko-progress-circle .ko-progress-circle__overlay {
            width: 105px;
            height: 105px;
            position: absolute;
            margin-left: 7.5px;
            margin-top: 7.5px;
            background-color: #fbfbfb;
            border-radius: 50%;
          }
          .ko-progress-circle[data-progress="0"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="0"] .ko-progress-circle__fill {
            transform: rotate(0deg);
          }
          .ko-progress-circle[data-progress="0"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(0deg);
          }
          .ko-progress-circle[data-progress="1"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="1"] .ko-progress-circle__fill {
            transform: rotate(1.8deg);
          }
          .ko-progress-circle[data-progress="1"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(3.6deg);
          }
          .ko-progress-circle[data-progress="2"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="2"] .ko-progress-circle__fill {
            transform: rotate(3.6deg);
          }
          .ko-progress-circle[data-progress="2"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(7.2deg);
          }
          .ko-progress-circle[data-progress="3"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="3"] .ko-progress-circle__fill {
            transform: rotate(5.4deg);
          }
          .ko-progress-circle[data-progress="3"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(10.8deg);
          }
          .ko-progress-circle[data-progress="4"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="4"] .ko-progress-circle__fill {
            transform: rotate(7.2deg);
          }
          .ko-progress-circle[data-progress="4"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(14.4deg);
          }
          .ko-progress-circle[data-progress="5"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="5"] .ko-progress-circle__fill {
            transform: rotate(9deg);
          }
          .ko-progress-circle[data-progress="5"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(18deg);
          }
          .ko-progress-circle[data-progress="6"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="6"] .ko-progress-circle__fill {
            transform: rotate(10.8deg);
          }
          .ko-progress-circle[data-progress="6"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(21.6deg);
          }
          .ko-progress-circle[data-progress="7"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="7"] .ko-progress-circle__fill {
            transform: rotate(12.6deg);
          }
          .ko-progress-circle[data-progress="7"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(25.2deg);
          }
          .ko-progress-circle[data-progress="8"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="8"] .ko-progress-circle__fill {
            transform: rotate(14.4deg);
          }
          .ko-progress-circle[data-progress="8"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(28.8deg);
          }
          .ko-progress-circle[data-progress="9"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="9"] .ko-progress-circle__fill {
            transform: rotate(16.2deg);
          }
          .ko-progress-circle[data-progress="9"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(32.4deg);
          }
          .ko-progress-circle[data-progress="10"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="10"] .ko-progress-circle__fill {
            transform: rotate(18deg);
          }
          .ko-progress-circle[data-progress="10"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(36deg);
          }
          .ko-progress-circle[data-progress="11"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="11"] .ko-progress-circle__fill {
            transform: rotate(19.8deg);
          }
          .ko-progress-circle[data-progress="11"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(39.6deg);
          }
          .ko-progress-circle[data-progress="12"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="12"] .ko-progress-circle__fill {
            transform: rotate(21.6deg);
          }
          .ko-progress-circle[data-progress="12"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(43.2deg);
          }
          .ko-progress-circle[data-progress="13"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="13"] .ko-progress-circle__fill {
            transform: rotate(23.4deg);
          }
          .ko-progress-circle[data-progress="13"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(46.8deg);
          }
          .ko-progress-circle[data-progress="14"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="14"] .ko-progress-circle__fill {
            transform: rotate(25.2deg);
          }
          .ko-progress-circle[data-progress="14"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(50.4deg);
          }
          .ko-progress-circle[data-progress="15"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="15"] .ko-progress-circle__fill {
            transform: rotate(27deg);
          }
          .ko-progress-circle[data-progress="15"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(54deg);
          }
          .ko-progress-circle[data-progress="16"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="16"] .ko-progress-circle__fill {
            transform: rotate(28.8deg);
          }
          .ko-progress-circle[data-progress="16"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(57.6deg);
          }
          .ko-progress-circle[data-progress="17"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="17"] .ko-progress-circle__fill {
            transform: rotate(30.6deg);
          }
          .ko-progress-circle[data-progress="17"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(61.2deg);
          }
          .ko-progress-circle[data-progress="18"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="18"] .ko-progress-circle__fill {
            transform: rotate(32.4deg);
          }
          .ko-progress-circle[data-progress="18"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(64.8deg);
          }
          .ko-progress-circle[data-progress="19"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="19"] .ko-progress-circle__fill {
            transform: rotate(34.2deg);
          }
          .ko-progress-circle[data-progress="19"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(68.4deg);
          }
          .ko-progress-circle[data-progress="20"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="20"] .ko-progress-circle__fill {
            transform: rotate(36deg);
          }
          .ko-progress-circle[data-progress="20"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(72deg);
          }
          .ko-progress-circle[data-progress="21"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="21"] .ko-progress-circle__fill {
            transform: rotate(37.8deg);
          }
          .ko-progress-circle[data-progress="21"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(75.6deg);
          }
          .ko-progress-circle[data-progress="22"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="22"] .ko-progress-circle__fill {
            transform: rotate(39.6deg);
          }
          .ko-progress-circle[data-progress="22"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(79.2deg);
          }
          .ko-progress-circle[data-progress="23"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="23"] .ko-progress-circle__fill {
            transform: rotate(41.4deg);
          }
          .ko-progress-circle[data-progress="23"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(82.8deg);
          }
          .ko-progress-circle[data-progress="24"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="24"] .ko-progress-circle__fill {
            transform: rotate(43.2deg);
          }
          .ko-progress-circle[data-progress="24"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(86.4deg);
          }
          .ko-progress-circle[data-progress="25"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="25"] .ko-progress-circle__fill {
            transform: rotate(45deg);
          }
          .ko-progress-circle[data-progress="25"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(90deg);
          }
          .ko-progress-circle[data-progress="26"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="26"] .ko-progress-circle__fill {
            transform: rotate(46.8deg);
          }
          .ko-progress-circle[data-progress="26"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(93.6deg);
          }
          .ko-progress-circle[data-progress="27"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="27"] .ko-progress-circle__fill {
            transform: rotate(48.6deg);
          }
          .ko-progress-circle[data-progress="27"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(97.2deg);
          }
          .ko-progress-circle[data-progress="28"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="28"] .ko-progress-circle__fill {
            transform: rotate(50.4deg);
          }
          .ko-progress-circle[data-progress="28"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(100.8deg);
          }
          .ko-progress-circle[data-progress="29"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="29"] .ko-progress-circle__fill {
            transform: rotate(52.2deg);
          }
          .ko-progress-circle[data-progress="29"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(104.4deg);
          }
          .ko-progress-circle[data-progress="30"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="30"] .ko-progress-circle__fill {
            transform: rotate(54deg);
          }
          .ko-progress-circle[data-progress="30"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(108deg);
          }
          .ko-progress-circle[data-progress="31"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="31"] .ko-progress-circle__fill {
            transform: rotate(55.8deg);
          }
          .ko-progress-circle[data-progress="31"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(111.6deg);
          }
          .ko-progress-circle[data-progress="32"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="32"] .ko-progress-circle__fill {
            transform: rotate(57.6deg);
          }
          .ko-progress-circle[data-progress="32"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(115.2deg);
          }
          .ko-progress-circle[data-progress="33"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="33"] .ko-progress-circle__fill {
            transform: rotate(59.4deg);
          }
          .ko-progress-circle[data-progress="33"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(118.8deg);
          }
          .ko-progress-circle[data-progress="34"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="34"] .ko-progress-circle__fill {
            transform: rotate(61.2deg);
          }
          .ko-progress-circle[data-progress="34"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(122.4deg);
          }
          .ko-progress-circle[data-progress="35"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="35"] .ko-progress-circle__fill {
            transform: rotate(63deg);
          }
          .ko-progress-circle[data-progress="35"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(126deg);
          }
          .ko-progress-circle[data-progress="36"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="36"] .ko-progress-circle__fill {
            transform: rotate(64.8deg);
          }
          .ko-progress-circle[data-progress="36"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(129.6deg);
          }
          .ko-progress-circle[data-progress="37"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="37"] .ko-progress-circle__fill {
            transform: rotate(66.6deg);
          }
          .ko-progress-circle[data-progress="37"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(133.2deg);
          }
          .ko-progress-circle[data-progress="38"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="38"] .ko-progress-circle__fill {
            transform: rotate(68.4deg);
          }
          .ko-progress-circle[data-progress="38"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(136.8deg);
          }
          .ko-progress-circle[data-progress="39"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="39"] .ko-progress-circle__fill {
            transform: rotate(70.2deg);
          }
          .ko-progress-circle[data-progress="39"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(140.4deg);
          }
          .ko-progress-circle[data-progress="40"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="40"] .ko-progress-circle__fill {
            transform: rotate(72deg);
          }
          .ko-progress-circle[data-progress="40"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(144deg);
          }
          .ko-progress-circle[data-progress="41"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="41"] .ko-progress-circle__fill {
            transform: rotate(73.8deg);
          }
          .ko-progress-circle[data-progress="41"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(147.6deg);
          }
          .ko-progress-circle[data-progress="42"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="42"] .ko-progress-circle__fill {
            transform: rotate(75.6deg);
          }
          .ko-progress-circle[data-progress="42"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(151.2deg);
          }
          .ko-progress-circle[data-progress="43"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="43"] .ko-progress-circle__fill {
            transform: rotate(77.4deg);
          }
          .ko-progress-circle[data-progress="43"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(154.8deg);
          }
          .ko-progress-circle[data-progress="44"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="44"] .ko-progress-circle__fill {
            transform: rotate(79.2deg);
          }
          .ko-progress-circle[data-progress="44"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(158.4deg);
          }
          .ko-progress-circle[data-progress="45"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="45"] .ko-progress-circle__fill {
            transform: rotate(81deg);
          }
          .ko-progress-circle[data-progress="45"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(162deg);
          }
          .ko-progress-circle[data-progress="46"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="46"] .ko-progress-circle__fill {
            transform: rotate(82.8deg);
          }
          .ko-progress-circle[data-progress="46"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(165.6deg);
          }
          .ko-progress-circle[data-progress="47"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="47"] .ko-progress-circle__fill {
            transform: rotate(84.6deg);
          }
          .ko-progress-circle[data-progress="47"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(169.2deg);
          }
          .ko-progress-circle[data-progress="48"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="48"] .ko-progress-circle__fill {
            transform: rotate(86.4deg);
          }
          .ko-progress-circle[data-progress="48"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(172.8deg);
          }
          .ko-progress-circle[data-progress="49"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="49"] .ko-progress-circle__fill {
            transform: rotate(88.2deg);
          }
          .ko-progress-circle[data-progress="49"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(176.4deg);
          }
          .ko-progress-circle[data-progress="50"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="50"] .ko-progress-circle__fill {
            transform: rotate(90deg);
          }
          .ko-progress-circle[data-progress="50"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(180deg);
          }
          .ko-progress-circle[data-progress="51"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="51"] .ko-progress-circle__fill {
            transform: rotate(91.8deg);
          }
          .ko-progress-circle[data-progress="51"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(183.6deg);
          }
          .ko-progress-circle[data-progress="52"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="52"] .ko-progress-circle__fill {
            transform: rotate(93.6deg);
          }
          .ko-progress-circle[data-progress="52"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(187.2deg);
          }
          .ko-progress-circle[data-progress="53"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="53"] .ko-progress-circle__fill {
            transform: rotate(95.4deg);
          }
          .ko-progress-circle[data-progress="53"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(190.8deg);
          }
          .ko-progress-circle[data-progress="54"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="54"] .ko-progress-circle__fill {
            transform: rotate(97.2deg);
          }
          .ko-progress-circle[data-progress="54"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(194.4deg);
          }
          .ko-progress-circle[data-progress="55"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="55"] .ko-progress-circle__fill {
            transform: rotate(99deg);
          }
          .ko-progress-circle[data-progress="55"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(198deg);
          }
          .ko-progress-circle[data-progress="56"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="56"] .ko-progress-circle__fill {
            transform: rotate(100.8deg);
          }
          .ko-progress-circle[data-progress="56"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(201.6deg);
          }
          .ko-progress-circle[data-progress="57"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="57"] .ko-progress-circle__fill {
            transform: rotate(102.6deg);
          }
          .ko-progress-circle[data-progress="57"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(205.2deg);
          }
          .ko-progress-circle[data-progress="58"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="58"] .ko-progress-circle__fill {
            transform: rotate(104.4deg);
          }
          .ko-progress-circle[data-progress="58"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(208.8deg);
          }
          .ko-progress-circle[data-progress="59"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="59"] .ko-progress-circle__fill {
            transform: rotate(106.2deg);
          }
          .ko-progress-circle[data-progress="59"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(212.4deg);
          }
          .ko-progress-circle[data-progress="60"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="60"] .ko-progress-circle__fill {
            transform: rotate(108deg);
          }
          .ko-progress-circle[data-progress="60"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(216deg);
          }
          .ko-progress-circle[data-progress="61"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="61"] .ko-progress-circle__fill {
            transform: rotate(109.8deg);
          }
          .ko-progress-circle[data-progress="61"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(219.6deg);
          }
          .ko-progress-circle[data-progress="62"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="62"] .ko-progress-circle__fill {
            transform: rotate(111.6deg);
          }
          .ko-progress-circle[data-progress="62"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(223.2deg);
          }
          .ko-progress-circle[data-progress="63"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="63"] .ko-progress-circle__fill {
            transform: rotate(113.4deg);
          }
          .ko-progress-circle[data-progress="63"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(226.8deg);
          }
          .ko-progress-circle[data-progress="64"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="64"] .ko-progress-circle__fill {
            transform: rotate(115.2deg);
          }
          .ko-progress-circle[data-progress="64"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(230.4deg);
          }
          .ko-progress-circle[data-progress="65"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="65"] .ko-progress-circle__fill {
            transform: rotate(117deg);
          }
          .ko-progress-circle[data-progress="65"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(234deg);
          }
          .ko-progress-circle[data-progress="66"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="66"] .ko-progress-circle__fill {
            transform: rotate(118.8deg);
          }
          .ko-progress-circle[data-progress="66"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(237.6deg);
          }
          .ko-progress-circle[data-progress="67"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="67"] .ko-progress-circle__fill {
            transform: rotate(120.6deg);
          }
          .ko-progress-circle[data-progress="67"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(241.2deg);
          }
          .ko-progress-circle[data-progress="68"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="68"] .ko-progress-circle__fill {
            transform: rotate(122.4deg);
          }
          .ko-progress-circle[data-progress="68"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(244.8deg);
          }
          .ko-progress-circle[data-progress="69"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="69"] .ko-progress-circle__fill {
            transform: rotate(124.2deg);
          }
          .ko-progress-circle[data-progress="69"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(248.4deg);
          }
          .ko-progress-circle[data-progress="70"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="70"] .ko-progress-circle__fill {
            transform: rotate(126deg);
          }
          .ko-progress-circle[data-progress="70"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(252deg);
          }
          .ko-progress-circle[data-progress="71"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="71"] .ko-progress-circle__fill {
            transform: rotate(127.8deg);
          }
          .ko-progress-circle[data-progress="71"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(255.6deg);
          }
          .ko-progress-circle[data-progress="72"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="72"] .ko-progress-circle__fill {
            transform: rotate(129.6deg);
          }
          .ko-progress-circle[data-progress="72"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(259.2deg);
          }
          .ko-progress-circle[data-progress="73"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="73"] .ko-progress-circle__fill {
            transform: rotate(131.4deg);
          }
          .ko-progress-circle[data-progress="73"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(262.8deg);
          }
          .ko-progress-circle[data-progress="74"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="74"] .ko-progress-circle__fill {
            transform: rotate(133.2deg);
          }
          .ko-progress-circle[data-progress="74"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(266.4deg);
          }
          .ko-progress-circle[data-progress="75"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="75"] .ko-progress-circle__fill {
            transform: rotate(135deg);
          }
          .ko-progress-circle[data-progress="75"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(270deg);
          }
          .ko-progress-circle[data-progress="76"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="76"] .ko-progress-circle__fill {
            transform: rotate(136.8deg);
          }
          .ko-progress-circle[data-progress="76"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(273.6deg);
          }
          .ko-progress-circle[data-progress="77"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="77"] .ko-progress-circle__fill {
            transform: rotate(138.6deg);
          }
          .ko-progress-circle[data-progress="77"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(277.2deg);
          }
          .ko-progress-circle[data-progress="78"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="78"] .ko-progress-circle__fill {
            transform: rotate(140.4deg);
          }
          .ko-progress-circle[data-progress="78"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(280.8deg);
          }
          .ko-progress-circle[data-progress="79"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="79"] .ko-progress-circle__fill {
            transform: rotate(142.2deg);
          }
          .ko-progress-circle[data-progress="79"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(284.4deg);
          }
          .ko-progress-circle[data-progress="80"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="80"] .ko-progress-circle__fill {
            transform: rotate(144deg);
          }
          .ko-progress-circle[data-progress="80"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(288deg);
          }
          .ko-progress-circle[data-progress="81"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="81"] .ko-progress-circle__fill {
            transform: rotate(145.8deg);
          }
          .ko-progress-circle[data-progress="81"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(291.6deg);
          }
          .ko-progress-circle[data-progress="82"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="82"] .ko-progress-circle__fill {
            transform: rotate(147.6deg);
          }
          .ko-progress-circle[data-progress="82"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(295.2deg);
          }
          .ko-progress-circle[data-progress="83"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="83"] .ko-progress-circle__fill {
            transform: rotate(149.4deg);
          }
          .ko-progress-circle[data-progress="83"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(298.8deg);
          }
          .ko-progress-circle[data-progress="84"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="84"] .ko-progress-circle__fill {
            transform: rotate(151.2deg);
          }
          .ko-progress-circle[data-progress="84"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(302.4deg);
          }
          .ko-progress-circle[data-progress="85"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="85"] .ko-progress-circle__fill {
            transform: rotate(153deg);
          }
          .ko-progress-circle[data-progress="85"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(306deg);
          }
          .ko-progress-circle[data-progress="86"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="86"] .ko-progress-circle__fill {
            transform: rotate(154.8deg);
          }
          .ko-progress-circle[data-progress="86"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(309.6deg);
          }
          .ko-progress-circle[data-progress="87"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="87"] .ko-progress-circle__fill {
            transform: rotate(156.6deg);
          }
          .ko-progress-circle[data-progress="87"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(313.2deg);
          }
          .ko-progress-circle[data-progress="88"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="88"] .ko-progress-circle__fill {
            transform: rotate(158.4deg);
          }
          .ko-progress-circle[data-progress="88"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(316.8deg);
          }
          .ko-progress-circle[data-progress="89"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="89"] .ko-progress-circle__fill {
            transform: rotate(160.2deg);
          }
          .ko-progress-circle[data-progress="89"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(320.4deg);
          }
          .ko-progress-circle[data-progress="90"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="90"] .ko-progress-circle__fill {
            transform: rotate(162deg);
          }
          .ko-progress-circle[data-progress="90"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(324deg);
          }
          .ko-progress-circle[data-progress="91"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="91"] .ko-progress-circle__fill {
            transform: rotate(163.8deg);
          }
          .ko-progress-circle[data-progress="91"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(327.6deg);
          }
          .ko-progress-circle[data-progress="92"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="92"] .ko-progress-circle__fill {
            transform: rotate(165.6deg);
          }
          .ko-progress-circle[data-progress="92"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(331.2deg);
          }
          .ko-progress-circle[data-progress="93"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="93"] .ko-progress-circle__fill {
            transform: rotate(167.4deg);
          }
          .ko-progress-circle[data-progress="93"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(334.8deg);
          }
          .ko-progress-circle[data-progress="94"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="94"] .ko-progress-circle__fill {
            transform: rotate(169.2deg);
          }
          .ko-progress-circle[data-progress="94"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(338.4deg);
          }
          .ko-progress-circle[data-progress="95"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="95"] .ko-progress-circle__fill {
            transform: rotate(171deg);
          }
          .ko-progress-circle[data-progress="95"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(342deg);
          }
          .ko-progress-circle[data-progress="96"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="96"] .ko-progress-circle__fill {
            transform: rotate(172.8deg);
          }
          .ko-progress-circle[data-progress="96"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(345.6deg);
          }
          .ko-progress-circle[data-progress="97"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="97"] .ko-progress-circle__fill {
            transform: rotate(174.6deg);
          }
          .ko-progress-circle[data-progress="97"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(349.2deg);
          }
          .ko-progress-circle[data-progress="98"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="98"] .ko-progress-circle__fill {
            transform: rotate(176.4deg);
          }
          .ko-progress-circle[data-progress="98"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(352.8deg);
          }
          .ko-progress-circle[data-progress="99"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="99"] .ko-progress-circle__fill {
            transform: rotate(178.2deg);
          }
          .ko-progress-circle[data-progress="99"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(356.4deg);
          }
          .ko-progress-circle[data-progress="100"] .ko-progress-circle__slice.full, .ko-progress-circle[data-progress="100"] .ko-progress-circle__fill {
            transform: rotate(180deg);
          }
          .ko-progress-circle[data-progress="100"] .ko-progress-circle__fill.ko-progress-circle__bar {
            transform: rotate(360deg);
          }
          
        </style>

        <!--meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="../img/logo.png">
        <link rel="shortcut icon" href="../img/logo.png">
        <link rel="manifest" href="../manifest.json">

        <!--file linked-->
        <link rel="stylesheet" href="../style.css">
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="../../css-animation-lib/node_modules/animate.css/animate.css">
        <link rel="stylesheet" href="../../css-animation-lib/node_modules/animate.css/source/animate.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"/>

    </head>
    <body>

        <div id="start-plants" style="position: relative">
            <input type="file" name="photo" id="file" onchange="return fileValidation(), sendIdentification()" style="position: absolute;" required>

            <img src="../img/arrowleft.svg" onclick="history.back()" style="position: absolute; top: 5.5vh; left: 1vw;">
            <h1 style="margin-top: 5vh; color: #B09F85; font-size: 27px;">Plant Health Check</h1>
            <p style="color: #3D4D43; font-size: 17px; font-weight: 600; margin-top: 10vh" id="1ab">Scan your plant to check its health</p>
            <p style="color: #3D4D43; font-size: 27px; font-weight: 600; margin-top: 10vh; display: none;" id="plant-score">Your Plant score</p>
            <button id="add-plant-btn">Scan Plant <img src="../img/plus-white.svg" style="float:right;"></button>

            <br>

            <div class="ko-progress-circle" data-progress="0" style="position: absolute; top: 45vh;">
              <div class="ko-circle">

                  <div class="full ko-progress-circle__slice">
                      <div class="ko-progress-circle__fill"></div>
                  </div>
                  <div class="ko-progress-circle__slice">
                    
            
                      <div class="ko-progress-circle__fill"></div>
                      <div class="ko-progress-circle__fill ko-progress-circle__bar"></div>
                  </div>
              </div>
            
              <div class="ko-progress-circle__overlay"></div>

            </div>
            
            <div style="color: #3D4D43; font-size: 27px; font-weight: 600; position: absolute; bottom: 28vh;" id="plant-score-percentage"></div>

            <button id="confirm-plants" onclick=nextp() style="display: none">Done</button>

        </div>

        <script src="../index.js"></script>

        <!--Image searching API-->
        <script type="text/javascript">
          

         



            //Plant indectifiation thing ---------------------------------------------------------------------------
            function sendIdentification() {
                const files = [...document.querySelector('input[type=file]').files];
                const promises = files.map((file) => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const res = event.target.result;
                        console.log(res);
                        resolve(res);
                    }
                    reader.readAsDataURL(file)
                })
                })
                
                Promise.all(promises).then((base64files) => {
                console.log(base64files)
                        
                const data = {
                api_key: "kDuvxVTXrfFfjyMrxJEziZEYRJD5zeIps1m5NQNI7oeBPlPRqD",
                images: base64files,
                // modifiers docs: https://github.com/flowerchecker/Plant-id-API/wiki/Modifiers
                modifiers: ["crops_fast", "similar_images"],
                language: "en",
                // disease details docs: https://github.com/flowerchecker/Plant-id-API/wiki/Disease-details
                disease_details: ["cause",
                                "common_names",
                                "classification",
                                "description",
                                "treatment",
                                "url"],
              };
              
              fetch('https://api.plant.id/v2/health_assessment', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
              })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success Plant.id API:', data);
                            $("1ab").hide();
                            $("#add-plant-btn").hide();
                            $("#plant-score").show();
                            $("#plant-score-percentage").show();
                            $("#ko-progress-circle").show();

                            $("#ko-progress-circle").css('display', 'block');
                            
                           



                            var perct = data.health_assessment.is_healthy_probability;
                            var nom = Math.floor(perct * 100);

                            $.ajax({
                              url: "../includes/last_healthcheck.php",
                              type: "POST",
                              data: { percentage: nom },
                              success: function(response) {
                                console.log(response);
                              },
                              error: function(xhr, status, error) {
                                console.error(error);
                              }
                            });
                            

                            window.randomize = function() {
                              $('.ko-progress-circle').attr('data-progress', nom);
                            }
                            setTimeout(window.randomize, 200);
                            $('.ko-progress-circle').click(window.randomize);

                            var element = document.getElementById("plant-score-percentage");
                            element.innerHTML = nom + "%";

                            document.getElementById("added-plant-container").appendChild(addedPlant);

                            pnt.innerHTML = '70';


                            
                            


                })
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                        }
                    ;

                  
                $('#add-plant-btn').click(function() {
                    $('#file').click();
                });


        </script>
    </body>
</html>