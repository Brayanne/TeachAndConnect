<?php
    session_start();
    require('connection/connect.php');
    $dbConn = getConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = $1 AND password = $2";
     
    $stmt = pg_query_params($dbConn, $sql, array($username, $password));
    
    $res = pg_fetch_assoc($stmt); 
    $uniqueId=$res['uniqueid'];
    $firstName = $res['firstname'];
    $lastName = $res['lastname'];
    
    // fetching user role
    $sql = "SELECT roleid FROM roletable WHERE uniqueid = $1";
    $stmt = pg_query_params($dbConn, $sql, array($uniqueId));
    $result = pg_fetch_assoc($stmt);
    $result = $result['roleid'];
    
    if(empty($result)) {
            header("Location: userLogin.php?error=WRONG USERNAME/PASSWORD");
        }  else {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['firstname'] = $firstName;
                $_SESSION['lastname'] = $lastName;
                $_SESSION['uniqueid'] = $uniqueId;
                if ($result == '1') {
                header("Location: adminPage.php");
                } else if ($result == '2') {
                header("Location: teacherMainPage.php");
                } else if ($result == '3') {
                header("Location: parentHome.php");
               } 
    }
?>