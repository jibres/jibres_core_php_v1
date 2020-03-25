function chartDrawer()
{
  if($("#chartdiv").length == 1){highChart();}
}

<?php
$dashboardData = \dash\data::dashboardData();
?>


function highChart()
{

  Highcharts.chart('chartdiv',
  {
    chart: {
      zoomType: 'x',
    },
    title: {
      text: '<?php echo T_("Sum factor price and count of it group by hours"); ?>'
    },
    xAxis: [{
      categories: <?php echo \dash\get::index($dashboardData, 'chart', 'categories'); ?>,
      crosshair: true
    }],
    yAxis: [{ // Primary yAxis
      labels: {
        format: '{value}',
      },
      title: {
        text: '<?php echo T_("Sum price"); ?>',
      }
    },
    { // Secondary yAxis
      title: {
        text: '<?php echo T_("Count"); ?>',
      },
      labels: {
        format: '{value}',
      },
      opposite: true
    }],
    legend: {
      layout: 'vertical',
      align: 'left',
      x: 120,
      verticalAlign: 'top',
      y: 50,
      floating: true,
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
    },
    series:
    [
      {
        name: '<?php echo T_("Sum price"); ?>',
        type: 'column',
        data: <?php echo \dash\get::index($dashboardData, 'chart', 'sum'); ?>,
        tooltip: {
          valueSuffix: ' <?php echo T_("Toman"); ?>'
        }

      },
      {
        name: '<?php echo T_("Count"); ?>',
        type: 'spline',
        yAxis: 1,
        data: <?php echo \dash\get::index($dashboardData, 'chart', 'count'); ?>,
        tooltip: {
          valueSuffix: ' <?php echo T_("Count"); ?>'
        }
      }
    ]
  });
}