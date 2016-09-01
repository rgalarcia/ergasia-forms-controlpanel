<?php 
	if (!isset($_GET["master"]))
	{
		if (isset($_GET["telf"]) && $_GET["telf"] != NULL)
		{
			include "sql_data.php";
			$telf = $_GET["telf"];
			$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
			$query = mysqli_query($link, "SELECT * FROM `users` WHERE `telf` = ".mysqli_real_escape_string($link,$telf)."");
			$result = mysqli_fetch_array($query);
			
			$uri = explode ("?", $_SERVER["REQUEST_URI"]);
			$supposed_form = filter_var ($uri[0], FILTER_SANITIZE_NUMBER_INT);
			$form = $result["form"];
			$answered = $result["answered"];
			
			if ($form != $supposed_form) die();

			if($answered == 1)
			{
				die("<div class='alert alert-success' role='alert'>Ya ha contestado este formulario. Volver&aacute; a estar disponible la semana siguiente.</div>");
			}
		}
		else
		{
			die();
		}
	}
	?>
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

	<title>Formulari 1 - Ergasia Seguretat S.L.</title>
	<link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">
	<link href="../cpanel/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="../cpanel/css/jumbotron.css" rel="stylesheet">
	<script src="../cpanel/js/ie-emulation-modes-warning.js"></script>

</head>
<body>
	<script src="../cpanel/js/jquery-1.12.0.min.js"></script>
	<script>
		$(document).ready( function(){
			$(".valorriesgo").hide();
			
			$('input[type="radio"]').click(function() {
				var radio = $(this).attr('class');
				if(radio == undefined)
				{
					radio = $(this).attr('name');
					$("#".concat(radio)).hide();
				}
				else
				{
					$("#".concat(radio)).show();
				}
			});
		});
	</script>
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
			<h4>Uso de protecciones personales</h4><br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se llevan consigo todos los elementos de protección requeridos para trabajar?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="11aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="11aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="11aoptradio" name="11aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="11aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="11boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="11boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="11boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<h4>Uso de herramientas personales</h4><br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se comprueba el buen estado de las herramientas antes de usarlas?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="21aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="21aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="21aoptradio" name="21aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="21aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="21boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="21boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="21boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<br>
					<div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se guarda un registro de edad de las herramientas para inspecciones periódicas?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="22aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="22aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="22aoptradio" name="22aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="22aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="22boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="22boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="22boptradio">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<br>
					<h4>Uso de otros métodos personales</h4><br><div class="form-group">		
						<label for="question" class="col-sm-2 control-label" style="text-align: justify">¿Se dice Usted?</label>
						<div class="col-sm-10">
							<center>
							<label class="radio-inline"><input type="radio" value="N/A" name="31aoptradio" required>N/A&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="B" name="31aoptradio">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class="radio-inline"><input type="radio" value="M" class="31aoptradio" name="31aoptradio">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class="valorriesgo" id="31aoptradio">
							<p><i>Valor del riesgo</i></p>
							
							<label class="radio-inline"><input type="radio" value="Alto" class="" name="31boptradio">Alto</label>
							<label class="radio-inline"><input type="radio" value="Medio" class="" name="31boptradio" checked>Medio</label>
							<label class="radio-inline"><input type="radio" value="Bajo" class="" name="31boptradio">Bajo</label>
							</div>
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