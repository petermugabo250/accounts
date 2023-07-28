<html>
    <head>
        <style type="text/css">
          body{
            background-image: url("back.jpg");
          }
          .background {
  width: 430px;
  height: 480px;
  position: absolute;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
  background-color: #080710;
}    
</style>
<link rel="stylesheet" href="logincss.css">
   
</head>
<body>




<div class="background">


</div>
<form action="" method="post">
  <h3>My Business | Login Page</h3>

  <label for="username">Username</label>
  <input type="text" placeholder="Email or Phone" name="username" required>

  <label for="password">Password</label>
  <input type="password" placeholder="Password" name="password" required>

  <input type="submit" name="login" value="Login" style="background-color: rgb(73, 73, 248);color:white;">
  <div class="social">
    <a href="create.php"><div class="go"><i class="fab fa-google"></i> Sign Up</div></a>
    <div class="fb"><i class="fab fa-facebook"></i> Forgot password?</div>
  </div>
</form>
<?php
if(isset($_POST['login']))
{
  require_once './includes/connection.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query=mysqli_query($conn,"select * from user where username='$user' and password='$pass'");
$login=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
if($login>0){
session_start();
 	$_SESSION['username']=$row['username'];
	echo"<script>alert('login successfully')</script>";
	echo"<script>location.href='accounts.php'</script>";
	}
	else{
		echo"<script>alert('incorrect Username or Password')</script>";
		echo"<script>location.href='index.php'</script>";
    
}}
?>
</body>
</html>
