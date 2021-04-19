<div class="avand">
  <?php if(\dash\data::pagebuilderMode() === 'header') {?>
    <div class="msg info2 fs14"><?php echo T_("Please choose header."); ?></div>
  <?php }else{ ?>
    <div class="msg info2 fs14"><?php echo T_("Please choose footer."); ?></div>
  <?php } //endif ?>
<?php foreach(\dash\data::lineList() as $key => $value) {?>
<section class="f" data-option='website-<?php echo a($value, 'key'); ?>'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo a($value, 'title');?></h3>
      <div class="body">
        <p><?php echo a($value, 'description') ?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <div data-ajaxify data-data='{"line" : "new", "key": "<?php echo a($value, 'key') ?>"}' class="btn primary block"><?php echo a($value, 'btn_title') ?></div>
    </div>
  </div>
</section>
<?php } //endif ?>