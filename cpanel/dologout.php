<?php
session_start();
if (isset($_GET["token"]) && $_GET["token"] != NULL)
{
	if ($_GET["token"] == $_SESSION["token"])
	{
		session_destroy();
		header("Location: login.php");
	}
}
?>