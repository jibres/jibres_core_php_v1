

var chart;


function getServerStat()
{
  if($('body').attr('data-in') === 'su' && $('body').attr('data-page') === 'home' && chart)
  {
    $.ajax({
      url: '<?php echo \dash\url::here(); ?>?cmd=health',
      success: function (_response)
      {
        _response = JSON.parse(_response);
        if(_response)
        {
          addNewServerData(_response)
        }

        setTimeout(function ()
        {
          getServerStat();
        }, 500);
      }
    });
  }
}


function addNewServerData(_result)
{
  if(_result && _result.disk && _result.memory)
  {
    var myTime = (new Date()).getTime();
    chart.series[0].addPoint([myTime, _result.disk], true);
    chart.series[1].addPoint([myTime, _result.cpu], true);
    chart.series[2].addPoint([myTime, _result.memory], true);


    if(chart.series[0].data.length > 60)
    {
      if (chart.series[0].points[0])
      {
          chart.series[0].points[0].remove();
      }
    }
    if(chart.series[1].data.length > 60)
    {
      if (chart.series[1].points[0])
      {
          chart.series[1].points[0].remove();
      }
    }
    if(chart.series[2].data.length > 60)
    {
      if (chart.series[2].points[0])
      {
          chart.series[2].points[0].remove();
      }
    }
  }
}



function chartDrawer()
{
  if($("#usageChart").length == 1)
  {
    highChart();
  }
}



function highChart()
{

  chart = Highcharts.chart('usageChart',
  {
    chart: {
      zoomType: 'x',
      style: {
        fontFamily: 'IRANSans, Tahoma, sans-serif'
      }
    },
    time: {
      useUTC: false
    },
    title: {
      text: '<?php echo T_("Server live resource usage") . ' '. \dash\face::site(); ?> '
    },
    xAxis: [{
      type: 'datetime',
      // tickPixelInterval: 150,
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
        text: '<?php echo T_("percentage"); ?>',
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
    series:
    [
      {
        name: '<?php echo T_("Disk usage"); ?>',
        type: 'area',
        animation: Highcharts.svg,
        data: [],
        tooltip: {
          valueSuffix: ' <?php echo T_("percentage"); ?>'
        }
      },
      {
        name: '<?php echo T_("CPU Usage"); ?>',
        type: 'areaspline',
        animation: Highcharts.svg,
        color: '#e66566',
        dashStyle: 'ShortDash',
        data: [],
        tooltip: {
          valueSuffix: ' <?php echo T_("percentage"); ?>'
        }
      },
      {
        name: '<?php echo T_("Memory"); ?>',
        type: 'spline',
        color: '#bda013',
        animation: Highcharts.svg,
        data: [],
        tooltip: {
          valueSuffix: ' <?php echo T_("percentage"); ?>'
        }
      }
    ]
  });

  getServerStat();
}


