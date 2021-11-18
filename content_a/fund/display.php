<div class="avand-lg">
	<div class="msg fs14 text-center txtB">
		<?php echo T_("Where are you?") ?>
	</div>
<section class="f">
  <?php foreach (\dash\data::fundList() as $key => $value) {?>
    <div class="c s12">
      <a data-ajaxify data-data='{"fund": "<?php echo a($value, 'id'); ?>"}' data-method='post' href="<?php echo \dash\url::pwd() ?>"  class="stat">
        <h3><?php echo a($value, 'title') ?></h3>
        <div class="val"><?php echo a($value, 'desc'); ?></div>
      </a>
    </div>
  <?php } //endif ?>
</section>
</div>

