<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Anmelden</title>
</head>

<body>
<h2>Anmelden</h2>
<br />
<?php
	# Bei Reload bleiben die Eingaben in Eingabefelder stehen 
	if (isset($_POST["deletLogname"])) {
		$deletLogname = htmlspecialchars($_POST["deletLogname"]);
		$logname = htmlspecialchars($_POST["logname"]);
		$passwort = htmlspecialchars($_POST["passwort"]);
	}
	else {
		$deletLogname = "";
		$logname = "";
		$passwort = "";
	}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
	Welcher Benutzer möchten Sie löschen?: <br />
	<input type="text" name="deletLogname" size="20" maxlength="30" value="<?php echo $deletLogname; ?>" />
	<br />
	<p>Bestätigen Sie Ihre Admin-Rechte!</p>
	Logname: <br />
	<input type="text" name="logname" size="20" maxlength="30" value="<?php echo $logname; ?>" />
	<br />
	Passwort: <br />
	<input type="password" name="passwort" size="20" maxlength="30" value="<?php echo $passwort; ?>" />
	<br />
	<input type="submit" value="Löschen" />
	<br />
</form>
<?php
	# Aktion mit der Daten aus dem Formular
	if (isset($_POST["deletLogname"])) {
		$loeschnenKandidat = array ("deletLogname" => $deletLogname, "logname" => $logname, "passwort" => $passwort);
		include "benutzerAktionen.php";
		$eintrit = new BenutzerAktionen();
		$eintrit->loeschen($loeschnenKandidat); 
	}
?>

<p>
<a href="startseite.php">ZurÃ¼ck zur Startseite</a>
</p>

</body>
</html>