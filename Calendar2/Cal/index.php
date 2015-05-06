<?php
    require("../../connection/connect.php");  
    session_start();
    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>T&C Event Calendar</title>
    <!--Navigation Style Sheet-->
    <link type="text/css" rel="stylesheet" href="../../css/navStyles.css">
	<link type="text/css" rel="stylesheet" href="../../css/mainHeaderStyles.css"> 
    <link type="text/css" rel="stylesheet" href="../../css/backgroundStyles.css">
    
    <link type="text/css" rel="stylesheet" href="media/layout.css" />
    <link type="text/css" rel="stylesheet" href="themes/calendar_green.css" />
    <!-- demo stylesheet 
    	    
        <link type="text/css" rel="stylesheet" href="themes/calendar_g.css" />    
          
        <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css" />    
        <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css" />    
        <link type="text/css" rel="stylesheet" href="themes/calendar_white.css" />    
-->
	<!-- helper libraries -->
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	<!-- daypilot libraries -->
    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	
</head>
<body>
    <!--
        <div id="header">
			<div class="bg-help">
				<div class="inBox">
					<h1 id="logo">Teach&Connect Event Calendar</h1>
					<!--<p id="claim"><a href="http://javascript.daypilot.org/"></a> </p>
					<hr class="hidden" />
				</div>
			</div>
        </div>
    -->
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
         <h1 id="mainHeader">Teach & Connect</h1>
    <br/>
        <!-- Navigation Bar -->
        <?php
            require("../../teacherNav.php");
            if ($_SESSION['roleid'] == 2) { // teacher
                generateTeacherCalNav();
            } else if ($_SESSION['roleid'] == 3) { // parent
                generateParentCalNav();
            }
            
        ?>
        <!-------------------->
    
        <h2 id="calendarHeader">Calendar</h2>
        <div class="shadow"></div>
        <div class="hideSkipLink"></div>
        <div class="main">
            
            
            
            
            <div style="float:left; width: 160px;">
                <div id="nav"></div>
            </div>
            <div style="margin-left: 160px;">
                <div id="dp"></div>
            </div>

            <script type="text/javascript">
                
                var nav = new DayPilot.Navigator("nav");
                nav.showMonths = 3;
                nav.skipMonths = 3;
                nav.selectMode = "week";
                nav.onTimeRangeSelected = function(args) {
                    dp.startDate = args.day;
                    dp.update();
                    loadEvents();
                };
                nav.init();
                
                var dp = new DayPilot.Calendar("dp");
                dp.viewType = "Week";

                dp.onEventMoved = function (args) {
                    $.post("backend_move.php", 
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            }, 
                            function() {
                                console.log("Moved.");
                            });
                };

                dp.onEventResized = function (args) {
                    $.post("backend_resize.php", 
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            }, 
                            function() {
                                console.log("Resized.");
                            });
                };

                // event creating
                dp.onTimeRangeSelected = function (args) {
                    var name = prompt("New event name:", "Event");
                    dp.clearSelection();
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        resource: args.resource,
                        text: name
                    });
                    dp.events.add(e);

                    $.post("backend_create.php", 
                            {
                                start: args.start.toString(),
                                end: args.end.toString(),
                                name: name
                            }, 
                            function() {
                                console.log("Created.");
                            });

                };

                dp.onEventClick = function(args) {
                    alert("clicked: " + args.e.id());
                };

                dp.init();

                loadEvents();

                function loadEvents() {
                    var start = dp.visibleStart();
                    var end = dp.visibleEnd();

                    $.post("backend_events.php", 
                    {
                        start: start.toString(),
                        end: end.toString()
                    }, 
                    function(data) {
                        //console.log(data);
                        dp.events.list = data;
                        dp.update();
                    });
                }

            </script>
            
            <script type="text/javascript">
            $(document).ready(function() {
                $("#theme").change(function(e) {
                    dp.theme = this.value;
                    dp.update();
                });
            });  
            </script>

        </div>
        <div class="clear">
        </div>
        
</body>
</html>

