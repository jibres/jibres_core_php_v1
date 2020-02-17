
<?php
$listStore_owner = \dash\data::listStore_owner();
if(!is_array($listStore_owner))
{
  $listStore_owner = [];
}

if($listStore_owner)
{
  if(count($listStore_owner) > 3)
  {
    myStoresOwner3Plus();
  }
  else
  {
    myStoresOwner();
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
    <a href='<?php echo @$value['url']; ?>/a' class="scard">
      <img src="<?php echo @$value['logo']; ?>" alt="<?php echo @$value['title']; ?>">
      <div class="body">
        <h2><?php echo @$value['title']; ?></h2>
        <div class="position txtRa">
          <span class="badge light s0"><?php echo T_("From"); ?> <?php echo \dash\fit::date(@$value['datecreated']); ?></span>
          <span class="badge light"><?php echo T_("Staff"); ?></span>
        </div>
        <div class="addr"><b><?php echo @$value['subdomain']; ?></b><span class="fc-mute fs09">.Jibres.<?php echo \dash\url::tld(); ?></span></div>
      </div>
    </a>
  </div>
  <?php }//endfor ?>

</div>

  <?php }//endif ?>

<?php }//endfunction ?>





<?php function myStoresOwner() {?>

  <?php if(\dash\data::listStore_owner() && is_array(\dash\data::listStore_owner())) {?>



<div class="f listOfStores">
    <?php foreach (\dash\data::listStore_owner() as $key => $value) {?>

  <div class="c6 x4 s12 pRa10">
    <a href='<?php echo @$value['url']; ?>/a' class="scardLarge grBlue3">
      <img src="<?php echo @$value['logo']; ?>" alt="<?php echo @$value['title']; ?>">
      <h2><?php echo @$value['title']; ?></h2>
      <div class="f summary">
        <div class="c4"><?php echo \dash\fit::number(@$value['product']). ' '. T_("Product"); ?></div>
        <div class="c4 pLR5"><?php echo \dash\fit::number(@$value['customer']). ' '. T_("Customer"); ?></div>
        <div class="c4"><?php echo \dash\fit::number(@$value['factor']). ' '. T_("Factor"); ?></div>
      </div>
      <div class="f meta">
        <div class="c6 s12 txtLa"><?php if(isset($value['lastactivity'])) { echo \dash\fit::date_human($value['lastactivity']); }?></div>
        <div class="c6 s12 txtRa"><?php echo T_("Created on"). ' '. \dash\fit::date(@$value['datecreated']); ?></div>
      </div>
      <div class="f meta">
        <div class="c">
          <span class="badge {%if admin%}primary{%else%}light{%endif%}"><?php echo T_("Owner"); ?></span>
        </div>
        <div class="cauto os">
          <div class="addr ltr"><b><?php echo @$value['subdomain']; ?></b><span>.Jibres.<?php echo \dash\url::tld(); ?></span></div>
        </div>
      </div>
    </a>
  </div>
  <?php }//endfor ?>
</div>

<?php }//endif ?>

<?php }//endfunction ?>











<?php function myStoresOwner3Plus() {?>
  <?php if(\dash\data::listStore_owner() && is_array(\dash\data::listStore_owner())) {?>

<div class="f listOfStores">
  <?php foreach (\dash\data::listStore_owner() as $key => $value) {?>

  <div class="c4 xauto s12 pRa10">
    <a href='<?php echo @$value['url']; ?>/a' class="scard">
      <img src="<?php echo @$value['logo']; ?>" alt="<?php echo @$value['title']; ?>">
      <div class="body">
        <h2><?php echo @$value['title']; ?></h2>
        <div class="position txtRa">
          <span class="badge light s0"><?php echo T_("From"); ?> <?php echo \dash\fit::date(@$value['datecreated']); ?></span>
          <span class="badge light"><?php echo T_("Owner"); ?></span>
        </div>
        <div class="addr"><b><?php echo @$value['subdomain']; ?></b><span class="fc-mute fs09">.Jibres.<?php echo \dash\url::tld(); ?></span></div>
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
    <a class="btn xl master" href="<?php echo \dash\url::here(); ?>/start" data-direct><?php echo T_("Build my own store"); ?></a>
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


