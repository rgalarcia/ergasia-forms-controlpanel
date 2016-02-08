<?php
include "sql_data.php";

//Get the telephone number from the user
if (isset($_GET["telf"])) $telf = $_GET["telf"];
else die ("Input error");

//Check that the user is in the database, and that it has not answered the form yet
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if (!$link) die ("Database connection error");

$result1 = mysqli_query($link, "SELECT `answered` FROM `users` WHERE `telf` = '" . mysqli_real_escape_string($link, $telf) . "';");
$result1_array = mysqli_fetch_row($result1);

if ($result1_array == NULL ) die("Aquest número de telèfon no té cap formulari associat.");
else if ($result1_array[0] == 1) die("Ja has respost aquesta enquesta. Gràcies per participar.");


//The user exists and it has not answered the form yet, send the user to the form
$result2 = mysqli_query($link, "SELECT `form` FROM `users` WHERE `telf` = '" . mysqli_real_escape_string($link, $telf) . "';");
$result2_array = mysqli_fetch_row($result2);
mysqli_close($link);
header("Location: ../form/form" . $result2_array[0] . ".html");
?>