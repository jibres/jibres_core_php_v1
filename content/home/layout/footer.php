<?php
$kingdom = \dash\url::kingdom();
if(\dash\language::current() === 'fa')
{
?>
<section id="jibresCertificates">
  <div class="fit-md">
    <h2><?php echo T_('Jibres Certificates'); ?></h2>
    <div class="f">
      <div class="c3 s6"><a tabindex='-1' target="_blank" rel='nofollow' href="https://pub.daneshbonyan.ir/"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-daneshbonyan.png" alt='DaneshBonyan Jibres'></a></div>
      <!-- <div class="c3 s6"><a tabindex='-1' target="_blank" rel='nofollow' href="https://shaparak.com/tips/%D8%B4%D8%B1%DA%A9%D8%AA-%D9%87%D8%A7%DB%8C-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%DB%8C%D8%A7%D8%B1"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bank-markazi.png" alt=''></a></div> -->
      <!-- <div class="c3 s6"><a tabindex='-1' target="_blank" rel='nofollow' href="https://shaparak.com/tips/%D8%B4%D8%B1%DA%A9%D8%AA-%D9%87%D8%A7%DB%8C-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%DB%8C%D8%A7%D8%B1"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-shaparak.png" alt=''></a></div> -->
      <div class="c3 s6"><a tabindex='-1' target="_blank" href="https://jibres.ir"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bmn.png" alt=''></a></div>
      <div class="c3 s6"><a tabindex='-1' target="_blank" rel='nofollow' href="https://trustseal.enamad.ir/?id=118387&Code=2iL8ULp5lVA5oSXMRiLp"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-enamad.png" alt=''></a></div>
      <div class="c3 s6"><a tabindex='-1' target="_blank" rel='nofollow' href="http://qom.irannsr.org/index.php?module=cdk&func=loadmodule&system=cdk&sismodule=user/content_view.php&cnt_id=225820&ctp_id=61&id=17394&sisOp=view"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-nsr.png" alt=''></a></div>
      <!-- <div class="c3 s6"><a tabindex='-1' target="_blank" rel='nofollow' href=""><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-brand.png" alt=''></a></div> -->
      <div class="c3 s6"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-samandehi.png" alt='' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=460, height=600, top=30")'></div>
    </div>
  </div>
</section>
<?php } ?>

<section id="jibresSupportLine">
    <h3><?php echo T_('Need Help?'). ' '. T_("We're here for you."); ?></h3>
    <a class="btn lg success" href="<?php echo $kingdom; ?>/contact"><?php echo T_('Contact with a Live Person'); ?></a>
</section>

<div id="jibresFooter">
  <div class="fit">
    <figure class="f align-center logo">
      <a class="cauto s12" href="/">
        <img loading="lazy" src="<?php echo \dash\url::cdn();
       if (\dash\language::current() === 'fa')
       {
        echo "/logo/fa-vertical/svg/Jibres-Logo-fa-vertical.svg";
       }
       else
       {
        echo "/logo/en-vertical/svg/Jibres-Logo-en-vertical.svg";
       }
       ?>" alt='<?php echo T_("Jibres Vertical Logo") ?>'>
      </a>
      <figcaption class="c s12"><?php echo \dash\data::site_desc(); ?> <a href="<?php echo $kingdom; ?>/about"><?php echo T_('Learn more about Jibres'); ?></a></figcaption>
    </figure>


    <div class="f">

        <div class="f" id="footerMenu">

          <nav class="c3 s6 pLR10">
            <h3><?php echo T_('eCommerce'); ?></h3>
            <a href="<?php echo $kingdom; ?>/benefits"><?php echo T_('Benefits'); ?></a>
            <a href="<?php echo $kingdom; ?>/pricing"><?php echo T_('Pricing'); ?></a>
          </nav>

          <?php
          if (false)
          {
          ?>

          <nav class="c3 s6 pLR10">
            <h3><?php echo T_('Domains'); ?></h3>
            <a href="<?php echo $kingdom; ?>/domain"><?php echo T_('Domain Name Search'); ?></a>
            <a href="<?php echo $kingdom; ?>/domain/transfer"><?php echo T_('Transfer Domain'); ?></a>
            <a href="<?php echo $kingdom; ?>/whois"><?php echo T_('Whois Lookup'); ?></a>
          </nav>

          <?php
          } // endif
          ?>


          <nav class="c3 s6 pLR10">
            <h3><?php echo T_('Resources'); ?></h3>
            <a href="<?php echo $kingdom; ?>/blog"><?php echo T_('Blog'); ?></a>
            <a href="<?php echo $kingdom; ?>/terms"><?php echo T_('Terms of Service'); ?></a>
            <a href="<?php echo $kingdom; ?>/privacy"><?php echo T_('Privacy Policy'); ?></a>
            <a href="<?php echo $kingdom; ?>/changelog"><?php echo T_('Changelog'); ?></a>
            <a href="<?php echo $kingdom; ?>/certificates"><?php echo T_('Certificates'); ?></a>
            <a href="<?php echo $kingdom; ?>/socialresponsibility"><?php echo T_('Social Responsibility'); ?></a>
          </nav>

          <nav class="c3 s6 pLR10">
            <h3><?php echo T_('Support'); ?></h3>
            <a href="<?php echo $kingdom; ?>/support"><?php echo T_('Support Center'); ?></a>
            <a href="<?php echo $kingdom; ?>/contact"><?php echo T_('Contact'); ?></a>
            <a href="<?php echo $kingdom; ?>/support/faq"><?php echo T_('FAQ'); ?></a>
            <a href="https://status.jibres.com" target="_blank"><?php echo T_('System Status'); ?></a>
            <a href="<?php echo $kingdom; ?>/support/ticket/add"><?php echo T_('Submit Ticket'); ?></a>
            <a href="<?php echo $kingdom; ?>/support/ticket/add?type=bug"><?php echo T_('Report Bug'); ?></a>
            <a href="<?php echo $kingdom; ?>/support/ticket/add?type=feedback"><?php echo T_('Send us Feedback'); ?></a>
          </nav>

          <nav class="c3 s6 pLR10">
            <h3><?php echo T_('Jibres Company'); ?></h3>
            <a href="<?php echo $kingdom; ?>/about"><?php echo T_('About Jibres'); ?></a>
            <a href="<?php echo $kingdom; ?>/team"><?php echo T_('Our Team'); ?></a>
            <a href="<?php echo $kingdom; ?>/logo"><?php echo T_('Jibres Logo'); ?></a>
            <a href="<?php echo $kingdom; ?>/brand"><?php echo T_('Brand Styleguide'); ?></a>
            <a target="_blank" href="<?php echo $kingdom; ?>/careers"><?php echo T_('Careers'); ?> <span class="mLa5 sf-external-link"></span></a>
            <a href="<?php echo $kingdom; ?>/press"><?php echo T_('Press and Media'); ?></a>
          </nav>
        </div>
    </div>

    <div id="jibresLastLine" class="f align-center">
      <div id="jibresCopyright" class="cauto">&copy; <?php echo \dash\datetime::fit(null, 'Y'). '. '. T_('All rights reserved.'). ' '. T_('Jibres, LLC'). ' ' ; ?>&reg;</div>
      <nav class="c langlist"><?php
        if(\dash\language::current() == 'fa')
        {
          echo "<a hreflang='en' target='_blank'  href='https://jibres.com'>English</a>";
        }
        else
        {
          echo "<a hreflang='fa' target='_blank'  href='https://jibres.ir'>فارسی</a>";
        }
      ?></nav>
      <nav class="cauto os share1">
        <a target="_blank" rel="nofollow" href="https://www.facebook.com/jibres" class="facebook">Become a Jibres fan on facebook</a>
        <a target="_blank" rel="nofollow" href="https://twitter.com/jibres_com" class="twitter">Follow Jibres on Twitter</a>
        <a target="_blank" rel="nofollow" href="https://linkedin.com/jibres_com" class="linkedin">Connect to Jibres on Linkedin</a>
        <a target="_blank" rel="nofollow" href="https://github.com/jibres" class="github">Connect to Jibres on Github</a>
        <a target="_blank" rel="nofollow" href="https://t.me/jibres" class="telegram">Join Jibres Telegram Channel</a>
        <a target="_blank" rel="nofollow" href="https://instagram.com/jibres_com" class="instagram">Follow Jibres on Instagram</a>
      </nav>
    </div>


  </div>
</div>






<div id="jibresBottomLine"></div>