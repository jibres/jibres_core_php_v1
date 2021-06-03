<!DOCTYPE html>
<html lang="fa" dir="<?php echo $direction;?>" translate="no" style="-webkit-text-size-adjust:none;">
<head>
 <meta charset="UTF-8"/>
	<title><?php echo $subject;?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="robots" content="noindex, nofollow">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
  /* CLIENT-SPECIFIC STYLES */
  img{-ms-interpolation-mode:bicubic;}
  /* Force IE to smoothly render resized images. */
  #outlook a{padding:0;}
  /* Force Outlook 2007 and up to provide a "view in browser" message. */
  table{mso-table-lspace:0pt;mso-table-rspace:0pt;}
  /* Remove spacing between tables in Outlook 2007 and up. */
  .ReadMsgBody{width:100%;}
  .ExternalClass{width:100%;}
  /* Force Outlook.com to display emails at full width. */
  p, a, li, td, blockquote{mso-line-height-rule:exactly;}
  /* Force Outlook to render line heights as they're originally set. */
  a[href^="tel"], a[href^="sms"]{color:inherit;cursor:default;text-decoration:none;}
  /* Force mobile devices to inherit declared link styles. */
  p, a, li, td, body, table, blockquote{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;}
  /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
  .ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font{line-height:100%;}
  /* Force Outlook.com to display line heights normally. */
  table{border-collapse:collapse;}

  .mobileOnly{ display:none !important;}
  /*Hide Full-Width Image on Desktop*/

  a, a:hover{
    color:#a80a5a !important;
    text-decoration:none !important;
  }
  p{
   margin-top: 0;
   margin-bottom: 15px;
  }

  @media only screen and (max-width:650px){
      img{
        width:auto !important;
        max-width:100% !important;
        height:auto !important;
      }
      .desktopPad{
        display:none !important;
      }
      .center img{
        margin-left:auto !important;
        margin-right:auto !important;
      }
      .center table{
        margin-right:auto;
        margin-left:auto;
      }
      .center{
        text-align:center !important;
      }
      .noPad{
        padding-top:0px !important;
        padding-right:0px !important;
        padding-bottom:0px !important;
        padding-left:0px !important;
      }
      .noSidePad { padding-right:0px !important;padding-left:0px !important;}
      .noBorder { border:0px !important;}
      hr { margin-right:auto !important;margin-left:auto !important;}
      .mobileOnly{ display:block !important;}
  }

	</style>

</head>
<body bgcolor="#f5f5ff" style="background:#f5f5ff;margin:0;padding:0;mso-padding-alt:0px 0px 0px 0px;font-family: IRANSans,tahoma!important">
 <div class="content" style="width:650px;max-width:100%;margin-left:auto;margin-right:auto;margin-bottom:20px;border-top:10px solid #a80a5a;white-space:normal;padding-top:20px;background-color:#ffffff;border-radius: 0 0 10px 10px;overflow:hidden;">
  <img src="<?php if($language === 'fa') { echo \dash\url::cdn().'/logo/fa/png/Jibres-Logo-fa-5000.png'; } else { echo \dash\url::cdn().'/logo/en/png/Jibres-Logo-en-5000.png';}?>" alt="Jibres logo" height="60" style="display:block;margin-right:auto;margin-left:auto;margin-bottom: 20px; max-width: 200px !important;max-height: 60px !important;">


  <div style="direction:<?php echo $direction;?>;padding-right:40px;padding-left:40px;padding-top:80px;padding-bottom:20px;overflow:hidden;background-color:#e8edfa;">
   <p>Hey mradib!</p>
   <p>Thanks for joining Docker. To finish registration, please click the button below to verify your account</p>
  </div>

  <img src="<?php echo \dash\url::cdn(); ?>/email/campaign/nowruz1400/wave1.png" alt="Jibres Nowruz 1400 festival" width="100%" style="display:block;margin-right:auto;margin-left:auto; max-width: 100% !important;max-height: 366px !important;">


  <div style="direction:<?php echo $direction;?>;padding-right:40px;padding-left:40px;padding-top:40px;padding-bottom:40px;">
   <p>We got a request to add this email address to your Jibres account. Tap below to go ahead.</p>
   <div style="text-align:center;padding-top: 40px;padding-bottom: 20px;">
    <a target="_blank" href="https://jibres.ir/campaign/nowruz1400" style="display:inline-block;border-radius:5px;color:#ffffff!important;font-size:18px;font-weight:bold;background-color:#80a555;padding:10px 20px;margin-bottom:30px;">Verify my Email</a>
    <p>If you did not sign up for Keybase, there is nothing to worry about, just disregard this email.</p>
   </div>
  </div>


 </div>
 <p style="direction:ltr;white-space:normal;color:#8f8f8f;font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:12px;padding-top:10px;padding-bottom:10px;text-align:center;">
  <span>Please do not reply to this email. Need help? Visit <a target="_blank" href="https://help.jibres.ir">Jibres Customer Support</a></span><br>
  <span>This email was sent to <a target="_blank" href="mailto:<?php echo $to;?>"><?php echo $to;?></a></span><br><br>
  <span>&#169; 2021 Jibres. All Rights Reserved. Jibres.club</span>
 </p>
</body>

</html>