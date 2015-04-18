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
    
	<script>
		var myDataRef = new Firebase('https://blistering-fire-5737.firebaseio.com/');

      $('#messageInput').keypress(function (e) {
        if (e.keyCode == 13) {
          var name = $('#nameInput').val();
          var text = $('#messageInput').val();
          myDataRef.push({name: name, text: text});
          $('#messageInput').val('');
        }
      });
      myDataRef.on('child_added', function(snapshot) {
        var message = snapshot.val();
        displayChatMessage(message.name, message.text);
      });
      function displayChatMessage(name, text) {
        $('<div/>').text(text).prepend($('<em>').text(name+': ')).appendTo($('#messagesDiv'));
        $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;

        $('<div>').text('['+timestamp+'] ').append($('<name>').text(name+': ')).append($('<em>').html(text)).appendTo($('#messagesDiv'));

      };
	</script>
	
    <h1> Hello World !!</h1>
</body>
</html>