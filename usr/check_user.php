<?php
include "sql_data.php";

########################
##   CHECK_USER.PHP   ##
########################
## -1: Invalid input  ##     
## -2: Database error ##
## 0: User dsnt exist ##
## 1: Everything's OK ##
########################

$outputJSON = [];

//We need a telephone number to proceed...
if (isset($_GET["telf"]) && trim($_GET["telf"]) != NULL && is_numeric(trim($_GET["telf"])))
{
	$telf = trim($_GET["telf"]);
}
else
{
	$outputJSON["result"] = -1;
	die(json_encode($outputJSON));
}

//Check whether the user exists in the DB
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if (!$link)
{
	$outputJSON["result"] = -2;
	die(json_encode($outputJSON));
}

$query = mysqli_query($link, "SELECT `answered` FROM `users` WHERE `telf` = '" . mysqli_real_escape_string($link, $telf) . "';");
if (!$query)
{
	$outputJSON["result"] = -2;
	die(json_encode($outputJSON));
}

$result = mysqli_fetch_array($query);

//Check whether the user exists or not
//and return the result to the user 
if ($result == NULL)
{
	$outputJSON["result"] = 0;
}
else
{
	$outputJSON["result"] = 1;
}

die(json_encode($outputJSON));
?>