<?php
session_start();
require('connection/connect.php');
$dbConn = getConnection();
 if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 

$sql = "SELECT description, profilepicture FROM users WHERE username = $1";
$stmt = pg_query_params($dbConn, $sql, array("teacher"));
$res = pg_fetch_assoc($stmt);

$profilepicture = $res['profilepicture'];
$description = $res['description'];

function getProfilePic(){
    $dbConn = getConnection();
    $sql = "SELECT profilepicture FROM users WHERE username =$1 ";
    $stmt = pg_query_params($dbConn, $sql, array('teacher'));
    $res = pg_fetch_assoc($stmt);

    return $res['profilepicture'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Teach & Connect</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link rel="stylesheet" type="text/css" href="css/newsfeed.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/teacherHomeStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <link type="text/css" rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    
    
</head>
    <input type="hidden" id="myid" value="<?=$_SESSION['uniqueid']?>">
<body onload="loadEvent()">
    <div id="wrapper">
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <h1 id="mainHeader">Teach & Connect</h1>
      
        <div id="userName">
            <h3 id="name"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h3>
        </div>
        
        <!-- Navigation Bar -->
        <?php
            require("teacherNav.php");
            generateParentNav();
        ?>
        <!---------------------->
        
    </div>
    <h1 id="profileHeader">Teacher's Profile </h1>
    <br/>
  
    
    <?php
        $profilePic = getProfilePic();
         if(!isset($profilePic)) {
             // Display Uknown
             echo "<img src='tmp/unknown.jpg' alt='Unknown User' />";
         }else {
            $profilePic = "teacher/".$profilePic;
            echo "<img src='img/$profilePic' id='proPicture'  alt='Users' />";
         }
         
     ?> 
    <br/> <br/>
    <h1 id="aboutme" style=font-family: Papyrus,fantasy>About Me:</h1>
    
     <?php 
            echo '<p style="border-style:solid; border-color:#228b22;">'.$description.'</p>';
     ?>
 
    
</body>
</html>

