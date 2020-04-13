<?php $myData = \dash\data::dashboardDetail(); ?>

 <div class="f">
  <div class="c9 s12">
   <div class="f">
    <div class="c6">
<?php
$listStore_owner = \dash\data::listStore_owner();
if($listStore_owner && is_array($listStore_owner))
{
?>
     <nav class="items">
      <ul>
       <li class="pA10"><?php echo T_("Bussiness that you are owner"); ?></li>
<?php foreach ($listStore_owner as $key => $value) {?>
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
      </ul>
     </nav>
<?php }//endif ?>
    </div>
    <div class="c6">
<?php
$listStore_staff = \dash\data::listStore_staff();
if($listStore_staff && is_array($listStore_staff))
{
?>
     <nav class="items">
      <ul>
       <li class="pA10"><?php echo T_("Bussiness that you are staff"); ?></li>
<?php foreach ($listStore_staff as $key => $value) {?>
       <li>
        <a class="f" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
         <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
         <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
         <div class="value"><?php echo \dash\get::index($value, 'subdomain'); ?></div>
         <div class="go"></div>
        </a>
       </li>
<?php }//endfor ?>
      </ul>
     </nav>
<?php }//endif ?>
    </div>
   </div>

  </div>


  <div class="c3 s12">

   <section class="circularChartBox">
    <?php $myPercent2=40;$myColor2='blue';include core.'\layout\elements\circularChart.php';?>
    <h3><?php echo T_("Profile Status");?></h3>
   </section>


   <nav class="items">
    <ul>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/domain">
       <div class="key"><?php echo T_('Domain Center');?></div>
       <div class="value">8</div>
       <div class="go"></div>
      </a>
     </li>
     <li>
      <a class="f" href="<?php echo \dash\url::here();?>/domain/buy">
       <div class="key"><?php echo T_('Buy New Domain');?></div>
       <div class="go"></div>
      </a>
     </li>
    </ul>
   </nav>
  </div>
 </div>


    <section class="f">
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search" class="stat">
       <h3><?php echo T_("Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search?" class="stat">
       <h3><?php echo T_("Account Balance");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
     <div class="c">
      <a href="<?php echo \dash\url::this() ?>/search?" class="stat">
       <h3><?php echo T_("Inter");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
    </section>

