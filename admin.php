<?php session_start(); 


$con = mysql_connect("localhost","root","");
mysql_select_db("votingsystem", $con);
$authlogin = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
if (mysql_num_rows($authlogin) > 0){
$authstatus = mysql_query("SELECT * FROM adminlist WHERE adminid='$_SESSION[sid]'");
if (mysql_num_rows($authstatus) > 0){

						// Prevent SQL Injection.
						function clean($str) {
						$str = @trim($str);
						if(get_magic_quotes_gpc()) {
						$str = stripslashes($str);
						}
						return mysql_real_escape_string($str);
						}
						$_SESSION["tn"] = clean($_POST['titlename']);
						
						// End of Cleaning!
						
if ($_POST['action'] == "updatetitle"){
mysql_query("UPDATE title SET text = '$_SESSION[tn]' WHERE auth = 'admin'");
}
if ($_POST['action'] == "votestatus"){
if ($_POST['vset'] == "0"){
mysql_query("UPDATE voting SET allowvoting = '0' WHERE auth = 'admin'");
}
else if ($_POST['vset'] == "1"){
mysql_query("UPDATE voting SET allowvoting = '1' WHERE auth = 'admin'");
}
}
if ($_POST['action'] == "updatecover"){
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if file already exists
if (file_exists($target_file)) {
    echo "<div id='errornotif'>Sorry, file already exists.</div>";
    $uploadOk = 0;
}

// Allow certain file formats
else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<div id='errornotif'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if($uploadOk == 0) {
    
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "<div id='upload' style='font-size:20px;text-align:center'>The cover photo was updated successfully!</div>";
	  $_SESSION['coverpath'] = basename($_FILES["fileToUpload"]["name"]);
	  mysql_query("UPDATE cover SET url = 'images/$_SESSION[coverpath]' WHERE auth = 'admin'");
	  unlink($_SESSION[cover]);

    } else {
        echo "<div id='errornotif'>Sorry, there was an error uploading your file.</div>";
     }
}
}
if ($_POST['action'] == "addcandy"){
$cname = $_POST['cname'];
$clname = $_POST['clname'];
$csid = $_POST['csid'];
$csec = $_POST['csec'];
$csex = $_POST['csex'];
$cage = $_POST['cage'];
$cgpa = $_POST['cgpa'];
$cpl = $_POST['cpl'];
$cabout = $_POST['cabout'];
$cposition = $_POST['cposition'];

$target_dir = "candidates/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$p = mysql_query("SELECT * FROM candidates");
while ($row = mysql_fetch_array($p)){
if ($csid == $row[c_id]){
	echo "<div id='errornotif'>Student ID already exist!</div>";
    $uploadOk = 0;
}
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<div id='errornotif'>Sorry, image file already exists.</div>";
    $uploadOk = 0;
}

// Allow certain file formats
else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<div id='errornotif'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
}

else if ($csid == null || $csid == ""){
 echo "<div id='errornotif'>Please input candidate Student ID!</div>";
 $uploadOk = 0;
 }
 

else if ($cname == null || $cname == ""){
 echo "<div id='errornotif'>Please input candidate name!</div>";
 $uploadOk = 0;
 }
 else if ($clname == null || $clname == ""){
 echo "<div id='errornotif'>Please input candidate last name!</div>";
 $uploadOk = 0;
 }
 
else if ($csec == null || $csec == ""){
 echo "<div id='errornotif'>Please input candidate course!</div>";
 $uploadOk = 0;
 }
 
else if ($cpl == null || $cpl == ""){
 echo "<div id='errornotif'>Please input candidate partylist!</div>";
 $uploadOk = 0;
 }
 
// Check if $uploadOk is set to 0 by an error
if($uploadOk == 0) {
    
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "<div id='upload' style='font-size:20px;text-align:center'>The candidate was successfully added!</div>";
	  $_SESSION['candypic'] = basename($_FILES["fileToUpload"]["name"]);
	  mysql_query("INSERT INTO candidates(c_id,c_course,c_lname,c_name,c_sex,c_age,c_gpa,c_about,c_position,c_partylist,c_urlpic) VALUES('$csid','$csec','$clname','$cname','$csex','$cage','$cgpa','$cabout','$cposition','$cpl','candidates/$_SESSION[candypic]')");
	  

    } else {
        echo "<div id='errornotif'>Sorry, there was an error uploading candidate image.</div>";
     }
}


}
}
}
mysql_close($con);
?>

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
<header class="art-header" style="background: url('<?php echo "$_SESSION[cover]"; ?>')"></header>
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

$con = mysql_connect("localhost","root","");
mysql_select_db("votingsystem", $con);
$authlogin = mysql_query("SELECT * FROM userslogin WHERE studentid='$_SESSION[sid]' and pwd='$_SESSION[pwd]'");
if (mysql_num_rows($authlogin) > 0){
$authstatus = mysql_query("SELECT * FROM adminlist WHERE adminid='$_SESSION[sid]'");
if (mysql_num_rows($authstatus) > 0){

		
		//Allow Voting
		$checkstatus = mysql_query("SELECT * FROM voting WHERE auth = 'admin'");
		while ($row = mysql_fetch_array($checkstatus)){
		if ($row[allowvoting] == 1){
		
		//-Turn Off Voting System!
		echo "<form method = 'POST' action = 'admin.php'>
		<input type='hidden' name='action' value='votestatus'/>
		<input type='hidden' name='vset' value='0'/><font style='font-size:25px;font-family:rockwell'>TURN VOTING SYSTEM: </font>
		<input type='submit' style='font-size:20px;font-family:rockwell;padding:5px;background-color:maroon;color:white;border-radius: 15px 15px 15px 15px' value='OFF'/>
		</form>
		";
		}
		else{
		//-Turn On Voting System!
		echo "<form method = 'POST' action = 'admin.php'>
		<input type='hidden' name='action' value='votestatus'/>
		<input type='hidden' name='vset' value='1'/><font style='font-size:25px;font-family:rockwell'>TURN VOTING SYSTEM: </font>
		<input type='submit' style='font-size:20px;font-family:rockwell;padding:5px;background-color:green;color:white;border-radius: 15px 15px 15px 15px' value='ON'/>
		</form>
		";
		}
		}
		
		//Update Title
		$fetchdata = mysql_query("SELECT * FROM title WHERE auth = 'admin'");
		while ($row = mysql_fetch_array($fetchdata)){
		echo "<form method='POST' action='admin.php'>
		<div style='font-size:20px;margin:10px'>
		Title: <input type='text' name='titlename' value='$row[text]'/><input type='hidden' name='action' value='updatetitle'/>
		<input type='submit' style='font-size:20px;font-family:rockwell;padding:5px;background-color:black;color:white;border-radius: 5px 5px 15px 5px' value='UPDATE'/>
		
		</form>
		";
		}
		
		//Update Cover Photo
		echo "<br>
		<form action='admin.php' method='POST' enctype='multipart/form-data'>Cover:
		<input type='file' name='fileToUpload' id='cover' style='padding-bottom:10px;padding-top:8px'/><br>
		<input type='hidden' name='action' value='updatecover'/>
		<input type='submit' value='CHANGE COVER' name='submit' style='font-size:20px;background-color:darkblue;color:white;font-family:rockwell;padding:5px;border-radius: 5px 5px 15px 5px'/> (900 x 300 pixels only)
		</form>
		
		";
		
		//Add Candidate
		echo "<hr/><div style='font-size:25px;font-family:rockwell'>ADD CANDIDATE:</div>";
		echo "<br>
		<form action='admin.php' method='POST' enctype='multipart/form-data'>Display Picture:
		<input type='file' name='fileToUpload' id='cover' style='padding-bottom:10px;padding-top:8px'/><br>
		<input type='hidden' name='action' value='addcandy'/>
		<div style='font-size:18px;margin:10px'>
		Candidate ID:<br> <input type='text' name='csid' value='".$csid."'/><br>
		First Name  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp Last Name<br> <input type='text' name='cname' value='".$cname."'/> &nbsp &nbsp &nbsp &nbsp <input type='text' name='clname' value='".$clname."'/><br>
		Course:<br> <input type='text' name='csec' value='".$csec."'/><br>
		Gender:<br> <select name='csex'>
		<option value='Male'>Male</option>
		<option value='Female'>Female</option>
		</select><br>
		Age: <br> <select name='cage'>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
		<option value='24'>24</option>
		<option value='25'>25</option>
		<option value='26'>26</option>
		<option value='27'>27</option>
		<option value='28'>28</option>
		<option value='29'>29</option>
		<option value='30'>30</option>
		</select><br>
		GPA: <br><select name='cgpa'>
		<option value='1.00'>1.00</option>
		<option value='1.25'>1.25</option>
		<option value='1.50'>1.50</option>
		<option value='1.75'>1.75</option>
		<option value='2.00'>2.00</option>
		<option value='2.25'>2.25</option>
		<option value='2.50'>2.50</option>
		<option value='2.75'>2.75</option>
		<option value='3.00'>3.00</option>

		</select><br>
		
		Running For: <br><select name='cposition'>
		<option value='President'>President</option>
		<option value='IVPresident'>Internal Vice President</option>
		<option value='EVPresident'>External Vice President</option>
		<option value='Secretary'>Secretary</option>
		<option value='Treasurer'>Treasurer</option>
		<option value='Auditor'>Auditor</option>
		<option value='P.R.O.'>P.R.O</option>
		<option value='BusinessManager'>Business Manager</option>
		</select></br>
		PartyList:<br> <input type='text' name='cpl' value='".$cpl."'/><br>
		About: <br> <textarea name='cabout'>".$cabout."</textarea><br>
		</div>
		<input type='submit' value='Add Candidate' name='submit' style='font-size:20px;background-color:green;color:white;font-family:rockwell;padding:5px;border-radius: 5px 5px 15px 5px'/>
		</form>

		";	


}
}
mysql_close($con);
?>
</div>
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
<p style="font-size:18px;font-family:rockwell">Copyright © 2017-2018, All Rights Reserved.</p>
</footer>
</div><br><br>
</div>
</body></html>