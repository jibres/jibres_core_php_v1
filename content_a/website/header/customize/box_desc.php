<form method="post" autocomplete="off" class="box impact">
  <header><h2><?php echo T_("Set Description");?></h2></header>
  <div class="body">
    <?php foreach ($box_detail as $key => $value) {?>
	    <label for="iddesc<?php echo \dash\get::index($value, 'name'); ?>"><?php echo T_("Description"); ?></label>
	    <textarea name="<?php echo \dash\get::index($value, 'name'); ?>" id="iddesc<?php echo \dash\get::index($value, 'name'); ?>" class="txt" rows="5"><?php echo \dash\get::index($header_detail, 'current_detail', \dash\get::index($value, 'name')); ?></textarea>
	<?php } //endfor ?>
  </div>
  <footer class="txtRa">
    <button class="btn success"><?php echo T_("Save") ?></button>
  </footer>
</form>


