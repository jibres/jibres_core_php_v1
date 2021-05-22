<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" translate="no" prefix="og: http://ogp.me/ns#">
 <head>
  <meta charset="UTF-8" />
  <title><?php echo \dash\url::domain(); ?></title>
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
  <meta content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.1, user-scalable=0" name="viewport"/>
  <meta content="summary" name="twitter:card"/>
  <meta content="<?php echo \dash\url::cdn(); ?>/img/cover/Jibres-cover-bot-1.jpg?v=2" name="twitter:image"/>
  <link href="<?php echo \dash\url::cdn(); ?>/css/jibres.min.css?1585664188" rel="stylesheet"/>
  <link href="<?php echo \dash\url::cdn(); ?>/css/jibres-domain-pin.css?v=3" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="<?php echo \dash\url::cdn(); ?>/favicons/favicon-64x64.png" type="image/x-icon" />
 </head>
 <body class="domainPin">
 	<main>
    <h1><?php echo \dash\url::domain(); ?></h1>
<?php if (\dash\url::tld() === 'ir') {?>
    <h2>This domain is registered by <a target="_blank" href="https://jibres.ir">Jibres</a></h2>
<?php } else {?>
    <h2>This domain is registered by <a target="_blank" href="https://jibres.com">Jibres</a></h2>
<?php }?>
 	</main>
 </body>
</html>