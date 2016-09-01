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

    <title>Afegir usuari - Ergasia Seguretat S.L.</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="./css/jumbotron.css" rel="stylesheet">
    <script src="./js/ie-emulation-modes-warning.js"></script>
	
 </head>

 <body>
 	<script src="./js/jquery-1.12.0.min.js"></script> 
	<!--- capçalera -->
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
					<li><a href="dades.php">Dades</a></li>
					<li class="active"><a href="usuaris.php">Afegir usuari</a></li>
					<li><a href="forms.php">Afegir formulari</a></li>
				</ul>
				<form class="navbar-form navbar-right" action="dades.php" method="get">
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
    <div class="container">
		<form class="form-horizontal" role="form" method="post" action="insert_user.php">
			<div class="form-group">
				<?php
				// User's alert/warning system
				if (isset($_GET["result"]) && $_GET["result"] != NULL)
				{	
					$result = $_GET["result"];
					
					if ($result==0)
					{						
						echo "<div class=\"alert alert-info\" role=\"alert\">Si us plau, ompli tots els camps de la petició per tal de continuar.</div>";
					}
					else if ($result==1) 
					{
						echo "<div class=\"alert alert-warning\" role=\"alert\">Les dades que ha introduït són invàlides.</div>";
					}
					else if ($result==2) 
					{
						echo "<div class=\"alert alert-danger\" role=\"alert\">Error de comunicació amb la base de dades. Comprovi la seva connexió o contacti amb l'administrador.</div>";
					}
					else if ($result==3) 
					{
						echo "<div class=\"alert alert-warning\" role=\"alert\">Ja existeix un usuari amb aquest número de telèfon.</div>";
					}
					else if ($result==4)
					{						
						echo "<div class=\"alert alert-success\" role=\"alert\">Registre de l'usuari en la base de dades exitós.</div>";
					}
				}
				?>
				<br>
				<label for="telf" class="col-sm-2 control-label">Telf.</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="telf" name="telf" placeholder="Número de telèfon" value="">
				</div>
			</div>
			<div class="form-group">		
				<label for="name" class="col-sm-2 control-label">Nom</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="Nom del client" value="">
				</div>
			</div>
			<div class="form-group">		
				<label for="business" class="col-sm-2 control-label">Empresa</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="business" name="business" placeholder="Nom de l'empresa" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="cif" class="col-sm-2 control-label">NIF</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="NIF" name="NIF" placeholder="NIF del client" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="form" class="col-sm-2 control-label">Form.</label>
				<div class="col-sm-10">
					<?php
						include "sql_data.php";
						$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
						$query = mysqli_query($link, "SELECT `form` FROM `forms` WHERE 1 ORDER BY `id` DESC LIMIT 350");
						
						$counter = 1;
						echo "<select multiple=\"\" class=\"form-control\" id=\"form\" name=\"form\">";
						while ($row = mysqli_fetch_array($query))
						{
							echo "<option id=\"form$row[0]\" value=\"$row[0]\">Formulari $row[0]</option>";
							$counter++;
						}
						echo "</select>";
					?>
					
				<h5>Per veure en detall un dels formularis, faci clic dret a sobre del mateix (permeti el pop-up). Per a seleccionar-lo, faci clic esquerra.</h5>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" name="submit" type="submit" value="Afegir" class="btn btn-primary">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
				<! Will be used to display an alert to the user>
				</div>
			</div>
		</form>
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
							var wdow = window.open('../form/form$i.php?master', '_blank');
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
