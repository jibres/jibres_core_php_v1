<?php require_once(root. 'content_account/address.php'); ?>
<form method="post" autocomplete="off">

	<div class="avand">

		<div class="box">
			<header><h2><?php echo T_("Choose your address") ?></h2></header>
			<div class="body">
				<?php if(\dash\data::addressDataTable()) {?>
					<!-- foreache adddress radio -->
				<?php } // endif ?>

			</div>
		</div>
		<div class="avand-md">
			<h3 data-kerkere2='.addNewAddress' data-kerkere-icon><?php echo T_("Add new address") ?></h3>
			<div class="addNewAddress" data-kerkere-content2='hide'>

				<?php bAddressAdd(); ?>
			</div>

		</div>

		<?php if(\dash\data::dataTable()) {?>

			<div class="row mT10">

				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<div class="c-xs-12 c-sm-6 c-lg-4 c-xxl-3">
						<a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
							<img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
							<footer>
								<div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
								<div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>
								<div class="title"><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></div>

							</footer>
						</a>
					</div>
				<?php } //endfor ?>
			</div>
		<?php }else{ // no product in cart ?>
			<div class="msg warn2 txtC txtB fs14"><?php echo T_("No product in your cart") ?></div>
		<?php } //endif ?>
	</div>
</form>