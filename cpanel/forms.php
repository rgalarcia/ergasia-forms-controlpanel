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

	<title>Afegir formulari - Ergasia Seguretat S.L.</title>
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="./css/jumbotron.css" rel="stylesheet">
	<script src="./js/ie-emulation-modes-warning.js"></script>

</head>

<body>

	<script src="./js/jquery-1.12.0.min.js"></script>
	<script>
		$(document).ready( function(){
			var categories = [];
			var numpreguntes = [];
			var preguntes = [];
			var data_array = [];
	  
			//Appends a number of additional categories (or not!)
			//according to the input specified by the user
			
			$("#append_new_cats").on("click", function() {
				var numcats = $("#num_cats_to_append").val();
				$("#newcats").html("");
				
				//Loop from 1 to the number of categories specified by the user
				//If the input is not a number, the loop would not run, thus no
				//new categories will be appended
				for (i = 1; i <= numcats; i++)
				{
					if (i == 1) $("#newcats").append("<h5>Ha escollit crear categories addicionals. Indiqui el nom de cadascuna de les noves categories:</h5><br>");
					$("#newcats").append("<div class=\"form-group col-lg-1\"><input type=\"text\" class=\"form-control\" id=\"cat".concat(i+9, "\" value=\"\" placeholder=\"Nom de la categoria\"></div><br><br>"));
				} 
	
				$("#newcats").append("<br><button type=\"button\" id=\"add_all_cats\" class=\"btn btn-success\">Crear categories</button>");
			});

			//We use the document.body in the .on method to detect a click on the 
			//add_all_cats button because it is a dinamically appended button
			//When add_all_cats is clicked, we loop to through the check-box categories,
			//determining which of them have been selected, and we loop through the additional
			//categories as well dertermining which of them have been filled with some text
			
			//We save these categories in a categories array which will be used later
			//in company of the questions array, in which various questions will be tied to
			//a especific category
			
			$(document.body).on("click", "#add_all_cats", function() {
				//We save the categories in a category array
				var i = 1;
				while ( $("#cat".concat(i)).val() != undefined)
				{		
					if ( (i <= 9 && $("#cat".concat(i)).prop('checked')) || (i > 9 && $("#cat".concat(i)).val().trim() != "") )
					{
						categories.push($("#cat".concat(i)).val().trim());		  
					}
					i++;
				}
				
				//We loop through the categories array and append the created categories to the HTML of the
				//page acompanied by an input to specify the number of questions to add for each category
				$("#multipurpose").html("<h4><b>Pas 2 de 3</b> - Indiqui el número de preguntes de què constarà cada categoria:</h4><br><br>");  
				for (i = 0; i < categories.length; i++)
				{

					$("#multipurpose").append("<label for=\"text\" class=\"col-sm-9 left-label\">".concat(categories[i], "</label><div class=\"col-sm-20\"><input type=\"text\" class=\"form-control\" id=\"numpc", i ,"\" name=\"nump\" placeholder=\"Nombre de preguntes\" value=\"\"></div><br>"));
				}
				
				//If there are not any categories, we must tell the user it is mandatory to set at least one category
				if (categories.length == 0) $( "#multipurpose" ).append("<div class=\"alert alert-warning\" role=\"alert\"><strong>Atenció! </strong> El formulari ha de contenir com a mínim una categoria on afegir-hi preguntes. <a href=\"forms.php\">Tornar enrere.</a></div>");
				else $("#multipurpose").append("<br><button type=\"button\" id=\"append_questions\" class=\"btn btn-success\">Crear preguntes</button>");
			
				//Debugging verbose
				console.log(categories);			
			});
			
			//Append number of questions for each category to an array
			$(document.body).on("click", "#append_questions", function() {
				var i = 0;
				var npreg = 0;

				while ($("#numpc".concat(i)).val() != undefined)
				{
					if ($("#numpc".concat(i)).val().trim() != "" && $("#numpc".concat(i)).val() != 0)
					{
						numpreguntes.push($("#numpc".concat(i)).val());
						npreg++;
					}
					else
					{
						numpreguntes.push(0);
					}						

					i++;
				}
				
				var iter = 0;
				$("#multipurpose").html("<h4><b>Pas 3 de 3</b> - Insereixi les preguntes per a cada categoria del formulari:</h4><br>");
				for (i = 0; i < categories.length; i++)
				{
		  
					if (numpreguntes[i] != 0 && npreg != 0) $("#multipurpose").append("<h4><i>".concat(categories[i], "</i></h4><br>"));
					for (var j = 1; j <= numpreguntes[i]; j++)
					{
						$("#multipurpose").append("<label for=\"text\" class=\"col-sm-2 left-label\">Pregunta ".concat(j, "</label><div class=\"col-sm-20\"><input type=\"text\" class=\"form-control\" id=\"numpc", iter ,"\" name=\"nump\" placeholder=\"Introdueix la pregunta\" value=\"\"></div><br>"));
						iter++;
					}
		  
				}
				if (npreg == 0) $("#multipurpose").append("<div class=\"alert alert-warning\" role=\"alert\"><strong>Atenció! </strong> El formulari ha de contenir com a mínim una pregunta. <a href=\"forms.php\">Tornar enrere.</a></div>");
				else $("#multipurpose").append("<br><button type=\"button\" id=\"genformfinal\" class=\"btn btn-success\">Generar formulari</button>");
			
				//Debugging verbose
				console.log(npreg);
				console.log(numpreguntes);
			});

			//Append categories and questions for each category
			$( document.body ).on("click", "#genformfinal", function() {
				var i = 0;
				var npreg = 0;
				while ($("#numpc".concat(i)).val() != undefined)
				{
					if ($("#numpc".concat(i)).val().trim() != "")
					{
						preguntes.push($("#numpc".concat(i)).val());
						npreg++;
					}
					else
					{
						preguntes.push("");
					}
					i++;
				}
				
				console.log(preguntes);
				
				var iter = 0;
				for (i = 0; i < categories.length; i++)
				{
					data_array[i] = [];
					data_array[i].push(categories[i]);
					data_array[i].push(numpreguntes[i]);
					
					for (j = 0; j < numpreguntes[i]; j++)
					{
						data_array[i].push(preguntes[iter]);
						iter++;
					}
				}
				
				if (npreg == 0)
				{
					$("#multipurpose").html("<div class=\"alert alert-warning\" role=\"alert\"><strong>Atenció! </strong> El formulari ha de contenir com a mínim una pregunta. <a href=\"forms.php\">Tornar enrere.</a></div>");
				}
				else
				{
					$("#multipurpose").html("<div><img src=\"treballant.gif\"  style=\"margin: 5px 100px 5px 5px; float: left;\"><br><br><h4>Estem treballant per generar el formulari...</h4></div><br><br><br>");
					console.log(data_array);
					var data = JSON.stringify(data_array);
					
					$.ajax({
						type: "POST",
						cache: false,
						url: "gen_form.php",
						data: {"JSONdata": data},
						dataType: "JSON",
						success: function (response) {							
							if (response.status == "OK")
							{
								$("#multipurpose").delay(1750).html("<div class=\"alert alert-success\" role=\"alert\">El <strong>formulari ".concat(response.form,"</strong> ha estat generat exitosament. <a href=\"../form/form",response.form,".php?master\" target=\"_blank\">Veure el formulari.</a></div>"));
							}
							else
							{
								$("#multipurpose").delay(1750).html("<div class=\"alert alert-danger\" role=\"alert\"><strong>Error</strong> intentant generar el formulari. Si us plau, contacta un administrador. <a href=\"forms.php\">Tornar enrere.</a></div>");								
							}
						}
					});
				}
			});
		
		});
	</script>
	
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
					<li><a href="usuaris.php">Afegir usuari</a></li>
					<li class="active"><a href="forms.php">Afegir formulari</a></li>
				</ul>
				<form class="navbar-form navbar-right" action="dades.php" method="get">
					<div class="form-group">
						<input class="form-control" id="name" name="name" placeholder="Cerca un usuari" type="text">
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
		<form class="form-horizontal" role="form">
			<div class="navbar-form">
				<!-- PART NOVA !-->
				<div id="multipurpose">
					<h4><b>Pas 1 de 3</b> - Seleccioni les categories de què constarà el formulari:</h4><br>
					<h5>Pot escollir entre aquestes categories per defecte:</h5>
					<label class="checkbox-inline"><input type="checkbox" id="cat1" value="Uso de plataformas elevadoras">Uso de plataformas elevadoras</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat2" value="Uso de escaleras de mano">Uso de escaleras de mano</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat3" value="Incendios">Incendios</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat4" value="Estado de orden">Estado de orden</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat5" value="Caída de objetos">Caída de objetos</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat6" value="Manipulación de objetos">Manipulación de objetos</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat7" value="Uso de protecciones personales">Uso de protecciones personales</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat8" value="Uso de herramientas personales">Uso de herramientas personales</label><br>
					<label class="checkbox-inline"><input type="checkbox" id="cat9" value="Instalación eléctrica">Instalación eléctrica</label><br></br>
					
					<div id="newcats">
						<h5>També pot crear categories addicionals noves pel formulari:</h5><br>
						<input class="form-control" id="num_cats_to_append" placeholder="Nombre de categories" type="text">
						<button type="button" id="append_new_cats" class="btn btn-default">Endavant</button><br><br>
						<h5>Si no en vol crear cap, premi directament "Endavant".</h5>
					</div>
				</div>
				<!-- FI DE PART NOVA !-->
			</div>
			<br>
			<div id="insertdiv">
			</div>
		</form>
		<br>
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