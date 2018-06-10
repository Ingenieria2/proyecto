function validarControl(){

	var fechaControl = document.formControlSalud.fechaControl.value;
    fechaControl = fechaControl.trim();

	var pesoPaciente = document.formControlSalud.pesoPaciente.value;
    pesoPaciente = pesoPaciente.trim();

  var vacunasPaciente = document.formControlSalud.vacunasPaciente.value;
    vacunasPaciente = vacunasPaciente.trim();

  var vacunasObservaciones = document.formControlSalud.vacunasObservaciones.value;
    vacunasObservaciones = vacunasObservaciones.trim();

  var maduracionPaciente = document.formControlSalud.maduracionPaciente.value;
    maduracionPaciente = maduracionPaciente.trim();

  var maduracionObservaciones = document.formControlSalud.maduracionObservaciones.value;
    maduracionObservaciones = maduracionObservaciones.trim();

  var examenfisicoPaciente = document.formControlSalud.examenfisicoPaciente.value;
    examenfisicoPaciente = examenfisicoPaciente.trim();

  var examenObservaciones = document.formControlSalud.examenObservaciones.value;
    examenObservaciones = examenObservaciones.trim();

	var pcPaciente = document.formControlSalud.pcPaciente.value;
    pcPaciente = pcPaciente.trim();

  var ppcPaciente = document.formControlSalud.ppcPaciente.value;
    ppcPaciente = ppcPaciente.trim();

  var tallaPaciente = document.formControlSalud.tallaPaciente.value;
    tallaPaciente = tallaPaciente.trim();


    if(fechaControl == ""){
      alert("Por favor, seleccione la fecha de control");
      return false;
    }

    if (pesoPaciente.length > 11) {
          alert("El campo de pesoPaciente tiene como maximo permitido 11 numeros.");
  		return false;
   	}

    if (!(vacunasPaciente  == 1) &&(!(vacunasPaciente  == 0))) {
      alert("Complete el campo de vacunas completas.");
      return false;
    }

    if (vacunasObservaciones == null || vacunasObservaciones.length < 2){
  		alert("Complete el campo de vacunas Observaciones, minimo requerido, 2 caracteres.");
          return false;
      }

  	if (vacunasObservaciones.length > 255) {
          alert("El campo de vacunas Observaciones tiene como máximo permitido 255 caracteres.");
  		return false;
      }

    if (!(maduracionPaciente  == 1) &&(!(maduracionPaciente  == 0))) {
      alert("Complete el campo de maduracion Paciente.");
      return false;
    }

    if (maduracionObservaciones == null || maduracionObservaciones.length < 2){
  		alert("Complete el campo de maduracion Observaciones, minimo requerido, 2 caracteres.");
          return false;
      }

  	if (maduracionObservaciones.length > 255) {
          alert("El campo de maduracion Observaciones tiene como máximo permitido 255 caracteres.");
  		return false;
      }

    if (!(examenfisicoPaciente  == 1) &&(!(examenfisicoPaciente  == 0))) {
      alert("Complete el campo de examen fisico Paciente.");
      return false;
    }

    if (examenObservaciones == null || examenObservaciones.length < 2){
  		alert("Complete el campo de examen Observaciones, minimo requerido, 2 caracteres.");
          return false;
      }

  	if (examenObservaciones.length > 255) {
          alert("El campo de examen Observaciones tiene como máximo permitido 255 caracteres.");
  		return false;
      }

  	if (isNaN(pcPaciente)){
        alert("El campo pc solo acepta números.");
        return false;
       }
    if (isNaN(ppcPaciente)){
        alert("El campo ppc solo acepta números.");
        return false;
      }
    if (isNaN(tallaPaciente)){
        alert("El campo talla solo acepta números.");
        return false;
       }


	return true;
}
