<?php if(!\dash\data::dataRow()) {  /* load all category detail*/ ?>
<?php $categoryDataTable = \dash\data::categoryDataTable(); ?>

<div class="avand mB10">
  <div class="row">
	<?php foreach ($categoryDataTable as $key => $value) {?>
    	<div class="c-xs-12 c-sm-6 c-lg-4 c-xxl-3 pRa5">
			 <a<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
				<img class="radius5px" src="<?php echo \dash\get::index($value, 'file'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
				<?php echo \dash\get::index($value, 'title'); ?>
			</a>
		</div>
	<?php } //endif ?>
  </div>
  <?php \dash\utility\pagination::html(); ?>
</div>
<?php } //endif ?>

<?php if(\dash\data::dataRow()) { /* load one category detail*/ ?>

<?php } //endif ?>