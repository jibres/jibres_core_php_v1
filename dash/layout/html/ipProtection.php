<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" translate="no" prefix="og: http://ogp.me/ns#">
 <head>
  <meta charset="UTF-8" />
  <title><?php echo T_("IP Protection"); ?> - <?php echo T_("Jibres"); ?></title>
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
  <meta content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.1, user-scalable=0" name="viewport"/>
  <meta content="Your IP Address is <?php echo \dash\server::ip(); ?>" name="description">
  <meta content="Javad Adib | Jibres" name="author">
  <link rel="shortcut icon" href="<?php echo \dash\url::cdn(); ?>/favicons/favicon-64x64.png" type="image/x-icon" />
  <link href="<?php echo \dash\layout\func::staticmtime('css/siftal-v3.min.css');?>" rel="preload stylesheet" as="style"/>
 </head>
 <body class="ipProtection">
 	<section class="avand-sm impact text-center">
    <svg class="mx-auto" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#00b59c"/><stop offset="1" stop-color="#9cffac"/></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="361" y2="151"><stop offset="0" stop-color="#c3ffe8"/><stop offset=".9973" stop-color="#f0fff4"/></linearGradient><g><g><g><path d="m436 81.621c-83.027 0-169.071-76.961-169.923-77.732-5.719-5.185-14.436-5.185-20.154 0-.857.777-86.675 77.732-169.923 77.732-8.284 0-15 6.716-15 15v179.638c0 145.524 108.236 203.674 189.65 234.755 1.723.658 3.536.986 5.35.986s3.627-.329 5.35-.986c114.154-43.58 189.65-111.559 189.65-234.755v-179.638c0-8.284-6.716-15-15-15z" fill="url(#SVGID_1_)"/></g></g><g><g><path d="m256 151c-57.897 0-105 47.103-105 105s47.103 105 105 105 105-47.103 105-105-47.103-105-105-105zm40.606 100.606-45 45c-2.928 2.929-6.767 4.394-10.606 4.394s-7.678-1.464-10.606-4.394l-15-15c-5.858-5.858-5.858-15.355 0-21.213 5.857-5.858 15.355-5.858 21.213 0l4.394 4.393 34.394-34.393c5.857-5.858 15.355-5.858 21.213 0 5.857 5.858 5.857 15.355-.002 21.213z" fill="url(#SVGID_2_)"/></g></g></g></svg>
    <h1 class="font-bold text-xl leading-loose mb-4"><?php echo T_("Protected by Jibres"); ?></h1>
    <pre class="alert-info text-xl mb-4 ltr" title="Your IP Address"><?php echo \dash\server::ip(); ?></pre>
    <p class="mb-4 leading-relaxed"><?php echo T_("We have noticed an unusual activity from your ip and you are blocked. Please confirm that you are not a robot!"); ?></p>

    <form id='ipProtectionJibresRecaptcha' method="POST">
      <div class="g-recaptcha" data-sitekey="<?php echo \dash\captcha\recaptcha::sitekey_v2(); ?>" data-callback="ipProtectionJibresRecaptcha"></div>
    </form>
 	</section>
 </body>
 <script async src="<?php echo \dash\layout\func::staticmtime('js/jibres.min.js');?>"></script>
 <script src="<?php echo \dash\url::cdn(); ?>/js/special/recaptchaAutoSubmit.js" async></script>
 <script src="https://www.google.com/recaptcha/api.js?hl=<?php echo \dash\language::current(); ?>" async defer></script>
</html>