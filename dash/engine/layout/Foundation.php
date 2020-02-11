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
{%for key, lang in lang.list if lang.list|length > 1 and not url.subdomain and lang.current != key|slice(0, 2)%}
{%set myLangUrl%}
{{url.base}}{%if lang.default != key|slice(0, 2) %}/{{key|slice(0, 2)}}{%endif%}{%if url.content%}/{{url.content}}{%endif%}{%if url.path%}/{{url.path}}{%endif%}
{%endset%}
 <link rel      ="alternate"                    href="{{myLangUrl}}" hreflang="{{key|slice(0, 2)}}"/>
{%endfor%}
 <link rel      ="stylesheet"                   href="{{url.static}}{{'/css/siftal.min.css' | filemtime}}"/>
{%block head%}{%endblock%}
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
{%if perm_su()%}  <div class='superAdmin{%if url.tld != "local"%} public{%endif%}'></div>{%endif%}

{%block foot_css%}{%endblock%}
  <script src="{{url.static}}{{'/js/siftal.min.js' | filemtime}}"></script>
{%if include.highcharts %}
  <script src="{{url.static}}{{'/js/highcharts/highcharts.min.js' | filemtime}}"></script>
{%endif%}
{%if user.id%}  <noscript><div class="line top danger fs16"><div class="txtB">{%trans "JavaScript is required to use our service."%}</div> {%trans "Enable JavaScript in your browser or use one which supports it."%}</div></noscript>{%endif%}
{%if youAreDead%}<div class="line"><div class="warn pA10">{{youAreDead}}</div></div>{%endif%}
{%block js%}{%endblock%}
{%if include.editor%}
  <script src="{{url.static}}{{'/js/medium-editor.min.js' | filemtime}}"></script>
  <link  href="{{url.static}}{{'/css/medium-editor.css' | filemtime}}" rel="stylesheet" media="screen"/>
{%endif%}
{%if options.site.googleAnalytics and url.tld != "local" %}
<script async src="https://www.googletagmanager.com/gtag/js?id={{options.site.googleAnalytics}}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{options.site.googleAnalytics}}');

  function pushStateGA()
  {
    var origin = window.location.protocol + '//' + window.location.host;
    var pathname = window.location.href.substr(origin.length);
    gtag('config', '{{options.site.googleAnalytics}}', {'page_path': pathname});
  }
</script>
{%endif%}

  <div data-xhr='foot_js' class="foot_js">{%block foot_js%}{%endblock%}</div>
 </div>
</body>
</html>