
<p class="msg danger2 fs16 txtC"><?php echo T_("If you dont know about this page, leave it!"); ?></p>

<?php if(\dash\data::isLockService()) {?>

  <p class="msg danger  fs20 txtB txtC"><?php echo T_("Service is Locked!"); ?></p>

<?php }else{ ?>

  <p class="msg success fs20 txtB txtC"><?php echo T_("Service is Running!"); ?></p>

<?php } //endif ?>

<div class="f">
  <div class="c s12">
    <div class="dcard x2 mB10" data-confirm data-data='{"type" : "lock"}'>
      <div class="statistic red">
        <div class="value"><?php echo T_("Lock"); ?></div>
        <div class="label"><?php echo T_("Lock service"); ?></div>
      </div>
    </div>
  </div>
  <div class="c s12">
    <div class="dcard x2 mB10" data-confirm data-data='{"type" : "pull"}'>
      <div class="statistic yellow">
        <div class="value"><?php echo T_("Pull"); ?></div>
        <div class="label"><?php echo T_("Pull service"); ?> </div>
      </div>
    </div>
  </div>
  <div class="c s12">
    <div class="dcard x2 mB10" data-confirm data-data='{"type" : "upgrade"}'>
      <div class="statistic blue">
        <div class="value"><?php echo T_("Upgrade"); ?></div>
        <div class="label"><?php echo T_("Update database"); ?></div>
      </div>
    </div>
  </div>
  <div class="c s12">
    <div class="dcard x2 mB10" data-confirm data-data='{"type" : "unlock"}'>
      <div class="statistic green">
        <div class="value"><?php echo T_("Unlock"); ?></div>
        <div class="label"><?php echo T_("Unlock service"); ?></div>
      </div>
    </div>
  </div>
</div>

<div class="f">
  <div class="c s6">
    <div class="msg fs14">
    <p><?php echo T_("If you want to show git pull result click below link"); ?></p>
    <a class="btn warn" target="_blank" href="<?php echo \dash\url::this(); ?>?git=all"><?php echo T_("Pull gir repository"); ?></a>
    </div>
  </div>

  <div class="c s6">
    <div class="msg fs14">
    <p><?php echo T_("Talambar CDN"); ?></p>
    <a class="btn success" target="_blank" href="https://cdn.talambar.ir/tmp/update/?hey=CDN"><?php echo T_("Pull CDN repository"); ?></a>
    </div>
  </div>



</div>

<?php if(\dash\data::isLockService()) {?>

<div class="msg fs14">
<p><?php echo T_("Force unlock page"); ?></p>
<a class="btn success" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/forceunlock?force=1"><?php echo T_("Force unlock page"); ?></a>
</div>


<?php } //endif ?>


<?php if(\dash\data::needUpgrade()) {?>
<?php
$needUpgrade = \dash\data::needUpgrade();

?>

  <div class="msg danger2 fs14">
  <p><?php echo T_("Database need to upgrade"); ?></p>
   <div class="f">

    <?php if(isset($needUpgrade['jibres']) && $needUpgrade['jibres']) {?>
      <div class="c">
        <span><?php echo T_("Jibres"); ?></span>
         <div><?php echo T_("current version"); ?><?php echo \dash\get::index($needUpgrade, 'jibres', 'current'); ?></div>
         <div><?php echo T_("new version"); ?><?php echo \dash\get::index($needUpgrade, 'jibres', 'upgrade'); ?></div>
      </div>
    <?php } //endif ?>

    <?php if(isset($needUpgrade['store']) && $needUpgrade['store']) {?>
      <div class="c">
        <span><?php echo T_("Stores"); ?></span>
         <div><?php echo T_("current version"); ?><?php echo \dash\get::index($needUpgrade, 'store', 'current'); ?></div>
         <div><?php echo T_("new version"); ?><?php echo \dash\get::index($needUpgrade, 'store', 'upgrade'); ?></div>
      </div>
    <?php } //endif ?>
   </div>
  </div>
<?php } //endif ?>

<div class="msg fs14">
<p><?php echo T_("Run all step by one click"); ?> <small><?php echo T_("For when you don't have heavy updates"); ?></small></p>
<div class="btn danger txtC xl" data-confirm data-data='{"type" : "all"}'><?php echo T_("Run all"); ?></div>
</div>
<div class="mB50">&nbsp;</div>

