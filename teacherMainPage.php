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
    <link type="text/css" rel="stylesheet" href="css/teacherHomeStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <style>
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style>
    
    <script>
        function loadEvent() {
				$.ajax({
					type: "GET",
					url: "loadEvents.php", // same directory
					dataType: "json",
					data: {"uniqueid": $("#myid").val()},
					success: function(data, status) {
						$("#feed").html("<h2>"+data['title']+"</h2><br><h3>"+data['description']+"</h3>");
					},
					complete: function(data, status) {
                        
					}
				});
			}
        
        
            $(function() {
        var dialog, form,

          title = $( "#title" ),
          description = $( "#description" ),
          allFields = $( [] ).add( title ).add( description );

        function addEvent() {
          var valid = true;
          allFields.removeClass( "ui-state-error" );

          if ( valid ) {
            $( "#feed" ).append( "<h2>"+title.val() + "</td>" +
              "<td>" + description.val() + "</td>"+
            "</tr>" );
            dialog.dialog( "close" );
          }
          return valid;
        }

        dialog = $( "#dialog-form" ).dialog({
          autoOpen: false,
          height: 500,
          width: 600,
          modal: true,
          buttons: {
            "Create an event": addEvent,
            Cancel: function() {
              dialog.dialog( "close" );
            }
          },
          close: function() {
            form[ 0 ].reset();
            allFields.removeClass( "ui-state-error" );
          }
        });

        form = dialog.find( "form" ).on( "submit", function( event ) {
          event.preventDefault();
          addEvent();
        });

        $( "#addEvent" ).button().on( "click", function() {
          dialog.dialog( "open" );
        });
      });
    </script>
    
</head>
    <input type="hidden" id="myid" value="<?=$_SESSION['uniqueid']?>">
<body onload="loadEvent()">
    <div id="wrapper">
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <h1 id="mainHeader">Teach & Connect</h1>
      
        <div id="userName">
            <h3><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?></h3>
        </div>
        
        <!-- Navigation Bar -->
        <?php
            require("teacherNav.php");
            generateTeacherNav();
        ?>
        <!---------------------->
        <div id="dialog-form" title="Create new post">
        <p class="validateTips">All form fields are required.</p>
 
          <form>
            <fieldset>
              <label for="Title">Title</label>
              <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all">
               <br />
              <label for="Description">Description</label>
               <br />
              <textarea rows="4" cols="50" id="description">
               </textarea>
              <!-- Allow form submission with keyboard without duplicating the dialog button -->
              <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
          </form>
        </div>
        
        <div id="newsfeed" >
            
            <br/>
            <br/>
            <h2 id="myEvents">My Events</h2>
            <div id="feed">
           
            </div>
            <form>
                <input type="button" value="+Add New Post" id="addEvent"> <br/><br/>
            </form>
        </div>
        
    </div>
</body>
</html>