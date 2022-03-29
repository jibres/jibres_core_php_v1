<!DOCTYPE html>
<html lang="<?php echo \dash\language::current();?>" dir="<?php echo \dash\language::dir();?>" translate="no" prefix="og: http://ogp.me/ns#">
 <head>
  <meta charset="UTF-8" />
  <title><?php echo T_("Your IP is Blocked"); ?> - <?php echo T_("Jibres"); ?></title>
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
  <meta content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.1, user-scalable=0" name="viewport"/>
  <meta content="Your IP Address is <?php echo \dash\server::ip(); ?>" name="description">
  <meta content="Javad Adib | Jibres" name="author">
  <link href="<?php echo \dash\layout\func::staticmtime('css/jibres.min.css');?>" rel="stylesheet"/>
  <link rel="shortcut icon" href="<?php echo \dash\url::cdn(); ?>/favicons/favicon-64x64.png" type="image/x-icon" />
  <script src="<?php echo \dash\url::cdn(); ?>/js/special/recaptchaAutoSubmit.js" async defer></script>
 </head>
 <body class="ipBlock">
 	<section class="avand-sm impact text-center">
    <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m256 0c-141.152344 0-256 114.847656-256 256s114.847656 256 256 256 256-114.847656 256-256-114.847656-256-256-256zm-192 256c0-105.871094 86.128906-192 192-192 41.40625 0 79.679688 13.296875 111.070312 35.679688l-267.390624 267.390624c-22.382813-31.390624-35.679688-69.679687-35.679688-111.070312zm192 192c-41.40625 0-79.679688-13.296875-111.070312-35.679688l267.390624-267.390624c22.382813 31.390624 35.679688 69.679687 35.679688 111.070312 0 105.871094-86.128906 192-192 192zm0 0" fill="#c80a5a"/></svg>
    <h2 class="font-bold"><?php echo T_("Sorry, you have been blocked"); ?></h2>
    <p><?php echo T_("We have an attack from your IP! Make Calm! breathe!"); ?></p>
    <pre class="msg minimal font-20 mb-2" title="Your IP Address"><?php echo \dash\server::ip(); ?></pre>
<?php
if(isset($_unblockDate) && $_unblockDate)
{
  echo '<time class="block msg">'. $_unblockDate. '</time>';
}
?>
    <div class="txtLa">
   		<h2 class="font-bold font-18"><?php echo T_("Why have i been blocked?"); ?></h2>
      <p><?php echo T_("We are using a security service to protect ourselves from online attacks. The action you just performed triggered the security solution. Several actions could trigger this block including submitting a certain word or phrase, a SQL command, or malformed data."); ?></p>

      <h2 class="font-bold font-18"><?php echo T_("What can i do to resolve this?"); ?></h2>
      <p class="mb-0"><?php echo T_("You can email us to let them know you were blocked. Please include what you were doing when this page came up and your IP address is shown on this page."); ?></p>
    </div>
 	</section>
 </body>
</html>