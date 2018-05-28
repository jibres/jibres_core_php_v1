function chartDrawer()
{
  if($("#chartdiv2").length == 1){myChart2();}
  if($("#chartdiv1").length == 1){myChart1();}
  if($("#chartdiv3").length == 1){myChart3();}
}


//-------------------------------------------------------------------------------------------------------
function myChart1()
{
  am4core.useTheme(am4themes_animated);

  var chart = am4core.create("chartdiv1", am4charts.XYChart);
  chart.data = {{dashboardData.product_price_variation | raw}};

  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.dataFields.category = "key";
  categoryAxis.renderer.minGridDistance = 60;


  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.title.text = '{%trans "Count of products"%}';

  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.categoryX = "key";
  series.dataFields.valueY = "value";
  series.tooltipText = "{valueY.value}"
  series.columns.template.strokeOpacity = 0;


  chart.cursor = new am4charts.XYCursor();

  // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
  series.columns.template.adapter.add("fill", function (fill, target)
  {
    return chart.colors.getIndex(target.dataItem.index);
  });

  var label = chart.plotContainer.createChild(am4core.Label);
  label.text = '{%trans "Price Variation"%}';
  label.x = 10;
  label.y = 10;
}



//-------------------------------------------------------------------------------------------------------
function myChart2()
{
  am4core.useTheme(am4themes_animated);

  var chart = am4core.create("chartdiv2", am4charts.XYChart);
  chart.data = {{dashboardData.product_price_group_by_unit | raw}};

  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.dataFields.category = "key";
  categoryAxis.renderer.minGridDistance = 60;


  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.title.text = '{%trans "Count of products"%}';

  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.categoryX = "key";
  series.dataFields.valueY = "value";
  series.tooltipText = "{valueY.value}"
  series.columns.template.strokeOpacity = 0;


  chart.cursor = new am4charts.XYCursor();

  // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
  series.columns.template.adapter.add("fill", function (fill, target)
  {
    return chart.colors.getIndex(target.dataItem.index);
  });

  var label = chart.plotContainer.createChild(am4core.Label);
  label.text = '{%trans "Product GroupBy Unit"%}';
  label.x = 10;
  label.y = 10;
}



//-------------------------------------------------------------------------------------------------------
function myChart3()
{

  am4core.useTheme(am4themes_animated);

  var chart = am4core.create("chartdiv3", am4charts.XYChart);

  chart.data = {{dashboardData.product_price_group_by_cat | raw}}

  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.dataFields.category = "key";
  categoryAxis.renderer.minGridDistance = 60;


  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.title.text = '{%trans "Count of products"%}';

  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.categoryX = "key";
  series.dataFields.valueY = "value";
  series.tooltipText = "{valueY.value}"
  series.columns.template.strokeOpacity = 0;


  chart.cursor = new am4charts.XYCursor();

  // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
  series.columns.template.adapter.add("fill", function (fill, target)
  {
    return chart.colors.getIndex(target.dataItem.index);
  });

  var label = chart.plotContainer.createChild(am4core.Label);
  label.text = '{%trans "Product GroupBy Category"%}';
  label.x = 10;
  label.y = 10;
}
