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
    <link type="text/css" rel="stylesheet" href="css/parentStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        function loadEvent() {
			$.ajax({
				type: "GET",
				url: "loadEvents.php", // same directory
				dataType: "json",
				data: {"uniqueid": 2},
				success: function(data, status) {
                        for(var i = 0; i < data.length; i++){
						$("#feed").append("<div class='post'><h2>"+data[i]['title']+"</h2><br><p>"+data[i]['description']+"</p></div>");
                        }
				},
				complete: function(data, status) {
                        
				}
			});
		}
    </script>
    
</head>
    
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
        
        
        <div id="newsfeed" >
            
            <br/>
            <br/>
            <h2 id="myEvents">My Events</h2>
            <div id="feed">
           
            </div>
            
        </div>
        
    </div>
</body>
</html>