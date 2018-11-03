function chartDrawer()
{
  if($("#chartdiv").length == 1){highChart();}
}



function highChart()
{

Highcharts.chart('chartdiv',
{
  chart: {
    zoomType: 'x',
    style: {
      fontFamily: 'IRANSans, Tahoma, sans-serif'
    }
  },
  title: {
    text: '{%trans "Sum factor price and count of it group by hours"%}'
  },
  xAxis: [{
    categories: {{dashboardData.chart.categories | raw}},
    crosshair: true
  }],
  yAxis: [{ // Primary yAxis
    labels: {
      format: '{value}',
      style: {
        color: Highcharts.getOptions().colors[0]
      }
    },
    title: {
      text: '{%trans "Sum price"%}',
      useHTML: Highcharts.hasBidiBug,
      style: {
        color: Highcharts.getOptions().colors[0]
      }
    }
  },
  { // Secondary yAxis
    title: {
      text: '{%trans "Count"%}',
      useHTML: Highcharts.hasBidiBug,
      style: {
        color: Highcharts.getOptions().colors[1]
      }
    },
    labels: {
      format: '{value}',
      style: {
        color: Highcharts.getOptions().colors[1]
      }
    },
    opposite: true
  }],
  tooltip: {
    useHTML: true,
    borderWidth: 0,
    shared: true
  },
  exporting:
  {
    buttons:
    {
      contextButton:
      {
        menuItems:
        [
         'printChart',
         'separator',
         'downloadPNG',
         'downloadJPEG',
         'downloadSVG'
        ]
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'left',
    x: 120,
    verticalAlign: 'top',
    y: 100,
    floating: true,
    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
  },
  credits:
  {
      text: '{{service.title}}',
      href: '{{service.url}}',
      position:
      {
          x: -35,
          y: -7
      },
      style: {
          fontWeight: 'bold'
      }
  },
  series: [
  {
    name: '{%trans "Sum price"%}',
    type: 'column',
    data: {{dashboardData.chart.sum | raw}},
    tooltip: {
      valueSuffix: ' {%trans "Toman"%}'
    }

  },
  {
    name: '{%trans "Count"%}',
    type: 'spline',
    yAxis: 1,
    data: {{dashboardData.chart.count | raw}},
    tooltip: {
      valueSuffix: ' {%trans "Count"%}'
    }
  }
  ]
}, function(_chart)
  {
    _chart.renderer.image('{{service.logo}}', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
  });
}