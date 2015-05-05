<?php
    require("connection/connect.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 

    function getGrades($studentid){
       $dbConn = getConnection();
       $sql = "SELECT * FROM grades WHERE studentid = $1";
       $stmt = pg_query_params($dbConn, $sql, array($studentid));
       $result = pg_fetch_assoc($stmt);
       return $result;
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
            generateTeacherNav();
        ?>
        <!---------------------->
        <br/>
        <br/><h2 id="header2">Gradebook &#x2713</h2>
        
        <table class="tftable" border="1">
       
        <tr><th>Grade Item</th><th>Grade</th><th>Range</th><th>Percentage</th><th>Letter Grade</th><th>Feedback</th><th>Update</th><th>Delete</th></tr>    
            
            <?php
             $studentid = 1; // 1 FOR TESTING PURPOSES! 
             // NEED TO GET PERCENTAGE, LETTER GRADE
             //$grades = getGrades($studentid);
             $dbConn = getConnection();
             $sql = "SELECT * FROM grades WHERE studentid = 1";
             $grades = pg_query($sql);
             echo $grades;
             while($grade = pg_fetch_assoc($grades)) { 
                 echo "<tr>";
                 echo "<td>" . htmlspecialchars($grade['title']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['grade']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['possiblepoints']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['possiblepoints']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['possiblepoints']) . "</td>";
                 echo "<td>" . htmlspecialchars($grade['feedback']) . "</td>";

             ?>  <td>
                     <form action="updateGrades.php">
                         <input type="hidden" name="assignmentid" value="<?=$grade['assignmentid']?>" />    
                         <input type="submit" value="Update" name="updateForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$grade['assignmentid']?>')">
                         <input type="hidden" name="assignmentid" value="<?=$grade['assignmentid']?>" />    
                         <input type="submit" value="Delete" name="deleteForm"/>
                     </form>   
                </td>
               </tr>

             <?php    
               } //closes foreach

             ?>            
            
            
        <tr><td>Assignment 1</td><td>10.00</td><td>0-10</td><td>100.00%</td><td>A</td><td>Excellent work!</td><td></td><td></td></tr>
        </table>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>