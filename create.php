<html>
    <head>
        <style type="text/css">
          body{
            background-image: url("back.jpg");
          }
          label{
            font-weight:bold; font-style:bold;
          }
  
</style>
<link rel="stylesheet" href="createcss.css">
   
</head>
<body>




<div class="background">


</div>
<form action="" method="post">
  <h3>My Business | Create Account</h3>

  <label for="username">Username</label>
  <input type="text" placeholder="Email or Phone" name="user" required>

  <label for="password">Password</label>
  <input type="password" placeholder="Pass" name="password" required>
  <label for="password">Telephone</label>
  <input type="text" placeholder="phone number" name="phone" required>
  <label for="password">E-mail</label>
  <input type="text" placeholder="E-mail" name="email" required>

  <input type="submit" name="create" value="Sign Up" style="background-color: rgb(73, 73, 248);">
  <div class="social">
    <a href="index.php"><div class="go"><i class="fab fa-google"></i> Sign in</div></a>
    <div class="fb"><i class="fab fa-facebook"></i> Forgot password?</div>
  </div>
</form>
<?php
if(isset($_POST['create']))
{
  require_once './pages/includes/connection.php';
    $user=$_POST['user'];
    $pass=$_POST['password'];
    $phn=$_POST['phone'];
    $mail=$_POST['email'];
    $insert= mysqli_query($conn,"INSERT INTO `user` (`userid`, `username`, `password`, `email`, `phone`) 
    VALUES (NULL, '$user', '$pass', '$phn', '$mail')") or die("failed to create");
    if($insert)
    {
        echo"<script>alert('Your account have been created login now')</script>";
        echo"<script>location.href='index.php'</script>";

    }

   
}
?>
</body>
</html>
