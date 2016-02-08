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

	<title>Formulari 10 - Ergasia Seguretat S.L.</title>
	<link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cpanel/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="../cpanel/css/jumbotron.css" rel="stylesheet">
	<script src="../cpanel/js/ie-emulation-modes-warning.js"></script>

</head>
<body>
    <div class="container">
    <h3>INSPECCION CONTINUA DE SEGURIDAD</h3>
    <h4>Empresa: <?php if(isset($_GET["business"])) echo $_GET["business"]; else echo "N/A"; ?></h4> 
		<form class="form-horizontal" role="form" method="post" action="../usr/answer.php">
			<br>
			<br>
			<div class="form-group" style="padding:20px">
			<h4>Manipulación de objetos</h4><br><div class="form-group">		
						<label for="name" class="col-sm-2 control-label">dsffsdfs</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" name="12aoptradio">N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" name="12aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" name="12aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p>Valor del riesgo</p>
							
							<label class="radio-inline"><input type="radio" name="12boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" name="12boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" name="12boptradio">Bajo</label>
						</center>
						</div>
					</div>
					<div class="form-group" style="padding:5px">
		<label for="comment">Comentario:</label>
		<textarea class="form-control" rows="5" id="comment"></textarea>
	</div>
	<button type="button" class="btn btn-success">Enviar</button>
	</form>
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