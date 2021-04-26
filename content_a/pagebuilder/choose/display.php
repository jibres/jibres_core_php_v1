<?php $current_active = \dash\url::subchild(); ?>
<div class="avand">
  <?php if(\dash\data::pagebuilderMode() === 'header') {?>
    <div class="msg info2 fs14"><?php echo T_("Pick a your header template and customize anything. After choose one of them, you can personalize your own unique header by set logo, menu and another features based on your choosen header."); ?></div>
  <?php }else{ ?>
    <div class="msg info2 fs14"><?php echo T_("Pick a your footer template and customize anything. After choose one of them, you can personalize your own unique footer by set logo, menu and another features based on your choosen footer."); ?></div>
  <?php } //endif ?>
<?php foreach(\dash\data::lineList() as $key => $value) {?>
<section class="f" data-option='website-<?php echo a($value, 'key'); ?>'>
  <div class="c6 s12">
    <div class="data">
      <h3><?php echo a($value, 'title');?></h3>
      <div class="body">

        <p><?php echo a($value, 'description') ?></p>
      </div>
    </div>
  </div>
  <div class="c2 s12">
    <?php if(a($value, 'sample_image')) {?>
    <div class="mT10">
      <img src="<?php echo a($value, 'sample_image') ?>">
    </div>
  <?php } //endif ?>
  </div>
  <div class="c4 s12">
    <div class="action">
        <?php if(a($value, 'key') === $current_active) {?>
          <div class="btn block"><?php echo T_("Current Template") ?></div>
        <?php }else{ ?>
          <div data-ajaxify data-data='{"line" : "new", "key": "<?php echo a($value, 'key') ?>"}' class="btn primary block"><?php echo a($value, 'btn_title') ?></div>
        <?php } //endif ?>
    </div>
  </div>
</section>
<?php } //endif ?>