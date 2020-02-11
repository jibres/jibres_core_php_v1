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
{%if lang.current =='fa'%}
        <a hreflang="en" data-direct href="https://jibres.com">English</a>
{%else%}
        <a hreflang="fa" data-direct href="https://jibres.ir">فارسی</a>
{%endif%}
      </nav>
    </div>

      <nav class="c s12 txtC">
{%if lang.current =='fa'%}
        <div class="certification">
         <div class="f">
          <div title='{%trans "Iran NSR Certification"%}'><a target="_blank" href="http://qom.irannsr.org/index.php?module=cdk&func=loadmodule&system=cdk&sismodule=user/content_view.php&cnt_id=225820&ctp_id=61&id=17394&sisOp=view"><img src="<?php echo \dash\url::static(); ?>/siftal/images/cert/irannsr.png" alt='{%trans "Iran NSR"%} Jibres'></a></div>
{%if url.domain == 'jibres.ir' or url.tld == "local"%}
          <div title='{%trans "Enamad Certification"%}'><img src="<?php echo \dash\url::static(); ?>/siftal/images/cert/enamad2.png" alt='{%trans "Enamad"%} Jibres' onclick='window.open("https://trustseal.enamad.ir/Verify.aspx?id=118387&amp;p=ZXabMoTvlxGEFbR7", "Popup","toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=720, top=30")'></div>

          <div title='{%trans "Samandehi Certification"%}'><img src="<?php echo \dash\url::static(); ?>/siftal/images/cert/samandehi.png" alt='{%trans "Samandehi"%} Jibres' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=162977&p=rfthgvkauiwkpfvljyoejyoe", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=460, height=600, top=30")'></div>
{%elseif url.domain == 'jibres.com' or url.tld == "local"%}
          <div title='{%trans "Enamad Certification"%}'><img src="<?php echo \dash\url::static(); ?>/siftal/images/cert/enamad2.png" alt='{%trans "Enamad"%} Jibres' onclick='window.open("https://trustseal.enamad.ir/Verify.aspx?id=77836&p=JOoynuxYPaV1q5Zq", "Popup","toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=720, top=30")'></div>

          <div title='{%trans "Samandehi Certification"%}'><img src="<?php echo \dash\url::static(); ?>/siftal/images/cert/samandehi.png" alt='{%trans "Samandehi"%} Jibres' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=110459&p=rfthrfthobpdaodsdshwpfvl", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=460, height=600, top=30")'></div>

{%endif%}
          <div title='{%trans "Shamad Certification"%}'><img src="<?php echo \dash\url::static(); ?>/siftal/images/cert/shamad.png" alt='{%trans "Shamad"%} Jibres' onclick='window.open("https://logo.saramad.ir/verify.aspx?CodeShamad=1-2-709257-65-2-3", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=500, height=700, top=0")'></div>
         </div>
        </div>
{%endif%}
     </nav>

    <div class="cauto s12 love"><a href="{%if lang.current =='fa'%}https://ermile.com/fa{%else%}https://ermile.com{%endif%}" target="_blank">{%trans "Proudly Made in IRAN"%}</a></div>
   </div>

  </div>
 </footer>