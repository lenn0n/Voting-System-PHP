<?php session_start(); ?>

<?php 

$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
$cp = mysql_query("SELECT * FROM adminlist WHERE adminid = '$_SESSION[sid]'");
if (mysql_num_rows($cp) > 0){

$check = mysql_query("SELECT * FROM userslogin WHERE studentid = '$_SESSION[gid]'");
if (mysql_num_rows($check) == 0){
if ($_SESSION['confirm'] == "ok"){
mysql_query("INSERT INTO userslogin(studentid,pwd) VALUES('$_SESSION[gid]','$_SESSION[gpass]')");
echo "Account was successfully registered!  <a href='generator.php'>Go Back</a>";
}
else{
echo "Student ID was not found in memberlist!  <a href='generator.php'>Go Back</a>";
}
}
else{
echo "Student ID was already registered!  <a href='generator.php'>Go Back</a>";
}
}
?>