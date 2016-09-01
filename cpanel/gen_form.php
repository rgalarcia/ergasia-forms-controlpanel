<?php
error_reporting(-1);
include "sql_data.php";

//Checking the user's input and treating it as a JSOON encoded array.
if (!isset($_POST["JSONdata"]) || $_POST["JSONdata"] == NULL)
{
	$status["status"] = "ERR";
	$status["input"] = "ERR";
	$status["dbinsertion"] = "NP";
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

//Inserting the form's data into the database
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
$query = mysqli_query($link, "INSERT INTO `forms`(`categories`, `questions`) VALUES (\"".mysqli_real_escape_string($link, utf8_decode($categories))."\", \"".mysqli_real_escape_string($link, utf8_decode($questions))."\")");

if ($query)
{
		$idform = mysqli_insert_id($link);
		$status["status"] = "OK";
		$status["input"] = "OK";
		$status["dbinsertion"] = "OK";
		$status["form"] = $idform;		
}
else
{
		$status["status"] = "ERR";
		$status["input"] = "OK";
		$status["dbinsertion"] = "ERR";
		$status["form"] = "NA";	
}

die(json_encode($status));
?>