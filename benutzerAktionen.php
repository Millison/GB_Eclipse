<?php
session_start();

class BenutzerAktionen {
	
	public $benutzerDaten = array (
			"vorname" => "",
			"nachname" => "",
			"logname" => "",
			"passwort" => "",
			"passTwo" => "",
			"rechte" => "",
			"login" => "");
	public $mysqli;
	public $servername = "localhost";
	public $DBLogname = "root";
	public $DBpasswort = "";
	public $dbname = "gaestebuch";
	
	public function __construct() {
		$mysqli = new mysqli("localhost", "root", "", "gaestebuch");
		
		if ($mysqli->connect_error) {
			echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
			exit();
		}
		
		if (!$mysqli->set_charset("utf8")) {
			echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
		} else {
			$this->mysqli = $mysqli;
			isset($_POST["vorname"]) ? $_SESSION["vorname"] = $_POST["vorname"]: $_SESSION["vorname"] = "";
			isset($_POST["nachname"]) ? $_SESSION["nachname"] = $_POST["nachname"]: $_SESSION["nachname"] = "";
			isset($_POST["logname"]) ? $_SESSION["logname"] = $_POST["logname"]: $_SESSION["logname"] = "";
			isset($_POST["passwort"]) ? $_SESSION["passwort"] = $_POST["passwort"]: $_SESSION["passwort"] = "";
			isset($_POST["passTwo"]) ? $_SESSION["passTwo"] = $_POST["passTwo"]: $_SESSION["passTwo"] = "";
			isset($_POST["rechte"]) ? $_SESSION["rechte"] = $_POST["rechte"]: $_SESSION["rechte"] = "";
			isset($_POST["login"]) ? $_SESSION["login"] = $_POST["login"]: $_SESSION["login"] = "";
		}
	}
	
	public function verbindung($servername, $DBLogname, $DBpasswort, $dbname) {
		/* DAS SOLL VERBESSET WERDEN!
		 * Keine feste Eingaben für LOGNAME und PASSWORT */
		$mysqli = new mysqli($servername, "root", "", $dbname);
	
		if ($mysqli->connect_error) {
			echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
			exit();
		}
		
		if (!$mysqli->set_charset("utf8")) {
			echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
		} else {
			$this->mysqli = $mysqli;
		}
		
		#echo "Verbindung hat geklappt!";
		#$this->mysqli = $mysqli;
	}
	
	public function anmeldung() {
		$this->verbindung("localhost", "root", "", "gaestebuch");
		$benutzerListe = $this->mysqli->query("SELECT logname, passwort, rechte FROM benutzer;");
		$_SESSION["login"] = "";
		
		while ($zeile = $benutzerListe->fetch_array()) {
			if (strcmp($_SESSION["logname"], $zeile["logname"]) == 0) {
				if (strcmp($_SESSION["passwort"], $zeile["passwort"]) == 0) {
					$_SESSION["rechte"] = $zeile["rechte"];
					$_SESSION["login"] = "ok";
					$benutzerListe->close();
					$this->mysqli->close();
					header('Location: http://localhost/dimas-test/GB_eclipse/startseite.php');
					
				} else {
					echo "Passwort ist Falsch!";
					exit();
				}
			}
		}
		if ($_SESSION["login"] != "ok") {
			echo "Benutzer ... ist unbekant!";
		}
		
		$benutzerListe->close();
		$this->mysqli->close();
		#exit();
	}
	
	public function benutzerTest() {
		if (strcmp($_SESSION["passwort"], $_SESSION["pass_two"]) == 0) {
			$eintraege = $this->mysqli->query("SELECT logname FROM benutzer;");
			while ($zeile = $eintraege->fetch_array()) {
				if (strcmp($_SESSION["logname"], $zeile["logname"]) == 0) {
					echo "Benutzer mit dem Name <strong>{$zeile['logname']}</strong> existiert schon!";
					$eintraege->close();
					$this->mysqli->close();
					exit();
				}
			}
			$this->registrierung();
		} else {
			echo "Passwort ist nicht identisch!";
		}
		
	}
	
	public function registrierung() {
		$insert = $this->mysqli->prepare("INSERT INTO benutzer
											(vorname,
											nachname,
											logname,
											passwort,
											rechte)
											VALUES(?, ?, ?, ?, ?)");
		$insert->bind_param("sssss", $_SESSION["vorname"],
				$_SESSION["nachname"],
				$_SESSION["logname"],
				$_SESSION["passwort"],
				$_SESSIONn["rechte"]);
		if($ergebnis = $insert->execute()) {
			
			header('Location: http://localhost/dimas-test/GB_eclipse/startseite.php');
			$_SESSION["login"] = "ok";
			$ergebnis->close();
			#$this->mysqli->close();
		} else {
			echo "Fehler bei der Registrierung: <br />";
			echo $this->mysqli->error();
		}
	}
	
	public function werDasIst($logname) {
		$benutzerListe = $this->mysqli->query("SELECT logname, rechte FROM benutzer;");
		
		while ($zeile = $benutzerListe->fetch_array()) {
			if (strcmp($logname, $zeile["logname"]) == 0) {
				$_SESSION["rechte"] = $zeile["rechte"];
			} else {
				$_SESSION["login"] = "";
			}
		}
		$benutzerListe->close();
		$this->mysqli->close();
		#return $this->benutzerDaten;
	}
	
	public function loeschen($loeschnenKandidat) {
		$this->verbindung("localhost", $loeschnenKandidat["logname"], $loeschnenKandidat["passwort"], "gaestebuch");
		$benutzerListe = $this->mysqli->query("SELECT logname, passwort, rechte FROM benutzer;");
		
		while ($zeile = $benutzerListe->fetch_array()) {
			if ( (strcmp($loeschnenKandidat["logname"], $zeile["logname"]) == 0)
					and strcmp($loeschnenKandidat["rechte"] == 1)) {
				
			} else {
				echo "Sie sind nicht Berechtigt für diese Aktion!";
			}
		}
	}
}


?>
