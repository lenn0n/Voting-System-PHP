<?php
session_start();
if ($_POST['remove'] == "removepres"){
unset($_SESSION[president_id]);
$_SESSION['votep'] = 0;
}

if ($_POST['remove'] == "removeivpres"){
unset($_SESSION[ivpresident_id]);
$_SESSION['voteivp'] = 0;
}

if ($_POST['remove'] == "removeevpres"){
unset($_SESSION[evpresident_id]);
$_SESSION['voteevp'] = 0;
}

if ($_POST['remove'] == "removesec"){
unset($_SESSION[secretary_id]);
$_SESSION['votesec'] = 0;
}

if ($_POST['remove'] == "removetre"){
unset($_SESSION[treasurer_id]);
$_SESSION['votetre'] = 0;
}

if ($_POST['remove'] == "removeaud"){
unset($_SESSION[auditor_id]);
$_SESSION['voteaud'] = 0;
}

if ($_POST['remove'] == "removepro"){
unset($_SESSION[pro_id]);
$_SESSION['votepro'] = 0;
}

if ($_POST['remove'] == "removebm"){
unset($_SESSION[bm_id]);
$_SESSION['votebm'] = 0;
}

header("location: index.php");
?>