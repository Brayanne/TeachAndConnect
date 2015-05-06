
<?php
    require("connection/connect.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    }

    if (isset($_SESSION['uniqueid'])){

         $uniqueid = $_SESSION['uniqueid'];
         
         $sql = "SELECT * FROM users WHERE uniqueid = '".$uniqueid."'"; // need to get uniqueid instead of the one for testing purposes
         $result = pg_query($sql);
         while($user = pg_fetch_assoc($result)) { 
                $firstname = htmlspecialchars($user['firstname']);
                $lastname = htmlspecialchars($user['lastname']);
                $description = htmlspecialchars($user['description']);
                $profilepicture = htmlspecialchars($user['profilepicture']);
         }

    }



     if (isset($_POST['updateForm'])) {  //the update form has been submitted
        $firstname = pg_escape_string($_POST['firstname']);
        $lastname = pg_escape_string($_POST['lastname']);
        $description = pg_escape_string($_POST['description']);
        $profilepicture = $_FILES['fileName']['name'];
                
       setUserImg(); 
    
         
        $query = "UPDATE users SET firstname = '".$firstname."', lastname = '".$lastname."',description = '".$description."',
                    profilepicture = '".$_FILES['fileName']['name']."' WHERE uniqueid = '".$uniqueid."'" ;

        $result = pg_query($query); 
        if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
         } 
         pg_close(); 
         header("Location: profileTemplate.php");
     }

function setUserImg(){
    $p = "img"."/". $_SESSION['username'];
    if(!file_exists($p)) {
        mkdir($p);
    }

    move_uploaded_file($_FILES['fileName']['tmp_name'], $p ."/". $_FILES['fileName']['name']);
    

}



    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Teach & Connect</title>
    <title>Update User</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/updateAssignmentStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <link type="text/css" rel="stylesheet" href="css/profile.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->
   
    
 
</head>
    <body>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <h1 id="mainHeader">Teach & Connect</h1>    
    <h1>Update Record</h1>
        <div id="formDiv">
        <br/>   
      <?php 
            $path = "img/".$_SESSION['username'].'/'.$profilepicture;
             echo "<img src = '$path' id ='proPicture'>";
             
         ?>      
        <br/>    
      <br/>
    <form method="post" enctype="multipart/form-data">
        First Name: <input type="text" name="firstname" value="<?=$firstname?>"> <br />
        Last Name: <input type="text" name="lastname" value="<?=$lastname?>"><br />
        Description: <input type="text" name="description" value="<?=$description?>"><br />
        Select Image: <input type="file" name="fileName" value="<?=$profilepicture?>"><br/>
        <input type="hidden" name="uniqueid" value="<?=$uniqueid?>"> 
<br/>
        <input id="button" type="submit" name="updateForm" value="Update!">
    
    </form>
         
         
            
        </div>         
        
    </body>
</html>