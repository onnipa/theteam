<?php
session_start();
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="utf-8" lang="fi">
			<title>Syötä tiedot</title>		
		</head>
		<body>
<?php

	include 'ssncheck.php';
	include 'yhteys.php';
	
	$last = $_POST["lastname"];
	$first = $_POST["firstname"];
	$hn = $_POST["ssn"];
	$addr = $_POST["address"];
	$email = $_POST["email"];
	$dob = $_POST["date_of_birth"];
	$user = $_POST["username"];
	$pw = $_POST["password"];
	$sex = $_POST["sex"];
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		if(empty($first)) 
		{
			$fnErr = "Etunimi puuttuu!\n"."<br>";
		}	
		elseif(!preg_match('/^[A-Öa-ö-]+$/', $first)) 
		{
			$fnErr = "Etunimi saa sisältää vain kirjaimia ja väliviivan!\n"."<br>";
		}
		else 
		{
			$first = test_input($first);
		}
		if(empty($last)) 
		{
			$lnErr = "Sukunimi puuttuu!\n"."<br>";
		}	
		elseif(!preg_match('/^[A-Öa-ö-]+$/', $last)) 
		{
			$lnErr = "Sukunimi saa sisältää vain kirjaimia ja väliviivan!\n"."<br>";
		}
		else 
		{
			$last = test_input($last);
		}
		if(empty($hn)) 
		{
			$ssnErr = "Henkilötunnus puuttuu!\n"."<br>";
		}	
		elseif(hetucheck($hn))
		{
			$ssn = test_input($hn);
		}
		if(empty($dob)) 
		{
			$dobErr = "Syntymäaika puuttuu!\n"."<br>";
		}	
		elseif($dob) 
		{
		/*	$synt = $dob;
			$synt = explode(".", $synt);
			$month = $synt[1];
			$day = $synt[0];
			$year = $synt[2];	
			
			if(!checkdate($month, $day, $year)) {	echo "Date is something strange!";	}	
			*/
			$dob = date("Y-m-d", strtotime($dob));			
			$today = date("Y-m-d");
			
			if($dob > $today)	{	echo "Date is not valid";	}		//die();		//die ei sovi tähän
		}
		else 
		{
			$dob = test_input($dob);
			$dob = date("Y-m-d", strtotime($dob));
		}
		if(empty($addr)) 
		{
			$addrErr = "Osoite puuttuu!\n"."<br>";
		}	
		else 
		{
			$addr = test_input($addr);
		}
		if(empty($email)) 
		{
			$emailErr = "Sähköpostiosoite puuttuu!\n"."<br>";
		}
		elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) 
		{
			$emailErr = "Sähköpostiosoite ei kelpaa!\n"."<br>";
		}	
		else 
		{
			$email = test_input($email);
		}
		if(empty($user)) 
		{
			$userErr = "Käyttäjätunnus puuttuu!\n"."<br>";
		}	
		else 
		{
			$user = test_input($user);
		}
		if(empty($pw)) 
		{
			$pwErr = "Salasana puuttuu!\n";
		}	
		else 
		{
			$last = test_input($last);
		}
	}
	if($first && $last && $ssn && $addr && $email && $dob && $user && $pw) 
	{		
		if($sex == 1)
			$sex = 'Male';
		elseif($sex == 2)
			$sex = 'Female';
		elseif($sex == 3)
			$sex = 'Other';
			
		$sql = "INSERT INTO person
				VALUES ('$ssn', '$first', '$last', '$sex', '$user', '$pw', '$dob', '$addr', '$email', 0)";
	
		$result = $conn->query($sql);
	
		if(!$result)
			echo "Pieleen meni!";
		else 	
		{
			$_SESSION["ssn"] = $ssn;
			$_SESSION["fn"] = $first;
			$_SESSION["ln"] = $last;
			$_SESSION["addr"] = $addr;
			$_SESSION["email"] = $email;
			$_SESSION["user"] = $user;
			$_SESSION["password"] = $pw;
			
			echo "Tietojen syöttäminen onnistui.\n"."<br>";
			echo "Siirryt kohta päävalikkoon.\n"."<br>";
			header("refresh:2; url=toiminnot.php");
		}
	}
?>		
			<form action="syota_tiedot.php" method="post">
				
					
					<fieldset><legend>Sukupuoli</legend>
							<label><input type="radio" name="sex" value="1" checked>Mies</label>
									<label><input type="radio" name="sex" value="2">Nainen</label>
									<label><input type="radio" name="sex" value="3">Joku muu</label>
					</fieldset>
					<fieldset><legend>Perustiedot</legend>
					<fieldset><legend>Syötä sairaustiedot</legend>
						<input type="button" value="Syötä sairaustiedot" onclick="document.location.href='diagnoosit.php'">
					</fieldset>
					<table>
					<tr><td>Etunimi:</td><td><input type="text" name="firstname" size="25" tabindex="1"
								value="<?php echo $first; ?>">
						<span class="error" style="color:red"> * <?php echo $fnErr;?></span></td></tr>
					<tr><td>Sukunimi:</td><td><input type="text" name="lastname" size="25" tabindex="2"
								value="<?php echo $last; ?>">
						<span class="error" style="color:red"> * <?php echo $lnErr;?></span></td></tr>				
					<tr><td>Henkilötunnus:</td><td><input type="text" name="ssn" size="25" tabindex="3"
								value="<?php echo $ssn; ?>" placeholder="123456-234S">
						<span class="error" style="color:red"> * <?php echo $ssnErr;?></span></td></tr>
					<tr><td>Syntymäaika:</td><td><input type="date" name="date_of_birth" size="25" tabindex="4"
								value="<?php echo $dob; ?>" placeholder="1985-03-24">
						<span class="error" style="color:red"> * <?php echo $dobErr;?></span></td></tr>
					<tr><td>Osoite:</td><td><input type="text" name="address" size="25" tabindex="5"
								value="<?php echo $addr; ?>">
						<span class="error" style="color:red"> * <?php echo $addrErr;?></span></td></tr>
					<tr><td>Sähköposti:</td><td><input type="email" name="email" size="25" tabindex="6"
								value="<?php echo $email; ?>">
						<span class="error" style="color:red"> * <?php echo $emailErr;?></span></td></tr>
					<tr><td>Käyttäjätunnus:</td><td><input type="text" name="username" size="25" tabindex="7"
								value="<?php echo $user; ?>">
						<span class="error" style="color:red"> * <?php echo $userErr;?></span></td></tr>
					<tr><td>Salasana:</td><td><input type="password" name="password" size="25" tabindex="8">
						<span class="error" style="color:red"> * <?php echo $pwErr;?></span></td></tr>
					<tr><td><input type="submit" value="Lähetä tiedot" tabindex="9">
							<input type="reset" value="Tyhjennä kentät" tabindex="10"></td></tr>
					<tr><td><input type="button" value="Takaisin" onclick="history.go(-1);return true;">
							</td></tr>
					</table>	
					</fieldset>		
			</form>
		</fieldset>
		</body>
	</html>