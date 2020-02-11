<section id='landing'>
 <div class="title">

  <div class="h2"><span class="typed"></span></div>

  <div id="typed-strings" class="hide">
    <h3><?php echo T_('Invoice Software'); ?></h3>
    <h4><?php echo T_('Easy Invoicing Software'); ?></h4>
    <h3><?php echo T_('Online Invoicing Software'); ?></h3>
    <h2><?php echo T_('Free Invoicing Software'); ?></h2>

    <h3><?php echo T_('Accounting Software'); ?></h3>
    <h2><?php echo T_('Online Accounting Software'); ?></h2>

    <h3><?php echo T_('Sales'); ?></h3>
    <h3><?php echo T_('Sales Software'); ?></h3>
    <h4><?php echo T_('Integrated Sales'); ?></h4>
    <h2 class="bold"><?php echo T_('Integrated Ecommerce Platform'); ?></h2>
  </div>
  <h3><?php echo \dash\data::page_desc2(); ?></h3>

 </div>
</section>


<section id='saleChannels'>
 <div class="cn">
  <div class="title">
   <h2><?php echo T_('Jibres Sale Channels'); ?></h2>
   <p><?php echo T_('Sales channels represent the different marketplaces where you sell your products.'); ?><br><?php echo T_('By use each sales channel on Jibres, you can keep track of your products, orders, and customers in one place.'); ?> <a href="{{url.kingdom}}/about"><?php echo T_('Read more'); ?></a></p>
  </div>

  <div class="f">
    <div class="c3 m6 s12">
      <div class="item">
        <img src="<?php echo \dash\url::icon(); ?>" alt="<?php echo T_('Jibres'); ?>">
        <h3><?php echo T_('Point of Sale Software'); ?></h3>
        <p><?php echo T_('Barcode reader'). T_(','). T_('Receipt printer'). T_(','). T_('PC POS'). T_(','). T_('Label Printing Scale'). T_(','). T_('Invoice Software'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s12">
      <div class="item">
        <img src="<?php echo \dash\url::icon(); ?>" alt='<?php echo T_('Jibres'); ?>'>
        <h3><?php echo T_('Mobile Online Store'); ?></h3>
        <p><?php echo T_('Create mobile app for your online store.'); ?> <?php echo T_('Free'). T_(','). T_('Fully Customizable'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s12">
      <div class="item">
        <img src="<?php echo \dash\url::icon(); ?>" alt='<?php echo T_('Jibres'); ?>'>
        <h3><?php echo T_('Social Marketing'); ?></h3>
        <p><?php echo T_('Easily add ecommerce to any website and social networks by embedding a single buy button.'); ?></p>
      </div>
    </div>

    <div class="c3 m6 s12">
      <div class="item">
        <img src="<?php echo \dash\url::icon(); ?>" alt='<?php echo T_('Jibres'); ?>'>
        <h3><?php echo T_('Online Store Website'); ?></h3>
        <p><?php echo T_('Online store builder allow you robust your business in a faster way, simpler way!'); ?></p>
      </div>
    </div>

  </div>
 </div>
</section>



<section id='keepitsimple'>
 <div class="title">
  <h2 title='{%trans "Simplest forever"%}'><?php echo T_('Keep it simple'); ?></h2>
  <h3><?php echo T_('Simplicity is the ultimate sophistication'); ?></h3>
  <h3><?php echo T_('No one can fullfill your e-commerce needs like us'); ?> <span>💪</span></h3>
 </div>
</section>



<section id='pricingPlans'>
  <div class="cn">
    <div class="headline">
      <h3>{%trans "Choose the plan that's right for you"%}</h3>
      <p>{%trans "Plans to fit your budget"%}</p>
    </div>
    <div class="f">
      <div class="c4 s12 pLR5">
        <div class="pricing-card bronze">
          <div class="name">{%trans "Bronze"%}</div>
          <div class="price"><span>{{ 140 | fitNumber}}</span> {%if lang.current == 'fa'%}{%trans "Hezar Toman"%}{%else%}${%endif%}</div>
          <div class="detail">
            <div><span class="txtB">{%trans "Order Limit"%}</span> <span>{{100 | fitNumber}}</span></div>
            <div><span class="txtB">{%trans "Staff"%}</span> <span>{{1 | fitNumber}}</span></div>
            <div><span class="txtB">{%trans "Basic"%}</span> <span>{%trans "Report"%}</span></div>
            <div><span class="txtB">{%trans "Basic"%}</span> <span>{%trans "Permission"%}</span></div>
            <div><span class="txtB">{%trans "Basic"%}</span> <span>{%trans "Personalization"%}</span></div>
          </div>
          <a href="{{url.kingdom}}/enter/signup" class="btn lg">{%trans "Get Bronze"%}</a>
          <div class="meta">{%trans "Renews every year."%}</div>
        </div>
      </div>
      <div class="c4 s12 pLR5">
        <div class="pricing-card silver">
          <div class="name">{%trans "Silver"%}</div>
          <div class="price"><span>{{ 300 | fitNumber}}</span> {%if lang.current == 'fa'%}{%trans "Hezar Toman"%}{%else%}${%endif%}</div>
          <div class="detail">
            <div><span class="txtB">{%trans "Order Limit"%}</span> <span>{{1000 | fitNumber}}</span></div>
            <div><span class="txtB">{%trans "Staff"%}</span> <span>{{5 | fitNumber}}</span></div>
            <div><span class="txtB">{%trans "Advanced"%}</span> <span>{%trans "Report"%}</span></div>
            <div><span class="txtB">{%trans "Basic"%}</span> <span>{%trans "Permission"%}</span></div>
            <div><span class="txtB">{%trans "Advanced"%}</span> <span>{%trans "Personalization"%}</span></div>
          </div>
          <a href="{{url.kingdom}}/enter/signup" class="btn lg">{%trans "Get Silver"%}</a>
          <div class="meta">{%trans "Renews every year."%}</div>
        </div>
      </div>
      <div class="c4 s12 pLR5">
        <div class="pricing-card gold">
          <div class="name">{%trans "Gold"%}</div>
          <div class="price"><span>{{ 700 | fitNumber}}</span> {%if lang.current == 'fa'%}{%trans "Hezar Toman"%}{%else%}${%endif%}</div>
          <div class="detail">
            <div><span class="txtB">{%trans "Order Limit"%}</span> <span>{%trans "Ultimate"%}</span></div>
            <div><span class="txtB">{%trans "Staff"%}</span> <span>{{20 | fitNumber}}</span></div>
            <div><span class="txtB">{%trans "Advanced"%}</span> <span>{%trans "Report"%}</span></div>
            <div><span class="txtB">{%trans "Advanced"%}</span> <span>{%trans "Permission"%}</span></div>
            <div><span class="txtB">{%trans "Advanced"%}</span> <span>{%trans "Personalization"%}</span></div>
          </div>
          <a href="{{url.kingdom}}/enter/signup" class="btn lg">{%trans "Get Gold"%}</a>
          <div class="meta">{%trans "Renews every year."%}</div>
        </div>
      </div>
    </div>

    <div class="headline">
      <h3>{%trans "Get started with our <span class='txtB'>Free Plan</span>"%}</h3>
    </div>
    <div class="f justify-center">
      <div class="c4 s12">
          <div class="pricing-card free">
            <div class="name">{%trans "Free"%}</div>
            <div class="price"><span>{{ 0 | fitNumber}}</span></div>
            <div class="detail">
              <div><span class="txtB">{%trans "Order Limit"%}</span> <span>{{10 | fitNumber}}</span></div>
              <div><span class="txtB">{%trans "Basic"%}</span> <span>{%trans "Report"%}</span></div>
              <div><span class="txtB">{%trans "Basic"%}</span> <span>{%trans "Personalization"%}</span></div>
            </div>
            <a href="{{url.kingdom}}/enter/signup" class="btn lg">{%trans "Get Free"%}</a>
            <div class="meta">{%trans "Free Forever."%}</div>
          </div>
      </div>
      <div class="c6 s12">
        <img src="<?php echo \dash\url::static(); ?>/img/homepage/jibres-free-plan.png" alt='{%trans "Jibres Free pricing"%}'>
      </div>
    </div>
  </div>
</section>



<section id='statistic'>
  <div class="cn">
    <h2 class="txtC txtB mB100 fs30" title="<?php echo T_('Of course Made with love 😍'); ?>"><?php echo T_('Jibres has created for futuristic entrepreneurs'); ?><span>❤️</span></h2>
    <div class="f txtC">
      <div class="c s12 pA10">
          <div class="fs50" title='{%trans "Item"%}'><?php echo \dash\data::homepagenumber_product(); ?>+</div>
          <h5><?php echo T_('Products'); ?></h5>
      </div>
      <div class="c s12 pA10">
          <div class="fs50" title='{%trans "Qty"%}'><?php echo \dash\data::homepagenumber_factor(); ?>+</div>
          <h5><?php echo T_('Factor'); ?></h5>
      </div>
      <div class="c s12 pA10">
          <div class="fs40" title='{%trans "Toman"%}'><?php echo \dash\data::homepagenumber_sum_factor(); ?>+</div>
          <h5><?php echo T_('Sold on Jibres'); ?></h5>
      </div>
    </div>
  </div>
</section>



<section id='roadmap'>
  <div class="cn">
    <div class="f align-center fix">
      <div class="cauto s12"><img src="<?php echo \dash\url::static(); ?>/img/homepage/jibres-vision.png" alt='<?php echo T_('Jibres roadmap'); ?>'></div>
      <div class="c s12">
        <h2><?php echo T_('Roadmap'); ?></h2>
        <h3><?php echo T_('World #1 Financial Platform'); ?></h3>
      </div>
    </div>
  </div>
</section>



<section id='quote'>
  <div class="title">
  <h4><?php echo T_('With Jibres we take less time of our customers and this means modern customer orientation'); ?></h4>
  <h5><?php echo T_('Majid Sadeghi'); ?></h5>
  <h5><?php echo T_('Sales Supervisor at SuperSaeed'); ?></h5>
 </div>
</section>