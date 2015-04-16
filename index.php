<!DOCTYPE html>
<html>
<head>
	<script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <title>Final Project</title>
</head>
<body>
	<div id='messageDiv'></div>
	<input type='text' id='nameInput' placeholder='Name'>
    <input type='text' id='messageInput' placeholder='Message'>
    <?php
	echo"	<script>
			var myDataRef = new Firebase('https://blistering-fire-5737.firebaseio.com/');

			$('#messageInput').keypress(function (e) {
	        if (e.keyCode == 13) {
	          var name = $('#nameInput').val();
	          var text = $('#messageInput').val();
	          // Adding to data base normally myDataRef.set(name + text);
	          // JSON Obj adding myDataRef.set({name: name, text: text});
	          myDataRef.push({name: name, text: text}); // Makes a list, chronologicallly added
	          $('#messageInput').val('');
	        }
	      });
			//You always read data using callbacks
			// 4 event types: value, child_added, child_changed, child_removed (extra child_moved)
			//Callback to firebase using on(event type, callback type) method 
			myDataRef.on('child_added', function(snapshot) {
				var message = snapshot.val();
				displayChatMessage(message.name, message.text);
			});

	      function displayChatMessage(name, text) {
	        $('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
	        $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
	      };
		</script>";
	?>
    <h1> Hello World !!</h1>
    <h1>Daniel Hello World !</h1>
</body>
</html>