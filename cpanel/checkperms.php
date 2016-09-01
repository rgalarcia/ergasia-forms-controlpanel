<?php
error_reporting(-1);
$filearray = scandir("../cpanel");

$i = 2;
while ($i < count($filearray))
{
	echo "Permissions of file ". $filearray[$i] ." are ". decoct(fileperms($filearray[$i])) . "<br>";
	$i += 1;
}

echo getcwd();

//if(fopen(getcwd() . "\prova.php", "r+"))
if(iswritable(getcwd() . "\prova.php"))
{
	echo "Success";
}
else
{
	echo "Error";
}
?>