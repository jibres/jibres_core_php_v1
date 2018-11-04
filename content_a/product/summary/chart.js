if($("#chartdiv1").length == 1){myChart1();}
if($("#chartdiv2").length == 1){myChart2();}
if($("#chartdiv3").length == 1){myChart3();}






//-------------------------------------------------------------------------------------------------------
function myChart1()
{


Highcharts.chart('chartdiv1', {
  chart: {
    type: 'line'
  },
  title: {
    text: '{%trans "Count product group by price"%}'
  },

  xAxis: {
    categories: {{dashboardData.product_price_variation.categories | raw}}
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
  series: [{
    name: '{%trans "Price"%}',
    data: {{dashboardData.product_price_variation.data | raw}},
  }]
});

}




//-------------------------------------------------------------------------------------------------------
function myChart2()
{

Highcharts.chart('chartdiv2', {
  chart: {
    type: 'line'
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
  series: [{
    name: '{%trans "Unit"%}',
    data: {{dashboardData.product_price_group_by_unit.data | raw}},
  }]
});

}







//-------------------------------------------------------------------------------------------------------
function myChart3()
{

Highcharts.chart('chartdiv3', {
  chart: {
    type: 'line'
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
  series: [{
    name: '{%trans "Category"%}',
    data: {{dashboardData.product_price_group_by_cat.data | raw}},
  }]
});

}

