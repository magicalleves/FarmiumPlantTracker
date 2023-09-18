<?php

/*empty input for signup*/
function emptyInputSignup($name, $email, $pwd) {
    $result = '';
    if (empty($name) || empty($email) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


/*incorrect email*/
function invalidEmail($email) {
    $result = '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}



/*creates user function*/
function createUser($conn, $name, $email, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd, last_login, usersIp) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index?error=stmtfailed");
        exit();
    }

    $ipaddress = $_SERVER['REMOTE_ADDR'];

    $current_time = time();

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashedPwd, $current_time, $ipaddress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    loginUser($conn, $email, $pwd);

    //echo "<script> alert('Registered successfully! You can log in now')
    //window.location.replace('../index'); </script>";

}


/*empty login input*/
function emptyInputLogin($email, $pwd) {
    $result = '';
    if (empty($email) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


/*checks for existing credentials*/
function uidExists($conn, $email) {
    $sql  = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedd");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    
    

    $resultData = mysqli_stmt_get_result($stmt);

    
    if ($row = mysqli_fetch_array($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    

    mysqli_stmt_close($stmt);
}



/*logs in user*/
function loginUser($conn, $email, $pwd) {
    $uidExists = uidExists($conn, $email, $email);

    /*wrong login*/
    if ($uidExists === false) {
        echo "<script> alert('Wrong login!');</script";
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    /*wrong password*/
    if ($checkPwd === false) {
        echo "<script> alert('Wrong login!');</script";
        header("location: ../index.php?error=wronglogin");
        exit();
    } 
    /*logs user in*/
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersEmail"];

        $userid = $_SESSION['userid'];

        $query5 = "SELECT * FROM userPlants WHERE usersId = $userid";
        $result5 = mysqli_query($conn, $query5);


        if (mysqli_num_rows($result5) > 0) {
            header("location: ../pages/menu");
        exit();
          } else {
            header("location: ../start/scan");
        exit();
          }
        
    }
}