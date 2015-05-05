<?php

if(isset($_GET['error'])){
    //echo $_GET['error'];
}
?>

<!--
To change this template use Tools | Templates.
-->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="css/loginStyles.css">
</head>
<body>
    <br/><h1 id="mainHeader">Teach & Connect</h1>
    <br/><br/>
    <h1>Login!</h1>
    
    <form action="login.php" method="POST">
        <br/>
        Username: <input type="text" name="username"><br/>
        Password: <input type="password" name="password"><br/>
        <br/>
        <input type="submit" value="Login!" name="loginForm" id="submitButton"/>
        
    </form>
    <br/>
    <h2 id="loginError">&#x2717 Wrong username or password, please try again.</h2>
</body>
</html>