<?php
$kingdom = \dash\url::kingdom();
if(\dash\language::current() === 'fa' && \dash\url::module() !== 'certificates')
{
?>
<section id="jibresCertificates">
  <div class="avand-md">
    <h2><a href="<?php echo \dash\url::kingdom() ?>/certificates"><?php echo T_('Jibres Certificates'); ?></a></h2>
    <div class="f">
      <div class="c3 s4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://pub.daneshbonyan.ir/"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-daneshbonyan.png" alt='DaneshBonyan Jibres'></a></div>
      <!-- <div class="c3 s4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://shaparak.com/tips/%D8%B4%D8%B1%DA%A9%D8%AA-%D9%87%D8%A7%DB%8C-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%DB%8C%D8%A7%D8%B1"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bank-markazi.png" alt=''></a></div> -->
      <!-- <div class="c3 s4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://shaparak.com/tips/%D8%B4%D8%B1%DA%A9%D8%AA-%D9%87%D8%A7%DB%8C-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%DB%8C%D8%A7%D8%B1"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-shaparak.png" alt=''></a></div> -->
      <div class="c3 s4"><a tabindex='-1' target="_blank" href="https://jibres.ir/certificates"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bmn.png" alt=''></a></div>
      <div class="c3 s4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://trustseal.enamad.ir/?id=118387&Code=2iL8ULp5lVA5oSXMRiLp"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-enamad.png" alt=''></a></div>
      <div class="c3 s4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="http://qom.irannsr.org/index.php?module=cdk&func=loadmodule&system=cdk&sismodule=user/content_view.php&cnt_id=225820&ctp_id=61&id=17394&sisOp=view"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-nsr.png" alt=''></a></div>
      <!-- <div class="c3 s4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href=""><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-brand.png" alt=''></a></div> -->
      <div class="c3 s4"><img data-src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-samandehi.png" alt='' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=460, height=600, top=30")'></div>
    </div>
  </div>
</section>
<?php } ?>

<section id="jibresSupportLine">
    <h3><?php echo T_('Need Help?'). ' '. T_("We're here for you."); ?></h3>
    <a class="btn lg success" href="<?php echo $kingdom; ?>/contact"><?php echo T_('Contact with a Live Person'); ?></a>
</section>

<div id="jibresFooter">
  <div class="avand">
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
      <figcaption class="c s12"><?php echo \dash\face::intro(); ?> <a href="<?php echo $kingdom; ?>/about"><?php echo T_('Learn more about Jibres'); ?></a></figcaption>
    </figure>


    <div class="f">

        <div class="f" id="footerMenu">

          <nav class="c3 s12 pLR10 items">
            <ul>
              <li><h3><?php echo T_('eCommerce'); ?></h3></li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/benefits">
                  <div class="key"><?php echo T_('Benefits'); ?></div>
                  <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/pricing">
                  <div class="key"><?php echo T_('Pricing'); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <?php
          if (false)
          {
          ?>

          <nav class="c3 s12 pLR10 items">
            <ul>
              <li><h3><?php echo T_('Domains'); ?></h3></li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/domain">
                <div class="key"><?php echo T_('Domain Name Search'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/domain/transfer">
                <div class="key"><?php echo T_('Transfer Domain'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/whois">
                <div class="key"><?php echo T_('Whois Lookup'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <?php
          } // endif
          ?>


          <nav class="c3 s12 pLR10 items">
            <ul>
              <li><h3><?php echo T_('Support'); ?></h3></li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/support">
                <div class="key"><?php echo T_('Support Center'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/contact">
                <div class="key"><?php echo T_('Contact'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/support/faq">
                <div class="key"><?php echo T_('FAQ'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="https://status.jibres.com" target="_blank" rel="nofollow noopener">
                <div class="key"><?php echo T_('System Status'); ?> <span class="mLa5 sf-external-link"></span></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/support/ticket/add">
                <div class="key"><?php echo T_('Submit Ticket'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/support/ticket/add?type=bug">
                <div class="key"><?php echo T_('Report Bug'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/support/ticket/add?type=feedback">
                <div class="key"><?php echo T_('Send us Feedback'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c3 s12 pLR10 items">
            <ul>
              <li><h3><?php echo T_('Resources'); ?></h3></li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/blog">
                <div class="key"><?php echo T_('Blog'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/terms">
                <div class="key"><?php echo T_('Terms of Service'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/privacy">
                <div class="key"><?php echo T_('Privacy Policy'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/changelog">
                <div class="key"><?php echo T_('Changelog'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/certificates">
                <div class="key"><?php echo T_('Certificates'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/socialresponsibility">
                <div class="key"><?php echo T_('Social Responsibility'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c3 s12 pLR10 items">
            <ul>
              <li><h3><?php echo T_('Jibres Company'); ?></h3></li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/about">
                <div class="key"><?php echo T_('About Jibres'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/mission">
                <div class="key"><?php echo T_('Jibres Mission'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/vision">
                <div class="key"><?php echo T_('Jibres Vision'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/values">
                <div class="key"><?php echo T_('Our Values'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/team">
                <div class="key"><?php echo T_('Our Team'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" target="_blank" href="<?php echo $kingdom; ?>/careers">
                <div class="key"><?php echo T_('Careers'); ?> <span class="mLa5 sf-external-link"></span></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/logo">
                <div class="key"><?php echo T_('Jibres Logo'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/brand">
                <div class="key"><?php echo T_('Brand Styleguide'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/press">
                <div class="key"><?php echo T_('Press and Media'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>
        </div>
    </div>

    <div id="jibresLastLine" class="f align-center">
      <div id="jibresCopyright" class="cauto s12">&copy; <?php echo \dash\datetime::fit(null, 'Y'). '. '. T_('All rights reserved.'). ' '. T_('Jibres, LLC'). ' ' ; ?>&reg;</div>
      <nav class="c s12 langlist"><?php
        if(\dash\language::current() == 'fa')
        {
          echo "<a hreflang='en' target='_blank' rel='follow noopener' href='https://jibres.com'>English <span class='mLa5 sf-external-link'></span></a>";
        }
        else
        {
          echo "<a hreflang='fa' target='_blank' rel='follow noopener' href='https://jibres.ir'>فارسی <span class='mLa5 sf-external-link'></span></a>";
        }
      ?></nav>
      <nav class="cauto s12 os share1">
        <a target="_blank" rel="nofollow noopener" href="https://www.facebook.com/jibres" class="facebook">Become a Jibres fan on facebook</a>
        <a target="_blank" rel="nofollow noopener" href="https://twitter.com/jibres_com" class="twitter">Follow Jibres on Twitter</a>
        <a target="_blank" rel="nofollow noopener" href="https://linkedin.com/jibres_com" class="linkedin">Connect to Jibres on Linkedin</a>
        <a target="_blank" rel="nofollow noopener" href="https://github.com/jibres" class="github">Connect to Jibres on Github</a>
        <a target="_blank" rel="nofollow noopener" href="https://t.me/jibres" class="telegram">Join Jibres Telegram Channel</a>
        <a target="_blank" rel="nofollow noopener" href="https://instagram.com/jibres_com" class="instagram">Follow Jibres on Instagram</a>
      </nav>
    </div>


  </div>
</div>






<div id="jibresBottomLine"></div>