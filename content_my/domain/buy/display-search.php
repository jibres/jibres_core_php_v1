<?php if(\dash\url::content() === 'my') {?>
  <div class="f justify-center">
    <div class="c8 m9 s12">


      <section class="box domainQuickBuy">
        <h3><a href="<?php echo \dash\url::here() ?>/domain"><?php echo T_("Discover the perfect domain now"); ?></a></h3>
        <p><?php echo T_("Every website start with a great domain name"); ?></p>
        <form method="get" action='<?php echo \dash\url::current() ?>' autocomplete='off'>
          <div class="input">
            <input type="search" name="q" autocomplete="off" maxlength="65" value="<?php echo \dash\data::getDomain(); ?>" <?php if (!\dash\detect\device::detectPWA()) {echo "autofocus";} ?> >
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
<?php } //endif ?>

<?php
$result = \dash\data::infoResult();
// var_dump($result);

if(isset($result['ir_master']))
{
  $master = $result['ir_master'];
  require('domain-search-result-ir.php');
}

if(isset($result['com_master']))
{
  $master = $result['com_master'];
  require('domain-search-result-ir.php');
}
?>


<div class="row ltr">
  <div class="c-xs-12 c-sm-6 <?php if(\dash\url::content() === 'my') { echo 'c-md-4'; } ?>">
  <?php if(isset($result['ir_list']) && is_array($result['ir_list'])){?>
    <h5 class="txtB mT20"><?php echo T_("Dot IR TLD"); ?></h5>
    <?php if($result['ir_list']) {?>
    <ul class="items">
    <?php foreach ($result['ir_list'] as $key => $value) {?>
     <li>
      <a href="<?php if(\dash\get::index($value, 'available')) { echo \dash\url::this(). '/buy/'. $key; }else{ if(\dash\get::index($value,'domain_name_valid')) { echo \dash\url::this(). '/whois?domain='. $key; } } //endif ?>" class="f item">
       <div class="key fit fc-mute"><?php echo substr(\dash\get::index($value, 'name'), 0, 15); ?></div>
       <div class="key grow txtB">.<?php echo \dash\get::index($value, 'tld'); ?></div>
       <?php if(\dash\get::index($value, 'available')) {?>
        <div class="value">
          <span class="compact font-10"><?php echo \dash\get::index($value, 'unit');?></span>
          <span class="compact"><?php echo \dash\fit::number(\dash\get::index($value, 'price_1year'));?></span>
        </div>
       <?php }else{ ?>
        <?php if(\dash\get::index($value,'domain_restricted')) {?>
          <div class="value"><?php echo T_("Domain is restricted") ?></div>
        <?php }elseif(!\dash\get::index($value,'domain_name_valid')) {?>
          <div class="value"><?php echo T_("Invalid") ?></div>
        <?php }else{ ?>
          <div class="value"><?php echo T_("Taken") ?></div>
        <?php } //endif ?>
       <?php } //endif ?>
       <?php if(\dash\get::index($value, 'available')) {?>
        <div class="go ok"></div>
        <?php }else{ ?>
          <?php if(\dash\get::index($value,'domain_restricted')) {?>
            <div class="go ban nok"></div>
          <?php }elseif(!\dash\get::index($value,'domain_name_valid')) {?>
            <div class="go invalid fc-red"></div>
          <?php }else{ ?>
            <div class="go detail nok"></div>
          <?php } //endif ?>
        <?php } //endif ?>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
    <?php }else{ ?>
      <div class="msg fs14"><?php echo T_("The IRNIC server not respond at this time!") ?></div>
    <?php } //endif ?>
  <?php } //endif ?>
  </div>
   <div class="c-xs-12 c-sm-6 <?php if(\dash\url::content() === 'my') { echo 'c-md-4'; } ?>">
  <?php if(isset($result['com_list']) && is_array($result['com_list'])){?>
    <h5 class="txtB mT20"><?php echo T_("International TLD"); ?></h5>
    <ul class="items">
    <?php foreach ($result['com_list'] as $key => $value) {?>
     <li>
      <a href="<?php if(\dash\get::index($value, 'available') && !\dash\get::index($value, 'domain_premium')) { echo \dash\url::this(). '/buy/'. $key; }else{ echo \dash\url::this(). '/whois?domain='. $key;} //endif ?>" class="f item">
       <div class="key fit fc-mute"><?php echo substr(\dash\get::index($value, 'name'), 0, 15); ?></div>
       <div class="key grow txtB">.<?php echo \dash\get::index($value, 'tld'); ?></div>
       <?php if(\dash\get::index($value, 'available') && !\dash\get::index($value, 'domain_premium')) {?>
        <div class="value">
          <span class="compact font-10"><?php echo \dash\get::index($value, 'unit');?></span>
          <span class="compact"><?php echo \dash\fit::number(\dash\get::index($value, 'price_1year'));?></span>
        </div>
       <?php }else{ ?>
        <?php if(\dash\get::index($value, 'domain_premium')) {?>
          <div class="value"><?php echo T_("Premium") ?></div>
        <?php }else{ ?>
          <div class="value"><?php echo T_("Taken") ?></div>
        <?php } //endif ?>
       <?php } //endif ?>
       <?php if(\dash\get::index($value, 'available') && !\dash\get::index($value, 'domain_premium')) {?>
        <div class="go ok"></div>
        <?php }else{ ?>
         <?php if(\dash\get::index($value,'domain_premium')) {?>
            <div class="go premium fc-blue"></div>
          <?php }else{ ?>
            <div class="go detail nok"></div>
          <?php } //endif ?>
        <?php } //endif ?>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
  <?php } //endif ?>
  </div>
  <?php if(\dash\url::content() === 'my') {?>
   <div class="c-xs-12 c-sm-6 <?php if(\dash\url::content() === 'my') { echo 'c-md-4'; } ?>">
  <?php if(\dash\data::domainSuggestion()) {?>
    <h5 class="txtB mT20"><?php echo T_("Our short suggestion"); ?></h5>
    <ul class="items">
    <?php foreach (\dash\data::domainSuggestion() as $key => $value) {?>
     <li>
      <a href="<?php echo \dash\url::this(). '/buy/'. \dash\get::index($value, 'domain') ?>" class="f item">
       <div class="key fit txtB"><?php echo \dash\get::index($value, 'root'); ?></div>
       <div class="key grow fc-mute">.<?php echo \dash\get::index($value, 'tld'); ?></div>

         <div class="value">
          <span class="compact font-10"><?php echo \lib\currency::unit();?></span>
          <span class="compact"><?php echo \dash\fit::number(\dash\data::irOneYearPrice());?></span>
        </div>
        <div class="go ok"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
  <?php } //endif ?>
  </div>
  <?php } //endif ?>
</div>




