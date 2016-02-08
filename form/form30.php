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

	<title>Formulari 30 - Ergasia Seguretat S.L.</title>
	<link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cpanel/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="../cpanel/css/jumbotron.css" rel="stylesheet">
	<script src="../cpanel/js/ie-emulation-modes-warning.js"></script>

</head>
<body>
    <div class="container">
    <h3>INSPECCIÓN CONTINUA DE SEGURIDAD</h3>
    <h4>EMPRESA: <?php if(isset($_GET["business"])) echo $_GET["business"]; else echo "N/A"; ?></h4> 
		<form class="form-horizontal" id="answer" role="form" method="post" action="../usr/answer.php?telf=<?php if(isset($_GET["telf"])) echo $_GET["telf"]; ?>">
			<h4>OBRA:</h4> <input type="text" class="form-control" id="obra" name="obra" placeholder="Nombre de la obra" value="" required>
			<hr>
			<h4>LEYENDA:</h4>
			<h5><strong>N/A:</strong> No aplicable.</h5>
			<h5><strong>B:</strong> Bien, condiciones correctas.</h5>
			<h5><strong>M:</strong> Mal, faltan condiciones de seguridad, se anota en la última página las medidas solicitadas y tomadas.</h5>
			<hr>
			<div class="form-group" style="padding:0px 20px 0px 20px">
			<h4>Uso de plataformas elevadoras</h4><br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="11boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="11boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="11boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova2</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="12aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="12aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="12aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="12boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="12boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="12boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<h4>Uso de escaleras de mano</h4><br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova3</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="21aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="21aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="21aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="21boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="21boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="21boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova4</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="22aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="22aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="22aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="22boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="22boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="22boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova5</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="23aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="23aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="23aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="23boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="23boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="23boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<h4>Incendios</h4><br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova6</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="31aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="31aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="31aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="31boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="31boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="31boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">Prova7</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="32aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="32aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" name="32aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" name="32boptradio" required>Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" name="32boptradio">Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" name="32boptradio">Bajo</label>
							</center>
						</div>
					</div>
					<br>
					<div class="form-group" style="padding:5px">
		<label for="comment">ANOMALÍAS/MEDIDAS PREVENTIVAS A IMPLANTAR:</label>
		<textarea class="form-control" name="comment" form="answer" rows="5" id="comment" required></textarea>
	</div>
	<button ="action" class="btn btn-success">Enviar</button>
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
	</div>
</body>

</html>