<?php session_start(); 
 error_reporting (E_ALL ^ E_NOTICE);?>
<?php
$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
$cp = mysql_query("SELECT url FROM cover WHERE auth = 'admin'");
while ($row = mysql_fetch_array($cp)){
$_SESSION['cover'] = $row['url'];
}
$title = mysql_query("SELECT text FROM title WHERE auth = 'admin'");
while ($row = mysql_fetch_array($title)){
$_SESSION['title'] = $row['text'];
}
mysql_close($con);

?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>FICT Voting System</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <link rel="stylesheet" href="style.css" media="screen">
</head>
<body>
<div id="art-main">
<div class="art-sheet clearfix">
<header class="art-header" style="background: url('<?php echo "$_SESSION[cover]"; ?>');opacity: 0.9;border-left:3px solid #292929;border-right:3px solid #292929;border-top:3px solid #292929;"></header>
<div id="title"><big><?php echo "$_SESSION[title]";?></big></div>
<?php 

$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
$process = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
if (mysql_num_rows($process) > 0){
echo "<nav class='art-nav'>
<ul class='art-hmenu'>
<li><a href='index.php' class='active'>Vote</a></li>
<li><a href='candidates.php'>Candidates</a></li>
<li><a href='status.php'>Unofficial Tally</a></li>
<li><a href='contact-us.php'>Report a Problem</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul> 
</nav>";
}
else{
echo "<nav class='art-nav'>
<ul class='art-hmenu'>
<li><a href='index.php' class='active'>Vote</a></li>
<li><a href='candidates.php'>Candidates</a></li>
<li><a href='status.php'>Unofficial Tally</a></li>
<li><a href='contact-us.php'>Report a Problem</a></li>
</ul> 
</nav>";
}
mysql_close($con);
?>
<div class="art-post"><br>
				    <?php 
						if (isset($_POST['fsid'])){
						
						// Prevent SQL Injection.
						function clean($str) {
						$str = @trim($str);
						if(get_magic_quotes_gpc()) {
						$str = stripslashes($str);
						}
						return mysql_real_escape_string($str);
						}
						$_SESSION["sid"] = clean($_POST['fsid']);
						$_SESSION["pwd"] = clean($_POST['fpwd']);
						// End of Cleaning!
						
						$con = mysql_connect("localhost","root","");
						mysql_select_db("VotingSystem", $con);
						$process = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
						if (mysql_num_rows($process) > 0){
						echo "<div id='successnotif'>Login Successfully!</div><br>";
						$fetchname = mysql_query("SELECT * FROM usersdata WHERE studentid = '$_SESSION[sid]'");
								while ($row = mysql_fetch_array($fetchname)){
								echo "<img src='images/computers.png' style='float:left;margin-left:0px'/><br><hr/><div style='font-size:25px;color:white;margin-bottom:10px;font-family:rockwell'><font style='color:lightblue'>ACCOUNT:</font> $row[fname] $row[lname] <font style='font-size:20px' color='pink'>[$row[studentid]]</font><br>
								<font style='color:lightblue'>SECTION:</font> $row[section]
								</div><hr/>";
						}
						$cp = mysql_query("SELECT * FROM adminlist WHERE adminid = '$_SESSION[sid]'");
						if (mysql_num_rows($cp) > 0){
						echo "<div style='align:center'><a href='index.php'><img src='images/ok.png'/></a><a href='admin.php'><img src='images/admincp.png'/></a></div></div>";
						}
						else{
						echo "<div style='align:center'><a href='index.php'><img src='images/ok.png'/></a></div></div>";
						}
						echo '<div class="art-postcontent art-postcontent-0 clearfix">

						<h3 style="text-align:center;font-size:21px">Vote Wisely!</h3>
						<p style="padding-left:13px;padding-right:13px;font-size:15px;font-size:20px;font-style:italic;text-align:center">
						"Those who stay away from the election think that one vote will do no good. <br>
						 Tis but one step more to think one vote will do no harm."<br> <font style="font-size:15px">~Ralph Waldo Emerson</font>
						</p>

						</div><br>
						<footer class="art-footer">
						<p style="font-size:18px;font-family:rockwell">Copyright © 2017-2018, All Rights Reserved.</p>
						</footer>
						</div>
						</div>';
						exit();
						}
						else{
						echo "<div id='errornotif'>Login Error: Student ID and Password didn't match!</div>";
							}
						mysql_close($con);
					}
						
						$con = mysql_connect("localhost","root","");
						mysql_select_db("VotingSystem", $con);
						$process = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
						if (mysql_num_rows($process) > 0){
						// Logged Users Can See This!
						$getname = mysql_query("SELECT * FROM usersdata WHERE studentid = '$_SESSION[sid]'");
						while($name = mysql_fetch_array($getname)){
						$_SESSION['name'] = $name['fname'] . " " . $name['lname'];
						}
						$checkstatus = mysql_query("SELECT allowvoting FROM voting WHERE auth = 'admin'");
						while ($row=mysql_fetch_array($checkstatus)){
						if ($row['allowvoting']==1){
						// VOTING SYSTEM IS OPEN
						$checkpres = mysql_query("SELECT * FROM candidates WHERE c_position='President'");
						$checkivpres = mysql_query("SELECT * FROM candidates WHERE c_position='IVPresident'");
						$checkevpres = mysql_query("SELECT * FROM candidates WHERE c_position='EVPresident'");
						$checksec = mysql_query("SELECT * FROM candidates WHERE c_position='Secretary'");
						$checktre = mysql_query("SELECT * FROM candidates WHERE c_position='Treasurer'");
						$checkaud = mysql_query("SELECT * FROM candidates WHERE c_position='Auditor'");
						$checkpro = mysql_query("SELECT * FROM candidates WHERE c_position='P.R.O.'");
						$checkbm = mysql_query("SELECT * FROM candidates WHERE c_position='BusinessManager'");
						if (mysql_num_rows($checkpres) > 0 && mysql_num_rows($checkivpres) > 0 && mysql_num_rows($checkevpres) > 0 && mysql_num_rows($checksec) > 0 && mysql_num_rows($checktre) > 0 && mysql_num_rows($checkaud) > 0 && mysql_num_rows($checkpro) > 0 && mysql_num_rows($checkbm) > 0){
						
								//System has enough candidates to present.
								$usercheckvote = mysql_query("SELECT voted FROM usersdata WHERE studentid = '$_SESSION[sid]'");
								while ($row=mysql_fetch_array($usercheckvote)){
								if ($row['voted'] == 0){
								// VOTING STARTS HERE!
								
								echo "<iframe style='border:0;margin:-10px;padding:-10px' width='900px' height='150px' src='show.php' name='panel'></iframe><hr/>";

								if ($_SESSION['votep'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='President'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_presidentid' value='$row[c_id]'/>
								<input type='hidden' name='post_pname' value='$row[c_lname]'/>
								<input type='hidden' name='post_purlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For President'/>
								</form></div>
								</table>";
								
								}
								}

								else if ($_SESSION['voteivp'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='IVPresident'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_ivpresidentid' value='$row[c_id]'/>
								<input type='hidden' name='post_ivpname' value='$row[c_lname]'/>
								<input type='hidden' name='post_ivpurlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For Internal Vice'/>
								</form></div>
								</table>";
								
								}
								}
								else if ($_SESSION['voteevp'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='EVPresident'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_evpresidentid' value='$row[c_id]'/>
								<input type='hidden' name='post_evpname' value='$row[c_lname]'/>
								<input type='hidden' name='post_evpurlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For External Vice'/>
								</form></div>
								</table>";
								
								}
								}
								else if ($_SESSION['votesec'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Secretary'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_secid' value='$row[c_id]'/>
								<input type='hidden' name='post_secname' value='$row[c_lname]'/>
								<input type='hidden' name='post_securlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For Secretary'/>
								</form></div>
								</table>";
								
								}
								}
								else if ($_SESSION['votetre'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Treasurer'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_treid' value='$row[c_id]'/>
								<input type='hidden' name='post_trename' value='$row[c_lname]'/>
								<input type='hidden' name='post_treurlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For Treasurer'/>
								</form></div>
								</table>";
								
								}
								}
								else if ($_SESSION['voteaud'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Auditor'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_audid' value='$row[c_id]'/>
								<input type='hidden' name='post_audname' value='$row[c_lname]'/>
								<input type='hidden' name='post_audurlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For Auditor'/>
								</form></div>
								</table>";
								
								}
								}
								else if ($_SESSION['votepro'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='P.R.O.'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_proid' value='$row[c_id]'/>
								<input type='hidden' name='post_proname' value='$row[c_lname]'/>
								<input type='hidden' name='post_prourlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For P.R.O.'/>
								</form></div>
								</table>";
								
								}
								}
								else if ($_SESSION['votebm'] == 0){
								$populate = mysql_query("SELECT * FROM candidates WHERE c_position='BusinessManager'");
								while ($row=mysql_fetch_array($populate)){
								echo "<table style='clear:both'><br>
								<img src='$row[c_urlpic]' width='150px' height='150px' style='float:left;border-radius:35px 15px 15px 15px'/>
								<form method='POST' action='vote.php'> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:40px;color:white;font-weight:bold'>$row[c_name] $row[c_lname]</div>
								Gender: <font color='pink' style='text-decoration:underline'>$row[c_sex]</font><br>
								Age: <font color='yellow'>$row[c_age] </font><br>
								Course: <font color='lightblue' style='text-decoration:underline'>$row[c_course]</font><br>
								GPA: <font color='lightgreen'>$row[c_gpa]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='float:right;padding-top:35px'><form method='POST' action='vote.php'>
								<input type='hidden' name='post_bmid' value='$row[c_id]'/>
								<input type='hidden' name='post_bmname' value='$row[c_lname]'/>
								<input type='hidden' name='post_bmurlpic' value='$row[c_urlpic]'/>
								<input type='submit' style='padding:15px;font-size:15px;border-radius:5px 20px 5px 20px;color:white;background-color:green' value='Vote For Business Manager'/>
								</form></div>
								</table>";
								
								}
								}
								else{
								echo "
								<div style='font-size:40px;text-align:center;font-family:rockwell;color:white'>You are about to vote all these people, <br>Do you want to proceed?<br>
								<form action='finishvoting.php' method='POST'><input type='submit' style='border-radius:50px 50px 50px 50px;margin-top:10px;padding:15px;background-color:green;color:white;font-size:30px;font-family:gothic' name='useract' value='YES, VOTE THEM ALL!'/>
								</form>
								<form action='candidates.php' method='POST'><input type='submit' style='border-radius:50px 50px 50px 50px;margin-top:10px;padding:15px;background-color:maroon;color:white;font-size:30px;font-family:gothic' name='useract' value='NO, LET ME THINK ABOUT IT.'/>
								</form></div>

								";
								
								}
								
								}
								else{
								// USER ALREADY VOTED~!
								$con = mysql_connect("localhost","root","");
								mysql_select_db("votingsystem", $con);
								$fetchname = mysql_query("SELECT * FROM usersdata WHERE studentid = '$_SESSION[sid]'");
								while ($row = mysql_fetch_array($fetchname)){
								echo "<img src='images/computers.png' style='float:left;margin-left:0px;margin-top:-20px'/><br><div style='font-size:25px;color:white;margin-bottom:10px;margin-top:-26px;font-family:rockwell'><hr/><font style='color:lightblue'>ACCOUNT:</font> $row[fname] $row[lname] <font style='font-size:20px' color='pink'>[$row[studentid]]</font><br>
								<font style='color:lightblue'>SECTION:</font> $row[section]<br><font style='color:white'>STATUS:</font> <font style='color:lightgreen'>VOTED</font>
								</div><hr/><br>";
								}
								$query = mysql_query("SELECT * FROM usersdata WHERE studentid = '$_SESSION[sid]'");
								while ($row = mysql_fetch_array($query)){
								$_SESSION['upid'] = $row[p];
								$_SESSION['uivpid'] = $row[ivp];
								$_SESSION['uevpid'] = $row[evp];
								$_SESSION['usecid'] = $row[sec];
								$_SESSION['utreid'] = $row[tre];
								$_SESSION['uaudid'] = $row[aud];
								$_SESSION['uproid'] = $row[pro];
								$_SESSION['ubmid'] = $row[bm];
								}
								$view1 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[upid]");
								$view2 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[uivpid]");
								$view3 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[uevpid]");
								$view4 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[usecid]");
								$view5 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[utreid]");
								$view6 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[uaudid]");
								$view7 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[uproid]");
								$view8 = mysql_query("SELECT * FROM candidates WHERE c_id = $_SESSION[ubmid]");
								echo '<div style="background-color:black;opacity: .7;border-radius:35px 0 15px 0">';
								while ($row = mysql_fetch_array($view1)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as President</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}
								while ($row = mysql_fetch_array($view2)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as Internal Vice President</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								while ($row = mysql_fetch_array($view3)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as External Vice President</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								while ($row = mysql_fetch_array($view4)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as Secretary</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								while ($row = mysql_fetch_array($view5)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as Treasurer</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								while ($row = mysql_fetch_array($view6)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as Auditor</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								while ($row = mysql_fetch_array($view7)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as P.R.O.</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								while ($row = mysql_fetch_array($view8)){
								echo "<img src='$row[c_urlpic]' width='100px' height='100px' style='margin-left:20px;margin-top:20px;float:left;border-radius:35px 15px 15px 15px'/> 
								<div style='float:left;font-family:roman;font-size:20px;text-align:left;padding-left:20px'>
								<div style='font-size:30px;color:white;font-weight:bold;margin-top:25px'><font color='yellow'><i>$row[c_name] $row[c_lname]</i></font> as Business Manager</div>
								Course: <font color='white' style='text-decoration:none'>$row[c_course]</font><br>
								PartyList: <font color='orange'>$row[c_partylist]</font>
								</div><div style='clear:both;padding-bottom:20px'></div>";
								}								
								echo '<br></div>';
								}
								}
						}
						else{
						//INVALID ELECTION! Missing candidates!
						echo "<center><h1 style='font-size:50px'>The server is currently close.</h1><br><a href='logout.php'><img src='images/logout.png'/></a></center>";
						}
						}
						else{
						// VOTING SYSTEM IS CLOSE
						echo "<center><h1 style='font-size:50px'>THE VOTING SYSTEM IS CLOSED!</h1><br><a href='logout.php'><img src='images/logout.png'/></a></center>";
						}
						}
						}
						else{
						// Non-logged Users Can See This!
						echo "<iframe style='border:0' width='800' height='200' name='panel' src='login.php'></iframe>";
						}
						mysql_close($con);
						?>
</div>
<hr/>
<div class="art-postcontent art-postcontent-0 clearfix">

<h3 style="text-align:center;font-size:21px">Vote Wisely!</h3>
<p style="padding-left:13px;padding-right:13px;font-size:15px;font-size:20px;font-style:italic;text-align:center">
"Those who stay away from the election think that one vote will do no good. <br>
 Tis but one step more to think one vote will do no harm."<br> <font style="font-size:15px">~Ralph Waldo Emerson</font>
</p>

</div><br>
<footer class="art-footer">
<p style="font-size:18px;font-family:rockwell">Copyright © 2017-2018, All Rights Reserved.</p><br>
<?php
$con = mysql_connect("localhost","root","");
mysql_select_db("votingsystem", $con);
$authlogin = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
if (mysql_num_rows($authlogin) > 0){
$authstatus = mysql_query("SELECT * FROM adminlist WHERE adminid='$_SESSION[sid]'");
if (mysql_num_rows($authstatus) > 0){
echo "<div style='align:center'><a href='admin.php'><img src='images/admincp.png'/></a></div>";
}
}
?>
</footer>
</div><br><br>
</div>
</body></html>