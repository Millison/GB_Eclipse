<?php
session_start();

class Verbindung {
	
	public $dbv;
	public $benutzerDaten = array (
			"vorname" => "",
			"nachname" => "",
			"logname" => "",
			"passwort" => "",
			"passTwo" => "",
			"rechte" => "",
			"login" => "");
	
	public function __construct() {
		$mysqli = new mysqli("localhost", "root", "", "gaestebuch");
		
		if ($mysqli->connect_error) {
			echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
			exit();
		}
		
		if (!$mysqli->set_charset("utf8")) {
			echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
		} else {
			$this->dbv = $mysqli;
		}
	}
	
	public function getConnect() {
		return $this->dbv;
	}
	
	public function setBenutzerDaten($datenSatz) {
		$this->benutzerDaten["vorname"] = $datenSatz["vorname"];
		$this->benutzerDaten["nachname"] = $datenSatz["nachname"];
		$this->benutzerDaten["logname"] = $datenSatz["logname"];
		$this->benutzerDaten["passwort"] = $datenSatz["passwort"];
		$this->benutzerDaten["passTwo"] = $datenSatz["passTwo"];
		$this->benutzerDaten["rechte"] = $datenSatz["rechte"];
		$this->benutzerDaten["login"] = $datenSatz["login"];
	}
	
	public function getBenutzerDaten() {
		return $this->benutzerDaten;
	}
}

?>