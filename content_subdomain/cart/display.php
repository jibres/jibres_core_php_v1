<div class="avand">

	<?php if(\dash\data::dataTable()) {?>

		<div class="txtRa">
			<a class="btn success xl w300 " href="<?php echo \dash\url::here() . '/shiping' ?>"><?php echo T_("Continue") ?></a>
		</div>

		<div class="row mT10">

			<?php foreach (\dash\data::dataTable() as $key => $value) {?>
				<div class="c-xs-12 c-sm-6 c-lg-4 c-xxl-3">
					<a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
						<img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
						<footer>
							<div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
							<div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>

							<div class="f jusitfy-center">
								<div class="c"></div>
								<div class="cauto txtC">
									<div class="input">
										<label class="addon btn success2" data-ajaxify data-method="post" data-data='{"type": "plus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>+</label>
										<input type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" readonly>
										<label class="addon btn danger2" data-ajaxify data-method="post" data-data='{"type": "minus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>-</label>
									</div>
								</div>
								<div class="c"></div>
							</div>
							<div data-confirm data-data='{"type": "remove", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}' class="linkDel mT10"><?php echo T_("Remove") ?></div>


						</footer>
					</a>
				</div>
			<?php } //endfor ?>
		</div>
	<?php }else{ // no product in cart ?>
		<div class="msg warn2 txtC txtB fs14"><?php echo T_("No product in your cart") ?></div>
	<?php } //endif ?>
</div>