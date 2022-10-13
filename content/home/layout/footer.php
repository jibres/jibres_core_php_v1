<?php
$kingdom = \dash\url::kingdom();
if(\dash\language::current() === 'fa' && \dash\url::module() !== 'certificates' && !\dash\agent::isBot())
{
?>
<section id="jibresCertificates">

  <div class="avand-md">
    <h3><a href="<?php echo $kingdom ?>/certificates"><?php echo T_('Jibres Certificates'); ?></a></h3>
    <div class="f">
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="<?php echo $kingdom ?>/certificates/daneshbonyan"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-daneshbonyan-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-daneshbonyan.png 2x" alt='دانش‌بنیان - جیبرس'></a></div>
<?php if(0) {?>
      <!-- <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="<?php echo $kingdom ?>/certificates/shaparak"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-cbi-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-cbi.png  2x" alt='جیبرس پرداخت یار رسمی بانک مرکزی '></a></div> -->
      <!-- <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="<?php echo $kingdom ?>/certificates/shaparak"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-shaparak-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-shaparak.png  2x" alt='جیبرس دارای مجوز ارائه درگاه پرداخت اینترنتی'></a></div> -->
<?php }?>
      <div class="c3 s6 ph4"><a tabindex='-1'><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-bmn-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-bmn.png  2x" alt='بنیاد ملی نخبگان'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="<?php echo $kingdom ?>/certificates/irnic"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-irnic-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-irnic.png  2x" alt='جیبرس نماینده رسمی ایرنیک'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="<?php echo $kingdom ?>/certificates/enamad"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-enamad-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-enamad-1.png  2x" alt='جیبرس دارای نماد اعتماد الکترونیکی'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' target="_blank" rel='nofollow noopener' href="<?php echo $kingdom ?>/certificates/nsr"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-nsr-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-nsr.png  2x" alt='جیبرس عضو رسمی سازمان نظام صنفی رایانه'></a></div>
      <div class="c3 s6 ph4"><a tabindex='-1' href="<?php echo $kingdom ?>/brand"><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-brand-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-brand.png  2x" alt='جیبرس برند ثبت شده'></a></div>

<?php if(true) {?>
      <div class="c3 s6 ph4"><a tabindex='-1'><img id="samandehiCert" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-samandehi-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-samandehi.png  2x" alt='جیبرس دارای نماد ساماندهی' data-open="https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe"></a></div>
<?php } else { ?>
      <div class="c3 s6 ph4"><a tabindex='-1'><img id="samandehiCert" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-samandehi-silver-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-samandehi-silver.png  2x" alt='جیبرس دارای نماد ساماندهی' data-open="https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe"></a></div>
<?php } //endif ?>
      <div class="c3 s6 ph4"><a tabindex='-1'><img loading="lazy" src="<?php echo \dash\url::cdn(); ?>/img/certificates/200px/jibres-certificate-chambertrust-200px.png" srcset="<?php echo \dash\url::cdn(); ?>/img/certificates/jibres-certificate-chambertrust.png  2x" alt='جیبرس عضو اتاق بازرگانی ایران'></a></div>
    </div>
  </div>
</section>
<?php } ?>

<section id="jibresSupportLine">
    <h4><?php echo T_('Need Help?'). ' '. T_("We're here for you."); ?></h4>
    <a class="btn-success btn-lg m-4" href="<?php echo $kingdom; ?>/contact"><?php echo T_('Contact with a Live Person'); ?></a>
    <?php echo file_get_contents(root."content/home/layout/footer-wave.svg"); ?>
</section>

<div id="jibresFooter">
  <div class="avand">
    <figure class="f align-center logo">
      <a class="cauto s12" href="<?php echo \dash\url::homepage(); ?>"><?php
if (\dash\language::current() === 'fa')
{
  echo file_get_contents(root."content/home/layout/brand-vertical-fa.svg");
}
else
{
  echo file_get_contents(root."content/home/layout/brand-vertical-en.svg");
}
       ?></a>
      <figcaption class="c s12"><?php echo T_("Integrated Ecommerce Platform Software") ?> / <?php echo T_("Quickly Start Free! Online Store Website & Mobile Online Store & Social Marketing & POS Software"); ?> / <?php echo T_("Accept Credit Cards - Fully Hosted - SEO Optimized - SSL Certificate - Fully API.") ?> <a href="<?php echo $kingdom; ?>/about"><?php echo T_('Learn more about Jibres'); ?></a></figcaption>
    </figure>


    <div class="f">
        <div class="f" id="footerMenu">

          <nav class="c s12 ph12 m6 pLR10 items long simple">
            <ul>
              <li class="title"><?php echo T_('eCommerce'); ?></li>
                <li>
                    <a class="item f" href="<?php echo $kingdom; ?>/pricing">
                        <div class="key"><?php echo T_('Pricing'); ?></div>
                        <div class="go"></div>
                    </a>
                </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/benefits">
                  <div class="key"><?php echo T_('Benefits'); ?></div>
                  <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo \dash\url::api('developers'); ?>/" target="_blank" rel='noopener'>
                  <div class="key">API</div>
                  <div class="go external"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c s12 ph12 m6 pLR10 items long simple">
            <ul>
              <li class="title"><?php echo T_('Domain Center'); ?></li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/domains">
                <div class="key"><?php echo T_('Domain Name Search'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/domains/search">
                <div class="key"><?php echo T_('Buy new domain'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/my/domain/transfer">
                <div class="key"><?php echo T_('Transfer Domain'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/my/domain/renew">
                <div class="key"><?php echo T_('Renew your Domain'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li class="hidden">
                <a class="item f" href="<?php echo $kingdom; ?>/whois">
                <div class="key"><?php echo T_('Whois Lookup'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/domains/pricing">
                <div class="key"><?php echo T_('Domain Pricing'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c s12 ph12 m6 pLR10 items long simple">
            <ul>
              <li class="title"><?php echo T_('Support'); ?></li>
              <li>
                <a class="item f" href="<?php echo \dash\url::support(); ?>" target="_blank" rel='follow'>
                <div class="key"><?php echo T_('Support Center'); ?></div>
                <div class="go external"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/uptime" target="_blank" rel='nofollow noopener'>
                <div class="key"><?php echo T_('System Status'); ?></div>
                <div class="go external"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/contact">
                <div class="key"><?php echo T_('Contact'); ?></div>
                <div class="go"></div>
                </a>
              </li>
<?php if(0) {?>
              <li>
                <a class="item f" href="<?php echo \dash\url::support(); ?>/faq">
                <div class="key"><?php echo T_('FAQ'); ?></div>
                <div class="go"></div>
                </a>
              </li>
<?php }?>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/my/ticket/add?type=feedback">
                <div class="key"><?php echo T_('Send us Feedback'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/bug">
                <div class="key"><?php echo T_('Jibres Bug Program'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c s12 ph12 m6 pLR10 items long simple">
            <ul>
              <li class="title"><?php echo T_('Resources'); ?></li>
<?php if (\dash\url::tld() === 'ir') {?>
              <li>
                <a class="item f" target="_blank" href="https://blog.jibres.<?php if(\dash\language::current() == 'fa') {echo "ir";} else {echo "com";} ?>">
                <div class="key"><?php echo T_('Blog'); ?>  <i class="sf-external-link"></i></div>
                <div class="go"></div>
                </a>
              </li>
<?php } ?>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/terms">
                <div class="key"><?php echo T_('Terms of Service'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/privacy">
                <div class="key"><?php echo T_('Privacy Policy'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/changelog">
                <div class="key"><?php echo T_('Changelog'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/certificates">
                <div class="key"><?php echo T_('Certificates'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/socialresponsibility">
                <div class="key"><?php echo T_('Social Responsibility'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/logo">
                <div class="key"><?php echo T_('Jibres Logo'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/brand">
                <div class="key"><?php echo T_('Brand Style Guide'); ?></div>
                <div class="go"></div>
                </a>
              </li>
            </ul>
          </nav>

          <nav class="c s12 ph12 m6 pLR10 items long simple">
            <ul>
              <li class="title"><?php echo T_('Jibres Company'); ?></li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/story">
                <div class="key"><?php echo T_('Jibres Story'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/about">
                <div class="key"><?php echo T_('About Jibres'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/mission">
                <div class="key"><?php echo T_('Jibres Mission'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/vision">
                <div class="key"><?php echo T_('Jibres Vision'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/values">
                <div class="key"><?php echo T_('Our Values'); ?></div>
                <div class="go"></div>
                </a>
              </li>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/team">
                <div class="key"><?php echo T_('Our Team'); ?></div>
                <div class="go"></div>
                </a>
              </li>
<?php if(\dash\language::current() == 'fa' and 0) { ?>
              <li>
                <a class="item f" href="https://careers.jibres.ir">
                <div class="key"><?php echo T_('Careers'); ?></div>
                <div class="go"></div>
                </a>
              </li>
<?php } ?>
              <li>
                <a class="item f" href="<?php echo $kingdom; ?>/press">
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
          echo "<a hreflang='en' target='_blank' rel='noopener' href='https://jibres.com'>English <span class='inline-block mLa5 sf-external-link'></span></a>";
        }
        else
        {
          echo "<a hreflang='fa' target='_blank' rel='noopener' href='https://jibres.ir'>فارسی <span class='inline-block mLa5 sf-external-link'></span></a>";
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