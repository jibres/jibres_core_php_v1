



<section class="jibresBanner" id='saleChannels'>
 <div class="fit">
  <div class="f">
    <div class="c3 m6 s12">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img data-src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step1-500.png" alt="<?php echo T_('Point of Sale Software'); ?>">
<?php } ?>
        <h3><?php echo T_('Point of Sale Software'); ?></h3>
        <p><?php echo T_('Barcode reader'). T_(','). T_('Receipt printer'). T_(','). T_('PC POS'). T_(','). T_('Label Printing Scale'). T_(','). T_('Invoice Software'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s12">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img data-src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step2-500.png" alt='<?php echo T_('Online Store Website'); ?>'>
<?php } ?>
        <h3><?php echo T_('Online Store Website'); ?></h3>
        <p><?php echo T_('Online store builder allow you robust your business in a faster way, simpler way!'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s12">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img data-src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step3-500.png" alt='<?php echo T_('Mobile Online Store'); ?>'>
<?php } ?>
        <h3><?php echo T_('Mobile Online Store'); ?></h3>
        <p><?php echo T_('Create mobile app for your online store.'); ?> <?php echo T_('Free'). T_(','). T_('Fully Customizable'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s12">
      <div class="item">
<?php if(\dash\language::current() === 'fa') { ?>
        <img data-src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-saleChannels-step4-500.png" alt='<?php echo T_('Social Marketing'); ?>'>
<?php } ?>

        <h3><?php echo T_('Social Marketing'); ?></h3>
        <p><?php echo T_('Easily add ecommerce to any website and social networks by embedding a single buy button.'); ?></p>
      </div>
    </div>

  </div>

  <div class="title">
   <p><?php echo T_('Sales channels represent the different marketplaces where you sell your products.'); ?><br><?php echo T_('By use each sales channel on Jibres, you can keep track of your products, orders, and customers in one place.'); ?> <a href="<?php echo \dash\url::kingdom() ?>/about"><?php echo T_('Read more'); ?></a></p>
  </div>
 </div>
</section>



<section id='keepitsimple'>
 <div class="title">
  <h2 title='<?php echo T_('Simplest forever'); ?>'><?php echo T_('Keep it simple'); ?></h2>
  <h3><?php echo T_('Simplicity is the ultimate sophistication'); ?></h3>
  <h3><?php echo T_('No one can fullfill your e-commerce needs like us'); ?> <span>💪</span></h3>
 </div>
</section>



<section id='pricingPlans'>
  <div class="cn">
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
        <img data-src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-free-plan.png" alt='<?php echo T_("Jibres Free Pricing"); ?>'>
      </div>
    </div>
  </div>
</section>



<section id='statistic'>
  <div class="cn">
    <h2 class="txtC txtB mB100 fs30" title="<?php echo T_('Of course Made with love 😍'); ?>"><?php echo T_('Jibres has created for futuristic entrepreneurs'); ?><span>❤️</span></h2>
    <div class="f txtC">
      <div class="c s12 pA10">
          <div class="fs50"><?php echo \dash\data::homepagenumber_product(); ?>+</div>
          <h5><?php echo T_('Products'); ?></h5>
      </div>
      <div class="c s12 pA10">
          <div class="fs50"><?php echo \dash\data::homepagenumber_factor(); ?>+</div>
          <h5><?php echo T_('Factor'); ?></h5>
      </div>
      <div class="c s12 pA10">
          <div class="fs40"><?php echo \dash\data::homepagenumber_sum_factor(); ?>+</div>
          <h5><?php echo T_('Sold on Jibres'); ?></h5>
      </div>
    </div>
  </div>
</section>



<section id='roadmap'>
  <div class="cn">
    <div class="f align-center fix">
      <div class="cauto s12"><img data-src="<?php echo \dash\url::cdn(); ?>/img/homepage/jibres-vision.png" alt='<?php echo T_('Jibres roadmap'); ?>'></div>
      <div class="c s12">
        <h2><?php echo T_('Roadmap'); ?></h2>
        <h3><?php echo T_('World #1 Financial Platform'); ?></h3>
      </div>
    </div>
  </div>
</section>



<section id='quote' data-bg='url("<?php echo \dash\url::cdn(); ?>/images/homepage/quote-supersaeed-sadeghi.jpg")'>
  <div class="title">
  <h4><?php echo T_('With Jibres we take less time of our customers and this means modern customer orientation'); ?></h4>
  <h5><?php echo T_('Majid Sadeghi'); ?></h5>
  <h5><?php echo T_('Sales Supervisor at SuperSaeed'); ?></h5>
 </div>
</section>

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
