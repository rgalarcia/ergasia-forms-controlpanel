<?php
session_start();
if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"]==NULL) {
	die(header('Location: login.php'));
}
?>
<?php
include "sql_data.php";
$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
for ($a = 0; $a <= 100; $a++)
{
if ($a == 47)
{
		$res1 = mysqli_query($link, "INSERT INTO `users`(`telf`, `name`, `business`, `NIF`, `form`) VALUES(400400555, 'lamborghinis', 'tinc problemes, inc', 'A1111111A', 2)");
}
else
{
	$res1 = mysqli_query($link, "INSERT INTO `users`(`telf`, `name`, `business`, `NIF`, `form`) VALUES(100200300, 'prova', 'tinc problemes, inc', 'A1111111A', 2)");
}
}
mysqli_close($link);






?>