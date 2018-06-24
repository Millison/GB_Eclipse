<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Eintrag</title>
</head>

<body>
<h2>Komentar eintragen</h2>
<br />
<?php 
	if (isset($_GET["wahl"])) {
		$parents = $_GET["wahl"];
	} else {
		$parents = 0;
	}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
	Ihr Kommentar: <br />
	<textarea name="text" cols="50" rows="10"></textarea>
	<br />
	<input type="submit" value="Senden" />
	<br />
</form>
<p><a href="startseite.php">Zurück zur Startseite</a></p>

<?php
	# Aktion mit der Daten aus dem Formular
	if (isset($_POST["text"])) {
		include 'kommentarenAktionen.php';
		$komment = new KommentarenAktionen();
		$komment->kommentHinzufuegen($_POST["text"], $parents);
	}
?>

</body>
</html>