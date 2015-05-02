<!DOCTYPE html>
<html>
<head>
    <title>T&C Event Calendar</title>
    <!--Navigation Style Sheet-->
    <link type="text/css" rel="stylesheet" href="../../css/mainPageStyles.css">
	      
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
        <div id="header">
			<div class="bg-help">
				<div class="inBox">
					<h1 id="logo">Teach&Connect Event Calendar</h1>
					<!--<p id="claim"><a href="http://javascript.daypilot.org/"></a> </p>-->
					<hr class="hidden" />
				</div>
			</div>
        </div>
    
    <div id="navigationBar">
            
        
        <nav>
	        <ul>
		        <li><a href="../../teacherMainPage.php">Home</a></li>
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
            <li><a href="#">Logout</a></li>
	    </ul>
    </nav>    
      </div>
    
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

