
<?php
    require("connection/connect.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    }

    if (isset($_GET['assignmentid'])){

         $assignmentid = $_GET['assignmentid'];
         
         $sql = "SELECT * FROM grades WHERE assignmentid = '".$assignmentid."'"; // need to get assignmentId instead of the one for testing purposes
         $result = pg_query($sql);
         while($grade = pg_fetch_assoc($result)) { 
                $title = htmlspecialchars($grade['title']);
                $possiblepoints = htmlspecialchars($grade['possiblepoints']);
                $studentid = htmlspecialchars($grade['studentid']);
                $feedback = htmlspecialchars($grade['feedback']);
                $assignmentGrade = htmlspecialchars($grade['grade']);
                

         }

    }

     if (isset($_POST['updateForm'])) {  //the update form has been submitted
        $studentid = pg_escape_string($_POST['studentid']);
        $title = pg_escape_string($_POST['title']);
        $grade = pg_escape_string($_POST['grade']);
        $possiblepoints = pg_escape_string($_POST['possiblepoints']);
        $feedback = pg_escape_string($_POST['feedback']);


        $query = "UPDATE grades
                SET studentid = '".$studentid."',
                    title = '".$title."',
                    grade = '".$grade."',
                    possiblepoints = '".$possiblepoints."',
                    feedback = '".$feedback."'
                WHERE assignmentid = '".$assignmentid."'";

        $result = pg_query($query); 
        if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
         } 
         pg_close(); 
         header("Location: viewGrades.php");
     }



    ?>

    <form method="post">

        Student ID: <input type="text" name="studentid" value="<?=$studentid?>"> <br />
        Title: <input type="text" name="title" value="<?=$title?>"><br />
        Grade: <input type="text" name="grade" value="<?=$assignmentGrade?>"><br />
        Possible Points: <input type="text" name="possiblepoints" value="<?=$possiblepoints?>"><br />
        Feedback: <input type="text" name="feedback" value="<?=$feedback?>"><br />
        <input type="hidden" name="assignmentid" value="<?=$assignmentid?>"> 

        <input type="submit" name="updateForm" value="Update!">
    
</form>