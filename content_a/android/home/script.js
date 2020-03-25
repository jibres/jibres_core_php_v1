function chartDrawer()
{
  if($("#chartdiv").length == 1){highChart();}
  if($("#charttotaldownload").length == 1){highChart2();}
}

<?php
$dashboardData = \dash\data::dashboardData();
?>



function highChart()
{

  Highcharts.chart('chartdiv',
  {
    title: { text: '<?php echo T_("Total new download application per day"); ?>' },
    xAxis: [{
      categories: <?php echo \dash\get::index($dashboardData, 'categories'); ?>,
      crosshair: true
    }],
    yAxis: [{ title: false }],
    series:
    [
      {
        name: '<?php echo T_("Count"); ?>',
        data: <?php echo \dash\get::index($dashboardData, 'count'); ?>,
        type: 'column',
        showInLegend: false,
        tooltip: {
          valueSuffix: ' <?php echo T_("Count"); ?>'
        }
      }
    ]
  });
}



function highChart2()
{

  Highcharts.chart('charttotaldownload',
  {
    title: { text: '<?php echo T_("Total Download application per day"); ?>' },
    xAxis: [{
      categories: <?php echo \dash\get::index($dashboardData, 'categories'); ?>,
      crosshair: true
    }],
    yAxis: [{ title: false }],
    series:
    [
      {
        name: '<?php echo T_("Count"); ?>',
        data: <?php echo \dash\get::index($dashboardData, 'count_all'); ?>,
        type: 'area',
        showInLegend: false,
        tooltip: {
          valueSuffix: ' <?php echo T_("Count"); ?>'
        }
      }
    ]
  });
}