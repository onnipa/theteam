<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="utf-8" lang="fi">
			<title>Uusi lääkemääräys</title>		
		</head>
		<body>
<?php
include 'yhteys.php';
function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$user = htmlspecialchars($data);
	return $data;
}

$med = test_input($_POST["medicin"]);
$dur = test_input($_POST["duration"]);
$quan = test_input($_POST["quantity"]);
$freq = test_input($_POST["frequency"]);
$start = test_input($_POST["startdate"]);
$start = test_input($start);
$start = date("Y-m-d", strtotime($start));
$pot = $_POST["potilas"];
$pot = explode(" ", $pot);
$laake = $_POST["lääke"];
$ssn = $pot[0];

		$sql1 = "SELECT *
					FROM person ORDER BY ssn";

		$result1 = mysqli_query($conn, $sql1);
		
		$sql2 = "SELECT *
					FROM medication ORDER BY medication_name";
				
		$result2 = mysqli_query($conn, $sql2);

if($med) 
{
	$sql3 = "INSERT INTO medication (medication_name)
				VALUES ('$med')";
		
	$result3 = $conn->query($sql3);
	
		if(!$result3) 
		{
			echo "Ei onnaa!";
		}
}

if($ssn && $laake && $dur && $quan && $freq && $start) 
{
	$sql4 = "INSERT INTO person_medication
				Values ('$quan', '$freq', '$dur', '$start', '$ssn', '$laake')";
	
	$result4 = $conn->query($sql4);
	
		if(!$result4)
			echo "Pieleen meni!";
		else 	
		{
			echo "Tietojen syöttäminen onnistui.\n"."<br>";
			header("refresh:2; url=toiminnot.php");
		}
}
?>
		<fieldset>
			<legend>Lääkemääräys</legend>
			<form action="<?php echo $_POST['PHP_SELF'] ?>" method="post">
				<fieldset>
					<legend>Valitse potilas</legend>
					<select name="potilas">	
						<?php
							while($row1 = mysqli_fetch_array($result1)):;?>
		<!--					<option selected disabled>Valitse potilas</option>	-->
								<option value="<?php echo "$row1[0] $row1[2] $row1[1]"; ?>" >
										<?php echo "$row1[0] $row1[2] $row1[1]"; ?></option>
						<?php endwhile; ?>
					</select>
				</fieldset>							
					<fieldset>
						<legend>Valitse lääke alla olevasta valikosta</legend>
						<select name="lääke">
							<?php	while($row2 = mysqli_fetch_array($result2)):;?>
							<option value="<?php echo $row2[0]; ?>" ><?php echo $row2[0]; ?></option>
							<?php endwhile; ?>
						</select>
							<br><br>
							&#x261D;Jos lääkkeen nimeä ei löydy valikosta &rarr;<br> 
							Kirjoita lääkkeen nimi alempana olevaan kenttään, 
							paina ensin "lähetä tiedot" ja sen jälkeen "päivitä sivu".<br>
							Tämän jälkeen voit valita lääkkeen yllä olevasta valikosta.
					</fieldset>
				<fieldset>
					<table>		
						<legend>Annostus</legend>
			<!--			<tr><td>Valittu potilas:</td><td><?php echo "$pot[0] $pot[1] $pot[2]"; ?></td></tr>	-->
						<tr><td>Lääkkeen nimi:</td><td><input type="text" name="medicin" size="25" tabindex="2">
						<tr><td>Kerta-annos:</td><td><input type="text" name="quantity" size="25" tabindex="4">
						<tr><td>Kuinka monta kertaa päivässä:</td><td><input type="text" name="frequency" size="25" tabindex="5">
						<tr><td>Alkamispäivämäärä:</td><td><input type="date" name="startdate" size="25" tabindex="6">
						<tr><td>Lääkekuurin kesto:</td><td><input type="text" name="duration" size="25" tabindex="7">
												
						<tr><td><input type="submit" value="Lähetä tiedot" tabindex="8">
							<input type="submit" value="Päivitä sivu" onclick="refresh" tabindex="9"></td>
							<td><input type="button" value="Takaisin" onclick="document.location.href='login.php'" tabindex="10"></td></tr>
					</table>
				</fieldset>				
			</form>
		</fieldset>		
			
	<!--		Valitse potilas:<?php echo " $pot[1] $pot[2]"; ?>	-->
		</body>
		</html>
