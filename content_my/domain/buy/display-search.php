<?php if(\dash\url::content() === 'my') {?>
  <div class="f justify-center">
    <div class="c8 m9 s12">


      <section class="box domainQuickBuy">
        <h3><a href="<?php echo \dash\url::here() ?>/domain"><?php echo T_("Discover the perfect domain now"); ?></a></h3>
        <p><?php echo T_("Every website start with a great domain name"); ?></p>
        <form method="get" action='<?php echo \dash\url::current() ?>' autocomplete='off'>
          <div class="input">
            <input type="search" name="q" autocomplete="off" maxlength="65" value="<?php echo \dash\data::getDomain(); ?>" <?php if (!\dash\detect\device::detectPWA()) {echo "autofocus";} ?> >
            <button class="addon btn-warning"><?php echo T_("Search"); ?></button>
          </div>
        </form>
      </section>
        <?php if(\dash\data::InvalidDomain()) {?>
          <div class="alert-warning fs14">
            <?php echo T_("Please enter a valid domain") ?>
          </div>
        <?php } //endif ?>
    </div>
  </div>
<?php } //endif ?>

<?php
$result = \dash\data::infoResult();
if($result)
{
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

}
elseif(!\dash\data::InvalidDomain() && \dash\validate::search_string())
{
  echo '<div class="alert-warning text-center mb-0">'. T_("Please enter valid domain name!"). "</div>";
}
?>


<div class="row ltr">
  <div class="c-xs-12 c-sm-6 <?php if(\dash\url::content() === 'my') { echo 'c-md-4'; } ?>">
  <?php if(isset($result['ir_list']) && is_array($result['ir_list'])){?>
    <h5 class="font-bold mt-4"><?php echo T_("Dot IR TLD"); ?></h5>
    <?php if($result['ir_list']) {?>
    <ul class="items">
    <?php foreach ($result['ir_list'] as $key => $value) {?>
     <li>
      <a href="<?php if(a($value, 'available') || a($value,'domain_restricted')) { echo \dash\url::this(). '/buy/'. $key; }else{ if(a($value,'domain_name_valid')) { echo \dash\url::this(). '/whois?domain='. $key; } } //endif ?>" class="f item">
       <div class="key fit fc-mute"><?php echo substr(a($value, 'name'), 0, 15); ?></div>
       <div class="key grow font-bold">.<?php echo a($value, 'tld'); ?></div>
       <?php if(a($value, 'available')) {?>
        <div class="value">
          <span class="compact font-10"><?php echo a($value, 'unit');?></span>
          <span class="compact"><?php echo \dash\fit::number(a($value, 'price_1year'));?></span>
        </div>
       <?php }else{ ?>
        <?php if(a($value,'domain_restricted')) {?>
          <div class="value"><?php echo T_("Domain is restricted") ?></div>
        <?php }elseif(!a($value,'domain_name_valid')) {?>
          <div class="value"><?php echo T_("Invalid") ?></div>
        <?php }else{ ?>
          <div class="value"><?php echo T_("Taken") ?></div>
        <?php } //endif ?>
       <?php } //endif ?>
       <?php if(a($value, 'available')) {?>
        <div class="go ok"></div>
        <?php }else{ ?>
          <?php if(a($value,'domain_restricted')) {?>
            <div class="go ban nok"></div>
          <?php }elseif(!a($value,'domain_name_valid')) {?>
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
      <div class="alert-danger"><?php echo T_("The IRNIC server not respond at this time. Try again later!") ?></div>
    <?php } //endif ?>
  <?php } //endif ?>
  </div>
   <div class="c-xs-12 c-sm-6 <?php if(\dash\url::content() === 'my') { echo 'c-md-4'; } ?>">
  <?php if(isset($result['com_list']) && is_array($result['com_list'])){?>
    <h5 class="font-bold mt-4"><?php echo T_("International TLD"); ?></h5>
    <ul class="items">
    <?php foreach ($result['com_list'] as $key => $value) {?>
     <li>
<?php if(a($value, 'available') && !a($value, 'domain_premium')) { ?>
      <a href="<?php echo \dash\url::this(). '/buy/'. $key; ?>" class="f item">
<?php } else { ?>
      <a href="<?php echo \dash\url::this(). '/whois?domain='. $key; ?>" class="f item" target="_blank">
<?php } ?>
       <div class="key fit fc-mute"><?php echo substr(a($value, 'name'), 0, 15); ?></div>
       <div class="key grow font-bold">.<?php echo a($value, 'tld'); ?></div>
       <?php if(a($value, 'available') && !a($value, 'domain_premium')) {?>
        <div class="value">
          <span class="compact font-10"><?php echo a($value, 'unit');?></span>
          <span class="compact"><?php echo \dash\fit::number(a($value, 'price_1year'));?></span>
        </div>
       <?php }else{ ?>
        <?php if(a($value, 'domain_premium')) {?>
          <div class="value"><?php echo T_("Premium") ?></div>
        <?php }else{ ?>
          <div class="value"><?php echo T_("Taken") ?></div>
        <?php } //endif ?>
       <?php } //endif ?>
       <?php if(a($value, 'available') && !a($value, 'domain_premium')) {?>
        <div class="go ok"></div>
        <?php }else{ ?>
         <?php if(a($value,'domain_premium')) {?>
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
    <h5 class="font-bold mt-4"><?php echo T_("Our short suggestion"); ?></h5>
    <ul class="items">
    <?php foreach (\dash\data::domainSuggestion() as $key => $value) {?>
     <li>
      <a href="<?php echo \dash\url::this(). '/buy/'. a($value, 'domain') ?>" class="f item">
       <div class="key fit font-bold"><?php echo a($value, 'root'); ?></div>
       <div class="key grow fc-mute">.<?php echo a($value, 'tld'); ?></div>

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




