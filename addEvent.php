<?php
    require 'connection/connect.php';
    $dbConn = getConnection();

    $sql = "INSERT INTO events (userid, title, description) values ($1, $2, $3)";
    $stmt = pg_query_params($dbConn, $sql, array($_GET['uniqueid'], $_GET['title'], $_GET['description']));
                          
?>