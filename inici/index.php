<?php

$Inicia = True; // Comprova si la sessió s'ha iniciat
if(isset($_SESSION['acces'])){
	$ses = $_SESSION['acces'];
	$Inicia = False;
	if($ses === 0){
		$Inicia = True;
	}
}
?>

<html>

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>Geijutsu</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style='background-color:lightblue'>

<?php
if($Inicia){
?>	
<div class="form-style-8">
<form method=post action=acces.php class='header'>
		Correu d'usuari : <input type=email name=nom class='input'><br>  
		Contrasenya :  <input type=password name=clau class='input'><br><br>
		<input type=submit value='Tramet' class='btn'>
	</form>
</div>
<?php
} else {
	echo "Usuari actual a Geijutsu Shop: $ses";
	echo "<br><br><a href=cataleg.php>Mostrar Catàleg</a>\n"; // Link al catàleg
	echo "<a href=surt.php>Sortir de la sessió</a><br>\n"; // Link per sortir
}
?>	

</body>

</html>	
