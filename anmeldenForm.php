<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Anmelden</title>
	</head>

<body>
	<h2>Anmelden</h2>
	<hr />
	<?php
		if (isset($_POST["logname"])) {
			$logname = htmlspecialchars($_POST["logname"]);
			$passwort = htmlspecialchars($_POST["passwort"]);
		}
		else {
			$logname = "";
			$passwort = "";
		}
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
		Logginname: <br />
		<input type="text" name="logname" size="20" maxlength="30" value="<?php echo htmlspecialchars($logname); ?>" />
		<br />
		Passwort: <br />
		<input type="password" name="passwort" size="20" maxlength="30" value="<?php echo htmlspecialchars($passwort); ?>" />
		<br />
		<input type="submit" value="Anmelden" name="knopf" />
		<br />
	</form>
	<p><a href="startseite.php">Zurück zur Startseite</a></p>
	<?php
		if (isset($_POST["logname"])) {
			include "benutzerAktionen.php";
			$eintrit = new BenutzerAktionen();
			$eintrit->anmeldung();
		}
	?>
	
</body>
</html>