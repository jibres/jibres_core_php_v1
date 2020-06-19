<div class="avand mB10">
	<?php if(!\dash\data::dataRow()) {  /* load all category detail*/ ?>
		<?php $categoryDataTable = \dash\data::categoryDataTable(); ?>

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
<?php } //endif ?>

<?php if(\dash\data::dataRow()) { /* load one category detail*/ ?>
	<div class="cbox">
		<h3><?php echo \dash\data::dataRow_title(); ?></h3>
	</div>
	<?php echo \dash\data::dataRow_desc(); ?>
	<img class="w300" src="<?php echo \dash\data::dataRow_file(); ?>">

	<?php if(\dash\data::productList()) {?>
		<div class="row mT10">

			<?php foreach (\dash\data::productList() as $key => $value) {?>
				<div class="c-xs-12 c-sm-6 c-lg-4 c-xxl-3 pRa10">
					<a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
						<img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
						<footer>
							<div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
							<div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>
						</footer>
					</a>
				</div>
			<?php } //endfor ?>
		</div>
		<?php \dash\utility\pagination::html(); ?>
	<?php } //endif ?>

<?php } //endif ?>
</div>