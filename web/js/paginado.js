function paginaAnterior(){
  	if(document.formularioBusqueda.pagina.value > 1){
		document.formularioBusqueda.pagina.value--;
	}
  	document.getElementById("formularioBusqueda").submit();
}

function paginaSiguiente(){
  document.formularioBusqueda.pagina.value++;
  document.getElementById("formularioBusqueda").submit();
}