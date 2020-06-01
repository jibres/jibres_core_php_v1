<div class="avand-lg">
	<div class="msg fs14 txtC txtB">
		<?php echo T_("Where are you?") ?>
	</div>
<section class="f">
  <?php foreach (\dash\data::fundList() as $key => $value) {?>
    <div class="c s12">
      <a data-ajaxify data-data='{"fund": "<?php echo \dash\get::index($value, 'id'); ?>"}' data-method='post' href="<?php echo \dash\url::pwd() ?>"  class="stat">
        <h3><?php echo \dash\get::index($value, 'title') ?></h3>
        <div class="val"><?php echo \dash\get::index($value, 'desc'); ?></div>
      </a>
    </div>
  <?php } //endif ?>
</section>
</div>

