<!DOCTYPE html>

<html lang="es">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../favicon.ico">

	<title>Gracias por contestar</title>
	<link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cpanel/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="../cpanel/css/jumbotron.css" rel="stylesheet">
	<script src="../cpanel/js/ie-emulation-modes-warning.js"></script>
	
</head>
<body>
	<div class="container" style="padding: 30px 20px 20px 20px">

		<?php
		include "sql_data.php";

		$uri = explode ("=", $_SERVER["HTTP_REFERER"]);
		$uri = explode ("&", $uri[1]);
		$form = filter_var ($uri[0], FILTER_SANITIZE_NUMBER_INT);
		if (!isset($_GET["telf"]) || $_GET["telf"] == NULL) die();
		else $telf = $_GET["telf"];
		
		$answers = "";
		$obra = $_POST["obra"];
		$comment = $_POST["comment"];
		$length = count($_POST)-1;

		$key2 = 0;
		foreach ($_POST as $key => $value)
		{
			if (($key2%2)==1)
			{
				$commanotcomma = $answers==""?"":"#";
			}
			else if (($key2%2)==0)
			{
				$commanotcomma = $answers==""?"":"|";		
			}
			
			if ($key != 0 && $key != $length) $answers = $answers . $commanotcomma . $value;
			$key2++;
		}

		$timestamp = time();
		
		$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
		$query3 = mysqli_query($link, "SELECT `form`, `answered` FROM `users` WHERE `telf`=\"".mysqli_real_escape_string($link, $telf)."\"");
		$result = mysqli_fetch_array($query3);
		
		if ($result["form"] == $form)
		{
			if ($result["answered"] != 1)
			{
				
				$query2 = mysqli_query($link, "UPDATE `users` SET `answered`=0 WHERE `telf`=\"".mysqli_real_escape_string($link, $telf)."\"");
				$query = mysqli_query($link, "INSERT INTO `uanswers`(`form`,`telf`,`obra`,`answers`,`comment`,`timestamp`) VALUES (\"".mysqli_real_escape_string($link, $form)."\", 
				\"".mysqli_real_escape_string($link, $telf)."\", \"".mysqli_real_escape_string($link, $obra)."\", \"".mysqli_real_escape_string($link, $answers)."\",
				\"".mysqli_real_escape_string($link, $comment)."\", \"".mysqli_real_escape_string($link, $timestamp)."\")");

				if (!$query) echo "<div class=\"alert alert-danger\" role=\"alert\">Error de comunicación con la base de dades. Vuelva a intentar-lo más tarde.</div>";
				else echo "<div class=\"alert alert-success\" role=\"alert\">Gracias por contestar. Para responder de nuevo el formulario, reinicie la aplicación.</div>";
				
			}
			else
			{
				echo "<div class=\"alert alert-success\" role=\"alert\">Ya ha contestado este formulario. Volverá a estar disponible la semana que viene.</div>";			
			}
		}
		?>
		<hr>
		<footer>
			<p>© 2016 Ergasia Seguretat, S.L.</p>
		</footer>
    </div>
     
    <script src="./js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>