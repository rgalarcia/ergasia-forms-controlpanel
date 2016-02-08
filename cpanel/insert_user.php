<?php

if (!isset($_POST["telf"]) || !isset($_POST["name"]) || !isset($_POST["business"]) || !isset($_POST["NIF"])) die(header("Location: usuaris.php?result=0"));
else if ($_POST["telf"] == NULL || $_POST["name"] == NULL || $_POST["business"] == NULL || $_POST["NIF"] == NULL) die(header("Location: usuaris.php?result=0"));
else if (!is_numeric($_POST["telf"]) || (strlen($_POST["telf"]) < 9 || strlen($_POST["telf"]) > 11)) die(header("Location: usuaris.php?result=1"));
else if (strlen($_POST["NIF"]) != 9) die(header("Location: usuaris.php?result=1"));
else if (isset($_POST["form"]) && $_POST["form"] != NULL && !is_numeric($_POST["form"])) die(header("Location: usuaris.php?result=1"));

$telf = $_POST["telf"];
$name = $_POST["name"];
$nif = $_POST["NIF"];
$business = $_POST["business"];
$form = $_POST["form"];
if (isset($_POST["form"])) $form = $_POST["form"];

include "sql_data.php";

//Connect to the database
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if (!$link) die (header("Location: usuaris.php?result=2"));

$res1 = mysqli_query($link, "SELECT `telf` FROM `users` WHERE `telf` = \"" . mysqli_real_escape_string($link, $telf) . "\"");
$data = mysqli_fetch_row($res1);


if ($data[0] != NULL) die(header("Location: usuaris.php?result=3"));

if (isset($_POST["form"]) && $_POST["form"] != NULL)
{
	$query = mysqli_query($link, "INSERT INTO `users`(`telf`, `name`, `business`, `NIF`, `form`) 
	VALUES (\"" . mysqli_real_escape_string($link, $telf) . "\", \"" . mysqli_real_escape_string($link, $name) . "\",
	\"" . mysqli_real_escape_string($link, $business) . "\", \"" . mysqli_real_escape_string($link, $nif) . "\", \"" . mysqli_real_escape_string($link, $form) . "\")");
}
else
{
	$query = mysqli_query($link, "INSERT INTO `users`(`telf`, `name`, `business`, `NIF`) 
	VALUES (\"" . mysqli_real_escape_string($link, $telf) . "\", \"" . mysqli_real_escape_string($link, $name) . "\",
	\"" . mysqli_real_escape_string($link, $business) . "\", \"" . mysqli_real_escape_string($link, $nif) . "\")");
}

header("Location: usuaris.php?result=4");

mysqli_close($link);

?>