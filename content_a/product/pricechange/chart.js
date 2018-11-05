if($("#chartdiv").length == 1){myChartProductPrice();}





//-------------------------------------------------------------------------------------------------------
function myChartProductPrice()
{

Highcharts.chart('chartdiv', {

  title: {
    text: '{%trans "Price change in time line"%}'
  },
   xAxis: [{
      categories: {{cahrtDetail.categories | raw}},
      crosshair: true
    }],
  yAxis: {
    title: {
      text: '{%trans "Price"%}'
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
  },

  series: {{cahrtDetail.data | raw}},

  responsive: {
    rules: [{
      condition: {
        maxWidth: 500
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom'
        }
      }
    }]
  }

});
}
