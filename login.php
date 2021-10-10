<?php
    require('function.php');
    session_start();
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);   
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        
        $query    = "SELECT * FROM art WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = query($query) or die(mysqli_error($conn));
        
        
        
        
        if (mysqli_num_rows(mysqli_query($conn,$query)) == 1) {
            $_SESSION['user'] = $result;
         
             echo "<script>location.href='index.php';</script>";
            die();
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } 
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style2.css"/>
</head>
<body>

    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  </form>

</body>
</html>