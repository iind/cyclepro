<?php

include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form 

$myusername=mysqli_real_escape_string($db,$_POST['username']); 
$mypassword=mysqli_real_escape_string($db,$_POST['password']); 


$sql="SELECT id FROM admin WHERE username='$myusername' and passcode='$mypassword'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$active=$row['id'];

$count=mysqli_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
#session_register("myusername");
$_SESSION['login_user']=$myusername;

header("location: welcome.php");
}
else 
{
$error="Your User Name or Password is invalid";
}
}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<html lang="en">
<title>Cycle Profix billing</title>

<style type="text/css">
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;

}
label
{
font-weight:bold;

width:100px;
font-size:14px;

}
.box
{
border:#666666 solid 1px;

}
</style>
</head>
<body background="images/cyclepro.jpg">
<div></div>

<div style="font-weight:bold; margin-bottom:10px"></div>

<div align="center" >
<div style="width:300px; border: solid 1px #333333; background-color:#FFEDDC" align="left">
<div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

<img src="images/head.png" height="32" width="300px">
<div style="margin:30px">

<form action="" method="post">
<label>User Name  </label><input type="text" name="username" /><br /><br />
<label>Password   </label><input type="password" name="password" /><br/><br />
<input type="submit" value=" Log in "/><br />

</form>
<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</div>
</div>
</div>

</body>
</html>
