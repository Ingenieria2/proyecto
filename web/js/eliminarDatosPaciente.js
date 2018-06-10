function eliminarDatosPaciente(){
  var result = confirm('¿Esta seguro que desea eliminar los datos del paciente?');
  if(result){
    return true;
  }else{
    return false;
  }
}
