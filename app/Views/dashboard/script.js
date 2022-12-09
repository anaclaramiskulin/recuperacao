google.charts.load('current', {'packages':['corechart','line']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var infoGraph = [];
var titlesChart = ["Dia", "Entrada" , "Saida"];
infoGraph.push(titlesChart);

var baseArray = outputArray.lenght >= inputArray.lenght ? outputArray : inputArray;
for (let i = 0; i < baseArray.length; i++) {
  let output = (outputArray[i] && outputArray[i].hasOwnProperty('value')) ? parseFloat(outputArray[i].value) : outputArray[i-1];
  let input = (inputArray[i] && inputArray[i].hasOwnProperty('value')) ? parseFloat(inputArray[i].value) : inputArray[i-1];

  chartItem = [baseArray[i].date, input, output];
  infoGraph.push(chartItem);
} 
var data = google.visualization.arrayToDataTable(infoGraph);

var options = {
title: 'Performance da empresa',
curveType: 'function',
legend: { position: 'bottom' }
};

var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));

chart.draw(data, options);

var chartArrayPie = [];
var chartHeaderPie = ['Tipo', 'Valor'];
chartArrayPie.push(chartHeaderPie);

moviments.forEach((item)=>{
  chartItem = [item.description, parseFloat(item.value)];
  chartArrayPie.push(chartItem);
})
var data = google.visualization.arrayToDataTable(chartArrayPie);

var options = {
    title: 'Serviços e renda:'
};

var chart = new google.visualization.PieChart(document.getElementById('piechart'));

chart.draw(data, options);
} 