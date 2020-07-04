<?php 
			
			$uid = $_POST['uid'];
			$pwd = $_POST['pwd'];
			$name = $_POST['name'];
			$address = $_POST['address'];
			$country = $_POST['country'];
			$zip = $_POST['zipcode'];
			$email = $_POST['email'];
			$sex = $_POST['gender'];
			$language = $_POST['language'];
			$about = $_POST['about'];
			
			// Let's check if the username is already exist
			$con = mysql_connect("localhost","root","");
			mysql_select_db("VotingSystem",$con);
			$check = mysql_query("SELECT * FROM users");
			while ($results = mysql_fetch_array($check))
				{
				if ($results['uid'] == $uid) $available = 0;
				else $available = 1;
				}
			// End of checking
			mysql_close($con);
			
			if (!$uid && !$pwd && !$name && !$country && !$zip && !$email && !$sex && !$language){
				echo "All <font style='color:red'>* </font>fields are required.";
			}else{
				if (strlen($uid) < 5 || strlen($uid) > 12)
				{
				echo "<div id='errornotif'>User ID must be of length 5 to 12!</div>";
				}
				else if ($available == 0)
				{
				echo "<div id='errornotif'>Username was already taken!</div>";
				}
				else if (strlen($pwd) < 7 || strlen($pwd) > 12)
				{
				echo "<div id='errornotif'>Password must be of length 7 to 12!</div>";
				}
				else if (preg_match("/^[a-zA-Z -]+$/", $name) === 0)
				{
				echo "<div id='errornotif'>Invalid name!</div>";
				}
				else if (preg_match("/^[0-9]+$/", $zip) === 0)
				{
				echo "<div id='errornotif'>Invalid ZIP Code!</div>";
				}
				else if ($country==null || $country=="")
				{
				echo "<div id='errornotif'>Please select your country!</div>";
				}
				else if (preg_match("/^[0-9a-zA-Z._]+@+([0-9a-zA-Z]+)*.[a-zA-Z]{2,4}$/", $email) === 0)
				{
				echo "<div id='errornotif'>Please input valid email!</div>";
				}
				else if ($sex==null || $sex=="")
				{
				echo "<div id='errornotif'>Please select your gender!</div>";
				}
				else if ($language==null || $language=="")
				{
				echo "<div id='errornotif'>Please select your language!</div>";
				}
				else
				{
				$con = mysql_connect("localhost","root","");
				mysql_select_db("jansuy",$con);
				mysql_query("INSERT INTO users(uid,pwd,name,address,country,zip,email,sex,language,about) VALUES ('$uid','$pwd','$name','$address','$country','$zip','$email','$sex','$language','$about')");
				mysql_close($con);
				echo "<div id='successnotif'>Account successfully registered!</div>";
				}
			}
?>

	<html>
	
		<style type="text/css">
		body{
		text-align:right;
		font-family:rockwell;
		max-width:480px;
		font-size:20;

		}

		#linya{
		margin:10;
		}

		#errornotif{
		background-color:red;
		color:white;
		padding:10;

		}

		#successnotif{
		background-color:darkgreen;
		color:white;
		padding:10;
		}
		
		input, select{
		font-size:20;
		}
		</style>


				<body>
				<div id="GG"></div>
				<h1>Registration Form</h1>
					<form method="POST" name="formko" action="<?php $_PHP_SELF ?>">
					
						<div id="linya"><font style="color:red">* </font>User ID: <input type="text" name="uid" value='<?php echo $uid?>'></div>
						<div id="linya"><font style="color:red">* </font>Password: <input type="text" name="pwd" value='<?php echo $pwd?>'/></div>
						<div id="linya"><font style="color:red">* </font>Name: <input type="text" name="name" value='<?php echo $name?>'/></div>
						<div id="linya">Address: <input type="text" name="address" value='<?php echo $address?>'/></div>
						<div id="linya"><font style="color:red">* </font>Country: 
						
						<!--Fetching country list :D -->
						<?php 
						echo "<select name='country'>";
						$con=mysql_connect("localhost","root","");
						mysql_select_db("jansuy",$con);
						$paste = mysql_query("SELECT * FROM country");
						while ($row=mysql_fetch_array($paste)){
						echo "<option value=".$row['cname'];
						echo ">".$row['cname']."</option>";
						}
						echo "</select></div>";
						mysql_close($con);
						?>
						
						<div id="linya"><font style="color:red">* </font>ZIP Code: <input type="text" name="zipcode" value='<?php echo $zip?>'/></div>
						<div id="linya"><font style="color:red">* </font>E-mail: <input type="text" name="email" value='<?php echo $email?>'/></div>
						<div id="linya"><font style="color:red">* </font>Sex: <input type="radio" name="gender" value="Male"> Male
						<input type="radio" name="gender" value="Female"> Female</div>
						<div id="linya"><font style="color:red">* </font>Language: <input type="checkbox" name="language" value="English"/> English
						<input type="checkbox" name="language" value="Non-English"/>Non-English</div>
						<div id="linya">About: <textarea rows="5" name="about"><?php echo $about?></textarea></div>
						<div id="linya"><input type="submit"/></div>

					</form>
				</body>  
	</html>
	
