<div id="jibresCertificates">
  <div class="fit-md">
    <h2><?php echo T_('Jibres Certificates'); ?></h2>
    <div class="f">
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-daneshbonyan.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-bank-markazi.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-shaparak.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-bmn.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-enamad.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-nsr.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-brand.png"alt=''></a></div>
      <div class="c3 s6"><a href=""><img src="<?php echo \dash\url::static(); ?>/img/certificates/jibres-certificate-samandehi.png"alt=''></a></div>

    </div>
  </div>
  <div>
  </div>
</div>

<div id="jibresSupportLine">
    <h3><?php echo T_('Need Help?'). ' '. T_("We're here for you."); ?></h3>
    <a class="btn lg success" href="/contact"><?php echo T_('Contact with a Live Person'); ?></a>
</div>

<div id="jibresFooter">
  <div  class="fit">
    <div class="f">
      <div class="c6 s12" id="footerInfo">
        <picture class="logo">
          <a href="/">
            <img src="<?php echo \dash\url::logo(); ?>" alt='<?php echo T_("Jibres") ?>'>
          </a>
        </picture>
        <p><?php echo \dash\data::site_desc(); ?></p>

      </div>
      <div class="c6 s12" id="footerMenu">
        <div class="f">
          <div class="c4 s12 pRa10">

          </div>
          <div class="c4 s12 pRa10">
            <nav>
              <a href="/domain" class="txtB">Domains</a>
              <a href="/domain/search" class="txtb">Domain Name Search</a>
              <a href="/domain/transfer" class="txtb">Transfer Domain</a>
              <a href="/domain/whois" class="txtb">Whois Lookup</a>
            </nav>

          </div>
          <div class="c4 s12 pRa10">
            <nav>
              <a href="/support" class="txtB">Support</a>
              <a href="/support" class="txtb">Support Center</a>
              <a href="https://status.jibres.com" target="_blank"><?php echo T_('System Status'); ?></a>
              <a href="/support/ticket/new" class="txtb">Submit Ticket</a>
              <a href="/support/ticket/new?type=bug" class="txtb">Report Bug</a>
              <a href="/support/ticket/new?type=feedback" class="txtb">Send us Feedback</a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



 <footer id='tfooter'>
  <div class="cn">

   <nav class="f top">
    <a class="cauto link_home" href="<?php echo \dash\url::kingdom(); ?>"><?php echo T_('Home'); ?></a>
    <a class="cauto" href="<?php echo \dash\url::kingdom(); ?>/about"><?php echo T_('About'); ?></a>
    <a class="cauto hide" href="<?php echo \dash\url::kingdom(); ?>/press"><?php echo T_('Press and Media'); ?></a>
    <a class="cauto" href="<?php echo \dash\url::kingdom(); ?>/careers" target="_blank"><?php echo T_('Careers'); ?></a>
    <a class="cauto" href="<?php echo \dash\url::kingdom(); ?>/socialresponsibility"><?php echo T_('Social Responsibility'); ?></a>
    <a class="cauto" href="<?php echo \dash\url::kingdom(); ?>/help/faq"><?php echo T_('FAQ'); ?></a>
   </nav>

   <div class="f middle">
     <nav class="c3 s12">
       <h4><?php echo T_('Jibres'); ?></h4>
        <a href="<?php echo \dash\url::kingdom(); ?>/benefits"><?php echo T_('Benefits'); ?></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/pricing"><?php echo T_('Pricing'); ?></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/changelog"><?php echo T_('Changelog'); ?></a>
      </nav>

      <nav class="c3 s12">
       <h4><?php echo T_('Learn More'); ?></h4>
        <a href="<?php echo \dash\url::kingdom(); ?>/terms"><?php echo T_('Terms of Service'); ?></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/privacy"><?php echo T_('Privacy Policy'); ?></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/socialresponsibility"><?php echo T_('Social Responsibility'); ?></a>
      </nav>

      <nav class="c3 s12">
       <h4><?php echo T_('Support'); ?></h4>
        <a href="<?php echo \dash\url::kingdom(); ?>/contact"><?php echo T_('Contact'); ?></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/help/faq"><?php echo T_('FAQ'); ?></a>
        <a href="<?php echo \dash\url::kingdom(); ?>/logo"><?php echo T_('Logo'); ?></a>
        <a href="https://status.jibres.com" target="_blank"><?php echo T_('System Status'); ?></a>
      </nav>

      <div class="c s12 os">
        <nav class="share1">
          <a data-direct href="https://www.facebook.com/jibres" class="facebook">Jibres facebook</a>
          <a data-direct href="https://twitter.com/jibres_com" class="twitter">Twitter of Jibres</a>
          <a data-direct href="https://t.me/jibres" class="telegram">Telegram channel of Jibres</a>
          <a data-direct href="https://instagram.com/jibres_com" class="instagram">Jibres on Instagram</a>
        </nav>
      </div>


   </div>

   <div class="f bottom align-center">
    <div class="cauto s12">
      <nav class="langlist" data-xhr="langlist">
<?php
if(\dash\language::current() == 'fa')
{
  echo "<a hreflang='en' data-direct href='https://jibres.com'>English</a>";
}
else
{
  echo "<a hreflang='fa' data-direct href='https://jibres.ir'>فارسی</a>";
}
?>
      </nav>
    </div>
    <div class="c"></div>
    <div class="cauto s12 love"><?php echo T_('Proudly Made in IRAN'); ?></div>
   </div>

  </div>
 </footer>




 <div id="jibresBottomLine">

 </div>