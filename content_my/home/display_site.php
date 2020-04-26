<?php $myData = \dash\data::dashboardDetail(); ?>

 <div class="f">
  <div class="c9 s12 pRa10">

    <section class="f">
     <div class="c pRa10">
      <a href="<?php echo \dash\url::here() ?>/business"  class="stat">
       <h3><?php echo T_("Business");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'store_count'));?></div>
      </a>
     </div>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::here() ?>/domain" class="stat">
       <h3><?php echo T_("Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'domain_count'));?></div>
      </a>
     </div>
     <div class="c">
      <a href="<?php echo \dash\url::kingdom() ?>/account/billing" class="stat <?php if(\dash\get::index($myData, 'budget')>0) echo " green"; ?>">
       <h3><?php echo T_("Account Balance");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'budget'));?></div>
      </a>
     </div>
    </section>

    <section class="box domainQuickBuy">
      <h3><a href="<?php echo \dash\url::here() ?>/domain"><?php echo T_("Search for your dream domain"); ?></a></h3>
      <p><?php echo T_("Every website start with a great domain name"); ?></p>
      <form method="get" action="<?php echo \dash\url::here(); ?>/domain/buy" autocomplete='off'>
        <div class="input ltr">
          <input type="search" name="q" autocomplete="off" maxlength="65" placeholder='<?php echo T_('Enter your idea for domain name') ?>'>
          <button class="addon btn warn"><?php echo T_("Register Domain"); ?></button>
        </div>
      </form>
    </section>

   <div class="f">
    <div class="c6 s12 pRa10">
     <h5 class="txtB mT20"><?php echo T_("Business that you are owner"); ?></h5>
     <nav class="items">
      <ul>
<?php
$listStore_owner = \dash\data::listStore_owner();
if($listStore_owner && is_array($listStore_owner))
{
 foreach ($listStore_owner as $key => $value)
 {
?>
       <li>
        <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
         <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
         <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
         <div class="value"><?php echo \dash\get::index($value, 'subdomain'); ?></div>
         <div class="go next"></div>
        </a>
       </li>
<?php
  } //endfor
} //endif
?>
      </ul>
     </nav>

     <nav class="items">
      <ul>
       <li>
        <a class="f" href="<?php echo \dash\url::here(); ?>/business/start">
         <div class="go plus ok"></div>
         <div class="key"><?php echo T_("Add New Business");?></div>
        </a>
       </li>
      </ul>
     </nav>

    </div>

    <div class="c6 s12">
     <h5 class="txtB mT20"><?php echo T_("Business that you are staff"); ?></h5>
     <nav class="items">
      <ul>
<?php
$listStore_staff = \dash\data::listStore_staff();
if($listStore_staff && is_array($listStore_staff))
{
 foreach ($listStore_staff as $key => $value) {?>
       <li>
        <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
         <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
         <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
         <div class="value"><?php echo \dash\get::index($value, 'subdomain'); ?></div>
         <div class="go next"></div>
        </a>
       </li>
<?php }//endfor ?>
<?php } else { //endif ?>
       <li class="pA10"><div class="msg mB0"><?php echo T_("You are not staff yet!"); ?></div></li>
<?php }//endif ?>
      </ul>
     </nav>
    </div>
   </div>

  </div>

  <div class="c3 s12">

   <section class="circularChartBox">
    <?php $myPercent=\dash\get::index($myData, 'complete_profile', 'percent'); include core.'/layout/elements/circularChart.php';?>
    <h3><?php echo T_("Account Status");?></h3>
    <p><?php echo T_("Badges are little bits of digital flair that you earn for your simple actions on Jibres"); ?></p>
   </section>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php if(\dash\get::index($myData, 'complete_profile', 'mobile')) { echo \dash\url::kingdom(). '/account/my'; }else{ echo \dash\url::kingdom(). '/enter/verify';}?>">
       <div class="key"><?php echo T_('Verify Mobile');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'mobile')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/email">
       <div class="key"><?php echo T_('Verify Email');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'email')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/username">
       <div class="key"><?php echo T_('Set Username');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'username')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/profile">
       <div class="key"><?php echo T_('Set Birthday');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'birthday')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/avatar">
       <div class="key"><?php echo T_('Set Avatar');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'avatar')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
    </ul>
   </nav>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/billing">
       <div class="key"><?php echo T_('Top up Your Account');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'firstpay')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
    </ul>
   </nav>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/business/start">
       <div class="key"><?php echo T_('Add Your First Business');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'firststore')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="">
       <div class="key"><?php echo T_('Add Your First Product');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'firstproduct')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="">
       <div class="key"><?php echo T_('Sale Your First Invoice');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'firstorder')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
   </ul>
  </nav>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/domain/buy">
       <div class="key"><?php echo T_('Buy Your First Domain');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'firstdomain')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/domain/renew">
       <div class="key"><?php echo T_('Renew Your First Domain');?></div>
       <div class="go <?php if(\dash\get::index($myData, 'complete_profile', 'firstrenew')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
    </ul>
   </nav>

  </div>
 </div>
