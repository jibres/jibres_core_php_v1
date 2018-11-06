if($("#chartdiv1").length == 1){myChart1();}
if($("#chartdiv2").length == 1){myChart2();}
if($("#chartdiv3").length == 1){myChart3();}






//-------------------------------------------------------------------------------------------------------
function myChart1()
{


  Highcharts.chart('chartdiv1', {
    chart:
    {
      type: 'line',
      zoomType: 'x',
      style:
      {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    title: {
      text: '{%trans "Count product group by price"%}'
    },

    xAxis: {
      categories: {{dashboardData.product_price_variation.categories | raw}},
      crosshair: true
    },
    yAxis: [{ // Primary yAxis
      labels: {
        format: '{value}',
        style: {
          color: Highcharts.getOptions().colors[0]
        }
      },
      title: {
        text: '{%trans "Count"%}',
        useHTML: Highcharts.hasBidiBug,
        style: {
          color: Highcharts.getOptions().colors[0]
        }
      }
    }],
    tooltip: {
      useHTML: true,
      borderWidth: 0,
      shared: true
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
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
    series: [{
      name: '{%trans "Price"%}',
      data: {{dashboardData.product_price_variation.data | raw}},
    }]
  }, function(_chart)
  {
    _chart.renderer.image('{{service.logo}}', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
  });

}




//-------------------------------------------------------------------------------------------------------
function myChart2()
{

  Highcharts.chart('chartdiv2', {
    chart:
    {
      type: 'area',
      zoomType: 'x',
      style:
      {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    tooltip: {
      useHTML: true,
      borderWidth: 0,
      shared: true
    },
    title: {
      text: '{%trans "Count product group by unit"%}'
    },

    xAxis: {
      categories: {{dashboardData.product_price_group_by_unit.categories | raw}}
    },
    yAxis: {
      title: {
        text: '{%trans "Count"%}'
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
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
    series: [{
      name: '{%trans "Unit"%}',
      data: {{dashboardData.product_price_group_by_unit.data | raw}},
    }]
  }, function(_chart)
  {
    _chart.renderer.image('{{service.logo}}', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
  });

}







//-------------------------------------------------------------------------------------------------------
function myChart3()
{

  Highcharts.chart('chartdiv3', {
    chart:
    {
      type: 'line',
      zoomType: 'x',
      style:
      {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    title: {
      text: '{%trans "Count product group by category"%}'
    },

    xAxis: {
      categories: {{dashboardData.product_price_group_by_cat.categories | raw}}
    },
    yAxis: {
      title: {
        text: '{%trans "Count"%}'
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
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
    series: [{
      name: '{%trans "Category"%}',
      data: {{dashboardData.product_price_group_by_cat.data | raw}},
    }]
  }, function(_chart)
  {
    _chart.renderer.image('{{service.logo}}', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
  });

}

