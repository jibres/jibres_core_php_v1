<?php
$kingdom = \dash\url::kingdom();
if(\dash\language::current() === 'fa' && \dash\url::module() !== 'certificates')
{
?>
<section id="jibresCertificates">
  <div class="avand-md">
    <h2><a href="<?php echo \dash\url::kingdom() ?>/certificates"><?php echo T_('Jibres Certificates'); ?></a></h2>
    <div class="f">
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://pub.daneshbonyan.ir/"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-daneshbonyan.png" alt='دانش‌بنیان - جیبرس'></a></div>
      <!-- <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://shaparak.com/tips/%D8%B4%D8%B1%DA%A9%D8%AA-%D9%87%D8%A7%DB%8C-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%DB%8C%D8%A7%D8%B1"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bank-markazi.png" alt='جیبرس پرداخت یار رسمی بانک مرکزی '></a></div> -->
      <!-- <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://shaparak.com/tips/%D8%B4%D8%B1%DA%A9%D8%AA-%D9%87%D8%A7%DB%8C-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%DB%8C%D8%A7%D8%B1"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-shaparak.png" alt='جیبرس دارای مجوز ارائه درگاه پرداخت اینترنتی'></a></div> -->
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" href="<?php echo \dash\url::kingdom(); ?>/certificates"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bmn.png" alt='بنیاد ملی نخبگان'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://www.nic.ir/List_of_Resellers"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-irnic.png" alt='جیبرس نماینده رسمی ایرنیک'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="https://trustseal.enamad.ir/?id=118387&Code=2iL8ULp5lVA5oSXMRiLp"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-enamad.png" alt='جیبرس دارای نماد اعتماد الکترونیکی'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="http://qom.irannsr.org/index.php?module=cdk&func=loadmodule&system=cdk&sismodule=user/content_view.php&cnt_id=225820&ctp_id=61&id=17394&sisOp=view"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-nsr.png" alt='جیبرس عضو رسمی سازمان نظام صنفی رایانه'></a></div>
      <!-- <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href=""><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-brand.png" alt='جیبرس برند ثبت شده'></a></div> -->
      <div class="c3 s6 ph4"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-samandehi.png" alt='جیبرس دارای نماد ساماندهی' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=460, height=600, top=30")'></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" href="<?php echo \dash\url::kingdom(); ?>/certificates"><img src="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-chambertrust.png" alt='جیبرس عضو اتاق بازرگانی ایران'></a></div>
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
        <img src="<?php echo \dash\url::cdn();
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

          <nav class="c s12 ph12 m6 pLR10 items simple">
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
              <li>
                <a class="f" href="<?php echo \dash\url::api('developers'); ?>/" target="_blank" rel='follow noopener'>
                  <div class="key"><?php echo T_('Developers API'); ?></div>
                  <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c s12 ph12 m6 pLR10 items simple">
            <ul>
              <li><h3><?php echo T_('Domain Center'); ?></h3></li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/domains">
                <div class="key"><?php echo T_('Domain Name Search'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/domains/search">
                <div class="key"><?php echo T_('Buy new domain'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/my/domain/transfer">
                <div class="key"><?php echo T_('Transfer Domain'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/my/domain/renew">
                <div class="key"><?php echo T_('Renew your Domain'); ?></div>
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

          <nav class="c s12 ph12 m6 pLR10 items simple">
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
                <a class="f" href="<?php echo $kingdom; ?>/status">
                <div class="key"><?php echo T_('System Status'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="f" href="<?php echo $kingdom; ?>/support/ticket/add?type=feedback">
                <div class="key"><?php echo T_('Send us Feedback'); ?></div>
                <div class="go"></div>
                </a>
              </li>

              <li>
                <a class="f" href="<?php echo $kingdom; ?>/bug">
                <div class="key"><?php echo T_('Jibres Bug Program'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c s12 ph12 m6 pLR10 items simple">
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

          <nav class="c s12 ph12 m6 pLR10 items simple">
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
                <a class="f" href="<?php echo $kingdom; ?>/careers">
                <div class="key"><?php echo T_('Careers'); ?></div>
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
      <nav class="c s12 pLR10 langlist"><?php
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
<?php if (\dash\url::tld() === 'ir') {?>
        <a target="_blank" rel="nofollow noopener" href="https://twitter.com/MyJibres" class="twitter">Follow Jibres on Twitter</a>
<?php } else { ?>
        <a target="_blank" rel="nofollow noopener" href="https://twitter.com/JibresDotCom" class="twitter">Follow Jibres on Twitter</a>
<?php } ?>
        <a target="_blank" rel="nofollow noopener" href="https://www.linkedin.com/company/jibres/" class="linkedin">Connect to Jibres on Linkedin</a>
        <a target="_blank" rel="nofollow noopener" href="https://github.com/jibres" class="github">Connect to Jibres on Github</a>
        <a target="_blank" rel="nofollow noopener" href="https://t.me/jibres" class="telegram">Join Jibres Telegram Channel</a>
        <a target="_blank" rel="nofollow noopener" href="https://instagram.com/JibresDotCom" class="instagram">Follow Jibres on Instagram</a>
      </nav>
    </div>
  </div>
</div>






<div id="jibresBottomLine"></div>