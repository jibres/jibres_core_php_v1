<div class="avand cartPage">
	<h1><?php echo T_("Shopping Cart"); ?></h1>
<?php if(\dash\data::dataTable()) {?>
	<div class="row">
		<div class="c-8">
			<div class="box">


<?php foreach (\dash\data::dataTable() as $key => $value) {?>
	<div class="item">
		<div class="row">
			<div class="c-auto">
				<img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
			</div>
			<div class="c">
				<div class="title"><a href="<?php echo \dash\get::index($value, 'url'); ?>"><?php echo \dash\get::index($value, 'title') ?></a></div>
				<div class="availability" data-type='stock'>In Stock</div>

				<div class="row productCountLine">
					<div class="c-auto">
						<div class="input productCount">
							<label class="addon btn" data-ajaxify data-method="post" data-data='{"type": "plus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>+</label>
							<input type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" readonly>
							<label class="addon btn" data-ajaxify data-method="post" data-data='{"type": "minus_cart", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'>-</label>
						</div>
					</div>
					<div class="c">
						<div class="productDel" data-confirm data-data='{"type": "remove", "product_id": "<?php echo \dash\get::index($value, 'product_id') ?>"}'><?php echo T_("Delete") ?></div>
					</div>

				</div>
			</div>
			<div class="c-auto">
          <div class="priceLine">
            <div class="priceShow" data-cart>
              <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span>
							<span class="unit"><?php echo \dash\get::index($value, 'unit'); ?><?php echo \lib\currency::unit(); ?></span>
            </div>
          </div>
			</div>
		</div>
	</div>
<?php } //endfor ?>




			</div>
		</div>
		<div class="c-4">
			<div class="box">
			</div>
		</div>

	</div>
<?php } //endif ?>










<hr>
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