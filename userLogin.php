<?php

if(isset($_GET['error'])){
    echo $_GET['error'];
}
?>

<!--
To change this template use Tools | Templates.
-->
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Login Screen</h1>
    
    <form action="login.php" method="POST">
        
        Username: <input type="text" name="username"><br/>
        Password: <input type="password" name="password"><br/>
        <input type="submit" value="Login!" name="loginForm"/>
        
    </form>
</body>
</html>