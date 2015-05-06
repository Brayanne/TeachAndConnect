
<?php
    require("connection/connect.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    }

    if (isset($_GET['uniqueid'])){

         $uniqueid = $_GET['uniqueid'];
         
         $sql = "SELECT * FROM users WHERE uniqueid = '".$uniqueid."'"; // need to get uniqueid instead of the one for testing purposes
         $result = pg_query($sql);
         while($user = pg_fetch_assoc($result)) { 
                $firstname = htmlspecialchars($user['firstname']);
                $lastname = htmlspecialchars($user['lastname']);
                $description = htmlspecialchars($user['description']);
         }

    }

     if (isset($_POST['updateForm'])) {  //the update form has been submitted
        $firstname = pg_escape_string($_POST['firstname']);
        $lastname = pg_escape_string($_POST['lastname']);
        $description = pg_escape_string($_POST['description']);
         
        $query = "UPDATE users
                SET firstname = '".$firstname."',
                    lastname = '".$lastname."',
                    description = '".$description."'
                WHERE uniqueid = '".$uniqueid."'";

        $result = pg_query($query); 
        if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
         } 
         pg_close(); 
         header("Location: adminPage.php");
     }



    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/updateAssignmentStyles.css">
    <link type="text/css" rel="stylesheet" href="css/adminStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
    <body>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <h1 id="mainHeader">Teach & Connect</h1>  
       <br/>
    <h1>Update Record</h1>
        <div id="formDiv">
            
      <br/> 
    <form method="post">
        First Name: <input type="text" name="firstname" value="<?=$firstname?>"> <br />
        Last Name: <input type="text" name="lastname" value="<?=$lastname?>"><br />
        Description: <input type="text" name="description" value="<?=$description?>"><br />
        <input type="hidden" name="uniqueid" value="<?=$uniqueid?>"> 
<br/>
        <input id="button" type="submit" name="updateForm" value="Update!">
    </form>
            
        </div>         
        
    </body>
</html>