	function deshabilitarUsuario(){
		var result = confirm('Esta seguro que desea deshabilitar el usuario?');
		if(result){
			return true;
		}else{
			return false;       
		}
	}
	
	
	function habilitarUsuario(){
		var result = confirm('Esta seguro que desea habilitar el usuario?');
		if(result){
			return true;
		}else{
			return false;       
		}
	}