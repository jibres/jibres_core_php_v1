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
      style: {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
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
        style: {
          color: Highcharts.getOptions().colors[0]
        }
      },
      title: {
        text: '<?php echo T_("Sum price"); ?>',
        useHTML: Highcharts.hasBidiBug,
        style: {
          color: Highcharts.getOptions().colors[0]
        }
      }
    },
    { // Secondary yAxis
      title: {
        text: '<?php echo T_("Count"); ?>',
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
        text: '<?php echo T_('Jibres'); ?>',
        href: '<?php echo 'https://jibres.com'; ?>',
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
  }, function(_chart)
  {
    _chart.renderer.image('<?php echo \dash\url::icon(); ?>', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
  });
}