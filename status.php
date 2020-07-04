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
<li><a href='candidates.php'>Candidates</a></li>
<li><a href='status.php' class='active'>Unofficial Tally</a></li>
<li><a href='contact-us.php'>Report a Problem</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul> 
</nav>";
}
else{
echo "<nav class='art-nav'>
<ul class='art-hmenu'>
<li><a href='index.php'>Vote</a></li>
<li><a href='candidates.php'>Candidates</a></li>
<li><a href='status.php' class='active'>Unofficial Tally</a></li>
<li><a href='contact-us.php'>Report a Problem</a></li>
</ul> 
</nav>";
}
mysql_close($con);
?>
<div class="art-post"><br>

<!--LETS START!-->
<?php
$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>President:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='President' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								
echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>Internal Vice President:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='IVPresident' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								
								echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>External Vice President:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='EVPresident' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>Secretary:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Secretary' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>Treasurer:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Treasurer' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>Auditor:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='Auditor' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>P.R.O.:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='P.R.O.' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								echo "<br><br><div style='font-size:40px;float:left;margin-right:110px;margin-top:-50px;font-family:rockwell'><font color='lightblue'>Business Manager:</font></div><div style='font-size:40px;float:right;margin-right:110px;margin-top:-50px;font-family:rockwell'>Votes</div>";
$populate = mysql_query("SELECT * FROM candidates WHERE c_position='BusinessManager' ORDER BY c_hits DESC");
								$c = 1;
								while ($row=mysql_fetch_array($populate)){
								echo "
								<div style='font-size:30px;color:white;font-weight:bold'><b style='color:orange'>[$c]</b> $row[c_name] $row[c_lname]</div>
								<div style='font-size:30px;float:right;margin-right:150px;margin-top:-40px'><b style='color:lightgreen'>$row[c_hits]</b></div>
								<div style='clear:both'></div>
								";
								$c++;
								}
								echo "<br> <br> <br>";
								
								?>
<!--END!-->
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