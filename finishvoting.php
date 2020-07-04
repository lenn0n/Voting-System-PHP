<?php
session_start();
$con = mysql_connect("localhost","root","");
mysql_select_db("votingsystem", $con);
$login = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
if (mysql_num_rows($login) > 0){

$usercheckvote = mysql_query("SELECT voted FROM usersdata WHERE studentid = '$_SESSION[sid]'");
while ($row=mysql_fetch_array($usercheckvote)){
if ($row['voted'] == 0){

$cvp = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[president_id]'");
while ($row = mysql_fetch_array($cvp)){
$_SESSION['cvp'] = $row['c_hits'] + 1;
}
$cvivp = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[ivpresident_id]'");
while ($row = mysql_fetch_array($cvivp)){
$_SESSION['cvivp'] = $row['c_hits'] + 1;
}
$cvevp = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[evpresident_id]'");
while ($row = mysql_fetch_array($cvevp)){
$_SESSION['cvevp'] = $row['c_hits'] + 1;
}
$cvsec = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[secretary_id]'");
while ($row = mysql_fetch_array($cvsec)){
$_SESSION['cvsec'] = $row['c_hits'] + 1;
}
$cvtre = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[treasurer_id]'");
while ($row = mysql_fetch_array($cvtre)){
$_SESSION['cvtre'] = $row['c_hits'] + 1;
}
$cvaud = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[auditor_id]'");
while ($row = mysql_fetch_array($cvaud)){
$_SESSION['cvaud'] = $row['c_hits'] + 1;
}
$cvpro = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[pro_id]'");
while ($row = mysql_fetch_array($cvpro)){
$_SESSION['cvpro'] = $row['c_hits'] + 1;
}
$cvbm = mysql_query("SELECT * FROM candidates WHERE c_id = '$_SESSION[bm_id]'");
while ($row = mysql_fetch_array($cvbm)){
$_SESSION['cvbm'] = $row['c_hits'] + 1;
}
$_SESSION['votep'] = 0;
$_SESSION['voteivp'] = 0;
$_SESSION['voteevp'] = 0;
$_SESSION['votesec'] = 0;
$_SESSION['votetre'] = 0;
$_SESSION['voteaud'] = 0;
$_SESSION['votepro'] = 0;
$_SESSION['votebm'] = 0;
mysql_query("UPDATE usersdata SET voted = '1', p = '$_SESSION[president_id]', ivp = '$_SESSION[ivpresident_id]', evp = '$_SESSION[evpresident_id]', sec = '$_SESSION[secretary_id]', tre= '$_SESSION[treasurer_id]', aud = '$_SESSION[auditor_id]', pro = '$_SESSION[pro_id]', bm = '$_SESSION[bm_id]' WHERE studentid = '$_SESSION[sid]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvp]' WHERE c_id = '$_SESSION[president_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvivp]' WHERE c_id = '$_SESSION[ivpresident_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvevp]' WHERE c_id = '$_SESSION[evpresident_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvsec]' WHERE c_id = '$_SESSION[secretary_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvtre]' WHERE c_id = '$_SESSION[treasurer_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvaud]' WHERE c_id = '$_SESSION[auditor_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvpro]' WHERE c_id = '$_SESSION[pro_id]'");
mysql_query("UPDATE candidates SET c_hits = '$_SESSION[cvbm]' WHERE c_id = '$_SESSION[bm_id]'");
unset($_SESSION["president_id"]);
unset($_SESSION["ivpresident_id"]);
unset($_SESSION["evpresident_id"]);
unset($_SESSION["secretary_id"]);
unset($_SESSION["auditor_id"]);
unset($_SESSION["treasurer_id"]);
unset($_SESSION["pro_id"]);
unset($_SESSION["bm_id"]);
header("location: index.php");
mysql_close($con);
}
else{
header("location: index.php");
mysql_close($con);
}
}

}
else{
header("location: index.php");
mysql_close($con);
}

?>