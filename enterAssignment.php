<!--
To change this template use Tools | Templates.
-->
<!DOCTYPE html>
<html>
<head>
    <title>Enter Assignment</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/enterAssignmentsStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
    <body>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><h1 id="mainHeader">Teach & Connect</h1><br/>
        
        <!-- Navigation Bar -->
        <?php
            require("teacherNav.php");
            generateTeacherNav();
        ?>
        <!---------------------->
        
        <br/><br/><br/>
        <h1 id="enterAssignmentHeader">Enter Assignment</h1>
        <div id="enterAssignmentDiv" > <br/>
            <div id="innerDiv">
                
                Student ID: <input type="text" id="studentid"><br/>
                Assignment Title: <input type="text" id="title"><br/>
                Assignment Grade: <input type="text" id="grade"><br/>
                Possible Points: <input type="text" id="possiblepoints"><br/>
                Feedback: <input type="text" id="feedback"><br/><br/>
                <input type="button" value="Enter" id="enterAssignment">  
                
            </div>
        </div>
        
        <script>
            $("#enterAssignment").click( function(event){
                var studentid = $("#studentid").val();
                var title = $("#title").val();
                var grade = $("#grade").val();
                var possiblepoints = $("#possiblepoints").val();
                var feedback = $("#feedback").val();
                alert(feedback);                
                
                $.ajax({
                    type: "POST",
                    url: "http://totem-desert.codio.io:3000/Final_Project/Digital-Parent-Teacher-Assistant/submitAssignment.php",
                    data: {studentid: studentid,
                          title: title,
                          grade: grade,
                          possiblepoints: possiblepoints,
                          feedback: feedback}
                }); 
            });      
        </script>
        
    </body>
</html>