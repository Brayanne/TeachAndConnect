<?php
    require("connection/connect.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 
 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Grades</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/viewGradesStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <style type="text/css">
    .tftable {font-size:12px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
    .tftable th {font-size:12px;background-color:#171515;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
    .tftable tr {background-color:#2f2f2f;}
    .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
    .tftable tr:hover {background-color:#171515;}
    </style>
</head>
    

    <body>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div id="header">
            <br/><h1 id="mainHeader">Teach & Connect</h1><br/>
        </div>
        <!-- Navigation Bar -->
        <?php
            require("teacherNav.php");
            generateParentNav();
        ?>
        <!---------------------->
        <br/>
        <br/><h2 id="header2">Gradebook &#x2713</h2>
        
        <table class="tftable" border="1">
       
        <tr><th>Grade Item</th><th>Grade</th><th>Range</th><th>Percentage</th><th>Letter Grade</th><th>Feedback</th></tr>    
            
            <?php
             $gradeTotal = 0;
             $possiblePointsTotal = 0;
             $dbConn = getConnection();
             $sql = "SELECT * FROM grades WHERE studentid = 1";
             $grades = pg_query($sql);
             while($grade = pg_fetch_assoc($grades)) { 
                 echo "<tr>";
                 echo "<td>" . htmlspecialchars($grade['title']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['grade']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['possiblepoints']) . "</td>";
                 $gradeTotal += $grade['grade'];
                 $possiblePointsTotal += $grade['possiblepoints'];
                 $average = ($grade['grade'] / $grade['possiblepoints']) * 100;
                 
                 $letter = 'F';
                 if($average >= 90)
                     $letter = 'A';
                 else if($average >= 80)
                     $letter = 'B';
                 else if($average >= 70)
                     $letter = 'C';
                 else if($average >= 60)
                     $letter = 'D';
                 else 
                     $letter = 'F';
                 
                 echo "<td>" . number_format($average, 2) . "%</td>";
                 echo "<td>" . $letter . "</td>";
                 echo "<td>" . htmlspecialchars($grade['feedback']) . "</td>";
                 echo "</tr>";
               } //closes foreach

               $classAverage = number_format(($gradeTotal / $possiblePointsTotal), 2) * 100;
               $letter = 'F';
                 if($classAverage >= 90)
                     $letter = 'A';
                 else if($classAverage >= 80)
                     $letter = 'B';
                 else if($classAverage >= 70)
                     $letter = 'C';
                 else if($classAverage >= 60)
                     $letter = 'D';
                 else 
                     $letter = 'F';

             ?>            
            
            
         <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td><b>Earned Points</b></td><td><b>Possible Total Points</b></td><td><b>Class Average</b></td><td><b>Letter Grade</b></td><td></td></tr>

        <tr><td></td><td><?=$gradeTotal?></td><td><?=$possiblePointsTotal?></td><td><?=$classAverage?>%</td><td><?=$letter?></td><td></td></tr>
                </table>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>