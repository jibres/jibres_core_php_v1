
<div class="avand">

  <div class="msg fs14 primary2 txtB f">
    <div class="c">
      <?php echo T_("Pick a your header template and customize anything. After choose one of them, you can personalize your own unique header by set logo, menu and another features based on your choosen header."); ?>
    </div>
    <div class="cauto"></div>
    <?php if(\dash\request::get()) {?>
    <div class="cauto">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/template"><?php echo T_("Clear filter") ?></a>
    </div>

    <?php } // endif ?>
  </div>
  <?php foreach (\dash\data::headerTemplate() as $key => $value) {?>
    <div class="box mB25-f">
      <header class="f align-center">
        <div class="c">
          <h2><?php echo \dash\get::index($value, 'title'); ?></h2>
        </div>
        <small class="cauto"><?php echo T_("version"). ' '. \dash\fit::number(\dash\get::index($value, 'version')) ?></small>
        <div class="cauto pLa10">
<?php if(\dash\get::index($value, 'key') === \dash\data::issetHeader()) {?>
          <a href="<?php echo \dash\url::that(); ?>" class="btn success"><?php echo T_("Current Template"); ?></a>
<?php }else{ ?>
          <div data-confirm data-data='{"header" : "<?php echo \dash\get::index($value, 'key'); ?>"}' class="btn secondary outline"><?php echo T_("Choose this template"); ?></div>
<?php } //endif ?>
        </div>
      </header>
      <div class="body zeroPad">
        <img class="block" src="<?php echo \dash\get::index($value, 'sample_image'); ?>" alt='<?php echo \dash\get::index($value, 'title'); ?>'>
      </div>
    </div>
  <?php } // endfor ?>


</div>