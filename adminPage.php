<?php
    require("connection/connect.php");  
    session_start();
    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM users 
                 WHERE uniqueid = '".$_GET['uniqueid']."'";    
        $result = pg_query($sql); 
        if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        } 
        pg_close(); 

    }
 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Admin</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/adminStyles.css">
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
  
        <br/><h1 id="mainHeader">Teach & Connect</h1><br/>
       <h1 id="header2">Administrator</h1>
        
       
        <div id="userName">
            <h3 id="name"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h3>
        </div>
        <br/>
        <br/><h2 id="header2">Records &#x2713</h2>
        
        <table class="tftable" border="1">
       
        <tr><th>First Name</th><th>Last Name</th><th>Description</th><th>Update</th><th>Delete</th></tr>    
            
            <?php
             $studentid = 1; // 1 FOR TESTING PURPOSES! 
             // NEED TO GET PERCENTAGE, LETTER GRADE
             //$grades = getGrades($studentid);
             $dbConn = getConnection();
             $sql = "SELECT * FROM users";
             $users = pg_query($sql);
             while($user = pg_fetch_assoc($users)) { 
                 echo "<tr>";
                 echo "<td>" . htmlspecialchars($user['firstname']) . "</td>";
                 echo "<td>" . htmlspecialchars($user['lastname']) . "</td>";
                 echo "<td>" . htmlspecialchars($user['description']) . "</td>";

             ?>  <td>
                     <form action="updateUser.php">
                         <input type="hidden" name="uniqueid" value="<?=$user['uniqueid']?>" />    
                         <input type="submit" value="Update" name="updateForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$user['uniqueid']?>')">
                         <input type="hidden" name="uniqueid" value="<?=$user['uniqueid']?>" />    
                         <input type="submit" value="Delete" name="deleteForm"/>
                     </form>   
                </td>
               </tr>
        
             <?php    
               } //closes foreach

             ?>            
            
        </table>
    <br/>
     <button id="logout" onclick="location.href='logout.php'">
            Logout
        </button>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>