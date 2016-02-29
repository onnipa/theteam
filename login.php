<?php
session_start();
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title>Kirjaudu sisään</title>		
		</head>
		<body>
<?php
function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$user = htmlspecialchars($data);
	return $data;
}

	include 'yhteys.php';

	$user = $_POST["username"];
	$pw = $_POST["password"];
	
	$sql = "SELECT *
				FROM person";
	
	$result = $conn->query($sql);
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		if(empty($user) && empty($pw)) 
		{
			$userErr = "Nimi puuttuu!";
			$pwErr = "Salasana puuttuu!";
		}
		elseif(empty($user))
		{
			$userErr = "Nimi puuttuu!";
		}
		elseif(empty($pw)) 
		{
			$pwErr = "Salasana puuttuu!";
		}	
		else 
		{
			$user = test_input($user);
			$pw = test_input($pw);
		}
	}
	
	if($result->num_rows > 0) 
	{
		//$setData = true;
		
		while($row = $result->fetch_assoc()) 
		{
		if($user && $pw) 
		{	
			if($row["username"] == $user && $row["password"] == $pw) 
			{
				$_SESSION['fn'] = test_input($row["firstname"]);
				$_SESSION['ln'] = test_input($row["lastname"]);
				$_SESSION['ssn'] = test_input($row["ssn"]);
				$_SESSION["dateofbirth"] = $row["dateofbirth"];
				$_SESSION["address"] = $row["address"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["user"] = $row["username"];
				$_SESSION["password"] = $row["password"];
				
				echo "Tervetuloa " . $row["lastname"]." ".$row["firstname"];
				
				header("refresh:1; url=toiminnot.php");
			}
			elseif($row["username"] == $user && $row["password"] != $pw) 
			{
				$pwErr = "Väärä salasana!";
			}
		/*	elseif($row["username"] != $user)  
			{
				$userErr = "Käyttäjätunnusta ei löydy!";
			}	*/	
		}
		}	
	}
?>	
			<p>
			<fieldset>
				<legend>Syötä käyttäjätunnus ja salasana</legend>
				<form action="login.php" method="post">
					<table><tr><td align="left" style="color:red">* Required field</td></tr>
							<tr><td>Käyttäjätunnus:</td><td><input type="text" name="username" placeholder="Käyttäjätunnus" size="40" tabindex="1">
									<span class="error" style="color:red"> * <?php echo $userErr;?></span></td></tr>
							<tr><td>Salasana:</td><td><input type="password" name="password" size="40" tabindex="2">
									<span class="error" style="color:red"> * <?php echo $pwErr;?></span></td></tr>
					</table>	</fieldset>
					<p>
					<table><tr><td><input type="submit" value="Kirjaudu sisään" tabindex="3">
								<input type="reset" value="Tyhjennä" tabindex="4"></td>
								<td><input type="button" value="Uusi käyttäjä" 
											onclick="document.location.href='syota_tiedot.php'"></td></tr>
					</p>					
					</table>			
				</form>		
			</p>
		</body>
		</html>