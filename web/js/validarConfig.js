function validarConfig(){
		
	var titulo = document.formulario.titulo.value;
	titulo = titulo.trim();

    var descripcion = document.formulario.descripcion.value;
    descripcion = descripcion.trim();
	
	var mail = document.formulario.contacto.value;
    mail = mail.trim();

	var listado = document.formulario.listado.value;
    listado = listado.trim();

	var mensaje = document.formulario.mensaje.value;
    mensaje = mensaje.trim();
    
	
	if (titulo  == null || titulo.length < 5) { 
		alert("Complete el campo de Titulo, minimo requerido, 5 caracteres.");        
		return false;
    }
	
	if (titulo.length > 30) {
        alert("El campo de Titulo tiene como maximo permitido 30 caracteres.");        
		return false;
    }
	
	if (!isNaN(titulo)) { 
		alert("El campo de Titulo no permite numeros.");        
		return false;
    }
	
	if (descripcion == null || descripcion.length < 6){
		alert("Complete el campo de Descripcion, minimo requerido, 6 caracteres.");
        return false;
    }
	
	if (descripcion.length > 255) {
        alert("El campo de Descripcion tiene como maximo permitido 255 caracteres.");        
		return false;
    }
	
	if (!isNaN(descripcion)) { 
		alert("El campo de Descripcion no permite numeros.");        
		return false;
    }
	
	if (mail == null || mail.length < 5){
        alert("Complete el campo Mail.");
        return false;
     }


    if (isNaN(listado)){
        alert("El campo telefono solo acepta numeros, puede ingresar su codigo de area seguido del numero.");
        return false;
     }

    if (listado == null || listado < 1){
        alert("Valor minimo permitido del Listado: 1.");
        return false;
     }
	 
	if (listado > 100) {
        alert("Valor maximo permitido del Listado: 100.");      
		return false;
 	}	
	
	if (mensaje == null || mensaje.length < 6){
		alert("Complete el campo de Mensaje, minimo requerido, 6 caracteres.");
        return false;
    }
	
	if (mensaje.length > 255) {
        alert("El campo de Mensaje tiene como maximo permitido 255 caracteres.");        
		return false;
    }
	
	if (!isNaN(mensaje)) { 
		alert("El campo de Mensaje no permite numeros.");        
		return false;
    }
	 
	return true;
}