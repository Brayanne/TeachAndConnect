<?php
    function getConnection() {
       
        $host = "ec2-54-225-154-5.compute-1.amazonaws.com"; 
        $user = "rdznjqrsvqcagr"; 
        $pass = "vzAAgCA_UqNLrz5PozibvabiDY"; 
        $db = "dbgb859gaj6lo0"; 
        $port = "5432";
        $con = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass")
         or die ("Could not connect to server\n"); 
       
        /*
        $query = "SELECT VERSION()"; 
        $rs = pg_query($con, $query) or die("Cannot execute query: $query\n"); 
        $row = pg_fetch_row($rs);

        echo $row[0] . "\n";
        */ 
        
        return $con;
        
    }
getConnection();
?>