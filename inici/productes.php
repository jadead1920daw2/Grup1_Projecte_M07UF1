<?php

class GestionaProductes{
	private $fitxerProductes;
	private $usuariActiu;
	
    function __construct($arxiuP,$usuari) { // Constructor
		$this->fitxerProductes = $arxiuP;
		$this->usuariActiu = $usuari;
	}
    public function vLlegeixfitxerProductes(){ // Llegeix el fitxer productes
		echo "<a href=index.php>Pàgina principal</a><br>\n";
		echo "\n<br>Usuari actiu: $this->usuariActiu<br>\n";
		if($this->usuariActiu == " ")
			echo "Mentre no sortiu de la sessió de   i us valideu amb un usuari registrat, no podeu comprar.<br><br>\n";
        $arxiu  = fopen($this->fitxerProductes, "r") or die("can't open file");
        if(!($this->usuariActiu == " " || $this->usuariActiu == " ")){
?>	
		<form method="post" action="cataleg.php">
			<p>Seleccioneu productes a comprar:</p>
<?php		
		}else{
			if($this->usuariActiu == " "){
?>	
			<p>Seleccioneu el producte a modificar la foto:</p>
<?php				
			}
		}
		$PrimeraVegada = True; // Concatenem text amb imatges
		for ($i = 0; $fila = fgetcsv($arxiu ); ++$i) {
			$foto = "../imatges/$fila[2]";
			if($this->usuariActiu == " "){
				echo "\n<br>[ $fila[0] (Preu: $fila[1]) <br>\n";
				echo "<img src=\"".$foto."\" alt=\"".$foto."\"><br>]<br>\n";
			}else{
				$tipus = ($this->usuariActiu == " ")?"radio":"checkbox";
				$seleccionat = "";
				if($PrimeraVegada && $this->usuariActiu == " "){
					$PrimeraVegada = False;
					$seleccionat = " checked=\"checked\"";
				}
?>
    <form method='post' action='fitxers.php' enctype='multipart/form-data'>
	<input type='hidden' name='max_file_size' value='2500000'> 

				<br><input type="<?php echo $tipus?>" <?php echo $seleccionat?> name="seleccioBotiga[]" value="<?php echo "$fila[0]"?>" /><?php echo "[ $fila[0] (Preu: $fila[1])"?><br />
<?php		
				echo "<img src=\"".$foto."\" alt=\"".$foto."\"><br>]<br>\n"; // Concatenacions
			}
		}
		fclose($arxiu);
        if(!($this->usuariActiu == " " || $this->usuariActiu == " ")){
?>	
			<br><br><input class="button button5" type="submit" name="submit" value="Afegiu al carret" /><br>
		</form>	
<?php		
		}else{
			if($this->usuariActiu == " "){
?>	
	<br><br>
	<input type='file' name='arxiu'><br>
	</b><input type ='submit' value='Tramet arxiu al servidor'>
    </form>		
<?php				
			}
		}
	}
}
?>

