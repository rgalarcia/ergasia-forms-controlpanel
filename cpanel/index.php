<?php
session_start();
if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"]==NULL) {
	die(header('Location: login.php'));
}
?>
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

    <title>Formularis - Egarsia Seguretat S.L.</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="./css/jumbotron.css" rel="stylesheet">
    <script src="./js/ie-emulation-modes-warning.js"></script>
	
</head>
  
<body>
	<!--- capçalera !--->
    <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Panell de control</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Inici</a></li>
					<li><a href="dades.php">Dades</a></li>
					<li><a href="usuaris.php">Afegir usuari</a></li>
					<li><a href="forms.php">Afegir formulari</a></li>
				</ul>
				<form class="navbar-form navbar-right" action="dades.php" method="get">
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Cerca un usuari" value="">
					</div>
					<button type="submit" class="btn btn-success">Cerca</button>
				</form>
				<form class="navbar-form navbar-right" action="dologout.php" method="get">
					<input type="hidden" class="form-control" id="token" name="token" value="<?php echo $_SESSION["token"]; ?>">
					<button type="submit" class="glyphicon glyphicon-log-out gi-10x"></button>
				</form>
			</div>
		</div>
    </nav>
	<br>
	<br>
    <div class="jumbotron">
		<div class="container">
			<h1>Benvigut al panell de control!</h1>
			<p>Per començar, seleccioni una de les opcions de sota. També pot cercar un usuari un concret mitjançant la cerca de la barra de dalt.</p>
		</div>
	</div>
    <div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>Dades</h2>
				<p>Aquesta opció permet veure tots els usuaris, dades rellevants sobre aquests, i si han completat el seu formulari associat. També permet canviar el formulari associat de un usuari per un de nou.</p>
				<p><a class="btn btn-default" href="dades.php" role="button">Porta'm-hi »</a></p>
			</div>
			<div class="col-md-4">
				<h2>Afegir usuari</h2>
				<p>Per tal d'afegir un nou usuari a la base de dades, seleccioni aquesta opció. </p>
				<p><a class="btn btn-default" href="usuaris.php" role="button">Porta'm-hi »</a></p>
			</div>
			<div class="col-md-4">
				<h2>Afegir formulari</h2>
				<p>Si es vol afegir un nou formulari, seleccioni aquesta opció.</p>
				<p><a class="btn btn-default" href="forms.php" role="button">Porta'm-hi »</a></p>
			</div>
		</div>
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
