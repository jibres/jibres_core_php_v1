<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" translate="no" prefix="og: http://ogp.me/ns#"<?php if ((\dash\permission::supervisor() && !\dash\detect\device::detectPWA() ) || \dash\url::tld() === 'local') echo ' data-debugger';?><?php if (\dash\data::HtmlPointerEventsNone()) echo ' class="pointer-events-none1 select-none"';?><?php if (\dash\detect\device::detectPWA() && !\dash\data::demoOnlineLoadPreviewSection()) {echo " data-pwa='". \dash\detect\device::detectPWA(). "'";}else{echo " data-desktop";}?>>
<head>
 <meta charset="UTF-8"/>
 <base href="<?php echo \dash\url::base();?>"/>
 <title><?php echo \dash\face::headTitle(); ?></title>
 <meta content="<?php echo \dash\face::desc(); ?>" name="description"/>
 <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
<?php if(\dash\data::demoOnlineLoadPreviewSection()) {?>
 <meta content="yes" name="jibres:sitebuilder:preview"/>
<?php }else{ ?>
 <meta content="<?php
if (\dash\detect\device::detectPWA())
{
  if(\dash\user::id())
  {
    echo 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0';
  }
  else
  {
    echo 'width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5';
  }
}
else
{
  echo 'width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5';
}
?>" name="viewport"/>
<?php } //endif ?>
<?php
if (!\dash\data::pageWithLogin())
{
?>
 <meta content="<?php echo \dash\url::kingdom();?>" name="site:root"/>
 <meta content="<?php echo \dash\face::twitterCard(); ?>" name="twitter:card"/>
 <meta content="<?php echo \dash\face::seo(); ?>" name="twitter:title"/>
 <meta content="<?php echo \dash\face::desc(); ?>" name="twitter:description"/>
 <meta content="<?php echo \dash\face::cover(); ?>?v=2" name="twitter:image"/>
 <meta content="@jibres_com" name="twitter:site"/>
 <meta content="@jibres_com" name="twitter:creator"/>
 <meta content="<?php echo \dash\url::current();?>" name="twitter:url"/>
 <meta content="website" property="og:type"/>
 <meta content="<?php echo \dash\face::seo(); ?>" property="og:title"/>
 <meta content="<?php echo \dash\face::desc(); ?>" property="og:description"/>
 <meta content="<?php echo \dash\face::cover(); ?>?v=2" property="og:image"/>
 <meta content="<?php echo \dash\url::current();?>" property="og:url"/>
 <meta content="<?php echo \dash\face::site(); ?>" property="og:site_name"/>
 <meta content='<?php echo \dash\language::current(); ?>' property='og:locale'/>
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
 <meta content="<?php echo \dash\url::jibres_subdomain('core');?>" name="jibres:core"/>
 <meta content="<?php echo \dash\url::jibres_subdomain('api');?>" name="jibres:api"/>
 <meta content="<?php echo \dash\url::cdn();?>/" name="jibres:cdn"/>
<?php
// disallow robots to find website
if(\dash\face::disallowSearchEngine())
{
  echo ' <meta content="noindex, nofollow" name="robots"/>'. "\n";
  echo ' <meta content="noindex, nofollow" name="googlebot"/>'. "\n";
}
else
{
 echo ' <meta content="index, follow" name="robots"/>'. "\n";
}

// add third party addons
if(\dash\data::addons())
{
  foreach (\dash\data::addons() as $service => $value)
  {
    if($value)
    {
      echo " <meta content='". $value. "' name='". $service. "'/>\n";
    }
  }
}
// if(\dash\server::referer())
// {
//   echo " <meta content='". urlencode(\dash\server::referer()). "' name='ref'/>\n";
// }
?>
 <meta content="yes" name="mobile-web-app-capable"/>
 <meta content="yes" name="apple-touch-fullscreen"/>
 <meta content="yes" name="apple-mobile-web-app-capable"/>
 <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<?php if(\dash\engine\store::inBusinessWebsite()) {?>
 <meta content="#000" name="theme-color"/>
 <meta content="#000" name="msapplication-TileColor">
<?php } else {?>
 <meta content="#c80a5a" name="theme-color"/>
 <meta content="#c80a5a" name="msapplication-TileColor">
<?php }?>
 <meta content="<?php echo \dash\face::site(); ?>" name="application-name"/>
 <meta content="<?php echo \dash\face::site(); ?>" name="apple-mobile-web-app-title"/>
 <meta content="Jibres" name="generator"/>
<?php if(\dash\engine\store::inBusinessWebsite()) {?>
 <meta content="business-website" name="jibres:zone"/>
 <link href="<?php echo \lib\store::logo();?>?v=1" type="image/png" rel="icon"/>
 <link href="<?php echo \lib\store::logo();?>?v=1" rel="shortcut icon"/>
 <link href="<?php echo \lib\store::logo();?>?v=1" rel="apple-touch-startup-image"/>
 <link href="<?php echo \lib\store::logo();?>?v=1" sizes="180x180" rel="apple-touch-icon"/>
 <link href="<?php echo \dash\url::kingdom();?>/manifest.webmanifest" rel="manifest"/>
 <meta content="<?php echo \dash\url::kingdom();?>/browserconfig.xml?v=1" name="msapplication-config"/>
<?php } else {?>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon.ico?j=2" rel="shortcut icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/apple-touch-icon.png?j=2" sizes="180x180" rel="apple-touch-icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon-32x32.png?j=2" sizes="32x32" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/favicon-16x16.png?j=2" sizes="16x16" type="image/png" rel="icon"/>
 <link href="<?php echo \dash\url::cdn();?>/favicons/safari-pinned-tab.svg?j=2" rel="mask-icon"/>
 <link href="<?php echo \dash\url::logo();?>?j=2" rel="apple-touch-startup-image"/>
 <link href="<?php echo \dash\url::kingdom();?>/manifest.webmanifest" rel="manifest"/>
 <meta content="<?php echo \dash\url::cdn();?>/favicons/browserconfig.xml?j=2" name="msapplication-config"/>
<?php } /*end if*/ if(\dash\detect\device::detectPWA() === 'ios') { ?>
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-750x1294.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-1242x2148.png" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-1536x2048.png" media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-1668x2224.png" media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
  <link rel="apple-touch-startup-image" href="<?php echo \dash\url::cdn();?>/img/splash/jibres-2048x2732.png" media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
<?php }?>
<?php
if (\dash\url::canonical())
{
  echo ' <link rel="canonical" href="'. \dash\url::canonical(). '"/>'. "\n";
}
if (\dash\url::root() === 'jibres' && \dash\url::tld() !== 'store')
{
 echo ' <link href="'. \dash\url::jibres_domain(). 'team" rel="author"/>'. "\n";
}
?>
<?php // @todo add rel alternative ?>
<?php
echo ' <link href="'. \dash\url::cdn(). '" rel="preconnect"/>'. "\n";
// add one css for everything!
// try to seperate it later
echo ' <link href="'. \dash\layout\func::staticmtime('css/siftal-v3.min.css'). '" rel="preload stylesheet" as="style"/>'."\n";
?>
<?php
  if(\dash\face::css() && is_array(\dash\face::css()))
  {
    foreach (\dash\face::css() as $key => $value)
    {
      echo " <link href='";
      if(\dash\str::strpos($value, 'http') === 0)
      {
        echo $value;
      }
      else
      {
        echo \dash\layout\func::staticmtime($value);
      }
      echo "' rel='stylesheet'/>\n";
    }
  }
?>
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
echo " data-in='". \dash\engine\content::get_name(). "'";
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
if(\dash\data::include_m2())
{
  echo " data-m2";
  if(is_string(\dash\data::include_m2()))
  {
    echo "=". \dash\data::include_m2(). ' ';
  }
}
if(\dash\engine\store::inStore() && \lib\store::enterprise())
{
    echo " data-enterprise='". \lib\store::enterprise(). "'";
}
// set iframe
if(\dash\request::is_iframe())
{
  echo " data-iframe";
}

if(\dash\data::bodyBackgroundStyle())
{
  echo " style='". \dash\data::bodyBackgroundStyle(). "'";
}

if(\dash\data::bodyMasterFont())
{
  echo " class='". \dash\data::bodyMasterFont(). "'";
}

echo " data-preload";
?>><?php
\dash\layout\find::allBlocks();
?><div class="js">
  <script async src="<?php echo \dash\layout\func::staticmtime('js/jibres.min.js');?>"></script>
<?php
// load pageScript
\dash\layout\find::pageScript();

if (\dash\user::id())
{
  echo "\n  ";
  echo '<noscript><div class="line top danger fs12"><span class="font-bold mb-2">';
  echo T_('JavaScript is required to use our service.');
  echo '</span> ';
  echo T_('Enable JavaScript in your browser or use one which supports it.');
  echo '</div></noscript>';
}
// @todo Javad check browser and show live or dead
// <div class="line warn fs20">YOU ARE DEAD!</div>

\dash\layout\find::allNotifs(); ?>
 </div>
</body>
</html>