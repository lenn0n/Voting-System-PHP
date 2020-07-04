<?PHP 
session_start();
$con = mysql_connect("localhost","root","");
mysql_select_db("VotingSystem", $con);
$_SESSION[gid] = $_POST["id"];
$get = mysql_query("SELECT * FROM usersdata WHERE studentid = '$_POST[id]'");
if (mysql_num_rows($get)>0){
while ($row = mysql_fetch_array($get)){
$_SESSION['lname'] = $row[lname];
$_SESSION['confirm'] = "ok";
}
}
else{
$_SESSION['lname'] = "ERROR";
$_SESSION['confirm'] = "no";
}

// Generates a strong password of N length containing at least one lower case letter, 
// one uppercase letter, one digit, and one special character. The remaining characters 
// in the password are chosen at random from those four sets. 
// 
// The available characters in each set are user friendly - there are no ambiguous 
// characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option, 
// makes it much easier for users to manually type or speak their passwords. 
// 
// Note: the $add_dashes option will increase the length of the password by 
// floor(sqrt(N)) characters. 

 function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds') 
 { 
 	$sets = array(); 
 	if(strpos($available_sets, 'l') !== false) 
 		$sets[] = 'abcdefghjkmnpqrstuvwxyz'; 
 	if(strpos($available_sets, 'u') !== false) 
 		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ'; 
 	if(strpos($available_sets, 'd') !== false) 
 		$sets[] = '23456789'; 
 	if(strpos($available_sets, 's') !== false) 
 		$sets[] = '1355680'; 
  
 	$all = ''; 
 	$password = ''; 
 	foreach($sets as $set) 
 	{ 
 		$password .= $set[array_rand(str_split($set))]; 
 		$all .= $set; 
 	} 
  
 	$all = str_split($all); 
 	for($i = 0; $i < $length - count($sets); $i++) 
 		$password .= $all[array_rand($all)]; 
  
 	$password = str_shuffle($password); 
  
 	if(!$add_dashes) 
 		return $password; 
  
 	$dash_len = floor(sqrt($length)); 
 	$dash_str = ''; 
 	while(strlen($password) > $dash_len) 
 	{ 
 		$dash_str .= substr($password, 0, $dash_len) . '-'; 
 		$password = substr($password, $dash_len); 
 	} 
 	$dash_str .= $password; 
 	return $dash_str; 
	
	}
	
	$_SESSION["gpass"] = $_SESSION['lname']."_". generateStrongPassword(5);
	header("location: generator.php");
?>