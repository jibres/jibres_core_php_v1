
function pushStateFinal()
{
  $('[data-page="android_splash"] input[type=radio][name=theme]').change(function() {
    var myColors = this.value.split('_');
    if(myColors.length != 4)
    {
      return false;
    }

    var start     = myColors[0];
    var end       = myColors[1];
    var colortext = myColors[2];
    var colordesc = myColors[3];


    $('[data-page="android_splash"] #start').val(start);
    $('[data-page="android_splash"] #end').val(end);
    $('[data-page="android_splash"] #colortext').val(colortext);
    $('[data-page="android_splash"] #colordesc').val(colordesc);


    applySplashColors();
  });

  function applySplashColors()
  {
    var myStyle;
    var mySplashPrev = $('[data-page="android_splash"] .mobileFrame[data-splash]');

    myStyle = 'background: linear-gradient(0deg, ';
    myStyle += $('[data-page="android_splash"] #start').val();
    myStyle += ', ';
    myStyle += $('[data-page="android_splash"] #end').val();
    myStyle += ')';

    mySplashPrev.attr('style', myStyle);
    mySplashPrev.find('h2').css('color', $('[data-page="android_splash"] #colortext').val());
    mySplashPrev.find('h3').css('color', $('[data-page="android_splash"] #colordesc').val());
    mySplashPrev.find('.desc').css('color', $('[data-page="android_splash"] #colordesc').val());
  }
  // run on init
  applySplashColors();

}
