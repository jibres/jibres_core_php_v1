<?php $myData = \dash\data::dashboardDetail(); ?>

 <div class="f">
  <div class="c9 s12 pRa10">

    <section class="row">
     <div class="c-xs-6 c">
      <a href="<?php echo \dash\url::here() ?>/business"  class="stat x70">
       <h3><?php echo T_("Business");?></h3>
       <div class="val"><?php echo \dash\fit::stats(a($myData, 'store_count'));?></div>
      </a>
     </div>
     <div class="c-xs-6 c">
      <a href="<?php echo \dash\url::here() ?>/domain" class="stat x70">
       <h3><?php echo T_("Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(a($myData, 'domain_count'));?></div>
      </a>
     </div>
     <div class="c-xs-0 c">
      <a href="<?php echo \dash\url::kingdom() ?>/account/billing" class="stat x70 <?php if(a($myData, 'budget')>0) echo " green"; ?>">
       <h3><?php echo T_("Account Balance");?></h3>
       <div class="val"><?php echo \dash\fit::number(a($myData, 'budget'));?></div>
      </a>
     </div>
    </section>


   <div class="f">
    <div class="c6 s12 pRa10">
     <h5 class="txtB mT20"><?php echo T_("Business that you are owner"); ?></h5>
<?php
$listStore_owner = \dash\data::listStore_owner();
if($listStore_owner && is_array($listStore_owner))
{
     echo '<nav class="items"><ul>';
 foreach ($listStore_owner as $key => $value)
 {
?>
       <li>
        <a class="f" href="<?php echo a($value, 'url'); ?>/a">
         <img src="<?php echo a($value, 'logo'); ?>" alt="<?php echo a($value, 'title'); ?>">
         <div class="key"><?php echo a($value, 'title'); ?></div>
         <div class="value"><?php echo a($value, 'subdomain'); ?></div>
         <div class="go next"></div>
        </a>
       </li>
<?php
  } //endfor
      echo '</ul></nav>';
} //endif
?>

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
        <a class="f" href="<?php echo a($value, 'url'); ?>/a">
         <img src="<?php echo a($value, 'logo'); ?>" alt="<?php echo a($value, 'title'); ?>">
         <div class="key"><?php echo a($value, 'title'); ?></div>
         <div class="value"><?php echo a($value, 'subdomain'); ?></div>
         <div class="go next"></div>
        </a>
       </li>
<?php }//endfor ?>
<?php } else { //endif ?>
       <li><div class="msg mB0"><?php echo T_("You are not staff yet!"); ?></div></li>
<?php }//endif ?>
      </ul>
     </nav>
    </div>
   </div>

  </div>

  <div class="c3 s12">

   <section class="circularChartBox">
    <?php $myPercent=a($myData, 'complete_profile', 'percent'); include core.'/layout/elements/circularChart.php';?>
    <h3><?php echo T_("Account Status");?></h3>
    <p><?php echo T_("Badges are little bits of digital flair that you earn for your simple actions on Jibres"); ?></p>
   </section>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php if(a($myData, 'complete_profile', 'mobile')) { echo \dash\url::kingdom(). '/account/my'; }else{ echo \dash\url::kingdom(). '/enter/verify';}?>">
       <div class="key"><?php echo T_('Verify Mobile');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'mobile')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/email">
       <div class="key"><?php echo T_('Verify Email');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'email')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/username">
       <div class="key"><?php echo T_('Set Username');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'username')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/profile">
       <div class="key"><?php echo T_('Set Birthday');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'birthday')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/avatar">
       <div class="key"><?php echo T_('Set Avatar');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'avatar')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
    </ul>
   </nav>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/billing">
       <div class="key"><?php echo T_('Top up Your Account');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'firstpay')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
    </ul>
   </nav>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php if(a($myData, 'complete_profile', 'firststore')){ echo \dash\url::here(). '/business/'; }else{echo \dash\url::here(). '/business/start'; } ?>">
       <div class="key"><?php echo T_('Add Your First Business');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'firststore')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f">
       <div class="key"><?php echo T_('Add Your First Product');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'firstproduct')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f">
       <div class="key"><?php echo T_('Sale Your First Invoice');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'firstorder')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
   </ul>
  </nav>

   <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php if(a($myData, 'complete_profile', 'firstdomain')){ echo \dash\url::here(). '/domain/search?list=mydomain'; }else{ echo \dash\url::here(). '/domain/buy'; } ?>">
       <div class="key"><?php echo T_('Buy Your First Domain');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'firstdomain')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php if(a($myData, 'complete_profile', 'firstrenew')){ echo \dash\url::here(). '/domain/search?list=renew'; }else{ echo \dash\url::here(). '/domain/renew'; } ?>">
       <div class="key"><?php echo T_('Renew Your First Domain');?></div>
       <div class="go <?php if(a($myData, 'complete_profile', 'firstrenew')){echo 'check ok';}else{echo 'times nok';} ?>"></div>
      </a>
     </li>
    </ul>
   </nav>

   <?php if(\dash\permission::supervisor()) {?>
    <nav class="items long">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom(). '/love' ?>">
       <div class="key"><i class="sf-heartbeat"></i> <?php echo T_('Jibres Management');?></div>
       <div class="go"></div>
      </a>
     </li>

     <li>
      <a class="f" href="<?php echo \dash\url::kingdom(). '/su' ?>">
       <div class="key"><i class="sf-cog"></i> <?php echo T_('Supervisor Panel');?></div>
       <div class="go"></div>
      </a>
     </li>
    </ul>
   </nav>
 <?php } //endif ?>
  </div>
 </div>
