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
<style>

.card {
  background: #fff;
  border-radius: 2px;
  display: inline-block;
 padding:20px;
 border-radius:10px;
  margin: 1rem;
  position: relative;
  
}

.card-1 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

.card-1:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}


</style>
    <!-- <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  </form> -->

    <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100vh;">
           <div class="card card-1">
           <center><h2>Login</h2></center>
           <form class="form" method="post" name="login">
           <table>
                <tr>
                    <td><label for="">Username</label></td>
                    <td> <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/></td>
                </tr>
    <tr>
    <td><label for="">Password</label></td>
    <td> <input type="password" class="login-input" name="password" placeholder="Password"/></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2"><center><input type="submit" value="Login" name="submit" class="login-button"/></center></td>
    </tr>
    <tr>
        <td> <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p></td>
    </tr>
            </table>
            </form>
           </div>
    </div>


</body>
</html>