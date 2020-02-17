function chartDrawer()
{
  if($("#chartdiv").length == 1){myChartProductPrice();}
}





//-------------------------------------------------------------------------------------------------------
function myChartProductPrice()
{

  Highcharts.chart('chartdiv',
  {
    chart:
    {
      height : "50%",
      zoomType: 'x',
      style:
      {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    title:
    {
      text: '<?php echo T_("Day Event"); ?>'
    },
     xAxis:
    [{
        categories: <?php echo \dash\data::cahrtDetail_categories(); ?>,
        crosshair: true
    }],
    credits:
    {
        text: '<?php echo \dash\data::service_title(); ?>',
        href: '<?php echo \dash\data::service_url(); ?>',
        position:
        {
            x: -35,
            y: -7
        },
        style: {
            fontWeight: 'bold'
        }
    },
    yAxis: [{ // Primary yAxis
      labels: {
        format: '{value}',
        style: {
          color: Highcharts.getOptions().colors[0]
        }
      },
      title: {
        text: '<?php echo T_("Count"); ?>',
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
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
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
    series: <?php echo \dash\data::cahrtDetail_data(); ?>,

  }, function(_chart)
  {
    _chart.renderer.image('<?php echo \dash\data::service_logo(); ?>', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
  });
}
