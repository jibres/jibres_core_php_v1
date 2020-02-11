<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" prefix="og: http://ogp.me/ns#"<?php if (\dash\permission::supervisor()) echo ' data-debugger';?><?php if (\dash\detect\device::detectPWA()) {echo " data-pwa='". \dash\detect\device::detectPWA(). "'";}?>>
<head>
 <meta charset="UTF-8"/>
 <base href="<?php echo \dash\url::base();?>"/>
 <title><?php echo \dash\data::global_title(); ?></title>
 <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
 <!--[if lte IE 9]><script>document.location = 'https://deadbrowser.com/{{lang.current}}';</script><![endif]-->
 <meta name     ="description"                  content="<?php echo \dash\data::page_desc(); ?>"/>
 <meta name     ="site:root"                    content="<?php echo \dash\url::kingdom();?>"/>
 <meta name     ="twitter:card"                 content="<?php echo \dash\data::page_twitterCard(); ?>"/>
 <meta name     ="twitter:title"                content="<?php echo \dash\data::global_title(); ?>"/>
 <meta name     ="twitter:description"          content="<?php echo \dash\data::page_desc(); ?>"/>
 <meta name     ="twitter:image"                content="<?php echo \dash\data::page_cover(); ?>"/>
 <meta name     ="twitter:site"                 content="@jibres_com"/>
 <meta name     ="twitter:creator"              content="@jibres_com">
 <meta name     ="twitter:url"                  content="<?php echo \dash\url::pwd();?>"/>
 <meta property ="og:type"                      content="website"/>
 <meta property ="og:title"                     content="<?php echo \dash\data::global_title(); ?>"/>
 <meta property ="og:description"               content="<?php echo \dash\data::page_desc(); ?>"/>
 <meta property ="og:image"                     content="<?php echo \dash\data::page_cover(); ?>"/>
 <meta property ="og:url"                       content="<?php echo \dash\url::pwd();?>"/>
 <meta property ="og:site_name"                 content="<?php echo \dash\data::site_title(); ?>" />
 <meta property ='og:locale'                    content='<?php echo \dash\language::current(); ?>'/>
 <meta name      ="robots"                      content="index, follow"/>
 <meta name     ="jibres:site"                  content="<?php echo \dash\url::site();?>">
 <meta name     ="jibres:api"                   content="<?php echo \dash\url::sitelang();?>/api/">
 <meta name     ="viewport"                     content="<?php
if (\dash\detect\device::detectPWA())
  echo 'width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0';
else
  echo 'width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.1, user-scalable=0';
?>">
 <meta name     ="application-name"             content="<?php echo \dash\data::site_title(); ?>"/>
 <meta name     ="msapplication-config"         content="<?php echo \dash\url::site();?>/browserconfig.xml?v=6">
 <meta name     ="theme-color"                  content="#c80a5a">
 <meta name     ="mobile-web-app-capable"       content="yes"/>
 <meta name     ="apple-touch-fullscreen"       content="yes"/>
 <meta name     ="apple-mobile-web-app-title"   content="<?php echo \dash\data::site_title(); ?>"/>
 <meta name     ="apple-mobile-web-app-capable" content="yes"/>
 <link rel      ="apple-touch-icon"             href="<?php echo \dash\url::site();?>/apple-touch-icon.png?v=6" sizes="180x180">
 <link rel      ="icon"                         href="<?php echo \dash\url::site();?>/favicon-64x64.png?v=6" sizes="64x64" type="image/png">
 <link rel      ="icon"                         href="<?php echo \dash\url::site();?>/favicon-32x32.png?v=6" sizes="32x32" type="image/png">
 <link rel      ="icon"                         href="<?php echo \dash\url::site();?>/favicon-16x16.png?v=6" sizes="16x16" type="image/png">
 <link rel      ="mask-icon"                    href="<?php echo \dash\url::site();?>/safari-pinned-tab.svg?v=6">
 <link rel      ="shortcut icon"                href="<?php echo \dash\url::site();?>/favicon.ico?v=6">
 <link rel      ="manifest"                     href="<?php echo \dash\url::kingdom();?>/manifest.webmanifest">
 <link rel      ="apple-touch-startup-image"    href="<?php echo \dash\url::logo();?>">
<?php
if (\dash\url::canonical())
echo '<link rel ="canonical" href="'. \dash\url::canonical(). '">';
?>
 <link rel      ="author"                       href="<?php echo \dash\url::kingdom();?>/humans.txt"/>
<?php // @todo add rel alternative ?>
 <link rel      ="stylesheet"                   href="<?php echo \dash\engine\template_engine::staticmtime('css/siftal.min.css');?>"/>
</head>

<body{%if global.subdomain%} data-subdomain='{{global.subdomain}}'{%endif%} data-in='{{global.content}}' data-page='{{global.page}}' class='{{global.direction}}{%if include.adminPanel%} siftal{%endif%} preload {{bodyclass}}'{%if global.theme%} data-theme='{{global.theme}}'{%endif%}{%if userToggleSidebar %}{%else%} data-clean{%endif%}{%if bodyel%} {{bodyel|raw}}{%endif%}{%if user.id%} data-user='{{user.id | coding("encode")}}'{%endif%}{%if requestGET.iframe%} data-iframe{%endif%}>
{%block body%}
{%if not runPWA%}
 <aside id='pageSidebar' data-xhr='pageSidebar'>
{%block sideBox%}{%endblock%}
 </aside>
{%endif%}
{%if not runPWA%}
 <div id='pageWrapper' data-xhr='pageWrapper'>
{%endif%}
  <header id="pageHeader" data-xhr='pageHeader'>
{%block header%}{%if runPWA%}{%embed "includes/html/pwa/pwa-header.html"%}{%endembed%}{%endif%}{%endblock%}
  </header>
{%if not runPWA%}
  <nav id="pageNav" data-xhr='pageNav'>
{%block nav%}{%endblock%}
  </nav>
{%endif%}
  <main id="pageContent" data-xhr='pageContent'>
{%block content%}{%endblock%}
  </main>
  <footer id="pageFooter" data-xhr='pageFooter'>
{%block footer%}{%endblock%}
  </footer>
{%if not runPWA%}
 </div>
{%endif%}
{%endblock%}

 <div class="js">
  <script src="<?php echo \dash\engine\template_engine::staticmtime('js/siftal.min.js');?>"></script>
<?php
if (\dash\data::include_highcharts())
{
  echo '  <script src="'. \dash\engine\template_engine::staticmtime('js/highcharts/highcharts.min.js'). '"></script>';
}
?>
<?php
if (\dash\user::id() or 1)
{
  echo '  <noscript><div class="line top danger fs12"><span class="txtB mB10">';
  echo T_('JavaScript is required to use our service.');
  echo '</span> ';
  echo T_('Enable JavaScript in your browser or use one which supports it.');
  echo '</div></noscript>';
}
?>

{%if youAreDead%}<div class="line"><div class="warn pA10">{{youAreDead}}</div></div>{%endif%}
{%block js%}{%endblock%}
{%if include.editor%}
  <script src="<?php echo \dash\engine\template_engine::staticmtime('js/medium-editor.min.js');?>"></script>
  <link  href="<?php echo \dash\engine\template_engine::staticmtime('css/medium-editor.css');?>" rel="stylesheet" media="screen"/>
{%endif%}
{%if options.site.googleAnalytics and url.tld != "local" %}
<script async src="https://www.googletagmanager.com/gtag/js?id={{options.site.googleAnalytics}}"></script>
<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '{{options.site.googleAnalytics}}'); function pushStateGA() { var origin = window.location.protocol + '//' + window.location.host; var pathname = window.location.href.substr(origin.length); gtag('config', '{{options.site.googleAnalytics}}', {'page_path': pathname}); }</script>
{%endif%}

  <div data-xhr='foot_js' class="foot_js">{%block foot_js%}{%endblock%}</div>
<?php
if(\dash\permission::supervisor())
{
  if(\dash\url::isLocal())
  {
    echo '  <div class="superAdmin public"></div>';
  }
  else
  {
    echo '  <div class="superAdmin"></div>';
  }
}
?>
 </div>
</body>
</html>