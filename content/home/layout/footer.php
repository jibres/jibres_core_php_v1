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
      <div class="c5 s12" id="footerInfo">
        <figure class="logo">
            <a href="/">
              <img src="<?php echo \dash\url::logo(); ?>" alt='<?php echo T_("Jibres") ?>'>
            </a>
          <figcaption><?php echo \dash\data::site_desc(); ?></figcaption>
        </figure>

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
      <div class="c1 s0"></div>
      <div class="c6 s12" id="footerMenu">
        <div class="f">
          <div class="c4 s12 pRa10">
            <nav>
              <h3>Domains</h3>
              <a href="/domain/search"><?php echo T_('Domain Name Search'); ?></a>
              <a href="/domain/transfer"><?php echo T_('Transfer Domain'); ?></a>
              <a href="/domain/whois"><?php echo T_('Whois Lookup'); ?></a>
            </nav>
          </div>
          <div class="c4 s12 pRa10">
            <nav>
              <h3>Jibres</h3>
              <a href="/about"><?php echo T_('About'); ?></a>
              <a href="/logo"><?php echo T_('Logo'); ?></a>
              <a href="/brand"><?php echo T_('Brand Styleguide'); ?></a>
              <a href="/careers"><?php echo T_('Careers'); ?></a>
              <a href="/certificates"><?php echo T_('Certificates'); ?></a>
            </nav>

            <nav>
              <h3>Resources</h3>
              <a href="/blog"><?php echo T_('Blog'); ?></a>
              <a href="/terms"><?php echo T_('Terms of Service'); ?></a>
              <a href="/privacy"><?php echo T_('Privacy Policy'); ?></a>
              <a href="/socialresponsibility"><?php echo T_('Social Responsibility'); ?></a>
            </nav>

          </div>
          <div class="c4 s12 pRa10">
            <nav>
              <h3>Support</h3>
              <a href="/support"><?php echo T_('Support Center'); ?></a>
              <a href="/support/faq"><?php echo T_('FAQ'); ?></a>
              <a href="https://status.jibres.com" target="_blank"><?php echo T_('System Status'); ?></a>
              <a href="/support/ticket/new"><?php echo T_('Submit Ticket'); ?></a>
              <a href="/support/ticket/new?type=bug"><?php echo T_('Report Bug'); ?></a>
              <a href="/support/ticket/new?type=feedback"><?php echo T_('Send us Feedback'); ?></a>


        <a href="/contact"><?php echo T_('Contact'); ?></a>
        <a href="/help/faq"></a>


            </nav>

            <nav>
              <h3>Contact</h3>
              <a href="/support">+98-21-2842-2590</a>
              <a href="/support">+98-25-3650-5460</a>
              <a href="/support">+98-25-3650-5281</a>
              <a href="/support">info@Jibres.com</a>
              <a href="/support">2th Floor<br>Haft-e-tir 1 St<br>Qom, IRAN</a>
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
    <a class="cauto hide" href="/press"><?php echo T_('Press and Media'); ?></a>
   </nav>

   <div class="f middle">
     <nav class="c3 s12">
       <h4><?php echo T_('Jibres'); ?></h4>
        <a href="/benefits"><?php echo T_('Benefits'); ?></a>
        <a href="/pricing"><?php echo T_('Pricing'); ?></a>
        <a href="/changelog"><?php echo T_('Changelog'); ?></a>
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
    <div class="cauto s12 love"><?php echo T_('Proudly Made in IRAN'); ?></div>
   </div>

  </div>
 </footer>




 <div id="jibresBottomLine">

 </div>