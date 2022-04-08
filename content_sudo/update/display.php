
<p class="alert-danger font-lg leading-relaxed text-center"><?php echo T_("If you dont know about this page, leave it!"); ?></p>

<?php if(\dash\data::isLockService()) {?>
  <p class="alert-danger fs20 font-bold text-center"><?php echo T_("Service is Locked!"); ?></p>
<?php }else{ ?>
  <p class="alert-success fs20 font-bold text-center"><?php echo T_("Service is Running!"); ?></p>
<?php } //endif ?>

<div class="grid grid-cols-4 gap-1">
    <div class="bg-white rounded-lg my-2 py-2" data-confirm data-data='{"type" : "lock"}'>
      <div class="statistic red">
        <div class="value font-lg leading-relaxed my-2"><?php echo T_("Lock"); ?></div>
        <div class="label"><?php echo T_("Lock service"); ?></div>
      </div>
    </div>
    <div class="bg-white rounded-lg my-2 py-2" data-confirm data-data='{"type" : "pull"}'>
      <div class="statistic yellow">
        <div class="value font-lg leading-relaxed my-2"><?php echo T_("Pull"); ?></div>
        <div class="label"><?php echo T_("Pull service"); ?> </div>
      </div>
    </div>
    <div class="bg-white rounded-lg my-2 py-2" data-confirm data-data='{"type" : "upgrade"}'>
      <div class="statistic blue">
        <div class="value font-lg leading-relaxed my-2"><?php echo T_("Upgrade"); ?></div>
        <div class="label mT5-f">
          <span><?php echo T_("Jibres"); ?> <b><?php echo \dash\fit::text(\dash\data::lastDBVersion_jibres()) ?></b></span> /
          <span><?php echo T_("Business"); ?> <b><?php echo \dash\fit::text(\dash\data::lastDBVersion_store()) ?></b></span>
        </div>
      </div>
    </div>
    <div class="bg-white rounded-lg my-2 py-2" data-confirm data-data='{"type" : "unlock"}'>
      <div class="statistic green">
        <div class="value font-lg leading-relaxed my-2"><?php echo T_("Unlock"); ?></div>
        <div class="label"><?php echo T_("Unlock service"); ?></div>
      </div>
    </div>
</div>

<div class="f">
  <div class="c s6">
    <div class="msg fs14 f">
      <div class="cauto">
          <a class="btn-warning" target="_blank" href="<?php echo \dash\url::this(); ?>?git=all"><?php echo T_("Pull git repository"); ?></a>

      </div>
      <div class="c"></div>
      <div class="cauto">
          <a class="btn-link" target="_blank" href="<?php echo \dash\url::here(); ?>/processlist">Mysql Process List</a>
      </div>
    </div>

  </div>

  <div class="c s6">
    <div class="msg fs14">
      <div class="btn master" data-confirm data-data='{"type": "cdn"}'><?php echo T_("Pull CDN repository"); ?></div>
      <a class="btn-link" href="<?php echo \dash\url::here(). '/tempfile' ?>"><?php echo T_("Temp files") ?></a>
    </div>
  </div>



</div>

<?php if(\dash\data::isLockService()) {?>

<div class="msg fs14">
<p><?php echo T_("Force unlock page"); ?></p>
<a class="btn-success" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/forceunlock?force=1"><?php echo T_("Force unlock page"); ?></a>
</div>


<?php } //endif ?>


<?php if(\dash\data::needUpgrade()) {?>
<?php
$needUpgrade = \dash\data::needUpgrade();

?>

  <div class="alert-danger fs14">
  <p><?php echo T_("Database need to upgrade"); ?></p>
   <div class="f">

    <?php if(isset($needUpgrade['jibres']) && $needUpgrade['jibres']) {?>
      <div class="c">
        <span class="font-bold"><?php echo T_("Jibres"); ?></span>
         <span><?php echo T_("current version"); ?> <b><?php echo a($needUpgrade, 'jibres', 'current'); ?></b></span> >>>
         <span><?php echo T_("new version"); ?> <b><?php echo a($needUpgrade, 'jibres', 'upgrade'); ?></b></span>
      </div>
    <?php } //endif ?>

    <?php if(isset($needUpgrade['store']) && $needUpgrade['store']) {?>
      <div class="c">
        <span class="font-bold"><?php echo T_("Business"); ?></span>
         <span><?php echo T_("current version"); ?> <b><?php echo a($needUpgrade, 'store', 'current'); ?></b></span> >>>
         <span><?php echo T_("new version"); ?> <b><?php echo a($needUpgrade, 'store', 'upgrade'); ?></b></span>
      </div>
    <?php } //endif ?>
   </div>
  </div>
<?php } //endif ?>

<div class="msg font-20 row align-center">
  <div class="c"><?php echo T_("Run all step by one click"); ?> <small><?php echo T_("For when you don't have heavy updates"); ?></small></div>
  <div class="c-auto os">
    <div class="btn-danger text-center" data-confirm data-timeout=0 data-data='{"type" : "all"}'><?php echo T_("Update & Upgrade all"); ?></div>
  </div>
</div>
<div class="mB50">&nbsp;</div>

