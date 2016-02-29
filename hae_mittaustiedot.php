<?php
session_start();
?>
<!doctype HTML>
	<html>
		<head>
			<meta charset="utf-8" lang="fi">
			<title>Hae tiedot</title>		
		</head>
		<body>
		<p>
			<?php echo "Asiakas: "; echo $_SESSION["fn"]." ".$_SESSION["ln"]." ".$_SESSION["ssn"]; ?>
		</p>			
			<form action="hae_mittaustiedot.php" method="post">
				<fieldset>
					<legend>Valitse haluamasi mittausarvo alla olevasta valikosta</legend>
					<select name="mittari" size="1" tabindex="1">
						<option value="0">----Valitse mittaus----</option>
						<option value="1">Verensokeri</option>
						<option value="2">Verenpaine</option>
						<option value="3">Lämpötila celsius</option>
						<option value="4">Lämpötila fahrenheit</option>
						<option value="5" >Paino</option>
						<option value="6" >Pituus</option>		
						<option value="7">Hengitysvirtaus</option>
						<option value="8">Hae kaikki mittaukset</option>			
					</select><br><br>
					<table>
						<tr><td>Henkilötunnus: </td><td><?php echo $_SESSION["ssn"]; ?></td></tr>	
						<tr><td><input type="submit" value="Hae tiedot" tabindex="3"></td>
						<td></td></tr>
					</table>	
				</fieldset>			
			</form>	
			<p>
			<input type="button" value="Takaisin päävalikkoon" onClick="document.location.href='toiminnot.php'">
			<input type="button" value="Kirjaudu ulos" onclick="document.location.href='logout.php'">
			<br>
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
	$typeid = $_POST["mittari"];
	$ssn = $_SESSION["ssn"];

	if($typeid == '1') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 1";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", verensokeri ".
										$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	elseif($typeid == '2') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 2";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", verenpaine ".
										$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	elseif($typeid == '3') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 3";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", lämpötila ".
										$row["Arvo"]." &deg;".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	elseif($typeid == '4') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 4";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", lämpötila ".
										$row["Arvo"]." &deg;".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	elseif($typeid == '5') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 5";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	//var_dump($row);
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", paino ".
										$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	elseif($typeid == '6') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 6";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", pituus ".
										$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	
	elseif($typeid == '7') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 7";
				

		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", hengitysvirtaus ".
										$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ".$row["Aika"]."<br>";
			}
		}
	}	
	
	elseif($typeid == '8') 
	{
		$sql = "SELECT p.lastname AS Sukunimi, p.firstname AS Etunimi, p.dateofbirth, 
						m.value AS Arvo, m_t.measurement_name, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				Inner JOIN person p ON m.ssn = p.ssn
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn'";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
				if($row["measurement_name"] == 'glucose') 
				{	$mittaus = 'verensokeri'; }
				elseif($row["measurement_name"] == 'pressure') 
				{	$mittaus = 'verenpaine'; }
				elseif($row["measurement_name"] == 'temperature') 
				{	$mittaus = 'lämpötila'; }
				elseif($row["measurement_name"] == 'weight') 
				{	$mittaus = 'paino'; }
				elseif($row["measurement_name"] == 'height') 
				{	$mittaus = 'pituus'; }
				elseif($row["measurement_name"] == 'flow')
				{	$mittaus = 'hengitysvirtaus'; }
				else { echo "???"; }
					
				$syntynyt = $row["dateofbirth"];
				$syntynyt = date("d.m.Y", strtotime($syntynyt));
				
				if($mittaus == 'lämpötila') 
				{
					echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", ".$mittaus." ".
										$row["Arvo"]." &deg;".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
				}
				else 
				{
					echo $row["Sukunimi"]." ".$row["Etunimi"].", syntymäaika: ".$syntynyt.", ".$mittaus." ".
										$row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
				}			
			}
		}
	}	
?>	
		</body>
	</html>