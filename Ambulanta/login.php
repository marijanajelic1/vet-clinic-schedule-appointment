<?php

session_start();

require_once "connection.php";

$usernameError=$passError="";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$conn->real_escape_string($_POST['username']);
    $pass=$conn->real_escape_string($_POST['password']);

    $val=true;
        if(empty($username)){
            $val=false;
            $usernameError="Username cannot be left blank!";
        }
        if(empty($pass)){
            $val=false;
            $passError="Password cannot be left blank!";
        }
    if($val){
        $sql= "SELECT * FROM user WHERE username='$username'";
        $result=$conn->query($sql);
        if($result->num_rows==0){
            $usernameError="This username doesn't exist!";
        }else{
            $row=$result->fetch_assoc();
            $dbPass=$row['password'];
            if($dbPass!=$pass){
                $passError="Incorrect password!";
            }
        
            else{
                $_SESSION['id']=$row['id'];
                $_SESSION['username']=$row['username'];
                $_SESSION['type']=$row['type'];
                header('Location:tasks/tasksindex.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <title>Login Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <style>
        .center {
    width: 50%;
    
    margin:auto;
    padding: 10px;
  }

    </style>
  </head>
  <body>
    <h1>Login</h1>
    <form action="" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username"><br><br>
      <span class='error'><?php echo $usernameError ?></span>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br><br>
      <span class='error'><?php echo $passError ?></span>
      <input type="submit" value="Login">
    </form>
  </body>
</html>