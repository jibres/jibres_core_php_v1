<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" prefix="og: http://ogp.me/ns#"<?php if (\dash\permission::supervisor() || \dash\url::tld() === 'local') echo ' data-debugger';?><?php if (\dash\detect\device::detectPWA()) {echo " data-pwa='". \dash\detect\device::detectPWA(). "'";}?>>
<head>
 <meta charset="UTF-8"/>
 <base href="<?php echo \dash\url::base();?>"/>
 <title><?php echo \dash\face::headTitle(); ?></title>
 <meta content="<?php echo \dash\face::desc(); ?>" name="description"/>
 <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
 <!--[if lte IE 9]><script>document.location = 'https://deadbrowser.com/{{lang.current}}';</script><![endif]-->
 <meta content="<?php
if (\dash\detect\device::detectPWA())
  echo 'width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0';
else
  echo 'width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.1, user-scalable=0';
?>" name="viewport"/>
<?php
if (!\dash\data::pageWithLogin())
{
?>
 <meta content="<?php echo \dash\url::kingdom();?>" name="site:root"/>
 <meta content="<?php echo \dash\face::twitterCard(); ?>" name="twitter:card"/>
 <meta content="<?php echo \dash\face::headTitle(); ?>" name="twitter:title"/>
 <meta content="<?php echo \dash\face::desc(); ?>" name="twitter:description"/>
 <meta content="<?php echo \dash\face::cover(); ?>" name="twitter:image"/>
 <meta content="@jibres_com" name="twitter:site"/>
 <meta content="@jibres_com" name="twitter:creator"/>
 <meta content="<?php echo \dash\url::current();?>" name="twitter:url"/>
 <meta content="website" property ="og:type"/>
 <meta content="<?php echo \dash\face::headTitle(); ?>" property ="og:title"/>
 <meta content="<?php echo \dash\face::desc(); ?>" property ="og:description"/>
 <meta content="<?php echo \dash\face::cover(); ?>" property ="og:image"/>
 <meta content="<?php echo \dash\url::current();?>" property ="og:url"/>
 <meta content="<?php echo \dash\face::site(); ?>" property ="og:site_name"/>
 <meta content='<?php echo \dash\language::current(); ?>' property ='og:locale'/>
<?php
}
if(\dash\user::id())
{
  echo " <meta content='". \dash\coding::encode(\dash\user::id()). "' name='user-Jibres'/>\n";
}
if(\dash\url::store())
{
  echo " <meta content='". \dash\url::store(). "' name='store-code'/>\n";
}
?>
 <meta content="<?php echo \dash\url::sitelang();?>/" name="jibres:sitelang"/>
 <meta content="<?php echo \dash\url::set_subdomain('api');?>/" name="jibres:api"/>
 <meta content="<?php echo \dash\url::cdn();?>/" name="jibres:cdn"/>
 <meta content="index, follow" name ="robots"/>
 <meta content="yes" name="mobile-web-app-capable"/>
 <meta content="yes" name="apple-touch-fullscreen"/>
 <meta content="yes" name="apple-mobile-web-app-capable"/>
 <meta content="#c80a5a" name="theme-color"/>
 <meta content="#c80a5a" name="msapplication-TileColor">
 <meta content="<?php echo \dash\face::site(); ?>" name="application-name"/>
 <meta content="<?php echo \dash\face::site(); ?>" name="apple-mobile-web-app-title"/>
 <meta content="<?php echo \dash\url::cdn();?>/favicons/browserconfig.xml?v=1" name="msapplication-config"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/apple-touch-icon.png?v=1" sizes="180x180" rel="apple-touch-icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon-64x64.png?v=1" sizes="64x64" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon-32x32.png?v=1" sizes="32x32" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon-16x16.png?v=1" sizes="16x16" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/safari-pinned-tab.svg?v=1" rel="mask-icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon.ico?v=1" rel="shortcut icon"/>
 <link href="<?php echo \dash\url::kingdom();?>/manifest.webmanifest" rel="manifest"/>
 <link href="<?php echo \dash\url::logo();?>" rel="apple-touch-startup-image"/>
<?php
if (\dash\url::canonical())
echo '<link rel ="canonical" href="'. \dash\url::canonical(). '"/>';
?>
 <link href="<?php echo \dash\url::kingdom();?>/humans.txt" rel="author"/>
<?php // @todo add rel alternative ?>
 <link href="<?php echo \dash\layout\func::staticmtime('css/siftal.min.css');?>" rel="stylesheet"/>
</head>

<body<?php
// subdomain
if (\dash\url::subdomain())
{
  echo " data-subdomain='". \dash\url::subdomain(). "'";
}
// set env as store code or Jibres or something else
echo " data-env='". \dash\data::global_env(). "'";
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
if(\dash\data::include_adminPanel())
{
  if(!\dash\data::userToggleSidebar())
  {
  // without sidebar
    echo " data-panel='clean'";
  }
  else
  {
  // with sidebar
    echo " data-panel";
  }
}
// set iframe
if(\dash\request::get('iframe'))
{
  echo " data-iframe";
}
echo " data-preload";
?>><?php
\dash\layout\find::allBlocks();
?>


 <div class="js">
  <script src="<?php echo \dash\layout\func::staticmtime('js/siftal.min.js');?>"></script>
<?php
if (\dash\data::include_highcharts())
{
  echo "\n  ";
  echo '<script src="'. \dash\layout\func::staticmtime('js/highcharts/highcharts-8.0.4.js'). '"></script>';
}

if (\dash\data::include_editor())
{
  echo "\n  ";
  echo '<script src="'. \dash\layout\func::staticmtime('js/medium-editor.min.js'). '"></script>';
  echo "\n  ";
  echo '<link  href="'. \dash\layout\func::staticmtime('css/medium-editor.css'). '" rel="stylesheet" media="screen"/>';
}
// load pageScript
\dash\layout\find::pageScript();

// <div data-xhr='foot_js' class="foot_js">{%block foot_js%}{%endblock%}</div>

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
if(\dash\option::config('site', 'googleAnalytics'))
{
  $gAnalytics = \dash\option::config('site', 'googleAnalytics');
  echo "\n  ";
  echo '<script async src="https://www.googletagmanager.com/gtag/js?id='. $gAnalytics. '"></script>';
  echo "<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '$gAnalytics'); function pushStateGA() { var origin = window.location.protocol + '//' + window.location.host; var pathname = window.location.href.substr(origin.length); gtag('config', '$gAnalytics', {'page_path': pathname}); }</script>";
}

if(false)
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