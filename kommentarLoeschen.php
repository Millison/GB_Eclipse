<?php

if (isset($_GET["wahl"])) {
	kommentarLoeschen($_GET["wahl"]);
}
			

function kommentarLoeschen($kommentarID) {
	
	$mysqli = new mysqli("localhost", "root", "", "gaestebuch");
	
	if ($mysqli->connect_error) {
		echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
		exit();
	}
	
	if (!$mysqli->set_charset("utf8")) {
		echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
	} else {
		$komment = "DELETE FROM buch WHERE id = $kommentarID";
		$delet = $mysqli->prepare($komment);
		if ($ergebnis = $delet->execute()) {
			echo "Kommentar wurde Gelöscht!";
			#$ergebnis->close();
			$mysqli->close();
			header('Location: http://localhost/dimas-test/GB_eclipse/startseite.php');
		} else {
			echo "Fehler bei Kommentar löschen: " . mysql_error();
			echo $mysqli->error;
		}
	}
	
	
}

?>
