<!DOCTYPE html>
<html lang="ca">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../favicon.ico">

	<title>Formulari 1 - Ergasia Seguretat S.L.</title>
	<link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cpanel/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="../cpanel/css/jumbotron.css" rel="stylesheet">
	<script src="../cpanel/js/ie-emulation-modes-warning.js"></script>

</head>
<body>

    <div class="container">
		<br>
		<br>
		<?php
		include "sql_data.php";

		//Get the telephone number from the user
		if (isset($_GET["telf"])) $telf = $_GET["telf"];
		else die ();

		//Check that the user is in the database, and that it has not answered the form yet
		$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
		if (!$link) die ("<div class=\"alert alert-danger\" role=\"alert\">Error de comunicación con la base de dades. Vuelva a intentar-lo más tarde.</div>");

		$result1 = mysqli_query($link, "SELECT `answered` FROM `users` WHERE `telf` = '" . mysqli_real_escape_string($link, $telf) . "';");
		$result1_array = mysqli_fetch_row($result1);

		if ($result1_array == NULL ) die("<div class=\"alert alert-danger\" role=\"alert\">Este número de teléfono no tiene ningún formulario asociado. Póngase en contacto con Ergasia.</div>");
		else if ($result1_array[0] == 1) die("<div class=\"alert alert-success\" role=\"alert\">Ya ha respondido a este formulario. Volverá a estar disponible la semana que viene.</div>");


		//The user exists and it has not answered the form yet, send the user to the form
		$result2 = mysqli_query($link, "SELECT `form`,`business` FROM `users` WHERE `telf` = '" . mysqli_real_escape_string($link, $telf) . "';");
		$result2_array = mysqli_fetch_row($result2);
		mysqli_close($link);
		header("Location: ../form/form" . $result2_array[0] . ".php?telf=" . $telf . "&business=" . $result2_array[1]);
		?>
		<hr>
		<footer>
			<p>© 2016 Ergasia Seguretat, S.L.</p>
		</footer>
    </div>
	
    <script src="../cpanel/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../cpanel/js/bootstrap.min.js"></script>
    <script src="../cpanel/js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>
