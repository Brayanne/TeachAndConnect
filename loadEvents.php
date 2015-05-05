<?php
    require 'connection/connect.php';
    $dbConn = getConnection();

    $sql = "SELECT * FROM events WHERE userid = $1 ORDER BY timestamp DESC";
    $stmt = pg_query_params($dbConn, $sql, array($_GET['uniqueid']));
    $result = pg_fetch_assoc($stmt);
    //print_r($result);

    echo json_encode($result);
?>