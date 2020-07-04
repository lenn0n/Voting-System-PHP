<?php
session_start();

$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
$process = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
if (mysql_num_rows($process) > 0){

						// Prevent SQL Injection.
						function cleanvote($str) {
						$str = @trim($str);
						if(get_magic_quotes_gpc()) {
						$str = stripslashes($str);
						}
						return mysql_real_escape_string($str);
						}
						// Cleaner executed!
						
						
if (isset($_POST['post_presidentid'])){
$_SESSION['votep'] = 1;
$_SESSION['president_id'] = cleanvote($_POST['post_presidentid']);
$_SESSION['pname'] = cleanvote($_POST['post_pname']);
$_SESSION['purlpic'] = cleanvote($_POST['post_purlpic']);
}

if (isset($_POST['post_ivpresidentid'])) {
$_SESSION['voteivp'] = 1;
$_SESSION['ivpresident_id'] = cleanvote($_POST['post_ivpresidentid']);
$_SESSION['ivpname'] = cleanvote($_POST['post_ivpname']);
$_SESSION['ivpurlpic'] = cleanvote($_POST['post_ivpurlpic']);
}

if (isset($_POST['post_evpresidentid'])) {
$_SESSION['voteevp'] = 1;
$_SESSION['evpresident_id'] = cleanvote($_POST['post_evpresidentid']);
$_SESSION['evpname'] = cleanvote($_POST['post_evpname']);
$_SESSION['evpurlpic'] = cleanvote($_POST['post_evpurlpic']);
}


if (isset($_POST['post_secid'])) {
$_SESSION['votesec'] = 1;
$_SESSION['secretary_id'] = cleanvote($_POST['post_secid']);
$_SESSION['secname'] = cleanvote($_POST['post_secname']);
$_SESSION['securlpic'] = cleanvote($_POST['post_securlpic']);
}

if (isset($_POST['post_treid'])) {
$_SESSION['votetre'] = 1;
$_SESSION['treasurer_id'] = cleanvote($_POST['post_treid']);
$_SESSION['trename'] = cleanvote($_POST['post_trename']);
$_SESSION['treurlpic'] = cleanvote($_POST['post_treurlpic']);
}

if (isset($_POST['post_audid'])) {
$_SESSION['voteaud'] = 1;
$_SESSION['auditor_id'] = cleanvote($_POST['post_audid']);
$_SESSION['audname'] = cleanvote($_POST['post_audname']);
$_SESSION['audurlpic'] = cleanvote($_POST['post_audurlpic']);
}

if (isset($_POST['post_proid'])) {
$_SESSION['votepro'] = 1;
$_SESSION['pro_id'] = cleanvote($_POST['post_proid']);
$_SESSION['proname'] = cleanvote($_POST['post_proname']);
$_SESSION['prourlpic'] = cleanvote($_POST['post_prourlpic']);
}

if (isset($_POST['post_bmid'])) {
$_SESSION['votebm'] = 1;
$_SESSION['bm_id'] = cleanvote($_POST['post_bmid']);
$_SESSION['bmname'] = cleanvote($_POST['post_bmname']);
$_SESSION['bmurlpic'] = cleanvote($_POST['post_bmurlpic']);
}

header("location: index.php");

}
mysql_close($con);
?>