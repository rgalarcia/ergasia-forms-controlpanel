<?php

include "sql_data.php";

//Connect to the database
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if (!$link) die ("Database connection error");

//GET OPTIONS
if (isset($_GET["name"]) && $_GET["name"] != NULL) $options = "specific"; //Info of a specific user is being requested
else if(isset($_GET["edit"]) && $_GET["edit"] != NULL) $options = "edit"; //Editing of users is requested
else $options = false;

$data = false;
if ($options == "specific")
{
	$usr = trim($_GET["name"]);
	if (strlen($usr)>=3)
	{
		$data = mysqli_query($link, "SELECT * FROM `users` WHERE `name` LIKE '%" . mysqli_real_escape_string($link, $usr) . "%'");
	}
	else
	{
		$data = mysqli_query($link, "SELECT * FROM `users` WHERE `name` LIKE '" . mysqli_real_escape_string($link, $usr) . "%'");
	}
	$copydata = $data;
	$data_array = mysqli_fetch_array($data);
	
	if ($data_array == NULL) $data = false;
	else $data = true;
}
else
{
	if ($options == "edit") $usr = $_GET["edit"];
	$data = mysqli_query($link, "SELECT * FROM `users`");
}

mysqli_close($link);

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

    <title>Dades - Ergasia Seguretat S.L.</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="./css/jumbotron.css" rel="stylesheet">
    <script src="./js/ie-emulation-modes-warning.js"></script>
	
</head>

 <body>
  	<script src="./js/jquery-1.12.0.min.js"></script>
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
					<li><a href="index.php">Inici</a></li>
					<li class="active"><a href="dades.php">Dades</a></li>
					<li><a href="usuaris.php">Afegir usuari</a></li>
					<li><a href="forms.php">Afegir formulari</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Cerca un usuari" value="">
					</div>
					<button type="submit" class="btn btn-success">Cerca</button>
				</form>
			</div>
      </div>
    </nav>
	<br>
	<br>
	<br>
	<br>
	<br>

	<div class="container">
		<?php
		if (isset($_GET["action"]) && $_GET["action"] != NULL && is_numeric($_GET["action"]))
		{
			$warn=$_GET["action"];
			if ($warn == 0) echo "<div class=\"alert alert-success\" role=\"alert\"> Usuari exitosament esborrat de la base de dades.</div>";
			else if ($warn == 1) echo "<div class=\"alert alert-success\" role=\"alert\"> Modificacions guardades exitosament.</div>";
			else if ($warn == 2) echo "<div class=\"alert alert-info\" role=\"alert\"> No s'ha modificat cap camp.</div>";
			else if ($warn == 3) echo "<div class=\"alert alert-warning\" role=\"alert\"> El número de telèfon que ha escrit ja està registrat a la base de dades.</div>";
		}
		
		if ($options == "specific" && !$data)
		{
			echo "<h4>Aquest nom no correspon a cap usuari de la base de dades.</h4>
			<br>
			<br>";
		}
		else if ($options == "specific" && $data)
		{
			echo "<h4>Informació del client:</h4>
			<br>";	
		}
		else if ($options == "edit" && !$data)
		{
			echo "<h4>Aquest nom no correspon a cap usuari de la base de dades.</h4>
			<br>
			<br>";
		}
		
		?>
		<div class="row">
			<div class="col-md-9">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Telèfon</th>
							<th>Nom</th>
							<th>Empresa</th>
							<th>NIF</th>
							<th>Formulari</th>
							<th>Resposta</th>
							<th>Editar</th>
							<?php if($options == "edit") echo "<th>Eliminar</th>"; ?>
						</tr>
					</thead>
					<tbody>
					
						<?php
						$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
						if ($options == false || $options == "edit")
						{
							$i = 1;
					
							while ($data_array = mysqli_fetch_array($data))
							{
								if (isset($usr) && $data_array["telf"] == $usr)
								{
									$resposta = $data_array["answered"]?"Sí":"No";
									echo "<form action=\"update_user.php?modify=$usr\" method=\"POST\">";
									echo "<tr>
									<td>" . $i . "</td>";
									echo "<td><input id=\"telf\" class=\"form-control\" type=\"text\" value=\"\" placeholder=\"" . $data_array["telf"] . "\" name=\"telf\" autofocus></input></td>";
									echo "<td><input id=\"name\" class=\"form-control\" type=\"text\" value=\"\" placeholder=\"" . $data_array["name"] . "\" name=\"name\"></input></td>";
									echo "<td><input id=\"business\" class=\"form-control\" type=\"text\" value=\"\" placeholder=\"" . $data_array["business"] . "\" name=\"business\"></input></td>";
									echo "<td><input id=\"NIF\" class=\"form-control\" type=\"text\" value=\"\" placeholder=\"" . $data_array["NIF"] . "\" name=\"NIF\"></input></td>";
									//echo "<td><input id=\"form\" class=\"form-control\" type=\"text\" value=\"\" placeholder=\"Formulari " . $data_array["form"] . " \" name=\"form\"></input></td>";

									echo "<td>";
									$query = mysqli_query($link, "SELECT `form` FROM `forms` WHERE 1 ORDER BY `form` DESC LIMIT 150");
										
									$counter = 1;
									echo "<select multiple class=\"form-control\" id=\"form\" name=\"form\">";
									while ($row = mysqli_fetch_array($query))
									{
										echo "<option id=\"form$row[0]\" class=\"form$row[0]\" value=\"$row[0]\">F. $row[0]</option>";
										$counter++;
									}
									echo "</select>";
									echo "</td>";
										
									echo "<td>$resposta</td>";
									echo "<td>
									<button type=\"submit\"  class=\"btn btn-default\" align=\"left\" aria-label=\"Save changes\">
									<span class=\"glyphicon glyphicon-ok gi-5x\" aria-hidden=\"true\"></span>
									</button>
									</td>";
									echo "<td>
									<button type=\"button\" onclick=\"if(confirm('Està segur de voler eliminar permanentment aquest usuari de la base de dades?')){window.location.assign('update_user.php?delete=" . $data_array["telf"] . "')} \" class=\"btn btn-default\" align=\"left\" aria-label=\"Save changes\">
									<span class=\"glyphicon glyphicon-remove gi-5x\" aria-hidden=\"true\"></span>
									</button>
									</td>
									</tr>"; 
									echo "</form>";
									$i++;
								}
								else
								{
									$resposta = $data_array["answered"]?"<a href=\"dades.php?name=" . $data_array["name"] . "\">Sí</a>":"No";
						
									echo "<tr>
									<td>" . $i . "</td>";
									echo "<td>" . $data_array["telf"] . "</td>";
									echo "<td>" . $data_array["name"] . "</td>";
									echo "<td>" . $data_array["business"] . "</td>";
									echo "<td>" . $data_array["NIF"] . "</td>";
									echo "<td><a target =\"_blank\" href=\"../form/form" . $data_array["form"] . ".php\">Formulari " . $data_array["form"] . "</a></td>";
									echo "<td>" . $resposta . "</td>";
									
									if($options != "edit")
									{
										echo "<td>
										<a href=\"dades.php?edit=" . $data_array["telf"] . "\">
										<button type=\"button\"  class=\"btn btn-default\" align=\"left\" aria-label=\"Edit user\">
										<span class=\"glyphicon glyphicon-edit gi-5x\" aria-hidden=\"true\"></span>
										</button>
										</a>
										</td>
										</tr>
										";										
									}
									else
									{
										echo "<td>
										<a href=\"dades.php?edit=" . $data_array["telf"] . "\">
										<button type=\"button\"  class=\"btn btn-default\" align=\"left\" aria-label=\"Edit user\">
										<span class=\"glyphicon glyphicon-edit gi-5x\" aria-hidden=\"true\"></span>
										</button>
										</a>
										</td>
										";
										
										echo "<td>
										</td>
										</tr>"; 										
									}
									
									$i++;
								}
							}
						}
						else
						{
							if ($data)
							{
								$counter = 0;
								do
								{
									$resposta = $data_array["answered"]?"Sí":"No";
									$telf = $data_array["telf"];
					
									echo "<tr>
									<td>1</td>";
									echo "<td>" . $data_array["telf"] . "</td>";
									echo "<td>" . $data_array["name"] . "</td>";
									echo "<td>" . $data_array["business"] . "</td>";
									echo "<td>" . $data_array["NIF"] . "</td>";
									echo "<td><a target =\"_blank\" href=\"../form/form" . $data_array["form"] . ".php\">Formulari " . $data_array["form"] . "</a></td>";
									echo "<td>" . $resposta . "</td>";
									echo "<td>
									<a href=\"dades.php?edit=" . $data_array["telf"] . "\">
									<button type=\"button\"  class=\"btn btn-default\" align=\"left\" aria-label=\"Edit user\">
									<span class=\"glyphicon glyphicon-edit gi-5x\" aria-hidden=\"true\"></span>
									</button>
									</a>
									</td>
									</tr>
									";
									$counter++;
								}
								while($data_array = mysqli_fetch_array($copydata));
								
								echo "</tbody>
				</table>";
								
								if ($counter == 1)
								{
									echo "<h4>Respostes als formularis:</h4><br>";
									$query2 = mysqli_query($link, "SELECT * from `uanswers` WHERE `telf` = ".mysqli_real_escape_string($link,$telf)."");
									if(!$query2) die("horror");
									
									while($data2 = mysqli_fetch_array($query2))
									{
										$id_2 = $data2["id"];
										$form_2 = $data2["form"];
										$tstamp_2 = date("d/m/Y", $data2["timestamp"]);
										
										
										echo "<h5>Resposta al <b>Formulari $form_2</b> el dia </b>$tstamp_2</b>: <a target=\"_blank\" href=\"gen_pdf.php?id=$id_2\">visualitzar i/o descarregar resposta en format PDF.</a></h5>";
									}
								}
							}
						}		
			  
						?>
						
			<?php
			if ($options!="specific") echo "</tbody>
			</table>
			";
			
			?>
			</div>
		</div>
		<hr>
		<footer>
			<p>© 2016 Ergasia Seguretat, S.L.</p>
		</footer>
    </div> 
	<script>
	$(document).ready(function (){
		
	<?php
		for ($i = 1; $i <= $counter; $i++)
		{
			echo "
			
			$('#form$i').mousedown(function(event) {
					
					switch (event.which)
					{
						case 3:
							var wdow = window.open('../form/form$i.php', '_blank');
							if (wdow == undefined)
							{
								alert(\"Si us plau, activi els pop-ups pel Panell de control.\");
							}
							
							break;
					}
					
			});";
		}
	?>
	
	});
	</script>
    <script src="./js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  
</body>

</html>
