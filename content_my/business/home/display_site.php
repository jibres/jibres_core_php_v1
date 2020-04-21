<?php

if($listStore_owner)
{
  if(count($listStore_owner) > 3)
  {
    myStoresOwner3Plus($listStore_owner);
  }
  else
  {
    myStoresOwner($listStore_owner);
  }
}
else
{
  createYourStore();
}

myStores();

?>




<?php function myStores() {?>

  <?php if(\dash\data::listStore_staff() && is_array(\dash\data::listStore_staff())) {?>

<div class="f listOfStores">

  <?php foreach (\dash\data::listStore_staff() as $key => $value) {?>

  <div class="c4 xauto s12 pRa10">
    <a href='<?php echo \dash\get::index($value, 'url'); ?>/a' class="scard">
      <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
      <div class="body">
        <h2><?php echo \dash\get::index($value, 'title'); ?></h2>
        <div class="position txtRa">
          <span class="badge light s0"><?php echo T_("From"); ?> <?php echo \dash\fit::date(\dash\get::index($value, 'datecreated')); ?></span>
          <span class="badge light"><?php echo T_("Staff"); ?></span>
        </div>
        <div class="addr"><b><?php echo \dash\get::index($value, 'subdomain'); ?></b><span class="fc-mute fs09">.Jibres.<?php echo \dash\url::tld(); ?></span></div>
      </div>
    </a>
  </div>
  <?php }//endfor ?>

</div>

  <?php }//endif ?>

<?php }//endfunction ?>





<?php function myStoresOwner($listStore_owner) {?>

  <?php if($listStore_owner && is_array($listStore_owner)) {?>
<div class="f listOfStores">
    <?php foreach ($listStore_owner as $key => $value) {?>

  <div class="c6 x4 s12 pRa10">
    <a href='<?php echo \dash\get::index($value, 'url'); ?>/a' class="scardLarge grBlue3">
      <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
      <h2><?php echo \dash\get::index($value, 'title'); ?></h2>
      <div class="f summary">
        <div class="c4"><?php echo \dash\fit::number(\dash\get::index($value, 'product')). ' '. T_("Product"); ?></div>
        <div class="c4 pLR5"><?php echo \dash\fit::number(\dash\get::index($value, 'customer')). ' '. T_("Customer"); ?></div>
        <div class="c4"><?php echo \dash\fit::number(\dash\get::index($value, 'factor')). ' '. T_("Factor"); ?></div>
      </div>
      <div class="f meta">
        <div class="c6 s12 txtLa"><?php if(isset($value['lastactivity'])) { echo \dash\fit::date_human($value['lastactivity']); }?></div>
        <div class="c6 s12 txtRa"><?php echo T_("Created on"). ' '. \dash\fit::date(\dash\get::index($value, 'datecreated')); ?></div>
      </div>
      <div class="f meta">
        <div class="c">
          <span class="badge light"><?php echo T_("Owner"); ?></span>
        </div>
        <div class="cauto os">
          <div class="addr ltr"><b><?php echo \dash\get::index($value, 'subdomain'); ?></b></div>
        </div>
      </div>
    </a>
  </div>
  <?php }//endfor ?>
</div>

<?php }//endif ?>

<?php }//endfunction ?>









<?php function myStoresOwner3Plus($listStore_owner) {?>
  <?php if($listStore_owner && is_array($listStore_owner)) {?>

<div class="f listOfStores">
  <?php foreach ($listStore_owner as $key => $value) {?>

  <div class="c4 xauto s12 pRa10">
    <a href='<?php echo \dash\get::index($value, 'url'); ?>/a' class="scard">
      <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
      <div class="body">
        <h2><?php echo \dash\get::index($value, 'title'); ?></h2>
        <div class="position txtRa">
          <span class="badge light s0"><?php echo T_("From"); ?> <?php echo \dash\fit::date(\dash\get::index($value, 'datecreated')); ?></span>
          <span class="badge light"><?php echo T_("Owner"); ?></span>
        </div>
        <div class="addr"><b><?php echo \dash\get::index($value, 'subdomain'); ?></b><span class="fc-mute fs09">.Jibres.<?php echo \dash\url::tld(); ?></span></div>
      </div>
    </a>
  </div>
  <?php }//endfor ?>
</div>
<?php }//endif ?>
<?php }//endfunction ?>



<?php function createYourStore() {?>
<div class="welcome">
  <p><?php echo T_("Jibres can painlessly and quickly help you to start your online business."); ?></p>
  <h2><?php echo T_("#1 World Sales Engineering System"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::here(); ?>/business/start"><?php echo T_("Build my own business"); ?></a>
  </div>

  <div class="f salesChannel s0">
    <div class="c3">
      <div class="msg pTB20">
        <h3><?php echo T_("Website"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/business/website"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
    <div class="c3 pLa10">
      <div class="msg pTB20">
        <h3><?php echo T_("Application"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/business/app"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
    <div class="c3 pLa10">
      <div class="msg pTB20">
        <h3><?php echo T_("Sale in business"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/business/pos"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
    <div class="c3 pLa10">
      <div class="msg pTB20">
        <h3><?php echo T_("Telegram bot"); ?></h3>
        <a target="_blank" href="<?php echo \dash\url::support(); ?>/business/telegram"><?php echo T_("Read more"); ?></a>
      </div>
    </div>
  </div>

</div>
<?php }//endfunction ?>


