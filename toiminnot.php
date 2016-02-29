<?php
session_start();
?>
<!doctype HTML>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title>Valitse toiminto</title>		
		</head>
	<body>
	<p>
		<?php echo "Asiakas: "; echo $_SESSION["fn"]." ".$_SESSION["ln"]." ".$_SESSION["ssn"]; ?>
	</p>
	<p>
		<fieldset><legend>Mittaustulokset</legend>
			<input type="button" value="Syötä mittaustuloksia" onclick="document.location.href='syota_mittaus.php'">
			<input type="button" value="Hae mittaustuloksia" onclick="document.location.href='hae_mittaustiedot.php'">
		</fieldset>
		<fieldset><legend>Lääkekuurit</legend>
			<input type="button" value="Voimassaolevat lääkitykset" onclick="document.location.href='laakietiedot.php'">
		</fieldset>	
		<fieldset><legend>Lääkärikonsultaatio</legend>
			<input type="button" value="Valitse lääkäri" onclick="document.location.href='valitse_laakari.html'">
		</fieldset>
		<fieldset>
			<input type="button" value="Takaisin" onclick="history.go(-1);return true;">
			<input type="button" value="Kirjaudu ulos" onclick="document.location.href='logout.php'">
			<input type="button" value="Muuta omia tietoja" onclick="document.location.href='muutos.php'">
		</fieldset>
	</p>	
	
	</body>
	</html>