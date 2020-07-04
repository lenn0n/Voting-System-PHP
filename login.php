<?php session_start();
 error_reporting (E_ALL ^ E_NOTICE); ?>

<!DOCTYPE html>
<html>
<style type="text/css">
body{
font-size: 110%;
font-family:rockwell;
float: left;
color:white;
}
a{
color:white;
}
input{
font-size: 110%;
font-family:rockwell;
}
</style>
<body>
<form method="POST" action="index.php" target="_parent">
<div style="float:left;padding-left:40px"><img src="images/computers.png"/></div>
<div style="float:left;padding-top:20px">Student ID: &nbsp <input type="text" name="fsid" value="<?php echo $_SESSION['sid'];?>"/><br><br>
Password:&nbsp &nbsp <input type="password" name="fpwd"/> <br><br></div>
<div style="float:left;padding-left:70px;padding-top:20px">Need an Account?<br><font style="color:lightgreen"> Please contact any<br>staff member of<br>FICT Organization.</font><br></div>
<div style="clear:both;margin-left:30px" align="center"> <input type="submit" style="background-color:darkblue;color:white;padding:7px;border-radius:15px 15px 15px 15px;margin-top:-10px" value="Login My Account"/></div>

</form>
</body>
</html>


