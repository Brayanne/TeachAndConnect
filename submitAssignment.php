<?php
    session_start();
    require('connection/connect.php');
    $dbConn = getConnection();

    $studentid = pg_escape_string($_POST['studentid']);
    $title = pg_escape_string($_POST['title']);
    $grade = pg_escape_string($_POST['grade']);
    $possiblepoints = pg_escape_string($_POST['possiblepoints']);
    $feedback = pg_escape_string($_POST['feedback']);


    $query = "INSERT INTO grades 
            (studentid, title, grade, possiblepoints, feedback)
            VALUES ('" . $studentid . "', '" . $title . "', '" . $grade ."', '" . $possiblepoints . "', '" .$feedback ."')";

    $result = pg_query($query); 
    if (!$result) { 
        $errormessage = pg_last_error(); 
        echo "Error with query: " . $errormessage; 
        exit(); 
     } 
     pg_close(); 
?>