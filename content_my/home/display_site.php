<?php $myData = \dash\data::dashboardDetail(); ?>

 <div class="f">
  <div class="c9 s12 pRa10">

    <section class="f">
     <div class="c pRa10">
      <a href="" class="stat">
       <h3><?php echo T_("Bussiness");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::here() ?>/domain" class="stat">
       <h3><?php echo T_("Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
     <div class="c">
      <a href="<?php echo \dash\url::here() ?>/search?" class="stat">
       <h3><?php echo T_("Account Balance");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
    </section>


   <div class="f">
    <div class="c6 s12 pRa10">
     <nav class="items">
      <ul>
       <li class="pA10"><?php echo T_("Bussiness that you are owner"); ?></li>
<?php
$listStore_owner = \dash\data::listStore_owner();
if($listStore_owner && is_array($listStore_owner))
{
 foreach ($listStore_owner as $key => $value) {?>
       <li>
        <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
         <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
         <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
         <div class="value"><?php echo \dash\get::index($value, 'subdomain'); ?></div>
         <div class="go"></div>
        </a>
       </li>
<?php }//endfor ?>
       <li>
        <a class="f" href="<?php echo \dash\url::here(); ?>/store/start">
         <img src="<?php echo \dash\url::icon();?>" alt="<?php echo T_("Add New Business");?>">
         <div class="key"><?php echo T_("Add New Business");?></div>
         <div class="go plus"></div>
        </a>
       </li>
<?php }//endif ?>
      </ul>
     </nav>
    </div>

    <div class="c6 s12">
     <nav class="items">
      <ul>
       <li class="pA10"><?php echo T_("Bussiness that you are staff"); ?></li>
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
         <div class="go"></div>
        </a>
       </li>
<?php }//endfor ?>
<?php } else { //endif ?>
       <li class="pA10"><div class="msg"><?php echo T_("You are not staff yet!"); ?></div></li>
<?php }//endif ?>
      </ul>
     </nav>
    </div>
   </div>

  </div>


  <div class="c3 s12">

   <section class="circularChartBox">
    <?php $myPercent=40;include core.'/layout/elements/circularChart.php';?>
    <h3><?php echo T_("Account Status");?></h3>
   </section>

   <nav class="items">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my">
       <div class="key"><?php echo T_('Mobile');?></div>
       <div class="go check ok"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/email">
       <div class="key"><?php echo T_('Email');?></div>
       <div class="go times nok"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/username">
       <div class="key"><?php echo T_('Username');?></div>
       <div class="go times nok"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/profile">
       <div class="key"><?php echo T_('Birthday');?></div>
       <div class="go times nok"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/my/avatar">
       <div class="key"><?php echo T_('Avatar');?></div>
       <div class="go check ok"></div>
      </a>
     </li>
    </ul>
   </nav>

   <nav class="items">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/store/start">
       <div class="key"><?php echo T_('Add Your First Bussiness');?></div>
       <div class="go ok check"></div>
      </a>
     </li>
     <li>
      <a class="f" href="">
       <div class="key"><?php echo T_('Add Your First Product');?></div>
       <div class="go nok times"></div>
      </a>
     </li>
     <li>
      <a class="f" href="">
       <div class="key"><?php echo T_('Sale Your First Invoice');?></div>
       <div class="go nok times"></div>
      </a>
     </li>
   </ul>
  </nav>

   <nav class="items">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/domain/buy">
       <div class="key"><?php echo T_('Buy Your First Domain');?></div>
       <div class="go ok check"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/domain/renew">
       <div class="key"><?php echo T_('Renew Your First Domain');?></div>
       <div class="go nok times"></div>
      </a>
     </li>
    </ul>
   </nav>

   <nav class="items">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::kingdom();?>/account/billing">
       <div class="key"><?php echo T_('Add First Money');?></div>
       <div class="go nok times"></div>
      </a>
     </li>
    </ul>
   </nav>

  </div>
 </div>
