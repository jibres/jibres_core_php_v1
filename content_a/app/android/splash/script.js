

$('[data-page="app_android_splash"] input[type=radio][name=theme]').change(function() {
  console.log(this.value);

  var from      = '#6DE195';
  var to        = '#C4E759';
  var colortext = '#000000';
  var colordesc = '#333333';


  $('[data-page="app_android_splash"] #from').val(from);
  $('[data-page="app_android_splash"] #to').val(to);
  $('[data-page="app_android_splash"] #colortext').val(colortext);
  $('[data-page="app_android_splash"] #colordesc').val(colordesc);


  applySplashColors();
});


function applySplashColors()
{
  $('[data-page="app_android_splash"] #from').val()
  $('[data-page="app_android_splash"] #to').val()
  $('[data-page="app_android_splash"] #colortext').val()
  $('[data-page="app_android_splash"] #colordesc').val()
}

