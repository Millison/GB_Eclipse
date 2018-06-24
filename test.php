<?php 
	class Etwas {
		public $var = "";
		
		public function __construct($text) {
			$this->var = $text;
		}
		
		public function __destruct() {
			$this->var;
		}
	}
	
	$mysqli = new mysqli("localhost", "root", "", "gaestebuch");
	
	if ($mysqli->connect_error) {
		echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
		exit();
	}
	
	if (!$mysqli->set_charset("utf8")) {
		echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
	}
	
	$ohneParents = $mysqli->query("SELECT * FROM buch WHERE parents=0 ORDER BY zeit DESC;");
	while ($zeileOP = $ohneParents->fetch_array()) {
		$abstabd = 0;
		echo "<p><strong>{$zeileOP['logname']} {$zeileOP['zeit']}</strong>: <br />{$zeileOP['text']}</p> ";
		$mitParents = $mysqli->query("SELECT * FROM buch WHERE parents<>0 ORDER BY zeit DESC;");
		while ($zeileMP = $mitParents->fetch_array()) {
			if ($zeileOP["id"] == $zeileMP["parents"]) {
				$abstabd += 25;
				echo "<div style=\"padding-left: {$abstabd}px;\"><strong>{$zeileMP['logname']} {$zeileMP['zeit']}</strong>: <br />{$zeileMP['text']}</div> ";
				$mitParentsZuParents = $mysqli->query("SELECT * FROM buch WHERE parents<>0 ORDER BY zeit DESC;");
				while ($zeileMPzuP = $mitParentsZuParents->fetch_array()) {
					if ($zeileMP["id"] == $zeileMPzuP["parents"]) {
						$abstabd += 25;
						echo "<div style=\"padding-left: {$abstabd}px;\"><strong>{$zeileMPzuP['logname']} {$zeileMPzuP['zeit']}</strong>: <br />{$zeileMPzuP['text']}</div> ";
					}
				}
			}
		}
	}
?> 
