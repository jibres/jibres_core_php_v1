function chartDrawer()
{

  if($("#postchart").length == 1){post_chart();}
  if($("#wordcloud").length == 1){wordcloud();}
}




function wordcloud()
{


  Highcharts.chart('wordcloud',
  {
    chart:
    {
      zoomType: 'x',
      style:
      {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    series: [{
      type: 'wordcloud',
      data: <?php echo \dash\data::allWordCloud(); ?>,
      name: '<?php echo T_("Count"); ?>'
    }],
    plotOptions: {
      series : {
        // turboThreshold: 1000
      },
        wordcloud: {
            style : {
              fontFamily: "IRANSans"
            }
        }
    },
    tooltip: {
      useHTML: true,
      borderWidth: 0
    },
    credits:
    {
        text: '<?php echo T_('Jibres'); ?>',
        href: '<?php echo 'https://jibres.com'; ?>',
        position:
        {
            align: 'left',
            x: 45,
            verticalAlign: 'top',
            y: 25
        },
        style: {
            color: '#15677b',
            fontWeight: 'bold'
        }
    },
    title: {
      text: '<?php echo T_("Word cloud"); ?>'
    }
  }, function(_chart)
  {
    _chart.renderer.image('<?php echo \dash\url::icon(); ?>', 10, 5, 30, 30).add();
  }
  );
}


<?php
$dashboardDetail = \dash\data::dashboardDetail();
?>


function post_chart()
{
  Highcharts.chart('postchart',
  {
    chart: {
      type: 'area',
      zoomType: 'x',
      style: {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    title: {
      text: '<?php echo T_("Post count"); ?>'
    },
    xAxis: {
      categories: <?php echo @$dashboardDetail['chart']['post']['categories']; ?>,
      tickmarkPlacement: 'on',
      title: {
        enabled: false
      }
    },
    yAxis: {
      title: {
        text: '<?php echo T_("Post"); ?>'
      },
      labels: {
        formatter: function () {
          return this.value / 1000;
        }
      }
    },
    tooltip: {
      useHTML: true,
      borderWidth: 0,
      shared: true,
      valueSuffix: ' <?php echo T_("post"); ?>'
    },
    plotOptions: {
      area: {
        stacking: 'normal',
        lineColor: '#666666',
        lineWidth: 1,
        marker: {
          lineWidth: 1,
          lineColor: '#666666'
        }
      }
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },
    exporting:
    {
      enabled: false
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
    series: <?php echo @$dashboardDetail['chart']['post']['data']; ?>
  }, function(_chart)
    {
      _chart.renderer.image('<?php echo \dash\url::icon(); ?>', 10, 5, 30, 30).attr({class: 'chartServiceLogo'}).add();
    }
  );
}

