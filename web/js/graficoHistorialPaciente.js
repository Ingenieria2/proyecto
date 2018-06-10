window.onload = function carga() {
  setTimeout(function(){
    document.getElementById("printButton").disabled=false;
    document.getElementById("exportButton").disabled=false;
  }, 7000);
  /*document.getElementById("curvaCrecimiento").style.display="none";
  document.getElementById("curvaTalla").style.display="none";
  document.getElementById("curvaPPC").style.display="none";*/
  curvaCrecimiento();
  curvaTalla();
  curvaPPC();
}

/*Creacion de PDF*/
function exportarPDF(){
  var index = 0;
  var divHeight, divWidth, ratio = 0;
  var newFilePDF = new jsPDF();
  var widthPDF = newFilePDF.internal.pageSize.width - 30;    
  var heightPDF = newFilePDF.internal.pageSize.height;
  curvaCrecimiento();
  curvaTalla();
  curvaPPC();
  
  // Datos de paciente
  cabecera(newFilePDF);
  historiaPacientePDF(newFilePDF);
  //Imagenes
  index = 40;
  newFilePDF.addPage();
  cabecera(newFilePDF);
  var canvas = document.querySelector("#curvaCrecimiento .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  var dataURLCrecimiento = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURLCrecimiento, 'JPEG', 20, index, widthPDF, heightPDF);
  newFilePDF.addPage();
  cabecera(newFilePDF);
  canvas = document.querySelector("#curvaTalla .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  var dataURLTalla = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURLTalla, 'JPEG', 20, index, widthPDF, heightPDF);
  newFilePDF.addPage();
  cabecera(newFilePDF);
  canvas = document.querySelector("#curvaPPC .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  var dataURLPPC = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURLPPC, 'JPEG', 20, index, widthPDF, heightPDF);
  var today = new Date();
  newFilePDF.save("ReportePaciente "+today.toISOString().substring(0, 10)+".pdf");

  /*document.getElementById("curvaCrecimiento").style.display="none";
  document.getElementById("curvaTalla").style.display="none";
  document.getElementById("curvaPPC").style.display="none";*/
}

function cabecera(filePDF){
  // Cabecera
  filePDF.setDrawColor(0);
  filePDF.setFillColor(236, 70, 25);
  filePDF.rect(0, 0, 210, 40, 'F');
  filePDF.setFont('helvetica')
  filePDF.setFontType('bold')
  filePDF.setFontSize(30);
  filePDF.text(5, 35, document.getElementsByTagName("title")[0].textContent);

  var img = new Image();
  img.onload = function(){
    var dataURI = getBase64Image(img);
    return dataURI;
  }
  //img.src = document.getElementsByClassName("imagenLogo")[0].src;
  //filePDF.addImage(img.onload(), 'PNG', 5, 5, 20, 20);
  // Pie de pagina
  filePDF.setDrawColor(0);
  filePDF.setFillColor(236, 70, 25);
  filePDF.rect(0, 277, 210, 20, 'F');
  filePDF.setFont('helvetica')
  filePDF.setFontType('normal')
  filePDF.setFontSize(15);
  filePDF.text(5, 277, document.getElementsByTagName("footer")[0].textContent);
}

function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.fillStyle = "#EC4619";
  ctx.fillRect(0, 0, img.width, img.height);
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL("image/jpeg");
  return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}

function historiaPacientePDF(filePDF){
  var col1 = 20;
  var col2 = 20;
  var renglon = 70;
  //Titulo
  filePDF.setFont('helvetica');
  filePDF.setFontType('bold');
  filePDF.setFontSize(25);
  filePDF.text(65, 55, 'Historia de Paciente');
  // Cuadro de datos
  filePDF.setFont('helvetica');
  filePDF.setFontType('normal');
  filePDF.setFontSize(12);
  filePDF.text(col1, renglon, 'Nombre y Apellido: ');
  renglon = renglon + 18;
  filePDF.text(col1, renglon, 'Fecha de nacimiento: ');
  renglon = renglon + 18;
  filePDF.text(col1, renglon, 'Documento: ');
  renglon = renglon + 18;
  filePDF.text(col1, renglon, 'Domicilio: ');
  renglon = renglon + 18;
  filePDF.text(col1, renglon, 'Telefono: ');
  renglon = renglon + 18;
  filePDF.text(col1, renglon, 'Genero: ');

  filePDF.setFont('courier');
  filePDF.setFontType('normal');
  filePDF.setFontSize(18);
  renglon = 78;
  filePDF.text(col2, renglon, document.getElementById("patientHistoriData").rows[4].cells[0].innerHTML);
  renglon = renglon + 18;
  filePDF.text(col2, renglon, document.getElementById("patientHistoriData").rows[5].cells[0].innerHTML);
  renglon = renglon + 18;
  filePDF.text(col2, renglon, document.getElementById("patientHistoriData").rows[6].cells[0].innerHTML);
  renglon = renglon + 18;
  filePDF.text(col2, renglon, document.getElementById("patientHistoriData").rows[7].cells[0].innerHTML);
  renglon = renglon + 18;
  filePDF.text(col2, renglon, document.getElementById("patientHistoriData").rows[6].cells[1].innerHTML);
  renglon = renglon + 18;
  filePDF.text(col2, renglon, document.getElementById("patientHistoriData").rows[5].cells[1].innerHTML);
  
}

/*Botones*/
/*function clickCurvaCrecimiento() {
  document.getElementById("curvaCrecimiento").style.display="block";
  curvaCrecimiento();
  document.getElementById("curvaTalla").style.display="none";
  document.getElementById("curvaPPC").style.display="none";
  window.scrollTo(0,document.body.scrollHeight);
}

function clickCurvaTalla() {
  document.getElementById("curvaCrecimiento").style.display="none";
  document.getElementById("curvaTalla").style.display="block";
  curvaTalla();
  document.getElementById("curvaPPC").style.display="none";
  window.scrollTo(0,document.body.scrollHeight);
}

function clickCurvaPPC() {
  document.getElementById("curvaCrecimiento").style.display="none";
  document.getElementById("curvaTalla").style.display="none";
  document.getElementById("curvaPPC").style.display="block";
  curvaPPC();
  window.scrollTo(0,document.body.scrollHeight);
}*/

function clickImprimirCurvas() {
  var elemento = document.querySelectorAll('.modal,.fade');
  for(var i = 0; i < elemento.length; i++){
    elemento[i].setAttribute('class', "row");
    elemento[i].style.width="500px";
    elemento[i].style.pageBreakBefore = "always";
    elemento[i].style.display="block";
  }
  curvaCrecimiento();
  curvaTalla();
  curvaPPC();
  window.print();
  for(var i = 0; i < elemento.length; i++){
    elemento[i].setAttribute('class', "modal fade");
    elemento[i].style.width="";
    elemento[i].style.pageBreakBefore = "";
    elemento[i].style.display="";
  }
  /*document.getElementById("curvaCrecimiento").style.display="none";
  document.getElementById("curvaTalla").style.display="none";
  document.getElementById("curvaPPC").style.display="none";*/
}

/*Tablas*/
function curvaCrecimiento() {
  var datosPasar = new Object({
    animationEnabled: true,
    zoomEnabled: true,
    exportEnabled: true,
    title:{
        text: "Gráfico de la evolución del Peso del paciente"
      },
    axisX:{
        title: "Semana",
        //valueFormatString: "##"
        interval: 1
      },
    axisY:{
        title: "Peso [Kg]",
        titleFontColor: "#6D78AD",
        lineColor: "#6D78AD",
        includeZero: true
      },
    legend:{
        verticalAlign: "top",
        fontSize: 16,
        dockInsidePlotArea: true,
        itemclick: function (e) {
          //console.log("legend click: " + e.dataPointIndex);
          //console.log(e);
          if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
          } else {
              e.dataSeries.visible = true;
          }
          e.chart.render();
        }
      },
    data: [
      {
        type: "spline",
        showInLegend: true,
        name: "Datos del Paciente",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "Media",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P10",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P50",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P90",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var gen;
  if( document.getElementById("genero") ){
    gen = document.getElementById("genero").value;
  }else {
    gen = "M";
  }

  var posting = $.post( auxURL[0]+"/statistics/datosCurva/peso"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      dataLength = resultArray.data_points.length;
      for (var i = 0; i < dataLength; i++) {
        datosPasar.data[0].dataPoints.push({
          x: parseInt(resultArray.data_points[i].valorx),
          y: parseFloat(resultArray.data_points[i].valory)
        });
      };
      for (var i = 0; i <= resultArray.data_points[dataLength-1].valorx; i++) {
        //Media
        datosPasar.data[1].dataPoints.push({
          x: parseInt(resultArray.m[i].valorx),
          y: parseFloat(resultArray.m[i].valory)
        });
        //P10
        datosPasar.data[2].dataPoints.push({
          x: parseInt(resultArray.p10[i].valorx),
          y: parseFloat(resultArray.p10[i].valory)
        });
        //P50
        datosPasar.data[3].dataPoints.push({
          x: parseInt(resultArray.p50[i].valorx),
          y: parseFloat(resultArray.p50[i].valory)
        });
        //P90
        datosPasar.data[4].dataPoints.push({
          x: parseInt(resultArray.p90[i].valorx),
          y: parseFloat(resultArray.p90[i].valory)
        });
      };
      var chart = new CanvasJS.Chart("curvaCrecimiento", datosPasar);
      chart.render();
    });  
}

function curvaTalla() {
  var datosPasar = new Object({
    animationEnabled: true,
    zoomEnabled: true,
    exportEnabled: true,
    title:{
        text: "Gráfico de la evolución de Talla del paciente"
      },
    axisX:{
        title: "Mes",
        //valueFormatString: "DD MMM,YY"
        interval: 1
      },
    axisY:{
        title: "Longitud [cm]",
        titleFontColor: "#6D78AD",
        lineColor: "#6D78AD",
        includeZero: true
      },
    legend:{
        verticalAlign: "top",
        fontSize: 16,
        dockInsidePlotArea: true,
        itemclick: function (e) {
          //console.log("legend click: " + e.dataPointIndex);
          //console.log(e);
          if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
          } else {
              e.dataSeries.visible = true;
          }
          e.chart.render();
        }
      },
    data: [
      {
        type: "spline",
        showInLegend: true,
        name: "Datos del Paciente",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "Media",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P10",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P50",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P90",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var genero;
  if( document.getElementById("genero") ){
    genero = document.getElementById("genero").value;
  }else {
    genero = "M";
  }
  var posting = $.post( auxURL[0]+"/statistics/datosCurva/talla"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      dataLength = resultArray.data_points.length;
      for (var i = 0; i < dataLength; i++) {
        datosPasar.data[0].dataPoints.push({
          x: parseInt(resultArray.data_points[i].valorx),
          y: parseFloat(resultArray.data_points[i].valory)
        });
      };
      for (var i = 0; i <= resultArray.data_points[dataLength-1].valorx; i++) {
        //Media
        datosPasar.data[1].dataPoints.push({
          x: parseInt(resultArray.m[i].valorx),
          y: parseFloat(resultArray.m[i].valory)
        });
        //P10
        datosPasar.data[2].dataPoints.push({
          x: parseInt(resultArray.p10[i].valorx),
          y: parseFloat(resultArray.p10[i].valory)
        });
        //P50
        datosPasar.data[3].dataPoints.push({
          x: parseInt(resultArray.p50[i].valorx),
          y: parseFloat(resultArray.p50[i].valory)
        });
        //P90
        datosPasar.data[4].dataPoints.push({
          x: parseInt(resultArray.p90[i].valorx),
          y: parseFloat(resultArray.p90[i].valory)
        });
      };
      var chart = new CanvasJS.Chart("curvaTalla", datosPasar);
      chart.render();
    });  
}

function curvaPPC() {
  var datosPasar = new Object({
    animationEnabled: true,
    zoomEnabled: true,
    exportEnabled: true,
    title:{
        text: "Gráfico de la evolución del PPC del paciente"
      },
    axisX:{
        title: "Semana",
        //valueFormatString: "DD MMM,YY"
        interval: 1
      },
    axisY:{
        title: "Perímetro cefálico [cm]",
        titleFontColor: "#6D78AD",
        lineColor: "#6D78AD",
        includeZero: true
      },
    legend:{
        verticalAlign: "top",
        fontSize: 16,
        dockInsidePlotArea: true,
        itemclick: function (e) {
          //console.log("legend click: " + e.dataPointIndex);
          //console.log(e);
          if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
          } else {
              e.dataSeries.visible = true;
          }
          e.chart.render();
        }
      },
    data: [
      {
        type: "spline",
        showInLegend: true,
        name: "Datos del Paciente",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "Media",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P10",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P50",
        dataPoints: []
      },
      {
        type: "spline",
        showInLegend: true,
        name: "P90",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var genero;
  if( document.getElementById("genero") ){
    genero = document.getElementById("genero").value;
  }else {
    genero = "M";
  }
  var posting = $.post( auxURL[0]+"/statistics/datosCurva/ppc"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      dataLength = resultArray.data_points.length;
      for (var i = 0; i < dataLength; i++) {
        datosPasar.data[0].dataPoints.push({
          x: parseInt(resultArray.data_points[i].valorx),
          y: parseFloat(resultArray.data_points[i].valory)
        });
      };
      for (var i = 0; i <= resultArray.data_points[dataLength-1].valorx; i++) {
        //Media
        datosPasar.data[1].dataPoints.push({
          x: parseInt(resultArray.m[i].valorx),
          y: parseFloat(resultArray.m[i].valory)
        });
        //P10
        datosPasar.data[2].dataPoints.push({
          x: parseInt(resultArray.p10[i].valorx),
          y: parseFloat(resultArray.p10[i].valory)
        });
        //P50
        datosPasar.data[3].dataPoints.push({
          x: parseInt(resultArray.p50[i].valorx),
          y: parseFloat(resultArray.p50[i].valory)
        });
        //P90
        datosPasar.data[4].dataPoints.push({
          x: parseInt(resultArray.p90[i].valorx),
          y: parseFloat(resultArray.p90[i].valory)
        });
      };

      //Guardar par exportar
      var chart = new CanvasJS.Chart("curvaPPC", datosPasar);
      chart.render();
    });  
}