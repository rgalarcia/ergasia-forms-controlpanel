<?php
echo "Hola";

error_reporting(-1);
include "sql_data.php";

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
	die(header("Location: index.php")); //Silence is golden


if (isset($_POST["username"]) && $_POST["username"] != NULL && isset($_POST["password"]) && $_POST["password"] != NULL)
{
	
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);
	
	
	$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	if (!$link) die("Error while trying to connect to database.");
	
	$data = mysqli_query($link, "SELECT * FROM `admins` WHERE `username` = '" . mysqli_real_escape_string($link, $username) . "' AND `password` = '" . mysqli_real_escape_string($link, $password) . "'");
	
	if ($data->num_rows > 0)
	{
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $username;
		$_SESSION["token"] = rand(0, 99999);
		die(header("Location: index.php"));
	}
	else
	{
		die(header("Location: login.php?error=2"));
	}
}
else
{
	die(header("Location: login.php?error=1"));
}
?>