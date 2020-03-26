
<div class="msg fs14 primary2 txtB">
  <?php echo T_("Choose your header template"); ?>
</div>
<?php foreach (\dash\data::headerTemplate() as $key => $value) {?>
  <div class="box">
    <header><h2><?php echo \dash\get::index($value, 'title'); ?></h2></header>
    <div class="body">
      <div class="f">
        <div class="c"><?php echo \dash\get::index($value, 'desc'); ?></div>
        <div class="cauto os"><img class="avatar fs50" src="<?php echo \dash\get::index($value, 'sample_image'); ?>"></div>
      </div>
    </div>
    <footer class="txtRa">
      <div data-confirm data-data='{"header" : "<?php echo $key; ?>"}' class="btn success"><?php echo T_("Choose this header"); ?></div>
    </footer>
  </div>
<?php } // endfor ?>

