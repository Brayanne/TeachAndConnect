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
    <link rel="stylesheet" type="text/css" href="css/mainPageStyles.css">
    <link rel="stylesheet" type="text/css" href="css/newsfeed.css">
</head>
    
<body>
    <div id="wrapper">
        
        <h1 id="mainHeader">Teach & Connect</h1>
      
        <div id="userName">
            <h3><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h3>
        </div>
        
        <div id="navigationBar">
            
        
        <nav>
	        <ul>
		        <li><a href="teacherMainPage.php">Home</a></li>
                <li>
                    <a href="#">Profile<span class="caret"></span></a>
                    <div>
				        <ul>
			                <li><a href="#">Edit</a></li>
			            </ul>
			        </div>
                </li>
                <li><a href="Calendar2/Cal/index.php">My Calendar</a></li>
		        <li>
      		        <a href="#">Grades<span class="caret"></span></a>
			        <div>
				        <ul>
			                <li><a href="#">Update</a></li>
				            <li><a href="#">View</a></li>
			            </ul>
			        </div>
		        </li>
		    
		    <li><a href="#">Add Parent</a></li>
            <li><a href="logout.php">Logout</a></li>
	    </ul>
    </nav>    
      </div>
        
        
        <div id="newsfeed">
            <br/>
            <h2>My Events</h2>
            
            
            
        </div>
        
    </div>
</body>
</html>