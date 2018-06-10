function eliminarUsuario(){
		var result = confirm('Esta seguro que desea eliminar el usuario?');
		if(result){
			return true;
		}else{
			return false;       
		}
	}
	
	
	function modificarUsuario(){
		var result = confirm('Esta seguro que desea modificar el usuario?');
		if(result){
			return true;
		}else{
			return false;       
		}
	}