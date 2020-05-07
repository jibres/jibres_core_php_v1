<div class="jibresBanner">
 <div class="avand impact">

  <h2 class="txtC"><?php echo T_('Search for your dream domain'); ?></h2>
  <form class="domainSearchBox" action='<?php echo \dash\url::kingdom() ?>/domains/search' method='get' autocomplete='off'>
   <p class="txtC"><?php echo T_('Every website starts with a great domain name'); ?></p>
  <div class="input ltr">
   <input type="search" name="q" id='domainFirstSearch' maxlength='63' autocomplete='off' <?php if (!\dash\detect\device::detectPWA() && 0) echo 'autofocus'?>>
   <button class="addon btn primary"><?php echo T_('Search'); ?></button>
  </div>
 </form>


  <section class="tripleDomainService">
   <div class="f">
    <div class="c4 s12 mB10 pRa10">
     <div class="item f f-column">
      <h3><?php echo T_('Register Domain'); ?></h3>
      <p class="flex-1"><?php echo T_('Been dreaming of a .com or .dev that says exactly what you want to say about your business? Find that perfect domain name and get it registered today!'); ?></p>
      <a class="btn block light" href="<?php echo \dash\url::kingdom() ?>/domains/search"><?php echo T_('Find my Domain'); ?></a>
     </div>
    </div>
    <div class="c4 s12 mB10 pRa10">
     <div class="item f f-column">
      <h3><?php echo T_('Transfer'); ?></h3>
      <p class="flex-1"><?php echo T_('Transfer your domains to Jibres and save on renewals. Most domains come with an extra year of registration added during the transfer process free of charge.'); ?></p>
      <a class="btn block light" href="<?php echo \dash\url::kingdom() ?>/my/domain/transfer"><?php echo T_('Transfer Now'); ?></a>
     </div>
    </div>
    <div class="c4 s12 mB10">
     <div class="item f f-column">
      <h3><?php echo T_('Renew'); ?></h3>
      <p class="flex-1"><?php echo T_("Searching for the lowest domain renew price? That's it. Jibres offer exclusive offer on renew domains at prices that won't break your budget. We are the best of best:)"); ?></p>
      <a class="btn block light" href="<?php echo \dash\url::kingdom() ?>/my/domain/renew"><?php echo T_('Renew Domain'); ?></a>
     </div>
    </div>
   </div>
  </section>


  <section>
   <div class="f">
    <div class="c6 s12 pRa20">
     <h3><?php echo T_('Find your winning domain'); ?></h3>
     <p><?php echo T_("When you register a domain, you're not just getting a web address. It's a vital piece of your online presence. Your domain name carries your brand, your public image, and your professional reputation. It's the first thing people see when they visit you, so buying a domain name registration means making some important decisions."); ?></p>

    </div>
    <div class="c6 s12">
     <h3><?php echo T_('How to find a good domain name'); ?></h3>
     <p><?php echo T_('A domain name represents your business or personal brand on the web, which means choosing the right one is important. Brainstorming is a great place to start, so grab your pen and jot down some words related to your idea.'); ?></p>
    </div>
   </div>
  </section>

 </div>
 <div class="avand impact">
  <h3><?php echo T_("Jibres Domain Pricing Comparison"); ?></h3>
  <table class="tbl1 v5">
    <thead>
      <tr>
        <td><?php echo ""; ?></td>
        <td><?php echo T_(".ir 1 year"); ?></td>
        <td><?php echo T_(".ir 5 Year"); ?></td>
        <td><?php echo T_(".com 1 year"); ?></td>
        <td><?php echo T_("Auto Renew"); ?></td>
        <td><?php echo T_("Beautiful Panel"); ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo T_("Jibres"); ?></td>
        <td><?php echo \dash\fit::number("5000"); ?></td>
        <td><?php echo \dash\fit::number("15000"); ?></td>
        <td><?php echo T_("Soon"); ?></td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <td>ایران سرور</td>
        <td><?php echo \dash\fit::number("6000"); ?></td>
        <td><?php echo \dash\fit::number("15000"); ?></td>
        <td><?php echo \dash\fit::number("149000"); ?></td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>پارس پک</td>
        <td><?php echo \dash\fit::number("7000"); ?></td>
        <td><?php echo \dash\fit::number("20000"); ?></td>
        <td><?php echo \dash\fit::number("159000"); ?></td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>آذر آنلاین</td>
        <td><?php echo \dash\fit::number("7900"); ?></td>
        <td><?php echo \dash\fit::number("29000"); ?></td>
        <td><?php echo \dash\fit::number("140000"); ?></td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>هاست ایران</td>
        <td><?php echo \dash\fit::number("12000"); ?></td>
        <td><?php echo \dash\fit::number("36000"); ?></td>
        <td><?php echo \dash\fit::number("198000"); ?></td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>ایران هاست</td>
        <td><?php echo \dash\fit::number("16000"); ?></td>
        <td><?php echo \dash\fit::number("48000"); ?></td>
        <td><?php echo \dash\fit::number("219000"); ?></td>
        <td>❌</td>
        <td>❌</td>
      </tr>

    </tbody>
  </table>
 </div>

 <section class="forDevelopers">
  <h3><?php echo T_('Built By Developers, For Developers.'); ?></h3>
  <img class="dreamRider" src='<?php echo \dash\url::cdn() ?>/img/domain/jibres-dream-rider.gif' alt='Jibres Dream Rider'>
 </section>


<?php include "definition.php"; ?>
<?php include "faq.php"; ?>

</div>
