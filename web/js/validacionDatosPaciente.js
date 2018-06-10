function validacionDatosPaciente(){

  var apellido = document.formDatosPaciente.apellido.value;
  apellido = apellido.trim();

	var nombre = document.formDatosPaciente.nombre.value;
	nombre = nombre.trim();


	var fecha_Nac = document.formDatosPaciente.fecha_Nac.value;
    fecha_Nac = fecha_Nac.trim();

	var genero = document.formDatosPaciente.genero.value;
    genero = genero.trim();

  var	id_tipo_documento = document.formDatosPaciente.id_tipo_documento.value;
    id_tipo_documento = id_tipo_documento.trim();

	var documento = document.formDatosPaciente.documento.value;
    documento = documento.trim();

  var domicilio = document.formDatosPaciente.domicilio.value;
    domicilio = domicilio.trim();

	var telefono = document.formDatosPaciente.telefono.value;
    telefono = telefono.trim();

	var obra_social = document.formDatosPaciente.obra_social.value;
    obra_social = obra_social.trim();



    if (apellido == null || apellido.length < 2){
  		alert("Complete el campo de Apellido, minimo requerido, 2 caracteres.");
          return false;
      }

  	if (apellido.length > 30) {
          alert("El campo de Apellido tiene como máximo permitido 30 caracteres.");
  		return false;
      }

  	if (!isNaN(apellido)) {
  		alert("El campo de Apellido no permite números.");
  		return false;
      }


	if (nombre  == null || nombre.length < 2) {
		alert("Complete el campo de Nombre, minimo requerido, 2 caracteres.");
		return false;
    }

	if (nombre.length > 30) {
    alert("El campo de Nombre tiene como maximo permitido 30 caracteres.");
		return false;
    }

	if (!isNaN(nombre)) {
		alert("El campo de Nombre no permite números.");
		return false;
    }

  if(fecha_Nac == ""){
    alert("Por favor, seleccione la fecha de nacimiento");
    return false;
  }


  if(genero == null){
    alert("Debe ingresar el género");
    return false;
  }

  if(id_tipo_documento ==  null){
    alert("Debe seleccionar el tipo de documento");
    return false;
  }


	if (isNaN(documento)){
        alert("El campo documento solo acepta números.");
        return false;
     }

    if (documento == null || documento.length < 7){
        alert("Complete el campo Documento, minimo requerido, 7 numeros.");
        return false;
     }

	if (documento.length > 9) {
        alert("El campo de Documento tiene como maximo permitido 9 numeros.");
		return false;
 	}

	if (domicilio == null) {
    alert("Complete el campo de domicilio.");
		return false;
    }


    if (isNaN(telefono)){
          alert("El campo telefono solo acepta números.");
          return false;
       }

      if (telefono == null || telefono.length < 7){
          alert("Complete el campo telefono, minimo requerido, 7 numeros.");
          return false;
       }

  	if (telefono.length > 12) {
          alert("El campo de telefono tiene como maximo permitido 12 numeros.");
  		return false;
   	}

    if( obra_social==  null){
      alert("Debe seleccionar su obra social");
      return false;
    }

	return true;
}
