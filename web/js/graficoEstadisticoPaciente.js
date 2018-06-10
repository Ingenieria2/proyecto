window.onload = function carga() {
  setTimeout(function(){
    document.getElementById("printButton").disabled=false;
    document.getElementById("exportButton").disabled=false;
  }, 7000);
  /*document.getElementById("curvaBarra").style.display="none";
  document.getElementById("graficoCircularVivienda").style.display="none";
  document.getElementById("graficoCircularCalefaccion").style.display="none";
  document.getElementById("graficoCircularAgua").style.display="none";*/
  barrasHSM();
  curvaCircularVivienda();
  curvaCircularCalefaccion();
  curvaCircularAgua();
}

/*Creacion de PDF*/
function exportarPDF(){
  var index = 0;
  var divHeight, divWidth, ratio = 0;
  var newFilePDF = new jsPDF();
  var widthPDF = newFilePDF.internal.pageSize.width - 30;    
  var heightPDF = newFilePDF.internal.pageSize.height;
  barrasHSM();
  curvaCircularVivienda();
  curvaCircularCalefaccion();
  curvaCircularAgua();
  
  //Imagenes
  index = 40;
  cabecera(newFilePDF);
  var canvas = document.querySelector("#curvaBarra .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  var dataURL = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURL, 'JPEG', 20, index, widthPDF, heightPDF);
  newFilePDF.addPage();
  cabecera(newFilePDF);
  canvas = document.querySelector("#graficoCircularVivienda .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  dataURL = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURL, 'JPEG', 20, index, widthPDF, heightPDF);
  newFilePDF.addPage();
  cabecera(newFilePDF);
  canvas = document.querySelector("#graficoCircularCalefaccion .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  dataURL = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURL, 'JPEG', 20, index, widthPDF, heightPDF);
  newFilePDF.addPage();
  cabecera(newFilePDF);
  canvas = document.querySelector("#graficoCircularAgua .canvasjs-chart-canvas");
  divHeight = canvas.height;
  divWidth = canvas.width;
  ratio = divHeight / divWidth;
  heightPDF = ratio * widthPDF;
  dataURL = canvas.toDataURL("image/jpeg");
  newFilePDF.addImage(dataURL, 'JPEG', 20, index, widthPDF, heightPDF);
  var today = new Date();
  newFilePDF.save("EstadisticaPacientes "+today.toISOString().substring(0, 10)+".pdf");

  /*document.getElementById("curvaBarra").style.display="none";
  document.getElementById("graficoCircularVivienda").style.display="none";
  document.getElementById("graficoCircularCalefaccion").style.display="none";
  document.getElementById("graficoCircularAgua").style.display="none";*/
}

function cabecera(filePDF){
  // Cabecera
  filePDF.setDrawColor(0);
  filePDF.setFillColor(236, 70, 25);
  filePDF.rect(0, 0, 210, 40, 'F');
  filePDF.setFont('helvetica')
  filePDF.setFontType('bold')
  filePDF.setFontSize(30);
  filePDF.text(5, 35, "Hospital Dr. Ricardo Gutierrez");

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

/*Botones*/
/*function clickBarrasHSM() {
  document.getElementById("curvaBarra").style.display="block";
  barrasHSM();
  document.getElementById("graficoCircularVivienda").style.display="none";
  document.getElementById("graficoCircularCalefaccion").style.display="none";
  document.getElementById("graficoCircularAgua").style.display="none";
  window.scrollTo(0,document.body.scrollHeight);
}

function clickCurvaCircularVivienda() {
  document.getElementById("curvaBarra").style.display="none";
  document.getElementById("graficoCircularVivienda").style.display="block";
  curvaCircularVivienda();
  document.getElementById("graficoCircularCalefaccion").style.display="none";
  document.getElementById("graficoCircularAgua").style.display="none";
  window.scrollTo(0,document.body.scrollHeight);
}

function clickCurvaCircularCalefaccion() {
  document.getElementById("curvaBarra").style.display="none";
  document.getElementById("graficoCircularVivienda").style.display="none";
  document.getElementById("graficoCircularCalefaccion").style.display="block";
  curvaCircularCalefaccion();
  document.getElementById("graficoCircularAgua").style.display="none";
  window.scrollTo(0,document.body.scrollHeight);
}

function clickCurvaCircularAgua() {
  document.getElementById("curvaBarra").style.display="none";
  document.getElementById("graficoCircularVivienda").style.display="none";
  document.getElementById("graficoCircularCalefaccion").style.display="none";
  document.getElementById("graficoCircularAgua").style.display="block";
  curvaCircularAgua();
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
  barrasHSM();
  curvaCircularVivienda();
  curvaCircularCalefaccion();
  curvaCircularAgua();
  window.print()
  for(var i = 0; i < elemento.length; i++){
    elemento[i].setAttribute('class', "modal fade");
    elemento[i].style.width="";
    elemento[i].style.pageBreakBefore = "";
    elemento[i].style.display="";
  }
  /*document.getElementById("curvaBarra").style.display="none";
  document.getElementById("graficoCircularVivienda").style.display="none";
  document.getElementById("graficoCircularCalefaccion").style.display="none";
  document.getElementById("graficoCircularAgua").style.display="none";*/
}

/*Tablas*/
function barrasHSM() {
  var datosPasar = new Object({
    animationEnabled: true,
    exportEnabled: true,
    title:{
        text: "Datos demograficos"
      },
    axisX:{
        //title: "Semana",
        //valueFormatString: "DD MMM,YY"
        //interval: 1
        valueFormatString:" "
      },
    axisY:{
        title: "Porcertaje [%]",
        titleFontColor: "#6D78AD",
        lineColor: "#6D78AD",
        includeZero: true
      },
    legend:{
        //verticalAlign: "top",
        fontSize: 16,
        //dockInsidePlotArea: true,
      },
    data: [
      {
        type: "column",
        showInLegend: true,
        name: "Con Heladera",
        dataPoints: []
      },
      {
        type: "column",
        showInLegend: true,
        name: "con Servicio electrico",
        dataPoints: []
      },
      {
        type: "column",
        showInLegend: true,
        name: "Con Mascota",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var posting = $.post( auxURL[0]+"/statistics/datosBarra"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      cantTotalPaciente = parseFloat(resultArray.CantidadPacientes[0].valory)
      //heladera
      datosPasar.data[0].dataPoints.push({
        x: parseInt(resultArray.heladera[0].valorx),
        y: parseFloat(resultArray.heladera[0].valory)/cantTotalPaciente
      });
      //electricidad
      datosPasar.data[1].dataPoints.push({
        x: parseInt(resultArray.electricidad[0].valorx),
        y: parseFloat(resultArray.electricidad[0].valory)/cantTotalPaciente
      });
      //mascotas
      datosPasar.data[2].dataPoints.push({
        x: parseInt(resultArray.mascotas[0].valorx),
        y: parseFloat(resultArray.mascotas[0].valory)/cantTotalPaciente
      });

      //Guardar par exportar
      var chart = new CanvasJS.Chart("curvaBarra", datosPasar);
      chart.render();
    });  
}

function curvaCircularVivienda() {
  var datosPasar = new Object({
    animationEnabled: true,
    exportEnabled: true,
    title:{
      text: "Tipos de vivienda"
    },
    legend: {
      maxWidth: 350,
      itemWidth: 120
    },
    data: [
      {
        type: "pie",
        showInLegend: true,
        legendText: "{indexLabel}",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var posting = $.post( auxURL[0]+"/statistics/datosVivienda"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      dataLength = resultArray.length;
      for (var i = 0; i < dataLength; i++) {
        datosPasar.data[0].dataPoints.push({
          y: parseInt(resultArray[i].valorx),
          indexLabel: resultArray[i].indexLabel
        });
      };

      //Guardar par exportar
      var chart = new CanvasJS.Chart("graficoCircularVivienda", datosPasar);
      chart.render();
    });  
}

function curvaCircularCalefaccion() {
  var datosPasar = new Object({
    animationEnabled: true,
    exportEnabled: true,
    title:{
      text: "Tipos de calefaccion"
    },
    legend: {
      maxWidth: 350,
      itemWidth: 120
    },
    data: [
      {
        type: "pie",
        showInLegend: true,
        legendText: "{indexLabel}",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var posting = $.post( auxURL[0]+"/statistics/datosCalefaccion"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      dataLength = resultArray.length;
      for (var i = 0; i < dataLength; i++) {
        datosPasar.data[0].dataPoints.push({
          y: parseInt(resultArray[i].valorx),
          indexLabel: resultArray[i].indexLabel
        });
      };

      //Guardar par exportar
      var chart = new CanvasJS.Chart("graficoCircularCalefaccion", datosPasar);
      chart.render();
    });  
}

function curvaCircularAgua() {
  var datosPasar = new Object({
    animationEnabled: true,
    exportEnabled: true,
    title:{
      text: "Tipos de agua"
    },
    legend: {
      maxWidth: 350,
      itemWidth: 120
    },
    data: [
      {
        type: "pie",
        showInLegend: true,
        legendText: "{indexLabel}",
        dataPoints: []
      }
    ]
  });

  var dataLength = 0;
  var auxURL =  document.URL.split("?");
  var resultArray,auxData = Array();
  var fecha;
  var posting = $.post( auxURL[0]+"/statistics/datosAgua"
    , {}
    , function (result) {
      resultArray = JSON.parse(result);
      dataLength = resultArray.length;
      for (var i = 0; i < dataLength; i++) {
        datosPasar.data[0].dataPoints.push({
          y: parseInt(resultArray[i].valorx),
          indexLabel: resultArray[i].indexLabel
        });
      };

      //Guardar par exportar
      var chart = new CanvasJS.Chart("graficoCircularAgua", datosPasar);
      chart.render();
    });  
}