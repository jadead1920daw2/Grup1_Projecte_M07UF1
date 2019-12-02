<?php
	$nombre_dies = 30 ;
	$data_expiracio = time() - 60 * 60 * 24 * $nombre_dies ; // Temps de caducitat de les cookies

	if (isset($_COOKIE['vectorCookie'])){
		unset($_COOKIE['vectorCookie']);
		setcookie("vectorCookie", '',$data_expiracio);
		echo "Esborrada la galeta vectorial.<br>\n";
	}else{
		echo "Res a esborrar.<br>\n";
	}
?>
