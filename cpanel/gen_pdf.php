<?php
include "sql_data.php";
require "/pdf/fpdf.php";

$errorJSON = array();

if (!isset($_GET["id"]) || $_GET["id"] == NULL)
{
	$errorJSON["errcode"] = "01";
	$errorJSON["message"] = "No response to check.";
	die(json_encode($errorJSON));
}
else
{
	$id = $_GET["id"];
}

$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
$query = mysqli_query($link, "SELECT * FROM `uanswers` WHERE `id` = \"".mysqli_real_escape_string($link, $id)."\"");

if (!$link || !$query)
{
	$errorJSON["errcode"] = "02";
	$errorJSON["message"] = "Database error. Contact an administrator.";
	die(json_encode($errorJSON));
}

$result = mysqli_fetch_array($query);

if ($result == NULL)
{
	$errorJSON["errcode"] = "03";
	$errorJSON["message"] = "Provided answer does not exist.";
	die(json_encode($errorJSON));
}

$telf = $result["telf"];
$query = mysqli_query($link, "SELECT * FROM `users` WHERE `telf` = \"".mysqli_real_escape_string($link, $telf)."\"");

$result = mysqli_fetch_array($query);

if ($result == NULL)
{
	$errorJSON["errcode"] = "04";
	$errorJSON["message"] = "Answer exists but no user is associated with it. Contact and administrator.";
	die(json_encode($errorJSON));
}

//Form's information
$form = $result["form"];
$query2 = mysqli_query($link, "SELECT * FROM `forms` WHERE `form` = \"".mysqli_real_escape_string($link, $form)."\"");
$f_result = mysqli_fetch_array($query2);

//Answer's information
$query3 = mysqli_query($link, "SELECT * FROM `uanswers` WHERE `id` = \"".mysqli_real_escape_string($link, $id)."\"");
$a_result = mysqli_fetch_array($query3);

######################
### PDF GENERATION ###
######################

//Basic information about the user and the response
$name = $result["name"];
$business = $result["business"];
$nif = $result["NIF"];
$form = $result["form"];
$obra = $a_result["obra"];
$timestamp = $a_result["timestamp"];

class PDF extends FPDF
{
	function Header()
	{
		$this->Image('logo.png',10,8,33);
		$this->SetFont('Arial','B',15);
		$this->Cell(80);
		$this->Cell(80,10,'RESPOSTA AL FORMULARI',1,0,'C');
		$this->Ln(20);
	}

	function Footer()
	{
		$timestamp = time();
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,5,utf8_decode('Pàgina '.$this->PageNo().''),0,0,'C');
		$this->Ln();
		$this->Cell(0,5,utf8_decode('Document generat el '. date("d/m/Y", $timestamp) . ' a les '. date("H:i:s", $timestamp) .''),0,0,'C');

	}
}

$pdf = new PDF();
$pdf->SetTitle('Resposta al formulari - Ergasia Seguretat S.L.');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10,'Dades', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(5);
$pdf->Ln();
$pdf->Cell(0, 5, 'Empresa: ' . utf8_decode($business), 0, 1);
$pdf->Cell(0, 5, 'NIF: ' . $nif, 0, 1);
$pdf->Cell(0, 5, 'Operari: ' . utf8_decode($name), 0, 1);
$pdf->Cell(0, 5, 'Obra: ' . utf8_decode($obra), 0, 1);
$pdf->Cell(0, 5, 'Formulari: ' . $form, 0, 1);
$pdf->Cell(0, 5, 'Data enviament: ' . date("d/m/Y", $timestamp), 0, 1);
$pdf->Cell(0, 5, 'Hora enviament: ' . date("H:i:s", $timestamp), 0, 1);
$pdf->Ln();

//Representing categories, questions and answers
$cat_array = $f_result["categories"];
$que_array = $f_result["questions"];
$ans_array = $a_result["answers"];
$comment = $a_result["comment"];

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10,'Resposta', 1);
$pdf->Ln(5);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5,'LEYENDA:', 0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 5,'N/A: No aplicable.', 0, 1);
$pdf->Cell(0, 5,'B: Bien, condiciones correctas.', 0, 1);
$pdf->Cell(0, 5,utf8_decode('N/A: Mal, faltan condiciones de seguridad, se anota en la última página las medidas solicitadas y tomadas.'), 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5,'RIESGO:', 0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 5,'Bajo - Medio - Alto', 0, 1);
$pdf->Ln();


$cat_explode = explode ("|", $cat_array);
$que_cat_explode = explode ("#", $que_array);
$ans_cat_explode = explode("#", $ans_array);

for ($i = 0; $i < count($ans_cat_explode); $i++)
{
	$ans_explode[$i] =  explode("|", $ans_cat_explode[$i]);
	
}

for ($i = 0; $i < count($cat_explode); $i++)
{	
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(0, 5, $cat_explode[$i], 0, 1);
	$pdf->Ln();
	
	$que_explode = explode("|", $que_cat_explode[$i]);
	
	for ($j = 0; $j < count($que_explode); $j++)
	{
		$pdf->SetFont('Arial', 'I', 9);
		$pdf->SetX(25);
		$pdf->MultiCell(50, 5, ($j+1).".- ". $que_explode[$j] . ':    ' . $ans_explode[$j][0] . '     ' . $ans_explode[$j][1], 0, 1);
		$pdf->Ln();
	}
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, utf8_decode('Anomalías / medidas preventivas a implantar:'), 0, 1);
$pdf->Ln();
$pdf->SetFont('Arial', 'I', 9);
$pdf->SetX(25);
$pdf->MultiCell(50, 5, utf8_decode($comment), 0, 1);
$pdf->Ln();

mysqli_close($link);
$pdf->Output('I', date("Ymd",$timestamp).'_'.preg_replace('/\s+/', '', $name).'_resp.pdf');
?>