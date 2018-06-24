<h2>Gästebuch</h2>
<hr />
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
		<input type="submit" value="Anmelden" name="anmelden" />
		<input type="submit" value="Registrieren" name="registrieren" />
	</form>
<?php 
	if (isset($_POST["anmelden"])) {
		header('Location: http://localhost/dimas-test/GB_eclipse/anmeldenForm.php');
	} elseif (isset($_POST["registrieren"])) {
		header('Location: http://localhost/dimas-test/GB_eclipse/registrierenForm.php');
	}
?>
<hr />