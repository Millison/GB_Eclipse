<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Regestrierung</title>
	</head>

<body>
	<h2>Regestrierung</h2>
	<hr />
	<?php
		if (isset($_POST["vorname"])) {
			$vorname = htmlspecialchars($_POST["vorname"]);
			$nachname = htmlspecialchars($_POST["nachname"]);
			$logname = htmlspecialchars($_POST["logname"]);
			$passwort = htmlspecialchars($_POST["passwort"]);
			$pass_two = htmlspecialchars($_POST["pass_two"]);
			$rechte = htmlspecialchars($_POST["rechte"]);
		}
		else {
			$vorname = "";
			$nachname = "";
			$logname = "";
			$passwort = "";
			$pass_two = "";
		}
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> " method="post">
		Ihr Vorname: <br />
		<input type="text" name="vorname" size="20" maxlength="30" value="<?php echo htmlspecialchars($vorname); ?>" />
		<br />
		Ihr Nachname: <br />
		<input type="text" name="nachname" size="20" maxlength="30" value="<?php echo htmlspecialchars($nachname); ?>" />
		<br />
		Logginname: <br />
		<input type="text" name="logname" size="20" maxlength="30" value="<?php echo htmlspecialchars($logname); ?>" />
		<br />
		Passwort: <br />
		<input type="password" name="passwort" size="20" maxlength="30" value="<?php echo htmlspecialchars($passwort); ?>" />
		<br />
		Passwort (wiederholen): <br />
		<input type="password" name="pass_two" size="20" maxlength="30" value="<?php echo htmlspecialchars($pass_two); ?>" />
		<br />
		Berechtigung: <br />
		<input type="radio" name="rechte" value="1"><label> Admin</label><br />
		<input type="radio" name="rechte" value="0"><label>  Benutzer</label><br />
		<input type="submit" value="Registrieren" />
		<br />
	</form>
	<?php
		if (isset($_POST["vorname"]) and isset($_POST["logname"])) {
			include "benutzerAktionen.php";
			$dbRegistrierung = new BenutzerAktionen();
			$dbRegistrierung->benutzerTest();
			
			/*if( strcmp($_POST["passwort"], $_POST["pass_two"]) == 0 ) {
				include "benutzerAktionen.php";
				$dbRegistrierung = new BenutzerAktionen();
				$dbRegistrierung->benutzerTest();
			} else {
				echo "Passwort ist nicht identisch!";
			}*/
		}
	?> 
	<p>
	<a href="startseite.php">Zurück zur Startseite</a>
	</p>

</body>
</html>