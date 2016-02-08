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

	<title>Formulari 19 - Ergasia Seguretat S.L.</title>
	<link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cpanel/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="../cpanel/css/jumbotron.css" rel="stylesheet">
	<script src="../cpanel/js/ie-emulation-modes-warning.js"></script>

</head>
<body>
    <div class="container">
    <h3>INSPECCIÓN CONTINUA DE SEGURIDAD</h3>
    <h4>EMPRESA: <?php if(isset($_GET["business"])) echo $_GET["business"]; else echo "N/A"; ?></h4> 
		<form class="form-horizontal" id="answer" role="form" method="post" action="../usr/answer.php">
			<h4>OBRA:</h4> <input type="text" class="form-control" id="obra" name="obra" placeholder="Nombre de la obra" value="">
			<hr>
			<h4>LEYENDA:</h4>
			<h5><strong>N/A:</strong> No aplicable.</h5>
			<h5><strong>B:</strong> Bien, condiciones correctas.</h5>
			<h5><strong>M:</strong> Mal, faltan condiciones de seguridad, se anota en la última página las medidas solicitadas y tomadas.</h5>
			<hr>
			<div class="form-group" style="padding:0px 20px 0px 20px">
			<h4>Estado de orden</h4><br><div class="form-group">		
						<label for="name" class="col-sm-2 control-label">Prova</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="00aoptradio">N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B"name="00aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M"name="00aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="00boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="00boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="00boptradio">Bajo</label>
						</center>
						</div>
					</div>
					<br>
					<div class="form-group" style="padding:5px">
		<label for="comment">ANOMALÍAS/MEDIDAS PREVENTIVAS A IMPLANTAR:</label>
		<textarea class="form-control" form="answer" rows="5" id="comment"></textarea>
	</div>
	<button type="action" class="btn btn-success">Enviar</button>
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