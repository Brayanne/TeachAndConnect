<?php
    function generateTeacherNav(){
        echo "<div id='navigationBar'>";
            
        echo "<nav>";
	        echo "<ul>";
		        echo "<li><a href='teacherMainPage.php'>Home</a></li>";
                echo "<li>";
                    echo "<a href='#'>Profile<span class='caret'></span></a>";
                    echo "<div>";
				        echo "<ul>";
			                echo "<li><a href='#'>Edit</a></li>";
			            echo "</ul>";
			        echo "</div>";
                echo "</li>";
                echo "<li><a href='Calendar2/Cal/index.php'>My Calendar</a></li>";
		        echo "<li>";
      		        echo "<a href='#'>Grades<span class='caret'></span></a>";
			        echo "<div>";
				        echo "<ul>";
				            echo "<li><a href='viewGrades.php'>View</a></li>";
                            echo "<li><a href='enterAssignment.php'>Enter</a></li>";
			            echo "</ul>";
			        echo "</div>";
		        echo "</li>";
		    
		    echo "<li><a href='#'>Add Parent</a></li>";
            echo "<li><a href='logout.php'>Logout</a></li>";
	    echo "</ul>";
    echo "</nav>";
        
      echo "</div>";
    }

    function generateTeacherCalNav(){
        echo "<div id='navigationBar'>";
            
        echo "<nav>";
	        echo "<ul>";
		        echo "<li><a href='../../teacherMainPage.php'>Home</a></li>";
                echo "<li>";
                    echo "<a href='#'>Profile<span class='caret'></span></a>";
                    echo "<div>";
				        echo "<ul>";
			                echo "<li><a href='#'>Edit</a></li>";
			            echo "</ul>";
			        echo "</div>";
                echo "</li>";
                echo "<li><a href='Calendar2/Cal/index.php'>My Calendar</a></li>";
		        echo "<li>";
      		        echo "<a href='#'>Grades<span class='caret'></span></a>";
			        echo "<div>";
				        echo "<ul>";
				            echo "<li><a href='../../viewGrades.php'>View</a></li>";
                            echo "<li><a href='../../enterAssignment.php'>Enter</a></li>";
			            echo "</ul>";
			        echo "</div>";
		        echo "</li>";
		    
		    echo "<li><a href='#'>Add Parent</a></li>";
            echo "<li><a href='../../logout.php'>Logout</a></li>";
	    echo "</ul>";
    echo "</nav>";
        
      echo "</div>";
    }

?>