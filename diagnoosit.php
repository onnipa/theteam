<?php
	session_start();
?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<title>Diagnoosigrgfafaft</title>
	</head>
	<body>
		<p>
			<?php echo "Asiakas: "; echo $_SESSION["fn"]." ".$_SESSION["ln"]." ".$_SESSION["ssn"]; ?>
		</p>
<?php
function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$user = htmlspecialchars($data);
	return $data;
}

include 'yhteys.php';

	$ssn = $_SESSION["ssn"];
	$diagnoosi = test_input($_POST["diagnoosi"]);
	$valikko = $_POST["valikko"];
	$diagdate = NULL;	
	$diagdate = test_input($_POST["aloituspvm"]);
	$diagdate = date("Y-m-d", strtotime($diagdate));	
	
	$sql1 = "SELECT * FROM medical";
	$result1 = mysqli_query($conn, $sql1);
		if(!$result1) {	echo "Jotain ikävää tapahtui... " . mysqli_error($conn);	}

if($diagnoosi && $ssn && $diagdate != NULL) 
{
	$sql2 = "INSERT INTO medical VALUES ('$diagnoosi')";
	$result2 = mysqli_query($conn, $sql2);
		if(!$result2) {	echo "Tietoja ei voitu tallentaa. " . mysqli_error($conn);	}	
	echo "Päivitä sivu."."<br>";
}
	
if($diagdate != NULL && $ssn && $valikko) 
{
	$sql3 = "INSERT INTO person_medical VALUES ('$diagdate', '$ssn', '$valikko')";
	$result3 = mysqli_query($conn, $sql3);
		if(!$result3) {	echo "Tietojen tallennus ei onnistunut. " . mysqli_error($conn);	}
	echo "Tiedot tallennettu."; header("refresh:1");
}

?>	
		<form action="<?php echo $_POST['PHP_SELF'] ?>" method="post">
			<fieldset>
				<legend>Valitse diagnoosi</legend>
				<select name="valikko">	
					<?php
						while($row1 = mysqli_fetch_array($result1)):;?>
		<!--					<option selected disabled>Valitse potilas</option>	-->
							<option value="<?php echo $row1[0]; ?>" ><?php echo $row1[0]; ?></option>
					<?php endwhile; ?>
					</select>
					<br><br>&#x261D;Jos diagnoosin nimeä ei löydy valikosta &rarr;<br> 
							Kirjoita diagnoosin nimi alempana olevaan kenttään, 
							paina ensin "lähetä tiedot" ja sen jälkeen "päivitä sivu".<br>
							Tämän jälkeen se löytyy yllä olevasta valikosta.
				</fieldset>		
				<fieldset>
					<table>		
						<legend>Diagnoosi</legend>
			<!--			<tr><td>Valittu potilas:</td><td><?php echo "$pot[0] $pot[1] $pot[2]"; ?></td></tr>	-->
						<tr><td>Diagnoosi:</td><td><input type="text" name="diagnoosi" size="25" tabindex="2">
						<tr><td>Diagnoosin pvm:</td><td><input type="date" name="aloituspvm" size="25" tabindex="3">
						<tr><td><input type="submit" name="eka" value="Lähetä tiedot" tabindex="4">
							<input type="submit" name="toka" value="Päivitä sivu" onclick="refresh" tabindex="5"></td>
							<td><input type="button" value="Takaisin" onclick="history.go(-1);return true;" tabindex="6">
							<input type="button" value="Päävalikkoon" onclick="document.location.href='toiminnot.php'" tabindex="7">
			</td></tr>
					</table>
				</fieldset>
		</form>
	</body>
	</html>
