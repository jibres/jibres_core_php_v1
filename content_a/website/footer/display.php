
<div class="msg fs14 primary2 txtB">
  <?php echo T_("Choose your footer template"); ?>
</div>
<?php foreach (\dash\data::footerTemplate() as $key => $value) {?>
  <div class="box">
    <footer><h2><?php echo \dash\get::index($value, 'title'); ?></h2></footer>
    <div class="body">
      <div class="f">
        <div class="c"><?php echo \dash\get::index($value, 'desc'); ?></div>
        <div class="cauto os"><img class="avatar fs50" src="<?php echo \dash\get::index($value, 'sample_image'); ?>"></div>
      </div>
    </div>
    <footer class="txtRa">
      <div data-confirm data-data='{"footer" : "<?php echo \dash\get::index($value, 'key'); ?>"}' class="btn success"><?php echo T_("Choose this footer"); ?></div>
    </footer>
  </div>
<?php } // endfor ?>

