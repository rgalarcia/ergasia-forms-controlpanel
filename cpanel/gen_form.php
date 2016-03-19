<?php
include "sql_data.php";

//Checking the user's input and treating it as a JSOON encoded array.
if (!isset($_POST["JSONdata"]) || $_POST["JSONdata"] == NULL)
{
	$status["status"] = "ERR";
	$status["input"] = "ERR";
	$status["dbinsertion"] = "NP";
	$status["htmcreation"] = "NP";
	$status["form"] = "NA";
	
	die(json_encode($status));
}
$jsondata = json_decode ($_POST["JSONdata"]);
//var_dump($jsondata);

$categories = "";
$questions = "";
$status = array();

//Separating categories and questions for each category and inserting them into two different strings
for ($i = 0; $i < count($jsondata); $i++)
{
	$notnullq = 0;
	for ($j = 2; $j < count($jsondata[$i]); $j++)
	{
		if (trim($jsondata[$i][$j]) != "")
		{
			if ($j != count($jsondata[$i])-1 && $i != count($jsondata)-1) $questions = $questions . $jsondata[$i][$j] . "|";
			else if ($j != count($jsondata[$i])-1 && $i == count($jsondata)-1) $questions = $questions . $jsondata[$i][$j] . "|";
			else if ($i != count($jsondata)-1) $questions = $questions . $jsondata[$i][$j] . "#";
			else $questions = $questions . $jsondata[$i][$j];
			
			$notnullq++;
		}
	}
	
	if ($notnullq != 0)
	{
		if ($i != count($jsondata)-1) $categories = $categories . $jsondata[$i][0] . "|";
		else $categories = $categories . $jsondata[$i][0];
	}
}

$categories = trim($categories, "|");
$questions = trim($questions, "|");
$categories = trim($categories, "#");
$questions = trim($questions, "#");

//Inserting the 
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
$query = mysqli_query($link, "INSERT INTO `forms`(`categories`, `questions`) VALUES (\"".mysqli_real_escape_string($link, utf8_decode($categories))."\", \"".mysqli_real_escape_string($link, utf8_decode($questions))."\")");

if ($query)
{
	$idform = mysqli_insert_id($link);
	$file = "../form/form".$idform.".php";
	
	// <head> of the form's HTML code
	$head = "<?php 
	if (!isset(\$_GET[\"master\"]))
	{
		if (isset(\$_GET[\"telf\"]) && \$_GET[\"telf\"] != NULL)
		{
			include \"sql_data.php\";
			\$telf = \$_GET[\"telf\"];
			\$link = mysqli_connect(\$sql_host, \$sql_user, \$sql_pass, \$sql_db);
			\$query = mysqli_query(\$link, \"SELECT * FROM `users` WHERE `telf` = \".mysqli_real_escape_string(\$link,\$telf).\"\");
			\$result = mysqli_fetch_array(\$query);
			
			\$uri = explode (\"?\", \$_SERVER[\"REQUEST_URI\"]);
			\$supposed_form = filter_var (\$uri[0], FILTER_SANITIZE_NUMBER_INT);
			\$form = \$result[\"form\"];
			\$answered = \$result[\"answered\"];
			
			if (\$form != \$supposed_form) die();

			if(\$answered == 1)
			{
				die(\"<div class='alert alert-success' role='alert'>Ya ha contestado este formulario. Volver&aacute; a estar disponible la semana siguiente.</div>\");
			}
		}
		else
		{
			die();
		}
	}
	?>
<!DOCTYPE html>
<html lang=\"es\">

<head>

	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
	<meta charset=\"utf-8\">
	<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		
	<meta name=\"description\" content=\"\">
	<meta name=\"author\" content=\"\">
	<link rel=\"icon\" href=\"../favicon.ico\">

	<title>Formulari $idform - Ergasia Seguretat S.L.</title>
	<link href=\"../cpanel/css/bootstrap.min.css\" rel=\"stylesheet\">
	<link href=\"../cpanel/css/ie10-viewport-bug-workaround.css\" rel=\"stylesheet\">
	<link href=\"../cpanel/css/jumbotron.css\" rel=\"stylesheet\">
	<script src=\"../cpanel/js/ie-emulation-modes-warning.js\"></script>

</head>
";

	// <body> of the form's HTML code
	$body = "<body>
	<script src=\"../cpanel/js/jquery-1.12.0.min.js\"></script>
	<script>
		$(document).ready( function(){
			$(\".valorriesgo\").hide();
			
			$('input[type=\"radio\"]').click(function() {
				var radio = $(this).attr('class');
				if(radio == undefined)
				{
					radio = $(this).attr('name');
					$(\"#\".concat(radio)).hide();
				}
				else
				{
					$(\"#\".concat(radio)).show();
				}
			});
		});
	</script>
    <div class=\"container\">
    <h3>INSPECCIÓN CONTINUA DE SEGURIDAD</h3>
    <h4>EMPRESA: <?php if(isset(\$_GET[\"business\"])) echo \$_GET[\"business\"]; else echo \"N/A\"; ?></h4> 
		<form class=\"form-horizontal\" id=\"answer\" role=\"form\" method=\"post\" action=\"../usr/answer.php?telf=<?php if(isset(\$_GET[\"telf\"])) echo \$_GET[\"telf\"]; ?>\">
			<h4>OBRA:</h4> <input type=\"text\" class=\"form-control\" id=\"obra\" name=\"obra\" placeholder=\"Nombre de la obra\" value=\"\" required>
			<hr>
			<h4>LEYENDA:</h4>
			<h5><strong>N/A:</strong> No aplicable.</h5>
			<h5><strong>B:</strong> Bien, condiciones correctas.</h5>
			<h5><strong>M:</strong> Mal, faltan condiciones de seguridad, se anota en la última página las medidas solicitadas y tomadas.</h5>
			<hr>
			<div class=\"form-group\" style=\"padding:0px 20px 0px 20px\">
			";
			
	for ($i = 0; $i < count($jsondata); $i++)
	{
		
		$counter = 0;
		for ($j = 2; $j < count($jsondata[$i]); $j++)
		{
			if (trim($jsondata[$i][$j]) != "") $counter++;
		}
		
		if ($counter != 0)
		{
		$body = $body . "<h4>".$jsondata[$i][0]."</h4><br>";
		
			for ($j = 2; $j < count($jsondata[$i]); $j++)
			{
				if ($jsondata[$i][$j] != "")
				{
					$body = $body . "<div class=\"form-group\">		
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
	
	$body = $body .
	
	"<div class=\"form-group\" style=\"padding:5px\">
		<label for=\"comment\">ANOMALÍAS/MEDIDAS PREVENTIVAS A IMPLANTAR:</label>
		<textarea class=\"form-control\" name=\"comment\" form=\"answer\" rows=\"5\" id=\"comment\" required></textarea>
	</div>
	<button =\"action\" class=\"btn btn-success\">Enviar</button>
	</form>
		<hr>
		<footer>
			<p>© 2016 Ergasia Seguretat, S.L.</p>
		</footer>
    </div>
    <script src=\"../cpanel/js/jquery.min.js\"></script>
    <script>window.jQuery || document.write('<script src=\"../../assets/js/vendor/jquery.min.js\"><\/script>')</script>
    <script src=\"../cpanel/js/bootstrap.min.js\"></script>
    <script src=\"../cpanel/js/ie10-viewport-bug-workaround.js\"></script>
	</div>
</body>

</html>";

	//HTML = <head>+<body>
	$html = $head.$body;
	//Create the form's file with this HTML
	$file = file_put_contents($file, $html, LOCK_EX);
	
	if ($file)
	{
		$status["status"] = "OK";
		$status["input"] = "OK";
		$status["dbinsertion"] = "OK";
		$status["htmcreation"] = "OK";
		$status["form"] = $idform;		
	}
	else
	{
		$status["status"] = "ERR";
		$status["input"] = "OK";
		$status["dbinsertion"] = "OK";
		$status["htmcreation"] = "ERR";
		$status["form"] = $idform;		
	}
}
else
{
		$status["status"] = "ERR";
		$status["input"] = "OK";
		$status["dbinsertion"] = "ERR";
		$status["htmcreation"] = "NP";
		$status["form"] = "NA";	
}

die(json_encode($status));
?>