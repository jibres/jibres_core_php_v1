<?php $createYourStore = true; ?>


<?php if($listStore_owner && is_array($listStore_owner)) {?>
  <?php $createYourStore = false; ?>
 <nav class="items">
   <ul>
    <?php foreach ($listStore_owner as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
       <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
       <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
       <div class="go"></div>
      </a>
     </li>
    <?php }//endfor ?>
   </ul>
 </nav>
<?php }//endif ?>

<?php if(\dash\data::listStore_staff() && is_array(\dash\data::listStore_staff())) {?>
 <nav class="items">
   <ul>
    <?php foreach (\dash\data::listStore_staff() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\get::index($value, 'url'); ?>/a">
       <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
       <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
       <div class="go"></div>
      </a>
     </li>
    <?php }//endfor ?>
   </ul>
 </nav>
<?php }//endif ?>





<?php if ($createYourStore) {?>
<div class="welcome">
  <p><?php echo T_("Jibres can painlessly and quickly help you to start your online business."); ?></p>
  <h2><?php echo T_("#1 World Sales Engineering System"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::here(); ?>/store/start"><?php echo T_("Build my own store"); ?></a>
  </div>

  <div class="f salesChannel s0">
    <div class="c3">
      <div class="msg pTB20">
        <h3><?php echo T_("Website"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/store/website"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
    <div class="c3 pLa10">
      <div class="msg pTB20">
        <h3><?php echo T_("Application"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/store/app"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
    <div class="c3 pLa10">
      <div class="msg pTB20">
        <h3><?php echo T_("Sale in store"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/store/pos"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
    <div class="c3 pLa10">
      <div class="msg pTB20">
        <h3><?php echo T_("Telegram bot"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/store/telegram"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
  </div>

</div>
<?php }//endfunction ?>


