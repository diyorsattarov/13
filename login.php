<?php
require_once 'database.class.php';
session_start();

if(isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $db = new Database();
    $stmt = $db->query("SELECT name, password FROM users WHERE name= '" .$name. "' and password= '" .$pass. "'");
    try {
        $db->execute($stmt);
        header('location: index.php');
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: register.php');
    }
}
else {
    
    //header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>
<div class='login'>
  <h2>Login</h2>
  <?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; } ?>
  <form action="login.php" method="POST">
    <input name='username' placeholder='Username' type='text'>
    <input id='password' name='password' placeholder='Password' type='password'>
    <input formmethod='POST' class='animated' type='submit' value='Enter'>
    </input>
    <a href="register.php">Register</a>
  </form>
</div>
</body>
</html>