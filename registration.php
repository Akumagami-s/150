<?php
    require('function.php');

    session_start();
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `art` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
        $query    = "SELECT * FROM art WHERE username='$username'
        AND password='" . md5($password) . "'";
        $result = query($query) or die(mysqli_error($conn));
        $_SESSION['user'] = $result;



        echo "<script>location.href='index.php';</script>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
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
<div style="display:flex;align-items:center;justify-content:center;width:100%;height:100vh;">
           <div class="card card-1">
            <center>     <h1 class="login-title">Registration</h1>
       </center>
           <form class="form" action="" method="post">

        <table>
            <tr>
                <td><label for="">Username</label></td>
                <td> <input type="text" class="login-input" name="username" placeholder="Username" required /></td>
            </tr>
            <tr>
                <td><label for="">Email</label></td>
                <td>  <input type="text" class="login-input" name="email" placeholder="Email Adress"></td>
            </tr>
            <tr>
                <td><label for="">Password</label></td>
                <td><input type="password" class="login-input" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" name="submit" value="Register" class="login-button"></td>
            </tr>
            <tr>
                <td>
       
       <p class="link">Already have an account? <a href="login.php">Login here</a></p></td>
            </tr>
        </table>
   
      
        

    </form>
</div>

</div>
</body>
</html>
