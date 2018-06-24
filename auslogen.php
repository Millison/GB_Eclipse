<h1>Gästebuch</h1>
<hr />
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
	<input type="submit" value="Auslogen" name="auslogen" />
</form>
<?php 
	if (isset($_POST["auslogen"])) {
		include 'logout.php';
	}
?>
<hr />