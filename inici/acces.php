<?php

require_once('gestionaContrasenyes.php');
?>
<html>

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>Geijutsu Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style='background-color:lightblue'>
	<?php
	function esborraCookies(){ // Funció per esborrar cookies
		$nombre_dies = 30 ;
		$data_expiracio = time() - 60 * 60 * 24 * $nombre_dies; // Temps que triguen les cookies en caducar

		if (isset($_COOKIE['vectorCookie'])){
			unset($_COOKIE['vectorCookie']);
			setcookie("vectorCookie", '',$data_expiracio);
		}	
	}
	
	$FitxerContrasenyes = "contrasenyes.txt"; // Declara la variable FitxerContrasenyes com el fitxer contrasenyes.txt
	$nom = $_REQUEST["nom"]; // Nom
	$clau = $_REQUEST["clau"]; // Contrasenya
	$acces = new GestionaContrasenyes($FitxerContrasenyes,$nom);
	if($acces->UsuariExisteix($nom)){ // Comprova si l'usuari existeix, i coincideix amb la seva contrasenya
		if($acces == $clau){
			$_SESSION['acces']=$nom;
			esborraCookies();
			require_once('cataleg.php');
		}else{
			echo "Ho lamentem no hi heu accedit correctament.<br><br>\n <a href=index.php>Torneu-ho a intentar</a>\n";
			print '<META HTTP-EQUIV="refresh" CONTENT="1;URL=./index.php">'; // Refresca la pàgina
		}
	}else{
		echo "\n<br>Usuari $nom, si existeix, ha accedit amb la contrasenya incorrecta   <br>\n";
		print '<META HTTP-EQUIV="refresh" CONTENT="1;URL=./index.php">';
	}
	?>
</body>

</html>	
