<?php

class KommentarenAktionen {
	
	public $benutzerDaten = array (
			"vorname" => "",
			"nachname" => "",
			"logname" => "",
			"passwort" => "",
			"passTwo" => "",
			"rechte" => "");
	public $mysqli;
	public $servername = "localhost";
	public $DBLogname = "root";
	public $DBpasswort = "";
	public $dbname = "gaestebuch";
	
	public function __construct() {
		$mysqli = new mysqli($this->servername, $this->DBLogname, $this->DBpasswort, $this->dbname);
	
		if ($mysqli->connect_error) {
			echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
			exit();
		}
		
		if (!$mysqli->set_charset("utf8")) {
			echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
		} else {
			$this->mysqli = $mysqli;
		}
	}
	
	public function ausgabe($rechte) {
		$eintraege = $this->mysqli->query("SELECT id, logname, zeit, text FROM buch;");
		
		if (!empty($rechte) and $rechte == 0) {
			// hier stimmt etwas nicht!
			while ($zeile = $eintraege->fetch_array()) {
				echo "<p><strong>{$zeile['logname']} {$zeile['zeit']}</strong>: <br />{$zeile['text']}</p> ";
				?>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
					<input type="submit" value="Antworten" name="antworten" />
				</form>
				<?php
			}
		} elseif (!empty($rechte) and $rechte == 1) {
			while ($zeile = $eintraege->fetch_array()) {
				$kommentID = $zeile["id"];
				echo "<p><strong>{$zeile['logname']} {$zeile['zeit']}</strong>: <br />{$zeile['text']}<br /> ";
				echo "<a href='http://localhost/dimas-test/GB_eclipse/kommentarForm.php?wahl=$kommentID'>Antworten</a>  ";
				echo "  <a href='?wahl=editieren+$kommentID'>Editieren</a>  ";
				echo "  <a href='http://localhost/dimas-test/GB_eclipse/kommentarLoeschen.php?wahl=$kommentID'>Löschen</a></p>";				
			}
		} else {
			while ($zeile = $eintraege->fetch_array()) {
				echo "<p><strong>{$zeile['logname']} {$zeile['zeit']}</strong>: <br />{$zeile['text']}</p> ";
			}
		}
	}
	
	public function kommentHinzufuegen($text, $parents) {
		$zeit = date('Y-d-m, G-i-s');
		$status = 0;
		#$parents = 0;
		$insert = $this->mysqli->prepare("INSERT INTO buch
											(logname,
											text,
											zeit,
											status,
											parents)
											VALUES(?, ?, ?, ?, ?)");
		$insert->bind_param("sssss", $_SESSION["logname"],
				$text,
				$zeit,
				$status,
				$parents);
		if($ergebnis = $insert->execute()) {
			echo "Ihr Kommentar wurde gespeichert.";
			$this->mysqli->close();
			$host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
			$uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
			$extra = "startseite.php";
			header("Location: http://$host$uri/$extra");
		} else {
			echo "Fehler bei der Registrierung: <br />";
			echo $this->mysqli->error;
		}
	}
}


?>
