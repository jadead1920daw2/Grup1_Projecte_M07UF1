<?php 

?>

<html>

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>Geijutsu Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style='background-color:lightblue'>
	<?php
	$_SESSION['acces']=0;
	session_destroy(); // Destruïm la sessió actual
	echo "Heu sortit del sistema<br><br>\n";
	echo "<a href=index.php>Torneu a l'inici</a>\n";
	print '<META HTTP-EQUIV="refresh" CONTENT="1;URL=./index.php">';
	?>
</body>

</html>	
