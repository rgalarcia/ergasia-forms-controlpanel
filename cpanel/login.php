<!DOCTYPE html>
<html lang="ca"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Iniciar sessió</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>

  </head>

  <body>
	

    <div class="container">
	<?php
		if (isset($_GET["error"]) && $_GET["error"] != NULL && is_numeric($_GET["error"]))
		{
			$warn=$_GET["error"];
			if ($warn == 1) echo "<div class=\"alert alert-info\" role=\"alert\"> Falta per omplir algun dels camps.</div>";
			else if ($warn == 2) echo "<div class=\"alert alert-warning\" role=\"alert\"> Nom d'usuari o contrasenya incorrectes.</div>";
		}
	?>
      <form class="form-signin" role="form" action="dologin.php" method="post">
        <h2 class="form-signin-heading">Siusplau, inicïi sessió</h2>
        <label for="inputEmail" class="sr-only">Nom d'usuari</label>
        <input id="username" class="form-control" placeholder="Nom d'usuari" required="" autofocus="" type="username" name="username" value="">
        <label for="inputPassword" class="sr-only">Contrasenya</label>
        <input id="password" class="form-control" placeholder="Contrasenya" required="" type="password" name="password" value="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Inicia sessió</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>