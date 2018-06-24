<?php

if (isset($_GET["wahl"])) {
	kommentarAntwort($_GET["wahl"]);
}
			

function kommentarAntwort($kommentarID) {
	
	$mysqli = new mysqli("localhost", "root", "", "gaestebuch");
	
	if ($mysqli->connect_error) {
		echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
		exit();
	}
	
	if (!$mysqli->set_charset("utf8")) {
		echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
	} else {
		include 'kommentarenAktionen.php';
		$eintrag = $mysqli->query("SELECT id FROM buch WHERE id='$kommentarID'");
		KommentarHinzufuegen($eintrag["text"], $eintrag["id"]);
	}	
}

?>
