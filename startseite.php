<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Gästebuch</title>
	</head>

<body>
	<?php
		include "benutzerAktionen.php";
		include "kommentarenAktionen.php";
				
		$komment = new KommentarenAktionen();
		
		if (isset($_SESSION["login"]) and $_SESSION["login"] == "ok" and
				isset($_SESSION["rechte"]) and $_SESSION["rechte"] == 1) {
			echo "Sie sind als {$_SESSION["logname"]} eingeloggt. Sie haben Admin-Rechte.";
			include 'auslogen.php';
			$komment->ausgabe(1);
			include 'kommentarForm.php';
		} elseif (isset($_SESSION["login"]) and $_SESSION["login"] == "ok" and
				isset($_SESSION["rechte"]) and $_SESSION["rechte"] == 0) {
			echo "Sie sind als {$_SESSION["logname"]} eingeloggt.";
			echo "Ihr Berechtigungsstufe ist: {$_SESSION["rechte"]} .";
			include 'auslogen.php';
			$komment->ausgabe(0);
			include 'kommentarForm.php';
		}else {
			include 'teilEns.php';
			$komment->ausgabe("");
		}
	?>
	
	</body>
</html>