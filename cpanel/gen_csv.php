<?php
session_start();
if (!isset($_SESSION["loggedin"]) or $_SESSION["loggedin"]==NULL) {
	die(header('Location: login.php'));
}
?>
<?php
include "sql_data.php";

$link = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if (!$link) die ("Database connection error");

if (isset($_GET["mode"]) && $_GET["mode"] != NULL)
{

	$mode = $_GET["mode"];
	
	if ($mode == "userlist")
	{
		//TODO: Generate all-users CSV data file
		header('Content-Type: application/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=llistat_usuaris_formularis.csv');
		header('Pragma: no-cache');
		
		echo "sep=," . PHP_EOL;
		echo utf8_decode("número resposta, telèfon, nom, empresa, NIF, formulari, dia, hora, obra, comentari, URL") . PHP_EOL;
		
		$data = mysqli_query($link, "SELECT * FROM `users` ORDER BY `business`");
		if (!$data) die ("error1");
		while($data_array = mysqli_fetch_array($data))
		{
			$numans=0;
			$telf = $data_array["telf"];
			$name = utf8_decode($data_array["name"]);
			$business = utf8_decode($data_array["business"]);
			$nif = $data_array["NIF"];
			$form = $data_array["form"];
			$data2 = mysqli_query($link, "SELECT * FROM `uanswers` WHERE `telf` = \"" . mysqli_real_escape_string($link, $telf) . "\" ORDER BY `id`");
			if (!$data2) die ("error2");
			while($data2_array = mysqli_fetch_array($data2))
			{
				$timestamp = $data2_array["timestamp"];
				$date = date("d/m/Y", $timestamp);
				$time = date("H:i:s", $timestamp);
				$obra = str_replace(",", " ", utf8_decode($data2_array["obra"]));
				$comment = str_replace(",", " ", utf8_decode($data2_array["comment"]));
				$aid = $data2_array["id"];
				$url = "http://ergasia.nereid.es/cpanel/gen_pdf.php?id=" . $aid;
				$numans+=1;
				
				echo "$numans, $telf, $name, $business, $nif, $form, $date, $time, $obra, $comment, $url" . PHP_EOL;
			}
		}
	}
	else if ($mode == "userinfo")
	{
		if ( isset($_GET["telf"]) && $_GET["telf"] != NULL && is_numeric($_GET["telf"]) )
		{
			$telf = $_GET["telf"];
			
			//TODO: Generate CSV file with particular user info
			header('Content-Type: application/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=info_usuari_'.$telf.'.csv');
			header('Pragma: no-cache');
			
			echo "sep=," . PHP_EOL;
			echo utf8_decode("formulari, dia, hora, obra, comentari, URL") . PHP_EOL;
			
			$data = mysqli_query($link, "SELECT * FROM `uanswers` WHERE `telf` = \"" . mysqli_real_escape_string($link, $telf) . "\"");
			while($data_array = mysqli_fetch_array($data))
			{
				$form = $data_array["form"];
				$timestamp = $data_array["timestamp"];
				$date = date("d/m/Y", $timestamp);
				$time = date("H:i:s", $timestamp);
				$obra = str_replace(",", " ", utf8_decode($data_array["obra"]));
				$comment = str_replace(",", " ", utf8_decode($data_array["comment"]));
				$aid = $data_array["id"];
				$url = "http://ergasia.nereid.es/cpanel/gen_pdf.php?id=" . $aid;
			
				echo "$form, $date, $time, $obra, $comment, $url" . PHP_EOL;
				
			}			
			
		}
		else
		{
			die("Error with URL format.");
		}
		
	}

}
else
{
	die("Error with URL format.");
}
?>