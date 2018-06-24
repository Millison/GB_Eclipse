<?php

class SQLabfragen {
	
	public $einBenutzer;
	public $mehrereBenutzer = array();
	public $benutzerKommentare = array();
	
	public function benutzerSuche($parameter, $wert) {
		$dbConnect = new Verbindung();
		
		if (strcmp($parameter, "logname")) {
			$db = $dbConnect->dbv;
			$benutzer = $db->query("SELECT * FROM benutzer WHERE 'logname'=$wert;");
			if (!empty($benutzer)) {
				$this->einBenutzer = $benutzer;
			} else {
				echo "Benutzer mit dem Logname " . $wert . " ist nicht gefunden!";
			}
			$benutzerListe->close();
			$dbConnect = NULL;
			exit();
		} elseif (strcmp($parameter, "vorname")) {
			$this->mehrereBenutzer = array();
			$db = $dbConnect->dbv;
			$benutzerListe = $db->query("SELECT * FROM benutzer WHERE 'vorname'=$wert;");
			if (!empty($benutzerListe)) {
				while ($zeile = $benutzerListe->fetch_array()) {
					array_push($this->mehrereBenutzer, $zeile);
				}
			} else {
				echo "Benutzer mit dem Vorname " . $wert . " ist nicht gefunden!";
			}
			$benutzerListe->close();
			$dbConnect = NULL;
			exit();
		} elseif (strcmp($parameter, "nachname")) {
			$this->mehrereBenutzer = array();
			$db = $dbConnect->dbv;
			$benutzerListe = $db->query("SELECT * FROM benutzer WHERE 'nachname'=$wert;");
			if (!empty($benutzerListe)) {
				while ($zeile = $benutzerListe->fetch_array()) {
					array_push($this->mehrereBenutzer, $zeile);
				}
			} else {
				echo "Benutzer mit dem Nachname " . $wert . " ist nicht gefunden!";
			}
			$benutzerListe->close();
			$dbConnect = NULL;
			exit();
		} else {
			echo "Die Suche nach " . $parameter . " ist nicht möglich!";
			$dbConnect = NULL;
		}
	}
	
	public function kommentarSuche($benutzer) {
		$this->benutzerKommentare = array();
		$dbConnect = new Verbindung();
		$db = $dbConnect->dbv;
		$kommentaren = $db->query("SELECT * FROM buch WHERE 'logname'=$benutzer;");
		if (!empty($kommentaren)) {
			while ($zeile = $kommentaren->fetch_array()) {
				array_push($this->benutzerKommentare, $zeile);
			}
		} else {
			echo "Der Benutzer " . $benutzer . " hat noch keine Kommentaren hinterlassen!";
		}
		$kommentaren->close();
		$dbConnect = NULL;
	}
}

?>