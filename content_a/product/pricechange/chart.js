if($("#chartdiv").length == 1){myChart();}





//-------------------------------------------------------------------------------------------------------
function myChart()
{

Highcharts.chart('chartdiv', {

  title: {
    text: '{%trans "Price change in time line"%}'
  },

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

  plotOptions: {
    series: {
      label: {
        connectorAllowed: false
      },
      pointStart: 2010
    }
  },

  series: {{cahrtDetail | raw}},

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
