<html>

<head>
	<meta content="text/html; charset=UTF­8" http­equiv="content­type">
	<title>Fitxers pujats al servidor de la botiga</title>
</head>

<body style='background-color:lightblue'>

<?php
$arxiuDeProductes = "productes.txt";

echo "<a href=cataleg.php>Torneu al catàleg</a><br>\n"; // Torna al catàleg
echo "<a href=index.php>Pàgina principal</a><br><br>\n"; // Torna a la pàgina principal

foreach($_POST['seleccioBotiga'] as $w){ // Recorre els productes que hem seleccionat
	echo "Heu seleccionat: $w<br>\n";
}

$filedata = file($arxiuDeProductes);
$newdata = array();
$lookfor = $w;
$newtext = $_FILES['arxiu']['name'];

foreach ($filedata as $filerow) {
	if (strstr($filerow, $lookfor) !== false){
		$line = explode(",\n",$filerow);
		$line[2] = "$newtext\n";
		$filerow = implode(",",$line);
	}
	$newdata[] = $filerow;
}
?>	

</body>

</html>
