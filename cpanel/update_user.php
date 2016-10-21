<?php
session_start();
if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"]==NULL) {
	die(header('Location: login.php'));
}
?>
<?php
include "sql_data.php";
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if (isset($_GET["delete"]) && $_GET["delete"] != NULL && is_numeric($_GET["delete"]))
{
	$del = $_GET["delete"];
	
	
	
	$res1 = mysqli_query($link, "DELETE FROM `users` WHERE `telf` = \"" . mysqli_real_escape_string($link, $del) . "\"");
	header("Location: dades.php?action=0");
}
else
{
	$change=false;
	if (!isset($_GET["modify"]) || $_GET["modify"] == NULL || !is_numeric($_GET["modify"]) || (strlen($_GET["modify"]) < 9 || strlen($_GET["modify"]) > 11))die("");
	$ortelf = $_GET["modify"];
	
	if (isset($_POST["name"]) && trim(strip_tags($_POST["name"])) != NULL && is_string($_POST["name"]))	
	{
		$name = strip_tags($_POST["name"]);
		mysqli_query($link, "UPDATE `users` SET `name` = '" . mysqli_real_escape_string($link, $name) . "' WHERE `telf` ='" . mysqli_real_escape_string($link, $ortelf) . "'");
		$change=true;
		
	}
	
	if (isset($_POST["business"]) && trim(strip_tags($_POST["business"])) != NULL && is_string($_POST["business"]))		
	{
		$business = strip_tags($_POST["business"]);
		mysqli_query($link, "UPDATE `users` SET `business` = '" . mysqli_real_escape_string($link, $business) . "' WHERE `telf` ='" . mysqli_real_escape_string($link, $ortelf) . "'");
		$change=true;
	}
	
	if (isset($_POST["NIF"]) && trim(strip_tags($_POST["NIF"])) != NULL && is_string($_POST["NIF"]) && (strlen($_POST["NIF"]) == 9))		
	{
		$NIF = strip_tags($_POST["NIF"]);
		mysqli_query($link, "UPDATE `users` SET `NIF` = '" . mysqli_real_escape_string($link, $NIF) . "' WHERE `telf` ='" . mysqli_real_escape_string($link, $ortelf) . "'");
		$change=true;
	}
	
	if (isset($_POST["form"]) && $_POST["form"] != NULL && is_numeric($_POST["form"]))	
	{
		$form = strip_tags($_POST["form"]);
		mysqli_query($link, "UPDATE `users` SET `form` = '" . mysqli_real_escape_string($link, $form) . "' WHERE `telf` ='" . mysqli_real_escape_string($link, $ortelf) . "'");
		$change=true;
		
	}
	
	if (isset($_POST["answered"]) && $_POST["answered"] != NULL && is_numeric($_POST["answered"]))
	{
		$answered = strip_tags($_POST["answered"]);
		mysqli_query($link, "UPDATE `users` SET `answered` = '" . mysqli_real_escape_string($link, $answered) . "' WHERE `telf` ='" . mysqli_real_escape_string($link, $ortelf) . "'");
		$change = true;
	}
	
	if (isset($_POST["telf"]) && $_POST["telf"] != NULL && is_numeric($_POST["telf"]) && !(strlen($_POST["telf"]) < 9 || strlen($_POST["telf"]) > 11))		
	{
		$telf = strip_tags($_POST["telf"]);
		$res1 = mysqli_query($link, "SELECT `telf` FROM `users` WHERE `telf` = \"" . mysqli_real_escape_string($link, $telf) . "\"");
		$data = mysqli_fetch_row($res1);
		if ($data[0] != NULL) die(header("Location: dades.php?action=3"));
		mysqli_query($link, "UPDATE `users` SET `telf` = '" . mysqli_real_escape_string($link, $telf) . "' WHERE `telf` ='" . mysqli_real_escape_string($link, $ortelf) . "'");
		$change=true;
	}
	
	if ($change) header("Location: dades.php?action=1");
	else header("Location: dades.php?action=2");
}
	

?>