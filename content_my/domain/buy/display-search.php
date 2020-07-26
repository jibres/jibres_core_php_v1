  <div class="f justify-center">
    <div class="c8 m9 s12">


      <section class="box domainQuickBuy">
        <h3><a href="<?php echo \dash\url::here() ?>/domain"><?php echo T_("Discover the perfect domain now"); ?></a></h3>
        <p><?php echo T_("Every website start with a great domain name"); ?></p>
        <form method="get" action='<?php echo \dash\url::current() ?>' autocomplete='off'>
          <div class="input">
            <input type="search" name="q" autocomplete="off" maxlength="65" value="<?php echo \dash\data::getDomain(); ?>" placeholder='<?php echo T_('Enter your idea for domain name') ?>' autofocus>
            <button class="addon btn warn"><?php echo T_("Search"); ?></button>
          </div>
        </form>
      </section>
        <?php if(\dash\data::InvalidDomain()) {?>
          <div class="msg warn fs14">
            <?php echo T_("Please enter a valid domain") ?>
          </div>
        <?php } //endif ?>
    </div>
  </div>

<?php
$result = \dash\data::infoResult();
// var_dump($result);
?>
<div class="row ltr">
  <div class="c-xs-12 c-sm-6 c-md-4">
  <?php if(isset($result['ir_list']) && is_array($result['ir_list'])){?>
    <ul class="items">
    <?php foreach ($result['ir_list'] as $key => $value) {?>
     <li class="f">
      <a href="<?php echo \dash\url::this(). '/buy/'. $key ?>" class="f">
       <div class="key">
        <span class="compact fc-mute"><?php echo \dash\get::index($value, 'name'); ?></span>
        <span class="compact txtB">.<?php echo \dash\get::index($value, 'tld'); ?></span></div>
       <?php if(\dash\get::index($value, 'available')) {?>
        <div class="value">
          <span class="compact font-10"><?php echo \dash\get::index($value, 'unit');?></span>
          <span class="compact"><?php echo \dash\fit::number(\dash\get::index($value, 'price_1year'));?></span>
        </div>
       <?php }else{ ?>
       <div class="value"><?php echo T_("Unavailable") ?></div>
       <?php } //endif ?>
       <?php if(\dash\get::index($value, 'available')) {?>
        <div class="go ok"></div>
        <?php }else{ ?>
        <div class="go detail nok"></div>
        <?php } //endif ?>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
  <?php } //endif ?>
  </div>
  <div class="c-xs-12 c-sm-6 c-md-4">
    <?php if(isset($result['com_list']) && is_array($result['com_list'])){?>
    <ul class="items">
    <?php foreach ($result['com_list'] as $key => $value) {?>
     <li class="f">
      <a href="<?php echo \dash\url::this(). '/buy/'. $key ?>" class="f">
       <div class="key"><span class=""><?php echo \dash\get::index($value, 'name'); ?></span> <span><?php echo \dash\get::index($value, 'tld'); ?></span></div>
       <div class="value"><?php if(\dash\get::index($value, 'available')) { echo T_("Available");}else{ echo T_("Not Available");} ?></div>
       <?php if(\dash\get::index($value, 'available')) {?>
        <div class="go ok"></div>
        <?php }else{ ?>
        <div class="go detail nok"></div>
        <?php } //endif ?>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
  <?php } //endif ?>

  </div>
  <div class="c-xs-12 c-sm-6 c-md-4">

  <?php if(\dash\data::domainSuggestion()) {?>
    <ul class="items">
      <?php foreach (\dash\data::domainSuggestion() as $key => $value) {?>
       <li class="f">
        <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain'); ?>" class="f">
         <div class="key"><?php echo T_("Suggestion for you");?></div>
         <div class="value"><?php echo \dash\get::index($value, 'domain'); ?></div>

        </a>
       </li>
     <?php }//endfor ?>
    </ul>
  <?php } // endif ?>
  </div>
</div>




