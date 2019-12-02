<?php
class GestionaContrasenyes{
	private $arxiuPwd;
	private $usuariActiu;
	private $ContrasenyaUsuariActiu;
	private $AcceditCorrectament;
	
    function __construct() { // Constructor
		$numargs = func_num_args();
		if($numargs == 1){ // Si hi ha un sol argument
			$this->arxiuPwd = func_get_arg(0);
			$this->usuariActiu = "__capUsuariActiu__";
			$this->ContrasenyaUsuariActiu = "";
			$this->AcceditCorrectament = False;
		}
 		if($numargs == 2){ // Si hi ha dos arguments
 			$this->arxiuPwd = func_get_arg(0);
			$this->AcceditCorrectament = False;
			if($this->UsuariExisteix(func_get_arg(1)))
				$this->usuariActiu = func_get_arg(1);
			else
				$this->usuariActiu = "__capUsuariActiu__";
       }

    }
    public function UsuariExisteix($NomUsuari){ // Funció que defineix si un usuari existeix
		$this->AcceditCorrectament = False;
        $arxiu  = fopen($this->arxiuPwd, "r") or die("can't open file"); // Llegeix l'arxiu o mostra que no es pot obrir l'arxiu
		for ($i = 0; $fila = fgetcsv($arxiu ); ++$i) {
			if (!strcmp($NomUsuari,$fila[0])){
				$this->usuariActiu = $NomUsuari;
				$this->ContrasenyaUsuariActiu = $fila[1];
				$this->AcceditCorrectament = True;
				break;
			}
		}
		fclose($arxiu);
		return $this->AcceditCorrectament;
	}
	public function UsuariContrasenyaCorrecte($NomUsuari,$contrasenya){
		if($this->UsuariExisteix($NomUsuari)){
			return ($this->ContrasenyaUsuariActiu == $contrasenya); // Comprova que la contrasenya sigui la que correspon a l'usuari
		}else
			return False;
	}
	function __toString() {
        return $this->ContrasenyaUsuariActiu;
    }
}
?>
