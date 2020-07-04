<?php session_start(); ?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>FICT Voting System</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <link rel="stylesheet" href="style.css" media="screen">
</head>
<body style="margin-left:25px">
<?php
if (isset($_SESSION[president_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:20px'>President</div>
<img src='$_SESSION[purlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removepres'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[pname]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:20px'>President</div>
<img src='candidates/defaults/President.png' width='100px' height='100px'/> </div>";
}

if (isset($_SESSION[ivpresident_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:10px'>Internal Vice</div>
<img src='$_SESSION[ivpurlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removeivpres'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[ivpname]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:10px'>Internal Vice</div>
<img src='candidates/defaults/IVPresident.png' width='100px' height='100px'/></div>";
}


if (isset($_SESSION[evpresident_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:10px'>External Vice</div>
<img src='$_SESSION[evpurlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removeevpres'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[evpname]</b></div></form>";}
else{
echo "<div style='float:left'><div style='padding-left:10px'>External Vice</div>
<img src='candidates/defaults/EVPresident.png' width='100px' height='100px'/></div>";
}


if (isset($_SESSION[secretary_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:20px'>Secretary</div>
<img src='$_SESSION[securlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removesec'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[secname]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:20px'>Secretary</div>
<img src='candidates/defaults/Secretary.png' width='100px' height='100px'/></div>";
}


if (isset($_SESSION[treasurer_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:20px'>Treasurer</div>
<img src='$_SESSION[treurlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removetre'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[trename]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:20px'>Treasurer</div>
<img src='candidates/defaults/Treasurer.png' width='100px' height='100px'/></div>";
}

if (isset($_SESSION[auditor_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:25px'>Auditor</div>
<img src='$_SESSION[audurlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removeaud'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[audname]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:25px'>Auditor</div>
<img src='candidates/defaults/Auditor.png' width='100px' height='100px'/></div>";
}

if (isset($_SESSION[pro_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:28px'>P.R.O.</div>
<img src='$_SESSION[prourlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removepro'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[proname]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:28px'>P.R.O.</div>
<img src='candidates/defaults/PRO.png' width='100px' height='100px'/></div>";
}


if (isset($_SESSION[bm_id])){ 
echo"<form action='remove.php' target='_parent' style='float:left' method='POST'>
<div style='padding-left:0px'>Business Manager</div>
<img src='$_SESSION[bmurlpic]' style='border-radius: 15px 5px 5px 5px' width='96px' height='96px'/>
<br><input type='hidden' name='remove' value='removebm'/><div style='padding-left:20px'>
<input type='submit' style='border-radius:2px 2px 10px 2px;background-color:maroon;color:white' value='Remove'/></div><div style='padding-left:-15px;margin-left:-15px;text-align:center;color:lightgreen'><b>$_SESSION[bmname]</b></div></div> </form>";}
else{
echo "<div style='float:left'><div style='padding-left:0px'>Business Manager</div>
<img src='candidates/defaults/bm.png' width='100px' height='100px'/></div>";
}

?>

</body>
</html>
