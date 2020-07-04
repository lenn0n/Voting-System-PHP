<?php session_start(); ?>
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
<li><a href='index.php'>Vote</a></li>
<li><a href='candidates.php' class='active'>Candidates</a></li>
<li><a href='status.php'>Unofficial Tally</a></li>
<li><a href='contact-us.php'>Report a Problem</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul> 
</nav>";
}
else{
echo "<nav class='art-nav'>
<ul class='art-hmenu'>
<li><a href='index.php'>Vote</a></li>
<li><a href='candidates.php' class='active'>Candidates</a></li>
<li><a href='status.php'>Unofficial Tally</a></li>
<li><a href='contact-us.php'>Report a Problem</a></li>
</ul> 
</nav>";
}
mysql_close($con);
?>
<div class="art-post"><br>

<?php
$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='President'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:15px 15px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For President )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='IVPresident'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:15px 15px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For Internal Vice President )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}


$populate = mysql_query("SELECT * FROM candidates WHERE c_position='EVPresident'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:25px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For External Vice President )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}

$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Secretary'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:25px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For Secretary )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}


$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Treasurer'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:25px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For Treasurer )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}

$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Auditor'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:25px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For Auditor )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='P.R.O.'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:25px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For P.R.O. )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}

$populate = mysql_query("SELECT * FROM candidates WHERE c_position='BusinessManager'");
								while ($row=mysql_fetch_array($populate)){
								echo "<div style='background-color:black;opacity: .8;border-radius:25px 15px 15px '>
								<div style='font-size:40px;text-align:center;color:white;font-weight:bold'><br> $row[c_name] $row[c_lname]<div style='font-size:15px;color:yellow;margin-bottom:10px'>( Running For Business Manager )</div></div>
								<center><img src='$row[c_urlpic]' width='250px' height='250px' style='border-radius:35px 15px 15px 15px'/><br>
								<br><font color='white' style='text-decoration:none'>$row[c_course]</font>
								<br><font color='white' style='text-decoration:none'><b>$row[c_partylist]</b></font>
								</center>
								<div style='font-family:roman;font-size:20px;text-align:center;padding-top:20px;font-style:italic'>\"$row[c_about]\"<br> <font style='font-style:normal'>------0o0------</font></div>
								<br>
								<br>
								</div><br>
								";
								
								}




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
<center><a href="candidates.php" style="text-decoration:none">GO BACK TO TOP</a></center>
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