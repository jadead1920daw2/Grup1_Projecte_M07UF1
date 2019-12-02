<?php

require_once('productes.php');

if (isset($_POST['esborraCookies'])){
	$nombre_dies = 30 ;
	$data_expiracio = time() - 60 * 60 * 24 * $nombre_dies ;

	if (isset($_COOKIE['vectorCookie'])){
		unset($_COOKIE['vectorCookie']);
		setcookie("vectorCookie", '',$data_expiracio);
		echo "Esborrat el carret de compra.<br>\n";
	}else{
		echo "Res a esborrar.<br>\n";
	}	
}
echo "<br><br><a href=surt.php>Surt de la sessió</a><br>\n";
if(isset($_SESSION['acces'])){
	$ses = $_SESSION['acces'];
	if($ses === 0){ // Si no podem iniciar sessió
		echo "Ho lamentem, no teniu la sessió activa.<br><br>\n <a href=index.php>Torneu-ho a intentar</a>\n";
		print '<META HTTP-EQUIV="refresh" CONTENT="3;URL=./index.php">';
	}else{ // Si podem iniciar sessió
		$cataleg = new GestionaProductes("productes.txt",$ses);
		$cataleg->vLlegeixfitxerProductes(); // Llegeix els productes
			if(!isset($vectorCistella))
				$vectorCistella = array();

			$ExisteixenCookies = False;
			if (isset($_COOKIE['vectorCookie'])){			
				$vector = json_decode($_COOKIE['vectorCookie']);
				foreach ($vector as $key => $value){
					array_push($vectorCistella,$value);
				}
			}	
		if (isset($_POST['submit'])){ // Per fer push al vector Cistella
			foreach($_POST['seleccioBotiga'] as $w){
				array_push($vectorCistella,$w);
			}
		}
			if(!empty($vectorCistella))
				echo "Carret de compra:<br /> <ul>";
		
			foreach ($vectorCistella as $value){
				echo "<li>$value</li>\n";
				$ExisteixenCookies = True;
			}
			$json = json_encode($vectorCistella); 
			setcookie('vectorCookie', $json);
			echo "</ul>";
			if($ExisteixenCookies){
?>
<body style='background-color:lightblue'>
<link rel="stylesheet" type="text/css" href="style.css">
				<form method="post" action="cataleg.php">
					<br><input class="button button5" type="submit" name="genereuRebut" value="Genereu rebut" /><br>

<?php
					if (isset($_POST['genereuRebut'])){
						file_put_contents("rebut.txt", implode(', ', $vectorCistella));
						echo "<br><a href=rebut.txt>Baixeu-vos el llistat de productes</a> (obriu a una nova pestanya)<br>\n";
					}
?>

					<br><input class="button button5" type="submit" name="esborraCookies" value="Esborreu el contingut del carret" /><br>
				</form>

<?php
			}
	}
} else {
		echo "Ho lamentem, no heu iniciat la sessió.<br><br>\n <a href=index.php>Torneu-ho a intentar</a>\n";
		print '<META HTTP-EQUIV="refresh" CONTENT="3;URL=./index.php">';
}
?>
