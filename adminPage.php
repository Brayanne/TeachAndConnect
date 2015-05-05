<?php
    require("connection/connect.php");  
    session_start();
    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
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
    <link type="text/css" rel="stylesheet" href="css/adminStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
</head>
    
<body>
    <div id="wrapper">
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <h1 id="mainHeader">Teach & Connect</h1>
      
        <div id="userName">
            <h3><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h3>
        </div>
        
        <div id="navigationBar">
            
        <nav>  
	        <ul>
		        <li><a href="adminPage.php">Home</a></li>
		        <li><a href="#">Add Teacher</a></li>
		        <li><a href="#">Add Parent</a></li>
                <li><a href="logout.php">Logout</a></li>
	    </ul>
    </nav>    
      </div>
        
        
        <div id="newsfeed">
            <br/>
            <h2 id="myEvents">My Events</h2>
            
            
            
        </div>
        
    </div>
</body>
</html>