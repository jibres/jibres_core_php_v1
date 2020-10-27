
<section id="homeLanding">
  <div class="avand-sm">
    <h2 class="bold"><?php echo T_('Everything you need to sell online'); ?></h2>

    <?php if(!\dash\user::login()) {?>
    <form class="row" method="post" autocomplete="off" action="<?php echo \dash\url::kingdom(). '/enter/hi' ?>">
      <div class="c-xs-12 c-sm-8 c-lg-8">
        <input class="input" type="tel" data-format="mobile-enter" maxlength="15" name="mobile" placeholder="<?php echo T_("Enter your mobile number") ?>">
      </div>
      <div class="c-xs-12 c-sm-4 c-lg-4">
        <button class="btn3"><?php echo T_("Go") ?></button>
      </div>
    </form>
  <?php } // endif ?>
    <p><?php echo T_("Try Jibres for free, and explore all services you need to start, run, and grow your business."); ?></p>

  </div>
</section>


<section class="jibresBanner" id="jibresChannel">
  <div class="avand">
    <div class="row padMore">
      <div class="c-xs-12 c-sm-12 c-lg-6">
        <a class="channel" href="<?php echo \dash\url::kingdom() ?>/" data-type='website'>
          <h2><?php echo T_('Online Store Website'); ?></h2>
          <p><?php echo T_('Online store builder allow you robust your business in a faster way, simpler way!'); ?></p>
        </a>
      </div>

      <div class="c-xs-12 c-sm-12 c-lg-6">
        <a class="channel" href="<?php echo \dash\url::kingdom() ?>/" data-type='app'>
          <h2><?php echo T_('Mobile Online Store'); ?></h2>
          <p><?php echo T_('Create mobile app for your online store.'); ?> <?php echo T_('Free'). T_(', '). T_('Fully Customizable'); ?>.</p>
        </a>
      </div>

      <div class="c-xs-12 c-sm-12 c-lg-6">
        <a class="channel" href="<?php echo \dash\url::kingdom() ?>/" data-type='pos'>
          <h2><?php echo T_('Point of Sale Software'); ?></h2>
          <p><?php echo T_('Barcode reader'). T_(', '). T_('Receipt printer'). T_(', '). T_('PC POS'). T_(', '). T_('Label Printing Scale'). T_(', '). T_('Invoice Software'); ?>.</p>
        </a>
      </div>

      <div class="c-xs-12 c-sm-12 c-lg-6">
        <a class="channel" href="<?php echo \dash\url::kingdom() ?>/" data-type='social'>
          <h2><?php echo T_('Social Marketing'); ?></h2>
          <p><?php echo T_('Easily add ecommerce to any website and social networks by embedding a single buy button.'); ?></p>
        </a>
      </div>
    </div>

    <div class="txtC mT10">
      <a class="hey" href="<?php echo \dash\url::kingdom() ?>/about"><div class="inside"><?php echo T_('By use each sales channel on Jibres, you can keep track of your products, orders, and customers in one place.'); ?></div></a>
    </div>

  </div>
</section>





<section id='saleChannels'>
 <div class="avand-lg impact">
  <div class="f">
    <h3><?php echo T_("Start your online business"); ?></h3>
    <h4><?php echo T_('No.1 Free eCommerce Solution') ?></h4>
  </div>
 </div>
</section>

<?php if(\dash\language::current() === 'fa') {?>
<section id="jibresDomain">
  <div class="avand-md">
   <h2><a href="<?php echo \dash\url::kingdom() ?>/domains"><?php echo T_("Jibres Domain Center"); ?></a></h2>
   <div class="domainQuickBuy box">
    <h3 class="mB10"><?php echo T_("Get your :val .IR domain", ["val" => "<span class='txtB'>". \dash\fit::number(\dash\data::domainPrice_ir1year()). ' '. \lib\currency::unit(). '</span>'] ); ?></h3>
    <form method="get" action="<?php echo \dash\url::kingdom(); ?>/domains/search" autocomplete='off'>
     <div class="input">
      <input type="text" name="q" autocomplete="off" maxlength="65" placeholder='<?php echo T_('Search for your dream domain') ?>'>
      <button class="addon btn primary"><span class="s0 mLa5"><?php echo T_("Register Domain"); ?></span><span class="sf-search"></span></button>
     </div>
    </form>
   </div>
   <p class="txtC fc-mute"><?php echo T_('Every website starts with a great domain name. Jibres offers cheap domain names with the most reliable service. Buy domain names with Jibres and see why we are cool!'); ?></p>
  </div>
</section>
<?php }?>



<section id='statistic'>
  <div class="avand">
    <h3 class="txtC txtB mB100 fs30" title="<?php echo T_('Of course Made with love 😍'); ?>"><?php echo T_('Jibres has created for futuristic entrepreneurs'); ?><span>❤️</span></h3>
    <div class="f txtC">
      <div class="c s12 pA10">
          <div class="fs50"><?php echo \dash\fit::stats(\dash\data::homepagenumber_product()) ?>+</div>
          <div class="font-14"><?php echo T_('Products'); ?></div>
      </div>
      <div class="c s12 pA10">
          <div class="fs50"><?php echo \dash\fit::stats(\dash\data::homepagenumber_factor()) ?>+</div>
          <div class="font-14"><?php echo T_('Factor'); ?></div>
      </div>
      <div class="c s12 pA10">
          <div class="fs40"><?php echo \dash\fit::stats(\dash\data::homepagenumber_sum_factor()) ?>+</div>
          <div class="font-14"><?php echo T_('Sold on Jibres'); ?></div>
      </div>
    </div>
  </div>
</section>


<section id="jibresInvoice">
  <div class="avand">
    <div class="row align-center">
      <div class="c-xs-12 c-sm-6">
        <h3><?php echo T_("Create an Invoice You're Proud Of"); ?></h3>
      </div>
      <div class="c-xs-12 c-sm-6">
        <h2><?php echo T_("Invoice your customers in seconds"); ?></h2>
        <p><?php echo T_("Create, send, and track professional invoices in seconds. Customize awesome invoices to reflect your brand and increase your customer's trust. Add your company logo, personalize the free invoice template, and create impressive invoices and estimates within seconds."); ?></p>
        <p><?php echo T_("Looking to send an invoice right now? Use Jibres online invoice generator to be more productive. Create and send a beautiful invoice from any device, anytime.") ?></p>

        <p><?php echo T_("Your account is always connected and your data is saved securely for you. Send invoices via email, SMS, and Telegram. Just one click and your invoice gets sent to your client.") ?></p>
      </div>
    </div>
  </div>
</section>


<section id="jibresForm">
  <div class="avand-md">
    <h2><?php echo T_("Free Online Form Builder"); ?></h2>

    <p><?php echo T_("Let us handle your data collection. Focus on the work that can't be automated. Create beautiful online forms without any technical knowledge. Jibres form builder allows you to quickly create efficient forms that are easy to take and get higher completion rates."); ?></p>
    <p><?php echo T_("Design professional forms with Jibres Online Form Builder. Customize to match your branding. Create a form to register in style, get contact details, or to collect feedback.") ?></p>

    <h5 class="txtB"><?php echo T_("100% Free"); ?></h5>
    <p><?php echo T_("Every form has its URL, so you can share the form with or without your own website. Create forms and surveys that people enjoy answering with Jibres.") ?></p>

    <h5 class="txtB"><?php echo T_("Reduce paper usage") ?></h5>
    <p><?php echo T_("Don't let paperwork slow you down anymore. Jibres Forms will increase your efficiency by automating tiresome manual tasks. You'll never have to waste paper and your valuable time again. Sit back and watch your work flow.") ?></p>
  </div>
</section>

<section id="jibresFeatures">
  <div class="avand-lg">
    <h3><?php echo T_("All-in-one Commerce Solution for your Business"); ?></h3>
    <div class="row">
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="<?php echo \dash\url::kingdom(); ?>">
          <i class="sf-lamp"></i>
          <h4><?php echo T_("SEO Optimized"); ?></h4>
          <p><?php echo T_("Billions of searches are conducted online every single day. Many people search for specific products and services with the intent to pay for these things."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="<?php echo \dash\url::kingdom(); ?>">
          <i class="sf-database"></i>
          <h4><?php echo T_("Fully Hosted"); ?></h4>
          <p><?php echo T_("We are maintain your store files and data in the cloud. You would not need to setup your own server, we are storing your data for you."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="<?php echo \dash\url::kingdom(); ?>">
          <i class="sf-unlock-alt"></i>
          <h4><?php echo T_("Free SSL Certificate"); ?></h4>
          <p><?php echo T_("SSL Protection For Anyone."); ?></p><p><?php echo T_("Protect you information, generate trust and improve Search Engine Ranking.") ?></p>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="<?php echo \dash\url::kingdom(); ?>">
          <i class="sf-card"></i>
          <h4><?php echo T_("Accept Credit Cards"); ?></h4>
          <p><?php echo T_("It's easy to accept various payment options in Jibres, including PayPal, Credit Cards and other offline methods."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="<?php echo \dash\url::kingdom(); ?>">
          <i class="sf-server-accept"></i>
          <h4><?php echo T_("Fully API"); ?></h4>
          <p><?php echo T_("API gives you full creative control to add Jibres buying experiences anywhere your customers are, including websites, apps, and social networks."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="<?php echo \dash\url::kingdom(); ?>">
          <i class="sf-heart"></i>
          <h4><?php echo T_("Premium Support"); ?></h4>
          <p><?php echo T_("With the Most Helpful Humans in the world, You're Never Alone."); ?></p><p><?php echo T_("Rely on our 24/7/365 Human Support.") ?></p>
        </a>
      </div>
    </div>
  </div>
</section>


<section id="jibresApp">
  <div class="avand-lg">
    <div class="row">
      <div class="c-xs-0 c-sm-0 c-lg-5"><figure><img src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-app.png" alt='<?php echo T_("Download Jibres App") ?>'></figure></div>
      <div class="c-xs-12 c-sm-12 c-lg-7 text">
        <h2><?php echo T_("Jibres Mobile App"); ?></h2>
        <p><?php echo T_("No matter where you are, Jibres stays in sync across all of your devices."); ?></p>

        <div class="dl">
          <a href="<?php echo \dash\url::kingdom(); ?>/app/android" title='<?php echo T_("Download Jibres App from Google play") ?>' target="_blank" rel="noopener">
<?php if(\dash\language::current() === 'fa') {?>
            <img src="<?php echo \dash\url::cdn(); ?>/img/app/get/googleplay-fa.png" alt='<?php echo T_("Jibres app on Google play") ?>'>
<?php } else {?>
            <img src="<?php echo \dash\url::cdn(); ?>/img/app/get/googleplay.png" alt='<?php echo T_("Jibres app on Google play") ?>'>
<?php }?>
          </a>
          <a href="<?php echo \dash\url::kingdom(); ?>/app/direct" title='<?php echo T_("Direct download Jibres app") ?>'>
<?php if(\dash\language::current() === 'fa') {?>
            <img src="<?php echo \dash\url::cdn(); ?>/img/app/get/downloadapk-fa.png" alt='<?php echo T_("Direct download Jibres app") ?>'>
<?php } else {?>
            <img src="<?php echo \dash\url::cdn(); ?>/img/app/get/downloadapk.png" alt='<?php echo T_("Direct download Jibres app") ?>'>
<?php }?>
          </a>
        </div>

      </div>
    </div>
  </div>
</section>


<section id='keepitsimple'>
 <div class="title">
  <h3 title='<?php echo T_('Simplest forever'); ?>'><?php echo T_('Keep it simple'); ?></h3>
  <p><?php echo T_('Simplicity is the ultimate sophistication'); ?></p>
  <p><?php echo T_('No one can fulfill your e-commerce needs like us'); ?> <span>💪</span></p>
 </div>

 <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
  <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
  <g class="parallax">
   <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.5)" />
   <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.3)" />
   <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.1)" />
   <use xlink:href="#gentle-wave" x="48" y="7" fill="#f7fafc" />
  </g>
 </svg>
</section>



<?php if(\dash\data::quote()) { ?>
<section id='jibresQuote'>
  <div class="avand">
    <h4><?php echo T_("Our Happy Friends!"); ?></h4>
    <div class="row padMore">
<?php foreach (\dash\data::quote() as $key => $value) {?>
      <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4 itemBox">
        <div class="item f f-column justify-between">
          <p class="flex-1"><?php echo $value['quote']; ?></p>
          <div class="shapeTop"></div>
          <div class="fiveStar"><span></span><span></span><span></span><span></span><span></span></div>
          <footer class="f align-center from">
            <div class="cauto"><img src="<?php echo \dash\url::cdn(); ?>/img/quote/50px/<?php echo $value['avatar']; ?>-50px.jpg" srcset="<?php echo \dash\url::cdn(); ?>/img/quote/<?php echo $value['avatar']; ?>.jpg 2x" alt='<?php echo $value['name']; ?>'></div>
            <div class="cauto pLa10">
              <div class="name"><?php echo $value['name']; ?></div>
              <div class="position"><?php echo $value['position']; ?></div>
            </div>
          </footer>
        </div>
      </div>
<?php } ?>
    </div>
  </div>
</section>
<?php } ?>

<div class="keywords hide">
  <span>[dfvs</span>
  <span>pdfvs</span>
  <span>]fvs</span>
  <span>jipres</span>
  <span>jeebres</span>
  <span>[d,vs</span>
  <span>tv,a</span>
  <span>gnj</span>
  <span>تهذقثس</span>
  <span>چیبرس</span>
  <span>جیب رس</span>
  <span>تهحقثس</span>
  <span>سشمث</span>
</div>


<section id='jibresPrivacy'>
  <div class="avand-md">
    <div class="securitySign"></div>
    <h3><a href="<?php echo \dash\url::kingdom() ?>/privacy"><?php echo T_("Security & Privacy") ?></a></h3>
    <p><?php echo T_("Privacy is at the core of everything we do. We are here to protect your information. Privacy is one of our most important core values. In a world of increasing complexity we firmly believe your data is yours and yours alone.") ?></p>
  </div>
</section>

