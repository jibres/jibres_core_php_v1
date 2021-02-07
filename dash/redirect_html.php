<!DOCTYPE html>
<html lang="<?php echo (\dash\language::current()); ?>" dir="ltr">
<head>
 <meta charset="UTF-8"/>
 <title><?php echo T_('Redirect');?> >>></title>

 <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
 <meta name ="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0 maximum-scale=1.5, minimal-ui"/>
 <link href="<?php echo(\dash\url::cdn()); ?>/images/favicon-error.png" rel="shortcut icon"/>
 <link href="<?php echo \dash\layout\func::staticmtime('css/jibres.min.css');?>" rel="stylesheet"/>
 <meta http-equiv="refresh" content="2; URL=<?php echo($_loc);?>">
</head>
<body class='redirecting' data-model='<?php echo $_model; ?>'>

  <div class='longfazers'><span></span><span></span><span></span><span></span></div>
  <div class='jet'>
    <span><span></span><span></span><span></span><span></span></span>
    <div class='base'><span></span><div class='face'></div></div>
  </div>
  <div class="detail">
    <h1<?php if($_txt) {echo ' title="'. $_txt. '"';} ?>><?php echo T_('REDIRECTING ...') ?></h1>
    <?php echo '  <h2><a href='. urlencode($_loc). '>'. strtok($_loc, '?') .'</a></h2>';
    if($_txt)
    {
      echo '  <br><p>'. $_txt .'</p>';
    }
    ?>

  </div>
 <script src="<?php echo \dash\layout\func::staticmtime('js/jibres.min.js');?>"></script>
</body>
</html>