function eliminarUsuario() {

  var seguro = prompt("¿Esta seguro que quiere eliminar su perfil?", "");
//Detectamos si el usuario ingreso un valor
if (seguro == 'Si')
  {
    alert("Tu perfil ha sido eliminado");
 }
//Detectamos si el usuario NO ingreso un valor
  else
   {
    alert("No has ingresado una opción");
   }
}