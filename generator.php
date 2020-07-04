<?php
session_start();


echo '<div class="wrapper"><div class="menubar"><form action="generatepass.php" method="POST"><div style="margin-left:120px">Student ID:
<input type="text" name="id" value="'.$_SESSION[gid].'"/><br><br>Password:
<input type="" name="pass" value="'.$_SESSION[gpass].'"/><br><br></div>
<input type="submit"  style="margin-left:250px" value="Generate Password"/>
</form>

<form action="generateaccount.php" method="POST">
<input type="submit" value="Register This Account" style="margin-left:240px"/>


</form>
</div></div>


';



?>

<style>
body{
font-size:25px;
font-weight:bold;

	}
.wrapper{
	width:1000px;
	height:auto;
	margin:auto;
}
.menubar{
	max-width: 700px;
	background-color: #FFFFFF;
	margin-left: auto;
	margin-right: auto;
	padding: 10px;
	box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.12);
	border: 1px solid #E4E4E4;

}

input{
font-size:25px;

}

</style>