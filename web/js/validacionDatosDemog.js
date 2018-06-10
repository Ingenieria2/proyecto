function validarDatosDem(){

	var heladera = document.formDatosDemog.heladera.value;
	heladera = heladera.trim();

    var electricidad = document.formDatosDemog.electricidad.value;
    electricidad = electricidad.trim();

	var mascotas = document.formDatosDemog.mascotas.value;
    mascotas = mascotas.trim();

	var vivienda = document.formDatosDemog.vivienda.value;
    vivienda = vivienda.trim();

	var calefaccion = document.formDatosDemog.calefaccion.value;
    calefaccion = calefaccion.trim();

	var agua = document.formDatosDemog.agua.value;
    agua = agua.trim();

	if (!(heladera  == 1) &&(!(heladera  == 0))) {
		alert("Complete el campo de heladera.");
		return false;
  }
  if (!(electricidad  == 1) &&(!(electricidad  == 0))) {
  	alert("Complete el campo de electricidad.");
  	return false;
  }
  if (!(mascotas  == 1) &&(!(mascotas  == 0))) {
  	alert("Complete el campo de mascotas.");
  	return false;
  }
  if (vivienda  == null) {
  	alert("Complete el campo de vivienda.");
  	return false;
  }
  if (calefaccion  == null) {
  	alert("Complete el campo de calefaccion.");
  	return false;
  }
  if (agua  == null) {
  	alert("Complete el campo de agua.");
  	return false;
  }

	return true;
}



function confirmaEliminarDatoDem(){
	var result = confirm('Esta seguro que desea eliminar el dato demografico?');
	if(result){
		return true;
	}else{
		return false;
	}
}


function modificarDatoDem(){
	var result = confirm('Esta seguro que desea modificar el dato demografico?');
	if(result){
		return true;
	}else{
		return false;
	}
}
