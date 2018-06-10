function modificarDatosPaciente(){
  var result = confirm('¿Esta seguro que desea modificar los datos del paciente?');
  if(result){
    return true;
  }else{
    return false;
  }
}
