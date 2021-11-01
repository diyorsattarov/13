<?php
require_once 'database.class.php';
session_start();

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-repeat']) && isset($_POST['email'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password-repeat'];
    $email = $_POST['email'];
    if($pass == $pass2) {
        $db = new Database();
        $stmt = $db->query("INSERT INTO users (name, email, password) VALUES ('". $name . "', '". $email ."', '". $pass . "')");
        try {
            $db->execute($stmt);
            header('location: login.php');
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: register.php');
        }
    }
    else {
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
  <h2>Register</h2>
  <?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; } ?>
  <form action="register.php" method="POST">
    <input name='username' placeholder='Username' type='text'>
    <input name='email' placeholder='email' type='text'>
    <input id='password' name='password' placeholder='Password' type='password'>
    <input id='password-repeat' name='password-repeat' placeholder='Password' type='password'>
    <input formmethod='POST' class='animated' type='submit' value='Enter'>
    </input>
    <a href="login.php">Login</a>
  </form>
</div>
</body>
</html>