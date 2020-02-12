<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" prefix="og: http://ogp.me/ns#"<?php if (\dash\permission::supervisor()) echo ' data-debugger';?><?php if (\dash\detect\device::detectPWA()) {echo " data-pwa='". \dash\detect\device::detectPWA(). "'";}?>>
<head>
 <meta charset="UTF-8"/>
 <base href="<?php echo \dash\url::base();?>"/>
 <title><?php echo \dash\data::global_title(); ?></title>
 <meta content="<?php echo \dash\data::page_desc(); ?>" name="description"/>
 <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
 <!--[if lte IE 9]><script>document.location = 'https://deadbrowser.com/{{lang.current}}';</script><![endif]-->
 <meta content="<?php
if (\dash\detect\device::detectPWA())
  echo 'width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0';
else
  echo 'width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.1, user-scalable=0';
?>" name="viewport">
<?php
if (!\dash\data::pageWithLogin())
{
?>
 <meta content="<?php echo \dash\url::kingdom();?>" name="site:root"/>
 <meta content="<?php echo \dash\data::page_twitterCard(); ?>" name="twitter:card"/>
 <meta content="<?php echo \dash\data::global_title(); ?>" name="twitter:title"/>
 <meta content="<?php echo \dash\data::page_desc(); ?>" name="twitter:description"/>
 <meta content="<?php echo \dash\data::page_cover(); ?>" name="twitter:image"/>
 <meta content="@jibres_com" name="twitter:site"/>
 <meta content="@jibres_com" name="twitter:creator"/>
 <meta content="<?php echo \dash\url::pwd();?>" name="twitter:url"/>
 <meta content="website" property ="og:type"/>
 <meta content="<?php echo \dash\data::global_title(); ?>" property ="og:title"/>
 <meta content="<?php echo \dash\data::page_desc(); ?>" property ="og:description"/>
 <meta content="<?php echo \dash\data::page_cover(); ?>" property ="og:image"/>
 <meta content="<?php echo \dash\url::pwd();?>" property ="og:url"/>
 <meta content="<?php echo \dash\data::site_title(); ?>" property ="og:site_name"/>
 <meta content='<?php echo \dash\language::current(); ?>' property ='og:locale'/>
<?php
}
?>
 <meta content="<?php echo \dash\data::site_title(); ?>" name="application-name"/>
 <meta content="<?php echo \dash\url::site();?>/browserconfig.xml?v=6" name="msapplication-config"/>
 <meta content="#c80a5a" name="theme-color"/>
 <meta content="yes" name="mobile-web-app-capable"/>
 <meta content="yes" name="apple-touch-fullscreen"/>
 <meta content="<?php echo \dash\data::site_title(); ?>" name="apple-mobile-web-app-title"/>
 <meta content="yes" name="apple-mobile-web-app-capable"/>
 <meta content="index, follow" name ="robots"/>
 <meta content="<?php echo \dash\url::site();?>" name="jibres:site"/>
 <meta content="<?php echo \dash\url::sitelang();?>/api/" name="jibres:api"/>
 <link href="<?php echo \dash\url::site();?>/apple-touch-icon.png?v=6" sizes="180x180" rel="apple-touch-icon"/>
 <link href="<?php echo \dash\url::site();?>/favicon-64x64.png?v=6" sizes="64x64" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::site();?>/favicon-32x32.png?v=6" sizes="32x32" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::site();?>/favicon-16x16.png?v=6" sizes="16x16" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::site();?>/safari-pinned-tab.svg?v=6" rel="mask-icon"/>
 <link href="<?php echo \dash\url::site();?>/favicon.ico?v=6" rel="shortcut icon"/>
 <link href="<?php echo \dash\url::kingdom();?>/manifest.webmanifest" rel="manifest"/>
 <link href="<?php echo \dash\url::logo();?>" rel="apple-touch-startup-image"/>
<?php
if (\dash\url::canonical())
echo '<link rel ="canonical" href="'. \dash\url::canonical(). '"/>';
?>
 <link href="<?php echo \dash\url::kingdom();?>/humans.txt" rel="author"/>
<?php // @todo add rel alternative ?>
 <link href="<?php echo \dash\engine\layout\fn::staticmtime('css/siftal.min.css');?>" rel="stylesheet"/>
</head>

<body<?php
// subdomain
if (\dash\url::subdomain())
{
  echo " data-subdomain='". \dash\url::subdomain(). "'";
}
// content
if(\dash\url::content() === null)
{
  echo " data-in='site'";
}
else
{
  echo " data-in='". \dash\url::content(). "'";
}
// page
echo " data-page='". \dash\data::global_page(). "'";
// class
echo " class='". \dash\language::dir();
if(\dash\data::include_adminPanel())
{
  echo " siftal";
}
if(\dash\data::bodyclass())
{
  echo " ". \dash\data::bodyclass();
}
echo " preload";
echo "'";
// theme
if(\dash\data::global_theme())
{
  echo " data-theme='". \dash\data::global_theme(). "'";
}
// sidebar
if(!\dash\data::userToggleSidebar())
{
  echo " data-clean";
}
if(\dash\user::id())
{
  echo " data-user='". \dash\coding::encode(\dash\user::id()). "'";
}
if(\dash\request::get('iframe'))
{
  echo " data-iframe";
}
echo ">";

\dash\engine\layout\find::allBlocks();
?>


 <div class="js">
  <script src="<?php echo \dash\engine\layout\fn::staticmtime('js/siftal.min.js');?>"></script>
<?php
if (\dash\data::include_highcharts())
{
  echo "\n  ";
  echo '<script src="'. \dash\engine\layout\fn::staticmtime('js/highcharts/highcharts.min.js'). '"></script>';
}

if (\dash\user::id())
{
  echo "\n  ";
  echo '<noscript><div class="line top danger fs12"><span class="txtB mB10">';
  echo T_('JavaScript is required to use our service.');
  echo '</span> ';
  echo T_('Enable JavaScript in your browser or use one which supports it.');
  echo '</div></noscript>';
}
// @todo Javad check browser and show live or dead
// <div class="line warn fs20">YOU ARE DEAD!</div>

if (\dash\data::include_editor())
{
  echo "\n  ";
  echo '<script src="'. \dash\engine\layout\fn::staticmtime('js/medium-editor.min.js'). '"></script>';
  echo "\n  ";
  echo '<link  href="'. \dash\engine\layout\fn::staticmtime('css/medium-editor.css'). '" rel="stylesheet" media="screen"/>';
}
if(\dash\option::config('site', 'googleAnalytics'))
{
  $gAnalytics = \dash\option::config('site', 'googleAnalytics');
  echo "<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '$gAnalytics'); function pushStateGA() { var origin = window.location.protocol + '//' + window.location.host; var pathname = window.location.href.substr(origin.length); gtag('config', '$gAnalytics', {'page_path': pathname}); }</script>";
}
// @todo javad
// foot_js
// <div data-xhr='foot_js' class="foot_js">{%block foot_js%}{%endblock%}</div>

if(\dash\permission::supervisor())
{
  if(\dash\url::isLocal())
  {
    echo "\n  <div class='superAdmin public'></div>";
  }
  else
  {
    echo "\n  <div class='superAdmin'></div>";
  }
}
?>
 </div>
</body>
</html>