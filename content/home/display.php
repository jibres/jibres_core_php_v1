
<section class="jibresBanner" id='saleChannels'>
 <div class="avand impact">
  <div class="f">
    <div class="c3 m6 s6 pA10 mB10">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step1-500.png" alt="<?php echo T_('Point of Sale Software'); ?>">
<?php } ?>
        <h3 class="s0-"><?php echo T_('Point of Sale Software'); ?></h3>
        <p class="s0"><?php echo T_('Barcode reader'). T_(', '). T_('Receipt printer'). T_(', '). T_('PC POS'). T_(', '). T_('Label Printing Scale'). T_(', '). T_('Invoice Software'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s6 pA10 mB10">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step2-500.png" alt='<?php echo T_('Online Store Website'); ?>'>
<?php } ?>
        <h3 class="s0-"><?php echo T_('Online Store Website'); ?></h3>
        <p class="s0"><?php echo T_('Online store builder allow you robust your business in a faster way, simpler way!'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s6 pA10 mB10">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step3-500.png" alt='<?php echo T_('Mobile Online Store'); ?>'>
<?php } ?>
        <h3 class="s0-"><?php echo T_('Mobile Online Store'); ?></h3>
        <p class="s0"><?php echo T_('Create mobile app for your online store.'); ?> <?php echo T_('Free'). T_(', '). T_('Fully Customizable'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s6 pA10 mB10">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step4-500.png" alt='<?php echo T_('Social Marketing'); ?>'>
<?php } ?>

        <h3 class="s0-"><?php echo T_('Social Marketing'); ?></h3>
        <p class="s0"><?php echo T_('Easily add ecommerce to any website and social networks by embedding a single buy button.'); ?></p>
      </div>
    </div>

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
   <use xlink:href="#gentle-wave" x="48" y="7" fill="#f7f7f9" />
  </g>
 </svg>
</section>



<section id='pricingPlans' class="s0">
  <div class="avand">
    <div class="headline">
      <h3><?php echo T_("Choose the plan that's right for you"); ?></h3>
      <p><?php echo T_('Plans to fit your budget'); ?></p>
    </div>
    <div class="f">
      <div class="c4 s12 pLR5">
        <div class="pricing-card bronze">
          <div class="name"><?php echo T_('Bronze') ?></div>
          <div class="price"><span><?php echo \dash\fit::number(140); ?></span><?php echo \dash\data::moneyUnit(); ?></div>
          <div class="detail">
            <div><span class="txtB"><?php echo T_('Order Limit'); ?></span> <span><?php echo \dash\fit::number(100); ?></span></div>
            <div><?php echo T_(':val Staff', ['val' => \dash\fit::number(1)]) ?></div>
            <div><?php echo T_('Basic Report'); ?></div>
            <div><?php echo T_('Basic Permission'); ?></div>
            <div><?php echo T_('Basic Personalization'); ?></div>
          </div>
          <a href="<?php echo \dash\url::kingdom() ?>/enter/signup" class="btn lg"><?php echo T_('Get Bronze'); ?></a>
          <div class="meta"><?php echo T_('Renews every year.'); ?></div>
        </div>
      </div>
      <div class="c4 s12 pLR5">
        <div class="pricing-card silver">
          <div class="name"><?php echo T_('Silver') ?></div>
          <div class="price"><span><?php echo \dash\fit::number(300); ?></span><?php echo \dash\data::moneyUnit(); ?></div>
          <div class="detail">
            <div><span class="txtB"><?php echo T_('Order Limit'); ?></span> <span><?php echo \dash\fit::number(1000); ?></span></div>
            <div><?php echo T_(':val Staff', ['val' => \dash\fit::number(5)]) ?></div>
            <div><?php echo T_('Advanced Report'); ?></div>
            <div><?php echo T_('Basic Permission'); ?></div>
            <div><?php echo T_('Advanced Personalization'); ?></div>
          </div>
          <a href="<?php echo \dash\url::kingdom() ?>/enter/signup" class="btn lg"><?php echo T_('Get Silver'); ?></a>
          <div class="meta"><?php echo T_('Renews every year.'); ?></div>
        </div>
      </div>
      <div class="c4 s12 pLR5">
        <div class="pricing-card gold">
          <div class="name"><?php echo T_('Gold') ?></div>
          <div class="price"><span><?php echo \dash\fit::number(700); ?></span><?php echo \dash\data::moneyUnit(); ?></div>
          <div class="detail">
            <div><span class="txtB"><?php echo T_('Ultimate Order Limit'); ?></span></div>
            <div><?php echo T_(':val Staff', ['val' => \dash\fit::number(20)]) ?></div>
            <div><?php echo T_('Advanced Report'); ?></div>
            <div><?php echo T_('Advanced Permission'); ?></div>
            <div><?php echo T_('Advanced Personalization'); ?></div>
          </div>
          <a href="<?php echo \dash\url::kingdom() ?>/enter/signup" class="btn lg"><?php echo T_('Get Gold'); ?></a>
          <div class="meta"><?php echo T_('Renews every year.'); ?></div>
        </div>
      </div>
    </div>

    <div class="headline">
      <h3><?php echo T_("Get started with our <span class='txtB'>Free Plan</span>"); ?></h3>
    </div>
    <div class="f justify-center">
      <div class="c4 s12">
          <div class="pricing-card free">
            <div class="name"><?php echo T_('Free') ?></div>
            <div class="price"><span><?php echo \dash\fit::number(0); ?></span></div>
            <div class="detail">
              <div><span class="txtB"><?php echo T_('Order Limit'); ?></span> <span><?php echo \dash\fit::number(10); ?></span></div>
              <div><?php echo T_('Basic Report'); ?></div>
              <div><?php echo T_('Advanced Personalization'); ?></div>
            </div>
            <a href="<?php echo \dash\url::kingdom() ?>/enter/signup" class="btn lg"><?php echo T_('Get Free'); ?></a>
            <div class="meta"><?php echo T_('Free Forever.'); ?></div>
          </div>
      </div>
      <div class="c6 s12">
        <img src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-free-plan.png" alt='<?php echo T_("Fly with our power"); ?>'>
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


<section id='jibresRoadmap'>
  <div class="avand">
    <h3><?php echo T_("Jibres Roadmap"); ?></h3>
    <h2><?php echo T_('World #1 Financial Platform'); ?></h2>
  </div>
</section>


<?php if(\dash\data::quote()) { ?>
<section id='jibresQuote'>
  <div class="avand">
    <h2><?php echo T_("Our Happy Friends!"); ?></h2>
    <div class="f">
<?php foreach (\dash\data::quote() as $key => $value) {?>
      <div class="c4 m6 s12 pA15">
        <div class="item f f-column justify-between">
          <p class="flex-1"><?php echo $value['quote']; ?></p>
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
