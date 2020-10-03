
<section id="homeLanding">
  <div class="avand-sm">
    <h1 class="bold"><?php echo T_('Everything you need to sell online'); ?></h1>

    <form class="row" method="post" autocomplete="off" action="<?php echo \dash\url::kingdom(). '/enter/hi' ?>">
      <div class="c-xs-12 c-sm-8 c-lg-8">
        <input class="input" type="tel" data-format="mobile-enter" maxlength="15" name="mobile" placeholder="<?php echo T_("Enter your mobile number") ?>">
      </div>
      <div class="c-xs-12 c-sm-4 c-lg-4">
        <button class="btn3"><?php echo T_("Enter") ?></button>
      </div>
    </form>
    <p><?php echo T_("Try Jibres for free, and explore all services you need to start, run, and grow your business."); ?></p>

  </div>
</section>


<section class="jibresBanner" id='saleChannels'>
 <div class="avand-lg impact">
  <div class="f">
    <h2><?php echo T_("Start your online business"); ?></h2>
  </div>

  <div class="title mT20">
   <p><?php echo T_('Sales channels represent the different marketplaces where you sell your products.'); ?><br><?php echo T_('By use each sales channel on Jibres, you can keep track of your products, orders, and customers in one place.'); ?> <a href="<?php echo \dash\url::kingdom() ?>/about"><?php echo T_('Read more about Jibres'); ?></a></p>
  </div>
 </div>
</section>


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


<section class="jibresChannel">
  <div class="avand-lg">
    <div class="row padMore">
      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h2 class="bigCart row align-end"><?php echo T_('Online Store Website'); ?></h2>
      </div>
      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h3 class="bigCart bgBlue row align-end"><?php echo T_('Online store builder allow you robust your business in a faster way, simpler way!'); ?></h3>
      </div>

      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h2 class="bigCart bgJibres row align-end"><?php echo T_('Mobile Online Store'); ?></h2>
      </div>
      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h3 class="bigCart bgBlack row align-end"><?php echo T_('Create mobile app for your online store.'); ?> <?php echo T_('Free'). T_(', '). T_('Fully Customizable'); ?></h3>
      </div>

      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h2 class="bigCart bgBlue row align-end"><?php echo T_('Point of Sale Software'); ?></h2>
      </div>
      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h3 class="bigCart row align-end"><?php echo T_('Barcode reader'). T_(', '). T_('Receipt printer'). T_(', '). T_('PC POS'). T_(', '). T_('Label Printing Scale'). T_(', '). T_('Invoice Software'); ?></h3>
      </div>

      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h2 class="bigCart bgBlack row align-end"><?php echo T_('Social Marketing'); ?></h2>
      </div>
      <div class="c-xs-12 c-sm-12 c-lg-6">
        <h3 class="bigCart bgBlue row align-end"><?php echo T_('Easily add ecommerce to any website and social networks by embedding a single buy button.'); ?></h3>
      </div>
    </div>
  </div>
</section>



<section id='statistic'>
  <div class="avand">
    <h2 class="txtC txtB mB100 fs30" title="<?php echo T_('Of course Made with love 😍'); ?>"><?php echo T_('Jibres has created for futuristic entrepreneurs'); ?><span>❤️</span></h2>
    <div class="f txtC">
      <div class="c s12 pA10">
          <div class="fs50"><?php echo \dash\fit::stats(\dash\data::homepagenumber_product()) ?>+</div>
          <h5><?php echo T_('Products'); ?></h5>
      </div>
      <div class="c s12 pA10">
          <div class="fs50"><?php echo \dash\fit::stats(\dash\data::homepagenumber_factor()) ?>+</div>
          <h5><?php echo T_('Factor'); ?></h5>
      </div>
      <div class="c s12 pA10">
          <div class="fs40"><?php echo \dash\fit::stats(\dash\data::homepagenumber_sum_factor()) ?>+</div>
          <h5><?php echo T_('Sold on Jibres'); ?></h5>
      </div>
    </div>
  </div>
</section>



<section id="jibresFeatures">
  <div class="avand-lg">
    <h2><?php echo T_("All the tools you need..."); ?></h2>
    <div class="row">
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="">
          <i class="sf-lamp"></i>
          <h3><?php echo T_("SEO Optimized"); ?></h3>
          <p><?php echo T_("Billions of searches are conducted online every single day. Many people search for specific products and services with the intent to pay for these things."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="">
          <i class="sf-database"></i>
          <h3><?php echo T_("Fully Hosted"); ?></h3>
          <p><?php echo T_("We are maintain your store files and data in the cloud. You would not need to setup your own server, we are storing your data for you."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="">
          <i class="sf-shield"></i>
          <h3><?php echo T_("Free SSL Certificate"); ?></h3>
          <p><?php echo T_("SSL Protection For Anyone."); ?></p><p><?php echo T_("Protect you information, generate trust and improve Search Engine Ranking.") ?></p>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="">
          <i class="sf-card"></i>
          <h3><?php echo T_("Accept Credit Cards"); ?></h3>
          <p><?php echo T_("It's easy to accept various payment options in Jibres, including PayPal, Credit Cards and other offline methods."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="">
          <i class="sf-server-accept"></i>
          <h3><?php echo T_("Fully API"); ?></h3>
          <p><?php echo T_("API gives you full creative control to add Jibres buying experiences anywhere your customers are, including websites, apps, and social networks."); ?></p>
        </a>
      </div>
      <div class="item c-xs-12 c-sm-12 c-md-4">
        <a href="">
          <i class="sf-heart"></i>
          <h3><?php echo T_("Premium Support"); ?></h3>
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
        <h1><?php echo T_("Jibres Mobile App"); ?></h1>
        <p><?php echo T_("No matter where you are, Jibres stays in sync across all of your devices."); ?></p>

        <div class="dl">
          <a href="<?php echo \dash\url::kingdom(); ?>/app/android" title='<?php echo T_("Download Jibres App from Google play") ?>' target="_blank" rel="noopener">
            <img src="<?php echo \dash\url::cdn(); ?>/img/app/app-dl-googleplay.png" alt='<?php echo T_("Jibres app on Google play") ?>'>
          </a>
          <a href="<?php echo \dash\url::kingdom(); ?>/app/direct" title='<?php echo T_("Direct download Jibres app") ?>'>
            <img src="<?php echo \dash\url::cdn(); ?>/img/app/app-dl-direct.png" alt='<?php echo T_("Direct download Jibres app") ?>'>
          </a>
        </div>

      </div>
    </div>
  </div>
</section>


<section id='keepitsimple'>
 <div class="title">
  <h2 title='<?php echo T_('Simplest forever'); ?>'><?php echo T_('Keep it simple'); ?></h2>
  <h3><?php echo T_('Simplicity is the ultimate sophistication'); ?></h3>
  <h3><?php echo T_('No one can fulfill your e-commerce needs like us'); ?> <span>💪</span></h3>
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
    <h2><?php echo T_("Our Happy Friends!"); ?></h2>
    <div class="row padMore">
<?php foreach (\dash\data::quote() as $key => $value) {?>
      <div class="c-xs-12 c-sm-12 c-md-6 c-lg-4 itemBox">
        <div class="item f f-column justify-between">
          <p class="flex-1"><?php echo $value['quote']; ?></p>
          <div class="shapeTop"></div>
          <div class="fiveStar"><span></span><span></span><span></span><span></span><span></span></div>
          <footer class="f align-center from">
            <div class="cauto"><img src="<?php echo \dash\url::cdn(); ?>/img/quote/<?php echo $value['avatar']; ?>" alt='<?php echo $value['name']; ?>'></div>
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
