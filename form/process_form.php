<?php
error_reporting(E_ALL);
global $form;
if (!isset($_GET["id"]) || $_GET["id"] == NULL)
{
	$errmsg = "id of the form not provided";
	die("Error ocurred @ file ". __FILE__ ." (line ". __LINE__ .") with message: $errmsg.");
}

$supposed_form = $_GET["id"];

if (!isset($_GET["master"]))
{
	if (isset($_GET["telf"]) && $_GET["telf"] != NULL)
	{
		include "sql_data.php";
		$telf = $_GET["telf"];
		$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
		$query = mysqli_query($link, "SELECT * FROM `users` WHERE `telf` = ".mysqli_real_escape_string($link, $telf)."");
		$result = mysqli_fetch_array($query);
			
		$form = $result["form"];
		$answered = $result["answered"];
			
		if ($form != $supposed_form) die($form."foo".$supposed_form);

		if($answered == 1)
		{
			die("<div class='alert alert-success' role='alert'>Ya ha contestado este formulario. Volver&aacute; a estar disponible la semana siguiente.</div>");
		}
	}
	else
	{
		die("bar");
	}
	
} else {
	include "sql_data.php";
	$form = $supposed_form;
	
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

	<title>Formulario <?php echo $form ?> - Ergasia Seguretat S.L.</title>
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
			<h4>CENTRO/OBRA:</h4> <input type="text" class="form-control" id="obra" name="obra" placeholder="Nombre de la obra" value="" required>
			<hr>
			<h4>LEYENDA:</h4>
			<h5><strong>N/A:</strong> No aplicable.</h5>
			<h5><strong>B:</strong> Bien, condiciones correctas.</h5>
			<h5><strong>M:</strong> Mal, faltan condiciones de seguridad, se anota en la última página las medidas solicitadas y tomadas.</h5>
			<hr>
			<div class="form-group" style="padding:0px 20px 0px 20px">
	<?php
	
	# Patch 31/08/2016
	// The objective of this patch is to simulate a JSONDATA user's input
	// from the information that is already stored in the database.
	
	$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	$query = mysqli_query($link, "SELECT * FROM `forms` WHERE `id` = ".mysqli_real_escape_string($link, $form)."");
	$result = mysqli_fetch_array($query);
	
	$c_exp = explode("|", $result["categories"]);
	$q_exp = explode("#", $result["questions"]);
	$jsondata = array();
	
	for ($i = 0; $i < count($c_exp); $i++)
	{
		$jsondata[$i][0] = $c_exp[$i];
		$jsondata[$i][1] = -1;
		$q_exp_2 = explode("|", $q_exp[$i]);
		
		for ($j = 0; $j < count($q_exp_2); $j++)
		{
			$jsondata[$i][$j+2] = $q_exp_2[$j];
		}
	}
	####
		
	for ($i = 0; $i < count($jsondata); $i++)
	{
		
		$counter = 0;
		for ($j = 2; $j < count($jsondata[$i]); $j++)
		{
			if (trim($jsondata[$i][$j]) != "") $counter++;
		}
		
		if ($counter != 0)
		{
		echo "<h4>".$jsondata[$i][0]."</h4><br>";
		
			for ($j = 2; $j < count($jsondata[$i]); $j++)
			{
				if ($jsondata[$i][$j] != "")
				{
					echo "<div class=\"form-group\">		
						<label for=\"question\" class=\"col-sm-2 control-label\" style=\"text-align: justify\">".$jsondata[$i][$j]."</label>
						<div class=\"col-sm-10\">
							<center>
							<label class=\"radio-inline\"><input type=\"radio\" value=\"N/A\" name=\"".($i+1).($j-1)."aoptradio\" required>N/A&nbsp;</label>
							<label class=\"radio-inline\"><input type=\"radio\" value=\"B\" name=\"".($i+1).($j-1)."aoptradio\">B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<label class=\"radio-inline\"><input type=\"radio\" value=\"M\" class=\"".($i+1).($j-1)."aoptradio\" name=\"".($i+1).($j-1)."aoptradio\">M&nbsp;&nbsp;&nbsp;</label><br>
							<br>
							<div class=\"valorriesgo\" id=\"".($i+1).($j-1)."aoptradio\">
							<p><i>Valor del riesgo</i></p>
							
							<label class=\"radio-inline\"><input type=\"radio\" value=\"Alto\" class=\"\" name=\"".($i+1).($j-1)."boptradio\">Alto</label>
							<label class=\"radio-inline\"><input type=\"radio\" value=\"Medio\" class=\"\" name=\"".($i+1).($j-1)."boptradio\" checked>Medio</label>
							<label class=\"radio-inline\"><input type=\"radio\" value=\"Bajo\" class=\"\" name=\"".($i+1).($j-1)."boptradio\">Bajo</label>
							</div>
							</center>
						</div>
					</div>
					<br>
					";
				}
			}
		}
	}
	?>
	
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
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"></script>')</script>
    <script src="../cpanel/js/bootstrap.min.js"></script>
    <script src="../cpanel/js/ie10-viewport-bug-workaround.js"></script>
	</div>
	
</body>

</html>